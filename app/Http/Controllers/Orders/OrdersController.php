<?php

namespace App\Http\Controllers\Orders;

use App\Http\Controllers\Controller;
use App\Http\Controllers\MainController;
use Illuminate\Http\Request;
use App\Models\OrderModel;
use App\Models\OrderStatus;
use App\Models\PaymentType;
use App\Models\CourrierType;
use App\Models\CartModel;
use App\Models\Sellers;
use App\Models\PouchModel;
use App\Models\SellerOrder;
use App\Models\SellerOrderItems;
use App\Models\StockLogs;
use App\Models\StockModel;
use App\Models\SystemLogs;
use Auth;
use Crypt;
use PDF;
use DB;

class OrdersController extends MainController
{
    public function __construct()
    {
        parent::__construct();
    	$this->data['_pages'] = pages('Orders & Review','Orders');
    }

    public function index(Request $request)
    {
    	$this->data['_courrier'] = CourrierType::orderBy('delivery_type')->get();
    	$this->data['_payment'] = PaymentType::orderBy('payment_method')->get();
    	$this->data['_status'] = OrderStatus::orderBy('status_name')->get();
    	$orders = SellerOrder::details(Auth::user()->id);
    	if($request->has('payment_method'))
    	{
    		if($request->payment_method != 'all')
    		{
    			$orders = $orders->where('order_payment_type', $request->payment_method);
    		}
    	}

    	if($request->has('delivery_type'))
    	{
    		if($request->delivery_type != 'all')
    		{
    			$orders = $orders->where('order_delivery_type', $request->delivery_type);
    		}
    	}

    	if($request->has('order_status'))
    	{
    		if($request->order_status != 'all')
    		{
    			$orders = $orders->where('seller_delivery_status', $request->order_status);
    		}
    	}

    	if($request->has('order_no'))
    	{
    		if($request->order_status != '')
    		{
    			$orders = $orders->where('seller_order.order_number','LIKE', '%'.$request->order_no.'%');
    		}
    	}

        if($request->has('daterange'))
        {
            $date_arr = explode(' - ', $request->daterange);
            if(isset($date_arr[1]))
            {
                $from   = date('m-d-Y', strtotime($date_arr[0]));
                $to     = date('m-d-Y', strtotime("+1 day", strtotime($date_arr[1])));
                $from_ar  = explode('-', $from);
                // dd($from);
                $orders = $orders->whereBetween('orders.order_date', [$from, $to]);
            }
        }


    	$this->data['_orders'] = $orders->orderBy('seller_order_id','desc')->paginate(20);
    	return view('orders.index', $this->data);
    }

    public function view($order_id)
    {
    	$order_id = Crypt::decrypt($order_id);
        
    	$this->data['order'] = SellerOrder::select('*','orders.id as order_id')
                                         ->where('seller_order_id', $order_id)
                                         ->where('seller_order.seller_id',Auth::user()->id)
                                         ->leftjoin('orders','orders.id','seller_order.order_id')
                                         ->leftjoin('users','users.userToken','orders.user_token')
                                         ->leftjoin('payment_methods','payment_methods.id','orders.order_payment_type')
                                         ->leftjoin('delivery_types','delivery_types.id','orders.order_delivery_type')
                                         ->leftjoin('delivery_status','delivery_status.id','seller_order.seller_delivery_status')
                                         ->first();
        // $this->data['_items'] = CartModel::where('cart_order_number', $this->data['order']->order_number)
        //                                  ->leftjoin('products','products.product_identifier','cart.product_identifier')
        //                                  ->get();

        $this->data['_items']   =  SellerOrderItems::details($order_id)->get();
        $this->data['_status']  = OrderStatus::get();
        $this->data['_pouches'] = PouchModel::orderBy('pouch_price')->get();
        if(is_null($this->data['order']))
        {
            return view('orders.notfound', $this->data);
        }
    	return view('orders.view', $this->data);
    }

