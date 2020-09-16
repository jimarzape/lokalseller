<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{
    protected $table 	= 'delivery_status';
    public $timestamps 	= false;
    public $primaryKey 	= 'id';
}
