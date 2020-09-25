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
use Auth;
use Crypt;
use PDF;

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


    	$this->data['_orders'] = $orders->paginate(20);
    	return view('orders.index', $this->data);
    }

    public function view($order_id)
    {
    	$order_id = Crypt::decrypt($order_id);
        
    	$this->data['order'] = SellerOrder::select('*','orders.id as order_id')
                                         ->where('seller_order_id', $order_id)
                                         ->leftjoin('orders','orders.id','seller_order.order_id')
                                         ->leftjoin('users','users.userToken','orders.user_token')
                                         ->leftjoin('payment_methods','payment_methods.id','orders.order_payment_type')
                                         ->leftjoin('delivery_types','delivery_types.id','orders.order_delivery_type')
                                         ->first();
        // $this->data['_items'] = CartModel::where('cart_order_number', $this->data['order']->order_number)
        //                                  ->leftjoin('products','products.product_identifier','cart.product_identifier')
        //                                  ->get();

        $this->data['_items']   =  SellerOrderItems::details($order_id)->get();
        $this->data['_status']  = OrderStatus::get();
        $this->data['_pouches'] = PouchModel::orderBy('pouch_price')->get();
    	return view('orders.view', $this->data);
    }

    public function update_status(Request $request)
    {
        try
        {
            $order_id                       = Crypt::decrypt($request->order_id);
            $order                          = new SellerOrder;
            $order->exists                  = true;
            $order->seller_order_id         = $order_id;
            $order->seller_delivery_status  = $request->status;
            $order->save();

            $update['delivery_status'] =$request->status;


            $details = SellerOrderItems::select('cart_id')->where('seller_order_id', 3)->get()->toArray();
            $cart_id = array();
            foreach($details as $det)
            {
                array_push($cart_id, $det['cart_id']);
            }

            CartModel::whereIn('cart_id', $cart_id)->update($update);

            $status = OrderStatus::where('id', $request->status)->first();

            $message['message'] = 'Order has been updated to '.$status->status_name;
            $message['code'] = $request->status;
            $message['print'] = $request->status == 2 ? route('orders.print', Crypt::encrypt($order_id)) : '';
            return response()->json($message, 200);
        }
        catch(\Exception $e)
        {
            return response()->json($e->getMessage(), 500);
        }
        


    }

    public function update_pouch(Request $request)
    {
        try
        {
            $order_id                   = Crypt::decrypt($request->order_id);
            $pouch                      = PouchModel::where('id', $request->pouch_id)->first();
            $order                      = new SellerOrder;
            $order->exists              = true;
            $order->seller_order_id     = $order_id;
            $order->seller_pouch_id     = $request->pouch_id;
            $order->seller_pouch_qty    = $request->pouch_qty;
            $order->seller_pouch_amount = $pouch->pouch_price;
            $order->save();

            $message['message'] = 'Pouch has been updated';
            $message['code'] = 0;
            return response()->json($message, 200);
        }
        catch(\Exception $e)
        {
            return response()->json($e->getMessage(), 500);
        }
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
