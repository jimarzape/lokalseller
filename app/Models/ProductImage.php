<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $table 	= 'product_images';
    public $timestamps 	= true;
    public $primaryKey 	= 'product_image_id';

    public function scopedetails($query, $product_id)
    {
    	return $query->where('product_id', $product_id);
    }
}
