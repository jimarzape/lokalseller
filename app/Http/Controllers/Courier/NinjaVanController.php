<?php

namespace App\Http\Controllers\Courier;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\MainController;
use App\Models\NinjaVan;
use Auth;

class NinjaVanController extends MainController
{
    public function __construct()
    {
    	parent::__construct();
    	$this->data['_pages'] = pages('Courier','Ninja Van');
    }

    public function index()
    {
    	$ninja = NinjaVan::seller(Auth::user()->id)->first();
    	$data['ninja_client_name'] 		= isset($ninja->ninja_client_name) ? $ninja->ninja_client_name : '';
    	$data['ninja_client_id'] 		= isset($ninja->ninja_client_id) ? $ninja->ninja_client_id : '';
    	$data['ninja_client_secret'] 	= isset($ninja->ninja_client_secret) ? $ninja->ninja_client_secret : '';

    	$this->data['ninja'] = $data;
    	return view('courier.ninja', $this->data);
    }

    public function save(Request $request)
    {
    	$check = NinjaVan::seller(Auth::user()->id)->first();
    	$ninja = new NinjaVan;
    	if(!is_null($check))
    	{
    		$ninja->exists = true;
    		$ninja->ninjavan_id = $check->ninjavan_id;
    	}
    	$ninja->seller_id 			= Auth::user()->id;
    	$ninja->ninja_client_name  	= $request->ninja_client_name;
		$ninja->ninja_client_id 	= $request->ninja_client_id;
		$ninja->ninja_client_secret = $request->ninja_client_secret;
    	$ninja->save();

    	return redirect()->route('courier.ninja');
    }
}
