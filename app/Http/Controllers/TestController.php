<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BrandModel;
use App\Models\ProductModel;
use App\Models\ProductImage;
use App\Models\Sellers;
use App\Models\StockModel;
use App\Models\CartModel;
use App\Models\OrderModel;
use App\Models\City;
use App\Models\Barangay;

class TestController extends Controller
{
    //

    public function assign_brand()
    {
    	$_brand = BrandModel::get();
    	foreach($_brand as $brand)
    	{
    		$identifier = $brand->brand_identifier;
    		$update['brand_id'] = $brand->brand_id;
    		$update['seller_id'] = $brand->owner_id;
    		$product = ProductModel::where('brand_identifier', $identifier)->update($update);
    	}

    	return 'done';
    }

    public function assign_stocks()
    {
    	$_products = ProductModel::get();
    	foreach($_products as $product)
    	{
    		$update['product_id'] = $product->product_id;
    		StockModel::where('product_identifier', $product->product_identifier)->update($update);

    	}

    	return 'done';
    }

    public function assign_image()
    {
    	$_products = ProductModel::get();
    	foreach($_products as $product)
    	{
    		if($product->product_image != '' || $product->product_image != null)
    		{
    			$img = new ProductImage;
	    		$img->product_id = $product->product_id;
	    		$img->image_url = $product->product_image;
	    		$img->image_primary = 1;
	    		$img->save();
    		}
    	}

    	return 'done';
    }

    public function assign_order()
    {
    	$_cart = CartModel::get();
    	foreach($_cart as $cart)
    	{
    		$product_identifier = $cart->product_identifier;
    		$products = ProductModel::where('product_identifier', $product_identifier)->first();
    		if(!is_null($products))
    		{
    			$update['seller_id'] = $products->seller_id;
    			OrderModel::where('order_number', $cart->cart_order_number)->update($update);
    		}
    	}	

    	return 'done';
    }


    public function load_city(Request $request)
    {
        $code = $request->code;
        $_city =  City::where('provCode', $code)->orderBy('citymunDesc')->get();
        $html = '';
        $data['data'] = array();
        foreach($_city as $city)
        {
            $temp = array();
            $temp['code'] = $city->citymunCode;
            $temp['label'] = $city->citymunDesc;
            array_push($data['data'], $temp);
        }

        return response()->json($data, 200);
    }

    public function load_brgy(Request $request)
    {
        $code = $request->code;
        $_city =  Barangay::where('citymunCode', $code)->orderBy('brgyDesc')->get();
        $data['data'] = array();
        foreach($_city as $city)
        {
            $temp = array();
            $temp['code'] = $city->brgyCode;
            $temp['label'] = $city->brgyDesc;
            array_push($data['data'], $temp);
        }
        return response()->json($data, 200);
    }
}
