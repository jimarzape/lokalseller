<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockModel extends Model
{
    protected $table 	= 'stocks';
    public $timestamps 	= true;
    public $primaryKey 	= 'id';

    public function scopedetails($query, $product_id)
    {
    	return $query->where('product_id', $product_id);
    }
}
