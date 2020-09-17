<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PouchModel extends Model
{
    protected $table 	= 'pouches';
    public $timestamps 	= false;
    public $primaryKey 	= 'id';
}
