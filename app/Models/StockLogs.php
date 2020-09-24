<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockLogs extends Model
{
    protected $table 	= 'product_stock_logs';
    public $timestamps 	= true;
    public $primaryKey 	= 'stock_log_id';
}
