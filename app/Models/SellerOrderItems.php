<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SellerOrderItems extends Model
{
    protected $table 	= 'seller_order_item';
    public $timestamps 	= true;
    public $primaryKey 	= 'eller_order_item_id';
}
