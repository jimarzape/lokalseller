<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\MainController;
use App\Models\SellerOrder;
use Auth;

class SalesController extends MainController
{
    public function __construct()
    {
        parent::__construct();
    	$this->data['_pages'] = pages('Reports','Sales');
    }

    public function index()
    {
    	$this->data['_sales'] = SellerOrder::sales(Auth::user()->id)->orderBy('created_at','desc')->paginate(20);
    	$this->data['_total'] = SellerOrder::sales(Auth::user()->id)->sum('seller_net');
    	// dd($this->data['_total']);
    	return view('reports.sales', $this->data);
    }
}
