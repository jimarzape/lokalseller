<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\MainController;
use Illuminate\Http\Request;
use App\Models\ProductModel;
use App\Models\BrandModel;
use App\Models\ProductImage;
use App\Models\StockModel;
use App\Models\StockLogs;
use App\Models\SystemLogs;
use App\Models\OnSale;
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

    public function index(Request $request)
    {
        $_items = ProductModel::brands()->stocks()
                              ->details(Auth::user()->id)
                              ->leftjoin('is_on_sale','is_on_sale.product_id','products.product_id');
        if($request->has('search'))
        {
            $_items = $_items->where('products.product_name','like','%'.$request->search.'%');
        }
        if($request->has('brand'))
        {
            if($request->brand != 'all')
            {
                $_items = $_items->where('products.brand_id', $request->brand);
            }
        }
        $_items = $_items->select('products.*','is_on_sale.sale_price','brands.brand_name',DB::raw('sum(stocks_quantity) as stocks'))
                            ->groupBy('products.product_id')
                            ->paginate(20);

        $this->data['_items'] = $_items;
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
                $data = ProductModel::where('product_id', $request->id)->first();

                $update                 = new ProductModel;
                $update->exists         = true;
                $update->product_id     = $request->id;
                $update->product_active = $data->product_active == 1 ? 0 : 1;
                $update->save();
                $status             = $data->product_active == 1 ? 'deactivated' : 'activated';
                $logs               = new SystemLogs;
                $logs->seller_id    = Auth::user()->id;
                $logs->logs         = strtoupper($status).' <u>'.$data->product_name.'</u>';
                $logs->save();

                $return['message']  = 'Product has been '.$status.'.';
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
        $this->data['sale']    = OnSale::where('product_id', $product_id)->first();
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
        // dd($product_id);
        // dd($this->data['sale']);
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

        $brand_data     =  BrandModel::where('brand_id', $request->brand_id)->first();
        $brand_identifier = '';
        if(!is_null($brand_data))
        {
            $brand_identifier = $brand_data->brand_identifier;
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
        $product->brand_identifier      = $brand_identifier;
        $product->product_timestamp     = date('Y-m-d H:i:s');
        $product->product_price         = $request->product_price;
        $product->brand_id              = $request->brand_id;
        $product->product_specification = $request->product_specification;
        $product->product_desc          = $request->product_desc;
        $product->seller_id             = Auth::user()->id;
        $product->save();
        
        $data = ProductModel::where('product_id', $request->product_id)->first();
        return redirect()->route('product.manage');
    }

    public function archived(Request $request)
    {
        $data                       = ProductModel::where('product_id', $request->id)->first();
        $product                    = new ProductModel;
        $product->exists            = true;
        $product->product_id        = $request->id;
        $product->product_archived  = 1;
        $product->save();

        $logs = new SystemLogs;
        $logs->seller_id = Auth::user()->id;
        $logs->logs = 'Deleted <u>'.$data->product_name.'</u>';
        $logs->save();
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

    public function stock_logs($product_id)
    {
        $product_id = Crypt::decrypt($product_id);
        $this->data['product'] = ProductModel::where('product_id',$product_id)->first();
        $this->data['_logs'] = StockLogs::select('*','product_stock_logs.created_at as date_logs')
                                        ->where('product_stock_logs.product_id',$product_id)
                                        ->leftjoin('stocks','stocks.id','product_stock_logs.stock_id')
                                        ->orderBy('stock_log_id','desc')
                                        ->paginate(20);
        return view('products.logs', $this->data);
    }

    public function put_sale(Request $request)
    {
        $product = ProductModel::where('product_id', $request->id)->first();
        $slash = OnSale::where('product_id', $request->id)->first();
        $data['product_id'] = $request->id;
        $data['product_price'] = isset($product->product_price) ? $product->product_price : 0;
        $data['slash_price'] = isset($slash->sale_price) ? $slash->sale_price : 0;
        return view('products.sale',$data); 
    }

    public function update_sale(Request $request)
    {
        $product_id             = $request->product_id;
        $update                 = new ProductModel;
        $update->exists         = true;
        $update->product_id     = $product_id;
        $update->product_price  = $request->product_price;
        $update->save();

        $data                   = ProductModel::where('product_id', $product_id)->first();

        OnSale::where('product_id',$product_id)->delete();

        $log_string = $data->product_name.' reverted to original price ('.number_format($request->product_price, 2).')';

        if($request->slash != '' && $request->slash > 0 && !is_null($request->slash))
        {
            $sale                       = new OnSale;
            $sale->product_identifier   = $data->product_identifier;
            $sale->sale_price           = $request->slash;
            $sale->product_id           = $product_id;
            $sale->save();
            $log_string = $data->product_name.' put to sale price ('.number_format($request->product_price, 2).')';
        }

        $logs                   = new SystemLogs;
        $logs->seller_id        = Auth::user()->id;
        $logs->logs             = $log_string;
        $logs->save();
    }
}
