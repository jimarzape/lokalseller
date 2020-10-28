<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OnSale extends Model
{
    protected $table 	= 'is_on_sale';
    public $timestamps 	= false;
    public $primaryKey 	= 'id';
}
