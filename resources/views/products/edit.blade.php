@extends('layouts.app')
@section('css')
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" type="text/css" href="/plugin/image-uploader.css">
<link rel="stylesheet" href="/dark/plugins/html5-editor/bootstrap-wysihtml5.css" />
@endsection
@section('content')
<div class="container-fluid">
	@if (count($errors) > 0)
	<div class="alert alert-danger alert-dismissible">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<ul>
			@foreach($errors as $err)
				@foreach($err as $img)
				<li>{{$img}}</li>
				@endforeach
			@endforeach
		</ul>
	</div>
	@endif
	<form class="" action="{{route('product.update')}}" method="POST" enctype="multipart/form-data">
		@csrf
		<input type="hidden" name="product_id" value="{{$product->product_id}}">
		<div class="card">
			<div class="card-header text-gold">
				<h3 class="text-gold">Basic Information</h3>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-md-12 ">
						<div class="form-group">
							<label class="text-gold">Product Image(s)</label>
		                    <div class="input-images"></div>
	                    </div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="text-gold">Product Name</label>
							<input type="text" class="form-control"  name="product_name" value="{{old('product_name',$product->product_name)}}" required>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="text-gold">Display Price: (Enter the lowest price on this item).</label>
							<input type="number" min="0" step="any" class="form-control text-right" value="{{old('product_price',$product->product_price)}}"  name="product_price" required>
						</div>
					</div>
				
					<div class="col-md-4">
						<div class="form-group">
							<label class="text-gold">Brands</label>
							<select class="form-control" name="brand_id" required>
								<option value="">Select Brand</option>
								@foreach($_brands as $brand)
								<option value="{{$brand->brand_id}}" {{old('brand_id',$product->brand_id) == $brand->brand_id ? 'selected="selected"' : ''}}>{{$brand->brand_name}}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label class="text-gold">SKU</label>
							<input type="text" class="form-control" value="{{old('sku',$product->sku)}}"  name="sku">
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group">
							<label class="text-gold">Short Description</label>
							<input type="text" class="form-control" name="product_specification" value="{{old('product_specification',$product->product_specification)}}">
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group">
							<label class="text-gold">Description</label>
							<textarea text-html5-editor class=" form-control" name="product_desc" rows="15" placeholder="Enter text ...">{!!old('product_desc',$product->product_desc)!!}</textarea>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="card">
			<div class="card-header text-gold">
				<h3 class="text-gold">
					<span>Inventory</span>

					<button type="button" class="btn btn-gold pull-right btn-modal ml-5" data-target="#stock-modal" data-toggle="modal" data-id="{{$product->product_id}}" data-container=".modal-content" data-url="{{route('product.new_stocks')}}">Manage Stocks</button>
					<a href="{{route('product.stock.logs', Crypt::encrypt($product->product_id))}}" class="btn btn-gold pull-right ">View Stock Logs</a> 
				</h3>
			</div>
			<div class="card-body">
				<div class="row"> 
					<div class="col-md-12">
						<div class="form-group">
							<div class="reload-content">
								<table class="table table-bordered table-condensed">
									<thead>
										<tr>
											<th class="text-gold">Size</th>
											<th class="text-gold">Unit Price</th>
											<th class="text-gold">Weight (grams)</th>
											<th class="text-gold">Stocks</th>
										</tr>
									</thead>
									<tbody>
										@foreach($_attr as $key => $attr)
										<tr>
											<td class="text-gold">{{$attr['size']}}</td>
											<td class="text-gold text-right">{{number_format($attr['price'], 2)}}</td>
											<td class="text-gold text-right">{{number_format($attr['weight'], 2)}}</td>
											<td class="text-gold text-right">{{number_format($attr['stocks'])}}</td>
										</tr>
										@endforeach
									</tbody>
								</table>
							</div>
						</div>	
					</div>
				</div>
			</div>
			<div class="card-footer text-right">
				<a class="btn btn-danger" href="{{route('product.manage')}}">Cancel</a>
				<button class="btn btn-gold" type="submit">Update Product</button>
			</div>
		</div>
	</form>
</div>
<div id="stock-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            
        </div>
    </div>
</div>
@endsection

@section('js')
<script type="text/javascript" src="/plugin/image-uploader.js"></script>
<script src="/dark/plugins/html5-editor/wysihtml5-0.3.0.js"></script>
    <script src="/dark/plugins/html5-editor/bootstrap-wysihtml5.js"></script>
<script type="text/javascript">
	$(document).ready(function () {
		$('.input-images').imageUploader({
			preloaded : [
				@foreach($_images as $key => $imgs)
				{
					id : "{{$imgs->product_image_id.'-img'}}",
					src : "{{$imgs->image_url}}"
				},
				@endforeach
			]
		});
		$('.text-html5-editor').wysihtml5();
	});
</script>
<script type="text/javascript" src="/js/product-edit.js?{{time()}}"></script>
@endsection