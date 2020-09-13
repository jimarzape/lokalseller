<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\MainController;
use Illuminate\Http\Request;
use Auth;

class ManageProductController extends MainController
{
    public function __construct()
    {
        
        parent::__construct();
    	$this->data['_pages'] = pages('Products','Manage Products');
    }

    public function index()
    {
    	return view('products.manage', $this->data);
    }
}
