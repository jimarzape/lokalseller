<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends MainController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
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
