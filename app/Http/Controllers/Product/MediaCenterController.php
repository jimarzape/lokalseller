<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\MainController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MediaCenterController extends MainController
{
    public function __construct()
    {
        
        parent::__construct();
    	$this->data['_pages'] = pages('Products','Media Center');
    }

    public function index()
    {
    	return view('products.media', $this->data);
    }
}
