<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Controllers\MainController;
use Illuminate\Http\Request;
use App\Models\BrandModel;
use Validator;
use Auth;

class BrandController extends MainController
{
    public function __construct()
    {
        
        parent::__construct();
    	$this->data['_pages'] = pages('Products','Brands');
    }

    public function index()
    {
    	$this->data['_brand'] = BrandModel::details(Auth::user()->id)->paginate(20);
    	return view('products.brands.index', $this->data);
    }

    public function _new()
    {
    	return view('products.brands.new');
    }

    public function save(Request $request)
    {
    	if($request->has('images'))
    	{
    		$image 			= $request->file('images');
    		$count 			= count($image) - 1;
    		$file 			= $image[$count];
    		$fileArray 		= array('images' => $file);
    		$rules 			= array(
		      'images' => 'mimes:jpeg,jpg,png,gif|required|max:10000' // max 10000kb
		    );
		    $validator = Validator::make($fileArray, $rules);
		    if ($validator->fails())
		    {
		    	return back()->with(['errors' => $validator->errors()->getMessages()], 400);
		    }
		    else
		    {
			    $upload_path = '/uploads/brands';
		        if($request->folder){ $upload_path = $request->folder; }
		        
		        $name 				= str_randoms(5).time().'.'.$image[$count]->getClientOriginalExtension();
		        $destinationPath 	= public_path($upload_path);
		        $image[$count]->move($destinationPath, $name);
		        $path 				= $upload_path.'/'.$name;

		    	$brand 						= new BrandModel();
		    	$brand->owner_id 			= Auth::user()->id;
		    	$brand->brand_name 			= $request->brand_name;
		    	$brand->brand_image 		= url($path);
		    	$brand->brand_identifier 	= 'LK-'.Auth::user()->id.date('YmdHis');
		    	$brand->save();
		    }
    		

	    	
    	}
    	else
    	{
    		$error[] = 'Image is required.';
    		return back()->with('errors' , $error);
    	}

    	return back();
    	
    }			

    public function view(Request $request)
    {
    	$data['brand'] = BrandModel::where('brand_id', $request->id)->first();
    	return view('products.brands.view',$data);
    }

    public function update(Request $request)
    {
    	$data 	= BrandModel::where('brand_id', $request->brand_id)->first();
    	$path 	= '';
    	if(!is_null($data))
    	{
    		$path = $data->brand_image;
    	}
    	if($request->has('images'))
    	{
    		$upload_path = '/uploads/brands';
	        if($request->folder){ $upload_path = $request->folder; }
	        $image 				= $request->file('images');
	        $count 				= count($image);
	        $name 				= str_randoms(5).time().'.'.$image[$count - 1]->getClientOriginalExtension();
	        $destinationPath 	= public_path($upload_path);
	        $image[$count - 1]->move($destinationPath, $name);
	        $path 				= url($upload_path.'/'.$name);
    	}
    	$brand 						= new BrandModel();
    	$brand->exists 				= true;
    	$brand->brand_id 			= $request->brand_id;
    	$brand->brand_name 			= $request->brand_name;
    	$brand->brand_image 		= $path;
    	$brand->save();

    	return redirect()->route('product.brand');
    }

    public function archived(Request $request)
    {
    	$brand 						= new BrandModel();
    	$brand->exists 				= true;
    	$brand->brand_id 			= $request->id;
    	$brand->brand_archived 		= 1;
    	$brand->save();
    }
}
