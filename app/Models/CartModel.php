<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartModel extends Model
{
    protected $table 	= 'cart';
    public $timestamps 	= false;
    public $primaryKey 	= 'cart_id';
}
