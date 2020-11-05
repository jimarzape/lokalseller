<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NinjaVan extends Model
{
    protected $table 	= 'ninjavan';
    public $timestamps 	= true;
    public $primaryKey 	= 'ninjavan_id';

    public function scopeseller($query, $seller_id)
    {
    	return $query->where('seller_id', $seller_id);
    }
}
