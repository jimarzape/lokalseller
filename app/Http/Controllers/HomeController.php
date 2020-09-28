<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\SellerOrder;
use App\Models\ProductModel;
use App\Models\BrandModel;
use App\Models\SellerOrderItems;
use DB;

class HomeController extends MainController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
        parent::__construct();
        $this->data['_pages'] = pages('Dashboard');
    }

    public function index()
    {
        $this->data['new']      = SellerOrder::where('seller_id', Auth::user()->id)->where('seller_delivery_status', 1)->count();
        $this->data['toship']   = SellerOrder::where('seller_id', Auth::user()->id)->where('seller_delivery_status', 2)->count();
        $this->data['success']  = SellerOrder::sales(Auth::user()->id)->count();
        $this->data['net']      = SellerOrder::sales(Auth::user()->id)->sum('seller_net');
        $this->data['monthly']  = SellerOrder::sales(Auth::user()->id)
                                            ->whereBetween('created_at', [date('Y-m-01'),date('Y-m-t')])
                                            ->sum('seller_net');
        $this->data['products'] = ProductModel::where('seller_id',Auth::user()->id)->where('product_archived',0)->count();
        $this->data['brands']   = BrandModel::where('owner_id',Auth::user()->id)->where('brand_archived', 0)->count();
        $this->data['_top']     = SellerOrderItems::select('*',DB::raw('sum(order_qty) as total_sold'))
                                                   ->leftjoin('products','products.product_id','seller_order_item.product_id')
                                                   ->leftjoin('brands','brands.brand_id','products.brand_id')
                                                   ->where('products.seller_id',Auth::user()->id)
                                                   ->whereBetween('seller_order_item.created_at', [date('Y-m-01'),date('Y-m-t')])
                                                   ->groupBy('products.product_id')
                                                   ->orderBy('total_sold','desc')
                                                   ->skip(0)->take(10)->get();
        $this->data['_orders']  = SellerOrder::where('seller_id',Auth::user()->id)
                                            ->leftjoin('delivery_status','delivery_status.id','seller_order.seller_delivery_status')
                                            ->orderBy('created_at','desc')
                                            ->skip(0)->take(10)->get();

        return view('dashboard', $this->data);
    }
}
