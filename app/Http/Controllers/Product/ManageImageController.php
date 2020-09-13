<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\MainController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;


class ManageImageController extends MainController
{
    public function __construct()
    {
        
        parent::__construct();
    	$this->data['_pages'] = pages('Products','Manage Image');
    }

    public function index()
    {
    	return view('products.image', $this->data);
    }
}