    public function update_status(Request $request)
    {
        try
        {
            $order_id                       = Crypt::decrypt($request->order_id);
            
            $proceed['success'] = true;
            $proceed['message'] = '';
            $order_data = SellerOrder::single($order_id)->first();
            if($order_data->order_delivery_type == 2 && $request->status == 2)
            {
                $proceed = Self::mr_speedy($order_id);
            }
            if($request->status == 6)
            {
                DB::table('cancellation')->where('order_number', $order_data->order_number)->delete();
            }
            if($request->status == 6 && ($order_data->seller_delivery_status == 1 || $order_data->seller_delivery_status == 2 || $order_data->seller_delivery_status == 5)) //cancelled orders
            {
                Self::cancel_order($order_id);
                
            }


            if(!$proceed['success'])
            {
                return response()->json($proceed['message'], 500);
            }

            $pouch                          = PouchModel::where('id', $request->pouch_id)->first();
            // dd($order_id);
            $order                          = new SellerOrder;
            $order->exists                  = true;
            $order->seller_order_id         = $order_id;
            $order->seller_delivery_status  = $request->status;
            $order->seller_pouch_id         = $request->pouch_id;
            $order->seller_pouch_qty        = $request->pouch_qty;
            $order->seller_pouch_amount     = $pouch->pouch_price;
            $order->save();

            Self::update_order($order_data->order_number, $request->status, $order_id);

            $update['delivery_status'] = $request->status;


            $details = SellerOrderItems::select('cart_id')->where('seller_order_id', 3)->get()->toArray();
            $cart_id = array();
            foreach($details as $det)
            {
                array_push($cart_id, $det['cart_id']);
            }

            CartModel::whereIn('cart_id', $cart_id)->update($update);

            $status = OrderStatus::where('id', $request->status)->first();
            // dd($order_data->status_name);
            $logs_text = 'Updated <b><u>'.$order_data->order_number.'</u></b> from delivery status - '.$order_data->status_name.' to '.$status->status_name.' and from pouch - '.$order_data->pouch_size.' ( amount : '.number_format($order_data->seller_pouch_amount, 2).' | qty : '.number_format($order_data->seller_pouch_qty).' ) to '.Self::null2Na($pouch->pouch_size).' ( amount : '.Self::null2Zero($pouch->pouch_price).' | qty '.number_format($request->pouch_qty).' )';

            $logs               = new SystemLogs;
            $logs->seller_id    = Auth::user()->id;
            $logs->logs         = $logs_text;
            $logs->save();


            $message['message'] = 'Order has been updated';
            $message['code'] = $request->status;
            $message['print'] = $request->status == 2 ? route('orders.print', Crypt::encrypt($order_id)) : '';
            return response()->json($message, 200);
        }
        catch(\Exception $e)
        {
            return response()->json($e->getMessage(), 500);
        }
    }

    public function update_order($order_number, $status, $seller_order_id)
    {
        $update['delivery_status'] = $status;
        OrderModel::where('order_number', $order_number)->update($update);

        $_items = SellerOrderItems::select('cart_id')->where('seller_order_item.seller_order_id', $seller_order_id)->get()->toArray();
        $carts  = array_column($_items, 'cart_id');

        CartModel::whereIn('cart_id', $carts)
                 ->update($update);
    }
    

    public function null2Zero($number)
    {
        if(is_null($number))
        {
            $number = 0;
        }
        return $number;
    }

    public function null2Na($variable)
    {
        if(is_null($variable))
        {
            $variable = 'N/A';
        }
        return $variable;
    }

    public function cancel_order($order_id)
    {
        $_items = SellerOrderItems::where('seller_order_id', $order_id)->get();
        foreach($_items as $items)
        {
            // 
            $stock = StockModel::where('id', $items->stock_id)->first();
            if(!is_null($stock))
            {
                // dd($stock);
                $new_qty                        = $stock->stocks_quantity + $items->order_qty ;
                $update_stock                   = new StockModel;
                $update_stock->exists           = true;
                $update_stock->id               = $stock->id;
                $update_stock->stocks_quantity  = $new_qty;
                $update_stock->save();
            }

            $logs               = new StockLogs;
            $logs->product_id   = $items->product_id;
            $logs->stock_id     = $items->stock_id;
            $logs->seller_id    = Auth::user()->id;
            $logs->stock_qty    = $items->order_qty;
            $logs->stock_price  = $items->selling_price;
            $logs->stock_weight = $items->weight;
            $logs->save();

        }
    }


