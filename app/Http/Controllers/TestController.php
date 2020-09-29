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
use App\Models\SellerOrder;
use App\Models\StockLogs;
use App\Models\SellerOrderItems;

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
                $update['delivery_status'] = $cart['delivery_status'];
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

    public function com()
    {
        $_order = OrderModel::get();
        foreach($_order as $order)
        {
            $com = 5;
            $share = $order->order_subtotal * ($com / 100);
            $update = new OrderModel;
            $update->exists = true;
            $update->id = $order->id;
            $update->lokal_com = $com;
            $update->lokal_com_amount = $share;
            $update->save();
        }

        $_seller = SellerOrder::get();
        foreach($_seller as $order)
        {
            $com = 5;
            $share = $order->seller_total * ($com / 100);
            $update = new SellerOrder;
            $update->exists = true;
            $update->seller_order_id = $order->seller_order_id;
            $update->seller_share_rate = $com;
            $update->seller_share = $share;
            $update->save();
        }

        return 'done';
    }


    public function inventory()
    {
        SellerOrder::truncate();
        StockLogs::truncate();
        SellerOrderItems::truncate();

        $_items = ProductModel::select('stocks.*','products.seller_id','products.product_id')
                                ->leftjoin('stocks','stocks.product_id','products.product_id')
                                ->get()->toArray();
        // dd($_items);
        $zero_stock = array();
        foreach($_items as $items)
        {
            if(is_null($items['id']))
            {
                // dd($items);
                array_push($zero_stock, $items['product_id']);
            }   
            else
            {
                $logs               = new StockLogs;
                $logs->product_id   = Self::null_zero($items['product_id']);
                $logs->stock_id     = Self::null_zero($items['id']);
                $logs->seller_id    = Self::null_zero($items['seller_id']);
                $logs->stock_qty    = Self::null_zero($items['stocks_quantity']);
                $logs->stock_price  = Self::null_zero($items['stocks_price']);
                $logs->stock_weight = Self::null_zero($items['stocks_weight']);
                $logs->save();
            }
            
        }
        dd(implode(',', $zero_stock));

        $_order = OrderModel::whereIn('delivery_status', array(1,2,3,4,7,8))->get();
        foreach ($_order as $order) {
            $order_id       = $order->id;
            $order_number   = $order->order_number;
            $_cart          = CartModel::select('products.*','cart.*', 'stocks.id as stock_id', 'stocks.stocks_quantity', 'stocks.stocks_size', 'stocks.stocks_weight', 'stocks.stocks_price')
                                        ->leftjoin('products','products.product_identifier','cart.product_identifier')
                                        ->leftjoin('stocks', function($join){
                                            $join->on('stocks.product_id','products.product_id');
                                            $join->on('stocks.stocks_size','cart.size');
                                        })
                                        ->where('cart_order_number', $order_number)
                                        ->get()->toArray();
            // dd($_cart);
            $group_arr          = array();
            $delivery_fee       = $order->order_delivery_fee;
            $delivery_status    = $order->delivery_status;
            foreach($_cart as $data)
            {
                $group_arr[$data['seller_id']][] = $data;
            }
            foreach($group_arr as $seller_id => $sell_items)
            {
                $seller_number  = 'SN-'.$seller_id.time();
                $net            = 0;
                $discount       = 0;
                $seller_share   = 0;
                $share_rate     = 5;
                $seller_total   = 0;
                $subtotal       = 0;
                $total_weight   = 0;

                $seller                         = new SellerOrder;
                $seller->order_id               =  $order_id;
                $seller->seller_id              =  $seller_id;
                $seller->order_number           =  $order_number;
                $seller->seller_order_number    =  $seller_number;
                $seller->seller_sub_total       =  $subtotal;
                $seller->seller_delivery_fee    =  $delivery_fee; 
                $seller->seller_total           =  $seller_total;
                $seller->seller_share_rate      =  $share_rate; 
                $seller->seller_share           =  $seller_share;
                $seller->seller_discount        =  0;
                $seller->seller_net             = $net;
                $seller->seller_delivery_status = $delivery_status;
                $seller->seller_remarks         = '';
                $seller->save();   
                $seller_order_id = $seller->seller_order_id;

                foreach($sell_items as $items)
                {
                    $sell_order                     = new SellerOrderItems;
                    $sell_order->seller_order_id    = $seller_order_id;
                    $sell_order->cart_id            = Self::null_zero($items['cart_id']);
                    $sell_order->product_id         = Self::null_zero($items['product_id']);
                    $sell_order->stock_id           = Self::null_zero($items['stock_id']);
                    $sell_order->order_qty          = Self::null_zero($items['quantity']);
                    $sell_order->size               = Self::null_zero($items['stocks_size']);
                    $sell_order->weight             = Self::null_zero($items['stocks_weight']);
                    $sell_order->selling_price      = Self::null_zero($items['stocks_price']);
                    $sell_order->selling_discount   = 0;
                    $sell_order->sold_price         = Self::null_zero($items['stocks_price']);
                    $sell_order->save();

                    $subtotal += ($items['quantity'] * $items['stocks_price']);
                    $total_weight += $items['stocks_weight'];

                    $logs               = new StockLogs;
                    $logs->product_id   = Self::null_zero($items['product_id']);
                    $logs->stock_id     = Self::null_zero($items['stock_id']);
                    $logs->seller_id    = $seller_id;
                    $logs->stock_qty    = (0 - Self::null_zero($items['quantity']));
                    $logs->stock_price  = Self::null_zero($items['stocks_price']);
                    $logs->stock_weight = Self::null_zero($items['stocks_weight']);
                    $logs->save();


                    $stock_data = StockModel::where('id', $items['stock_id'])->first();
                    if(!is_null($stock_data))
                    {
                        $update_stock                   = new StockModel;
                        $update_stock->exists           = true;
                        $update_stock->id               = Self::null_zero($items['stock_id']);
                        $update_stock->stocks_quantity  = ($stock_data->stocks_quantity - Self::null_zero($items['quantity']));
                        $update_stock->save();
                    }

                }

                $seller_share = ($share_rate / 100) * $subtotal;
                $seller_net = $subtotal - $seller_share;
                $seller_total = $subtotal + $delivery_fee;

                $update_seller = new SellerOrder;
                $update_seller->exists = true;
                $update_seller->seller_order_id = $seller_order_id;
                $update_seller->seller_sub_total = $subtotal;
                $update_seller->seller_share = $seller_share;
                $update_seller->seller_net = $seller_net;
                $update_seller->seller_total = $seller_total;
                $update_seller->save();
            }
        }
    }   

    public function null_zero($variable)
    {
        // if(is_null($variable))
        // {
        //     $variable = 0;
        // }
        return $variable;
    }


    public function mrspeedy()
    {
        $order_id = 159;
        $order_data = SellerOrder::single($order_id)->first();
        dd($order_data);
        $order = SellerOrder::select('*','seller_order.seller_id as seller_org_id','orders.id as order_id')
                                         ->where('seller_order_id', $order_id)
                                         ->leftjoin('orders','orders.id','seller_order.order_id')
                                         ->leftjoin('users','users.userToken','orders.user_token')
                                         ->leftjoin('payment_methods','payment_methods.id','orders.order_payment_type')
                                         ->leftjoin('delivery_types','delivery_types.id','orders.order_delivery_type')
                                         ->first();
        // dd($order_id);
        $sellers  = Sellers::where('sellers.id', $order->seller_org_id)
                                    ->leftjoin('refprovince','refprovince.provCode','sellers.province')
                                    ->leftjoin('refcitymun','refcitymun.citymunCode','sellers.city')
                                    ->leftjoin('refbrgy','refbrgy.brgyCode','sellers.brgy')
                                    ->first();

        $_items     = SellerOrderItems::details($order_id)->get();
        // dd($_items);
        $packages   = array();
        $weight     = 0;
        foreach($_items as $items)
        {
            $temp                           = array();
            $temp['ware_code']              = $items->brand_identifier;
            $temp['description']            = $items->product_name.' ('.$items->size.')';
            $temp['items_count']            = $items->order_qty;
            $temp['item_payment_amount']    = $items->sold_price;
            // $temp['cod']          = false;
            array_push($packages, $temp);

            $weight += $items->weight * $items->order_qty;
        }
        // dd($_items);

        $seller_address = strtoupper($sellers->street_address.', '.$sellers->brgyDesc.', '.$sellers->citymunDesc.', '.$sellers->provDesc);
        // $customer_address = strtoupper($order->userShippingAddress.', '.$order->userBarangay.', '.$order->userCityMunicipality.', '.$order->userProvince);

        $customer_address = $order->mapAddress;
        
        $packages = array();
        // dd($data);
        $method = 'cash'; //if payment method is cod - id =1, 
        $is_cod = $order->order_payment_type == 2 ? true : false;

        $shipping = [
            'matter' => 'TShirts',
            'total_weight_kg' => ($weight / 1000),
            'payment_method' => $method,
            'points' => [
                [
                    'address' => $seller_address, //seller
                    'contact_person' => [
                        'phone' => $sellers->contact_num,
                        'name' => strtoupper($sellers->name)
                    ],
                    // 'delivery_id' => $order_id,
                    // 'is_cod_cash_voucher_required ' => false,
                    'client_order_id' => $order->order_number,
                    'packages' => $packages,
                ], 
                [
                    'address' => $customer_address, //customer
                    'contact_person' => [
                        'phone' => $order->userMobile,
                        'name' => strtoupper($order->userFullName)
                    ],
                    // 'delivery_id' => $order_id,
                    // 'is_cod_cash_voucher_required ' => false,
                    'is_order_payment_here' => $is_cod,
                    'client_order_id' => $order->order_number,
                    'taking_amount' => $order->seller_total, //subtotal ?
                    // 'packages' => $packages,
                ],

            ],
        ];

        
        // dd($shipping);
        $json = json_encode($shipping, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        // dd($json);
        $curl = curl_init();
        // curl_setopt($curl, CURLOPT_URL, 'https://robot.mrspeedy.ph/api/business/1.1/create-order');
        curl_setopt($curl, CURLOPT_URL, 'https://robot.mrspeedy.ph/api/business/1.1/calculate-order');
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($curl, CURLOPT_HTTPHEADER, ['X-DV-Auth-Token: 4D2C728310323C2B6F7FF5972247079E15D6C10E']);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $json);
        $result = curl_exec($curl); 
        if ($result === false) { 
            throw new \Exception(curl_error($curl), curl_errno($curl)); 
        } 

        $returns = json_decode($result, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        dd($returns['order']);
    }

    public function index()
    {
        return 'LKL-89071'.time();
    }

    public function stockproductid()
    {
        $_stocks = StockModel::where('product_id',null)->get();
        foreach($_stocks as $stocks)
        {
            $product = ProductModel::where('product_identifier',$stocks->product_identifier)->first();
            if(!is_null($product))
            {
                // dd($product);
                $update = new StockModel;
                $update->exists = true;
                $update->id = $stocks->id;
                $update->product_id = $product->product_id;
                $update->save();
            }
        }
    }

    public function fix_order_zero()
    {
        $_order = SellerOrder::where('seller_sub_total', 0)->get();
        foreach($_order as $order)
        {
            $_cart = CartModel::select('*','stocks.id as stock_id')
                             ->leftjoin('products','products.product_identifier','cart.product_identifier')
                             ->leftjoin('stocks', function($join){
                                $join->on('stocks.stocks_size','cart.size');
                                $join->on('stocks.product_id','products.product_id');
                             })
                             ->where('cart_order_number', $order->order_number)
                             ->where('products.seller_id', $order->seller_id)
                             ->get();
            $subtotal = 0;

            foreach($_cart as $cart)
            {
                
                if(!is_null($cart->stocks_size))
                {
                    // dd($cart);
                    SellerOrderItems::where('seller_order_id', $order->seller_order_id)
                                    ->where('cart_id', $cart->cart_id)
                                    ->delete();
                    $item_order                     = new SellerOrderItems;
                    $item_order->seller_order_id    = $order->seller_order_id;
                    $item_order->cart_id            = $cart->cart_id;
                    $item_order->product_id         = $cart->product_id;
                    $item_order->stock_id           = $cart->stock_id;
                    $item_order->order_qty          = $cart->quantity;
                    $item_order->size               = $cart->size;
                    $item_order->weight             = $cart->stocks_weight;
                    $item_order->selling_price      = $cart->stocks_price;
                    $item_order->selling_discount   = 0;
                    $item_order->sold_price         = $cart->stocks_price;
                    $item_order->save();
                    $subtotal += ($cart->quantity * $cart->stocks_price);
                }
            }

            $total  = $subtotal + $order->seller_delivery_fee;
            $rate   = 5;
            $share  = $subtotal * ($rate / 100);
            $net    = $subtotal - $rate;
            $update_order                       = new SellerOrder;
            $update_order->exists               = true;
            $update_order->seller_order_id      = $order->seller_order_id;
            $update_order->seller_sub_total     = $subtotal;
            $update_order->seller_total         = $total;
            $update_order->seller_share_rate    = $rate;
            $update_order->seller_share         = $share;
            $update_order->seller_share         = $net;
            $update_order->save();
        }
    }
}
