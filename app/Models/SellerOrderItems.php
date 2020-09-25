<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SellerOrderItems extends Model
{
    protected $table 	= 'seller_order_item';
    public $timestamps 	= true;
    public $primaryKey 	= 'eller_order_item_id';


    public function scopedetails($query, $seller_order_id)
    {
    	return $query->where('seller_order_item.seller_order_id', $seller_order_id)
    				  ->leftjoin('cart','cart.cart_id','seller_order_item.cart_id')
		    		  ->leftjoin('products','products.product_identifier','cart.product_identifier')
		              ->orderBy('products.product_name');
    }
}
