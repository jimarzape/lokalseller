<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DeniedController extends Controller
{
    public function pending()
    {
    	return view('account.pending');
    }

    public function declined()
    {
    	return view('account.declined');
    }
}
