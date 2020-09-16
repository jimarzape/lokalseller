<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourrierType extends Model
{
    protected $table 	= 'delivery_types';
    public $timestamps 	= false;
    public $primaryKey 	= 'id';
}
