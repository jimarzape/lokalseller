<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\MainController;
use Auth;

class DashBoardController extends MainController
{
    public function __construct()
    {
        
        parent::__construct();
    	$this->data['_pages'] = pages('Dashboard');
    }

    public function index()
    {
    	// dd($this->data['_pages']);
    	return view('dashboard', $this->data);
    }
}
