<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderModel extends Model
{
    protected $table 	= 'orders';
    public $timestamps 	= true;
    public $primaryKey 	= 'id';

    public function scopedetails($query, $seller_id)
    {
    	return $query->select('orders.*','delivery_types.delivery_type','payment_methods.payment_method','delivery_status.status_name')
    				 ->where('orders.seller_id', $seller_id)
    				 ->leftjoin('payment_methods','payment_methods.id','orders.order_payment_type')
    				 ->leftjoin('delivery_types','delivery_types.id','orders.order_delivery_type')
    				 ->leftjoin('delivery_status','delivery_status.id','orders.delivery_status')
    				 ->orderBy('order_date','desc');
    }
}
