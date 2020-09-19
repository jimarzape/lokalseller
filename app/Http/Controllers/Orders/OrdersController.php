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
    	$orders = OrderModel::details(Auth::user()->id);
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
    			$orders = $orders->where('delivery_status', $request->order_status);
    		}
    	}

    	if($request->has('order_no'))
    	{
    		if($request->order_status != '')
    		{
    			$orders = $orders->where('order_number','LIKE', '%'.$request->order_no.'%');
    		}
    	}


    	$this->data['_orders'] = $orders->paginate(20);
    	return view('orders.index', $this->data);
    }

    public function view($order_id)
    {
    	$order_id = Crypt::decrypt($order_id);
        
    	$this->data['order'] = OrderModel::select('*','orders.id as order_id')
                                         ->where('orders.id', $order_id)
                                         ->leftjoin('users','users.userToken','orders.user_token')
                                         ->leftjoin('payment_methods','payment_methods.id','orders.order_payment_type')
                                         ->leftjoin('delivery_types','delivery_types.id','orders.order_delivery_type')
                                         ->first();
        $this->data['_items'] = CartModel::where('cart_order_number', $this->data['order']->order_number)
                                         ->leftjoin('products','products.product_identifier','cart.product_identifier')
                                         ->get();
        $this->data['_status'] = OrderStatus::get();
        $this->data['_pouches'] = PouchModel::orderBy('pouch_price')->get();
    	return view('orders.view', $this->data);
    }

    public function update_status(Request $request)
    {
        try
        {
            $order_id       = Crypt::decrypt($request->order_id);
            $order          = new OrderModel;
            $order->exists  = true;
            $order->id      = $order_id;
            $order->delivery_status = $request->status;
            $order->save();
            $status = OrderStatus::where('id', $request->status)->first();

            $message['message'] = 'Order has been updated to '.$status->status_name;
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
            $order_id               = Crypt::decrypt($request->order_id);
            $pouch                  = PouchModel::where('id', $request->pouch_id)->first();
            $order                  = new OrderModel;
            $order->exists          = true;
            $order->id              = $order_id;
            $order->pouch_id        = $request->pouch_id;
            $order->pouch_qty       = $request->pouch_qty;
            $order->pouch_amount    = $pouch->pouch_price;
            $order->save();

            $message['message'] = 'Pouch has been updated';
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
        $data['order'] = OrderModel::select('*','orders.id as order_id')
                                         ->where('orders.id', $order_id)
                                         ->leftjoin('users','users.userToken','orders.user_token')
                                         ->leftjoin('payment_methods','payment_methods.id','orders.order_payment_type')
                                         ->leftjoin('delivery_types','delivery_types.id','orders.order_delivery_type')
                                         ->first();
        $data['sellers']  = Sellers::where('sellers.id', $data['order']->seller_id)
                                    ->leftjoin('refprovince','refprovince.provCode','sellers.province')
                                    ->leftjoin('refcitymun','refcitymun.citymunCode','sellers.city')
                                    ->leftjoin('refbrgy','refbrgy.brgyCode','sellers.brgy')
                                    ->first();
        // dd($data);
        $pdf = PDF::loadView('orders.print',$data);

        return $pdf->stream(time().'.pdf');
    }

}
