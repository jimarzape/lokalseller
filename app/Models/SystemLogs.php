<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SystemLogs extends Model
{
    protected $table 	= 'system_logs';
    public $timestamps 	= true;
    public $primaryKey 	= 'logs_id';

    public function scopedetails($query, $seller_id)
    {	
    	return $query->select('system_logs.*','sellers.name')
    				->leftjoin('sellers','sellers.id','system_logs.seller_id')
    				->where('seller_id', $seller_id)
    				->orderBy('system_logs.created_at','desc');
    }
}
