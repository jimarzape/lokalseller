<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\MainController;
use Illuminate\Http\Request;
use App\Models\ProductModel;
use App\Models\BrandModel;
use App\Models\ProductImage;
use App\Models\StockModel;
use App\Models\StockLogs;
use Crypt;
use Auth;
use Validator;
use DB;

class ManageProductController extends MainController
{
    public function __construct()
    {
        
        parent::__construct();
    	$this->data['_pages'] = pages('Products','Manage Products');
    }

    public function index()
    {
    	$this->data['_items'] = ProductModel::brands()->stocks()
                                              ->details(Auth::user()->id)
                                              ->select('products.*','brands.brand_name',DB::raw('sum(stocks_quantity) as stocks'))
                                              ->groupBy('products.product_id')
                                              ->paginate(20);
        $this->data['_brand'] = BrandModel::where('owner_id', Auth::user()->id)->orderBy('brand_name')->get();
    	return view('products.manage', $this->data);
    }

    public function status(Request $request)
    {
        try
        {
            $data = ProductModel::where('product_id', $request->id)->first();
            if(is_null($data))
            {
                $message = "No data found";
                return response()->json($message, 400);
            }
            else
            {

                $update                 = new ProductModel;
                $update->exists         = true;
                $update->product_id     = $request->id;
                $update->product_active = $data->product_active == 1 ? 0 : 1;
                $update->save();

                $return['message']  = 'Product has been '.($data->product_active == 1 ? 'deactivated.' : 'activated.');
                $return['status']   = $data->product_active == 1 ? 0 : 1;
                return response()->json($return, 200);
            }
        }
        catch(\Exception $e)
        {
            return response()->json($e->getMessage(), 500);
        }
        
    }

    public function edit($product_id)
    {
        $product_id = Crypt::decrypt($product_id);
        $this->data['product'] = ProductModel::where('product_id', $product_id)->first();
        $this->data['_images'] = ProductImage::where('product_id', $product_id)->get();
        $this->data['_brands'] = BrandModel::details(Auth::user()->id)->get();
        $_attr      = attributes();
        $attr_array = array();
        foreach($_attr as $attr)
        {
            $temp['size']       = $attr;
            $temp['weight']     = 0;
            $temp['price']      = 0;
            $temp['stocks']     = 0;
            $temp['attr_id']    = null;

            /* check if exists */
            $stocks = StockModel::where('product_id', $product_id)->where('stocks_size', $attr)->first();
            if(!is_null($stocks))
            {
                $temp['weight']     = $stocks->stocks_weight;
                $temp['price']      = $stocks->stocks_price;
                $temp['stocks']     = $stocks->stocks_quantity;
                $temp['attr_id']    = $stocks->id;
            }

            array_push($attr_array, $temp);
        }
        // dd($attr_array);
        $this->data['_attr'] = $attr_array;
        return view('products.edit', $this->data);
    }

