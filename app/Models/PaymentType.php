<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentType extends Model
{
    protected $table 	= 'payment_methods';
    public $timestamps 	= false;
    public $primaryKey 	= 'id';
}
