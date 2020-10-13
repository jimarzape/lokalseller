<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SellerOrder extends Model
{
    protected $table 	= 'seller_order';
    public $timestamps 	= true;
    public $primaryKey 	= 'seller_order_id';


    public function scopedetails($query, $seller_id)
    {
    	return $query->select('seller_order.*','orders.order_number','seller_order.seller_order_id as order_id','delivery_types.delivery_type','payment_methods.payment_method','delivery_status.status_name','orders.order_date')
    				 ->where('seller_order.seller_id', $seller_id)
    				 ->leftjoin('orders','orders.id','seller_order.order_id')
    				 ->leftjoin('payment_methods','payment_methods.id','orders.order_payment_type')
    				 ->leftjoin('delivery_types','delivery_types.id','orders.order_delivery_type')
    				 ->leftjoin('delivery_status','delivery_status.id','seller_order.seller_delivery_status');
    				 // ->orderBy('order_date','desc');
    }

    public function scopesingle($query, $order_id)
    {
        return  $query->select('*','seller_order.seller_id as seller_org_id','orders.id as order_id')
                     ->where('seller_order_id', $order_id)
                     ->leftjoin('orders','orders.id','seller_order.order_id')
                     ->leftjoin('users','users.userToken','orders.user_token')
                     ->leftjoin('payment_methods','payment_methods.id','orders.order_payment_type')
                     ->leftjoin('delivery_status','delivery_status.id','seller_order.seller_delivery_status')
                     ->leftjoin('pouches','pouches.id','seller_order.seller_pouch_id')
                     ->leftjoin('delivery_types','delivery_types.id','orders.order_delivery_type');
    }

    public function scopesales($query, $seller_id)
    {
        return  $query->whereIn('seller_delivery_status', array(3,4,7,8))
                      ->where('seller_id', $seller_id);
    }
}
