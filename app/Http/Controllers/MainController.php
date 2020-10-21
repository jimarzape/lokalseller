<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class MainController extends Controller
{
	
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
           $user = Auth::user();
           // dd($user->approved);
           if($user->approved == 0)
           {
           	
           }

           return $next($request);
        });
    }
}
