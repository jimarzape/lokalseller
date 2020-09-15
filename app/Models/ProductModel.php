<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductModel extends Model
{
    protected $table 	= 'products';
    public $timestamps 	= true;
    public $primaryKey 	= 'product_id';

    public function scopedetails($query, $seller_id, $product_archived = 0)
    {
    	return $query->where('product_archived', $product_archived)
    				 ->where('seller_id', $seller_id)
    				 ->orderBy('product_name');
    }

    public function scopebrands($query)
    {
    	return $query->leftjoin('brands','brands.brand_id','products.brand_id');
    }

    public function scopestocks($quuery)
    {
        return $quuery->leftjoin('stocks','stocks.product_id','products.product_id');
    }
}