    public function update(Request $request)
    {
        $_preloaded = $request->preloaded;
        $arr_img = array();
        foreach($_preloaded as $pre)
        {
            $img_pre = explode('-', $pre);
            if(count($img_pre) > 1)
            {
                array_push($arr_img, $img_pre[0]);
            }
        }

        ProductImage::where('product_id', $request->product_id)
                    ->whereNotIn('product_image_id', $arr_img)
                    ->delete();

        if($request->has('images'))
        {
            $_images = $request->file('images');
            $path_img = array();
            foreach($_images as $image)
            {
                $image          = $request->file('images');
                $count          = count($image) - 1;
                $file           = $image[$count];
                $fileArray      = array('images' => $file);
                $rules          = array(
                  'images' => 'mimes:jpeg,jpg,png,gif|required|max:10000' // max 10000kb
                );
                $validator = Validator::make($fileArray, $rules);
                if ($validator->fails())
                {
                    return back()->withInput($request->input())
                                 ->with(['errors' => $validator->errors()->getMessages()], 400);
                }

                $upload_path = '/uploads/brands';
                if($request->folder){ $upload_path = $request->folder; }
                $name               = str_randoms(5).time().'.'.$image[$count]->getClientOriginalExtension();
                $destinationPath    = public_path($upload_path);
                $image[$count]->move($destinationPath, $name);
                $path               = url($upload_path.'/'.$name);
                array_push($path_img, $path);

                $saveImg                = new ProductImage;
                $saveImg->product_id    = $request->product_id;
                $saveImg->image_url     = $path;
                $saveImg->save();
            }
        }

        $product                        = new ProductModel;
        $product->exists                = true;
        $product->product_id            = $request->product_id;
        $product->sku                   = $request->sku;
        $product->product_name          = $request->product_name;
        if(isset($path_img[0]))
        {
            $product->product_image         = $path_img[0];
        }
        $product->brand_identifier      = '';
        $product->product_timestamp     = date('Y-m-d H:i:s');
        $product->product_price         = $request->product_price;
        $product->brand_id              = $request->brand_id;
        $product->product_specification = $request->product_specification;
        $product->product_desc          = $request->product_desc;
        $product->seller_id             = Auth::user()->id;
        $product->save();

        
        $data = ProductModel::where('product_id', $request->product_id)->first();

        // $_sizes = $request->sizes;
        // foreach($_sizes as $key => $size)
        // {
        //     if($request->weight[$key] <= 0 && $request->price[$key] <= 0 && $request->stocks[$key] <= 0 && $request->stock_id[$key] != null)
        //     {

        //     }
        //     else
        //     {
        //         $stocks                     = new StockModel;
        //         if($request->stock_id[$key] != null)
        //         {
        //             $stocks->exists         = true;
        //             $stocks->id             = $request->stock_id[$key];
        //         }
        //         $stocks->product_id         = $product->product_id;
        //         $stocks->stocks_size        = $size;
        //         $stocks->product_identifier = $data->product_identifier;
        //         $stocks->stocks_quantity    = $request->stocks[$key];
        //         $stocks->stocks_weight      = $request->weight[$key];
        //         $stocks->stocks_price       = $request->price[$key];
        //         $stocks->save();
        //     }
        // }
        return redirect()->route('product.manage');
    }

    public function archived(Request $request)
    {
        $product                    = new ProductModel;
        $product->exists            = true;
        $product->product_id        = $request->id;
        $product->product_archived  = 1;
        $product->save();
    }

    public function new_stocks(Request $request)
    {
        $data['product_id'] = $request->id;
        return view('products.stocks',$data);
    }

    public function save_stock(Request $request)
    {
        try
        {
            $_sizes = $request->sizes;
            $product_data = ProductModel::where('product_id', $request->product_id)->first();
            $product_identifier = $product_data->product_identifier;
            foreach($_sizes as $key => $size)
            {
                if($request->weight[$key] <= 0 && $request->price[$key] <= 0 && $request->stocks[$key] <= 0)
                {

                }
                else
                {
                    $check                      = StockModel::where('product_id', $request->product_id)->where('stocks_size', $size)->first();
                    $qty                        = $request->stocks[$key];
                    $stock_id                   = 0;
                    $stocks                     = new StockModel;
                    if(!is_null($check))
                    {
                        $stock_id               = $check->id;
                        $stocks->exists         = true;
                        $stocks->id             = $stock_id;
                        $qty                    = $check->stocks_quantity + $request->stocks[$key];
                    }
                    $stocks->product_id         = $request->product_id;
                    $stocks->stocks_size        = $size;
                    $stocks->product_identifier = $product_identifier;
                    $stocks->stocks_quantity    = $qty;
                    $stocks->stocks_weight      = $request->weight[$key];
                    $stocks->stocks_price       = $request->price[$key];
                    $stocks->save();
                    if(is_null($check))
                    {
                        $stock_id = $stocks->id;
                    }

                    $logs               = new StockLogs;
                    $logs->product_id   = $request->product_id;
                    $logs->stock_id     = $stock_id;
                    $logs->seller_id    = Auth::user()->id;
                    $logs->stock_qty    = $request->stocks[$key];
                    $logs->stock_price  = $request->price[$key];
                    $logs->stock_weight = $request->weight[$key];
                    $logs->save();
                }
            }
        }
        catch(\Exception $e)
        {
            return response()->json($e->getMessage(), 500);
        }
        
    }
}