    public function mr_speedy($order_id)
    {
        $ret['success'] = true;
        $ret['message'] = '';
        try
        {   
            $order = SellerOrder::single($order_id)->first();
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

            // $seller_address = strtoupper($sellers->street_address.', '.$sellers->brgyDesc.', '.$sellers->citymunDesc.', '.$sellers->provDesc);
            $seller_address = strtoupper($sellers->street_address);
            $other_address = strtoupper($order->userShippingAddress.', '.$order->userBarangay.', '.$order->userCityMunicipality.', '.$order->userProvince);

            $customer_address = $order->mapAddress;
            
            $packages = array();
            // dd($data);
            $method = 'cash'; //if payment method is cod - id =1, 
            $is_cod = $order->order_payment_type == 1 ? true : false;

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
                        'address' => $other_address, //customer
                        'contact_person' => [
                            'phone' => $order->userMobile,
                            'name' => strtoupper($order->userFullName)
                        ],
                        // 'delivery_id' => $order_id,
                        // 'is_cod_cash_voucher_required ' => false,
                        'is_order_payment_here' => $is_cod,
                        'client_order_id' => $order->order_number,
                        'taking_amount' => $order->seller_total, //subtotal ?
                        // 'note' => 'Customer identifiable address: You can verify this with the customer->'.$other_address,
                        // 'packages' => $packages,
                    ],

                ],
            ];

            
            // dd($shipping);
            $json = json_encode($shipping, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
            // dd($json);
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, 'https://robot.mrspeedy.ph/api/business/1.1/create-order');
            // curl_setopt($curl, CURLOPT_URL, 'https://robot.mrspeedy.ph/api/business/1.1/calculate-order');
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
            curl_setopt($curl, CURLOPT_HTTPHEADER, ['X-DV-Auth-Token: 4D2C728310323C2B6F7FF5972247079E15D6C10E']);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $json);
            $result = curl_exec($curl); 
            // dd($shipping);

            $error_msg = array(
                'different_regions' => 'Addresses from different regions are not allowed.',
                "required" => "Required parameter was not provided.",
                "unknown" => "Unknown parameter was encountered.",
                "invalid_list" => "Invalid JSON list.",
                "invalid_object" => "Invalid JSON object.",
                "invalid_boolean" => "Invalid boolean.",
                "invalid_date" => "Invalid date or time.",
                "invalid_date_format" => "Invalid date and time format.",
                "invalid_float" => "Invalid floating point number.",
                "invalid_integer" => "Invalid integer number.",
                "invalid_string" => "Invalid string.",
                "invalid_order" => "Order ID was not found.",
                "invalid_point" => "Point ID was not found.",
                "invalid_order_status" => "Invalid order status.",
                "invalid_vehicle_type" => "Invalid vehicle type.",
                "invalid_courier" => "Invalid courier ID.",
                "invalid_phone" => "Invalid phone number.",
                "invalid_region" => "Address is out of the delivery area for the region.",
                "invalid_order_package" => "Package was not found",
                "invalid_delivery_id" => "Delivery ID was not found",
                "invalid_delivery_package" => "Package ID for delivery was not found",
                "invalid_delivery_status" => "Invalid delivery status",
                "invalid_bank_card" => "Bank card ID was not found",
                "invalid_url" => "Invalid url",
                "invalid_enum_value" => "Invalid enum value",
                "different_regions" => "Addresses from different regions are not allowed.",
                "address_not_found" => "Address geocoding failed. Check your address with Google Maps service.",
                "min_length" => "String value is too short.",
                "max_length" => "String value is too long.",
                "min_date" =>  "Date and time is older than possible.",
                "max_date" =>  "Date and time is later than possible.",
                "min_size" =>  "List size is too small.",
                "max_size" => "List size is too large.",
                "min_value" => "Value is too small.",
                "max_value" => "Value is too large.",
                "cannot_be_past" => "Date and time cannot be in the past.",
                "start_after_end" => "Incorrect time interval. Start time should be earlier than the end.",
                "earlier_than_previous_point" => "Incorrect time interval. Time cannot be earlier than previous point time.",
                "coordinates_out_of_bounds" => "Point coordinates are outside acceptable delivery areas",
                "not_nullable" => "Value can not be null",
                "not_allowed" => "Parameter not allowed",
                "order_payment_only_one_point" => "Order payment can be specified only for one point",
                "cod_agreement_required" => "COD agreement required"
            );

            if ($result === false) { 

                // throw new \Exception(curl_error($curl), curl_errno($curl)); 
                $ret['success'] = false;
                $ret['message'] = curl_error($curl);
            } 
            else
            {
                $res_arr = json_decode($result);
                $ret['success'] = true;
                $ret['message'] = '';
                if(isset($res_arr->is_successful) && $res_arr->is_successful == false)
                {
                    // dd($res_arr);
                    if(isset($res_arr->parameter_errors))
                    {
                        if(isset($res_arr->parameter_errors->points))
                        {
                            foreach($res_arr->parameter_errors->points as $msgs)
                            {
                                foreach($msgs as $mrError)
                                {
                                    // dd($mrError[0]);
                                     if(isset($mrError[0]))
                                     {
                                        $ret['message'] = $error_msg[$mrError[0]];
                                     }
                                }
                               
                            }

                            $ret['success'] = false;
                        }
                    }
                }
               
                
            }
            // dd($json);
            $returns = json_decode($result, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        }   
        catch(\Exception $e)
        {
            $ret['success'] = false;
            $ret['message'] = $e->getMessage();
        }

        return $ret;
    }

    

    public function print($order_id)
    {

        $order_id = Crypt::decrypt($order_id);
        // dd($order_id);
        $data['order'] = SellerOrder::select('*','seller_order.seller_id as seller_org_id','orders.id as order_id')
                                         ->where('seller_order_id', $order_id)
                                         ->leftjoin('orders','orders.id','seller_order.order_id')
                                         ->leftjoin('users','users.userToken','orders.user_token')
                                         ->leftjoin('payment_methods','payment_methods.id','orders.order_payment_type')
                                         ->leftjoin('delivery_types','delivery_types.id','orders.order_delivery_type')
                                         ->first();
        // dd($order_id);
        $data['sellers']  = Sellers::where('sellers.id', $data['order']->seller_org_id)
                                    ->leftjoin('refprovince','refprovince.provCode','sellers.province')
                                    ->leftjoin('refcitymun','refcitymun.citymunCode','sellers.city')
                                    ->leftjoin('refbrgy','refbrgy.brgyCode','sellers.brgy')
                                    ->first();
        // dd($data);
        $pdf = PDF::loadView('orders.print',$data);

        return $pdf->stream($data['order']->order_number.'.pdf');
    }

}
