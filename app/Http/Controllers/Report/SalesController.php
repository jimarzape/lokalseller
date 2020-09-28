<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\MainController;
use App\Models\SellerOrder;
use App\Exports\SalesExport;
use Auth;
use Excel;

class SalesController extends MainController
{
    public function __construct()
    {
        parent::__construct();
    	$this->data['_pages'] = pages('Reports','Sales');
    }

    public function index(Request $request)
    {
        $sales      = SellerOrder::sales(Auth::user()->id);
        if($request->has('from') && $request->has('to'))
        {
            $sales  = $sales->whereBetween('created_at', [$request->from, $request->to]);
        }
    	$this->data['_sales'] = $sales->orderBy('created_at','desc')->paginate(20);
    	$this->data['_total'] = $sales->sum('seller_net');
    	// dd($this->data['_total']);
    	return view('reports.sales', $this->data);
    }

    public function export(Request $request)
    {
        $sales       = SellerOrder::sales(Auth::user()->id);
        if($request->has('from') && $request->has('to'))
        {
            if($request->from != '' && $request->to != '')
            {
                $sales  = $sales->whereBetween('created_at', [$request->from, $request->to]);
            }
            
        }
        $_sales = $sales->orderBy('created_at','desc')->get()->toArray();

        // dd($_sales);
        $data   = array();
        foreach($_sales as $sale)
        {
            $export = [
               $sale['order_number'],
               $sale['seller_order_number'],
               $sale['seller_sub_total'],
               $sale['seller_delivery_fee'],
               ($sale['seller_pouch_amount'] * $sale['seller_pouch_qty']),
               $sale['seller_share'],
               $sale['seller_net'],
               date('M d, Y', strtotime($sale['created_at'])),
            ];

            array_push($data, $export);
        }
        // dd($data);
        $export_data = new SalesExport($data);
        $title = 'SALES-'.date('ymdhis').'.csv';
        return Excel::download($export_data, $title, \Maatwebsite\Excel\Excel::CSV);
    }
}
