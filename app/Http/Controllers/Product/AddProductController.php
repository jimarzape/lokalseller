<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\MainController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BrandModel;
use App\Models\ProductModel;
use App\Models\ProductImage;
use App\Models\StockModel;
use App\Models\SystemLogs;
use Validator;
use Auth;

class AddProductController extends MainController
{
    public function __construct()
    {
        parent::__construct();
    	$this->data['_pages'] = pages('Products','Add Products');
    }

    public function index()
    {
        $this->data['_brands'] = BrandModel::details(Auth::user()->id)->get();
    	return view('products.add', $this->data);
    }

    public function save(Request $request)
    {
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
            }

            $brand_data     =  BrandModel::where('brand_id', $request->brand_id)->first();
            $brand_identifier = '';
            if(!is_null($brand_data))
            {
                $brand_identifier = $brand_data->brand_identifier;
            }

            $product_identifier = Auth::user()->id.date('YmdHis');

            $product                        = new ProductModel;
            $product->sku                   = $request->sku;
            $product->product_identifier    = $product_identifier;
            $product->product_name          = $request->product_name;
            $product->product_image         = isset($path_img[0]) ? $path_img[0] : '';
            $product->brand_identifier      = $brand_identifier;
            $product->product_timestamp     = date('Y-m-d H:i:s');
            $product->product_price         = $request->product_price;
            $product->brand_id              = $request->brand_id;
            $product->product_specification = $request->product_specification;
            $product->product_desc          = $request->product_desc;
            $product->seller_id             = Auth::user()->id;
            $product->save();

            foreach($path_img as $img)
            {
                $saveImg                = new ProductImage;
                $saveImg->product_id    = $product->product_id;
                $saveImg->image_url     = $img;
                $saveImg->save();
            }

            $_sizes = $request->sizes;
            foreach($_sizes as $key => $size)
            {
                if($request->weight[$key] <= 0 && $request->price[$key] <= 0 && $request->stocks[$key] <= 0)
                {

                }
                else
                {
                    $stocks                     = new StockModel;
                    $stocks->product_id         = $product->product_id;
                    $stocks->stocks_size        = $size;
                    $stocks->product_identifier = $product_identifier;
                    $stocks->stocks_quantity    = $request->stocks[$key];
                    $stocks->stocks_weight      = $request->weight[$key];
                    $stocks->stocks_price       = $request->price[$key];
                    $stocks->save();
                }
            }


            $logs               = new SystemLogs;
            $logs->seller_id    = Auth::user()->id;
            $logs->logs         = 'Created new product <u>'.$request->product_name.'</u>';
            $logs->save();

            $success['message'] = 'New Item has been inserted successfully.';
            return back()->with('success' , 'New Item has been inserted successfully.', 200);
        }
        else
        {
            $error['images'][0] = 'Image is required.';
            return back()->withInput($request->input())
                         ->with('errors' , $error, 400);
        }
    }
}
