<?php

namespace App\Http\Controllers\Orders;

use App\Http\Controllers\Controller;
use App\Http\Controllers\MainController;
use Illuminate\Http\Request;
use App\Models\OrderModel;
use App\Models\OrderStatus;
use App\Models\PaymentType;
use App\Models\CourrierType;
use Auth;
use Crypt;

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
    	$this->data['order'] = OrderModel::where('id', $order_id)->first();
    	return view('orders.view', $this->data);
    }

}
