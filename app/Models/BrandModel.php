<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BrandModel extends Model
{
    protected $table 	= 'brands';
    public $timestamps 	= true;
    public $primaryKey 	= 'brand_id';

    public function scopedetails($query, $owner_id, $brand_archived = 0)
    {
    	return $query->where('brand_archived', $brand_archived)
    				 ->where('owner_id', $owner_id)
    				 ->orderBy('brand_name');
    }
}
