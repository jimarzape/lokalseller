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
	@if(session()->has('success'))
	<div class="alert alert-success alert-dismissible">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		{{ session()->get('success') }}
	</div>
	@endif
	<form class="" action="{{route('product.save')}}" method="POST" enctype="multipart/form-data">
		@csrf
		<div class="card">
			<div class="card-header text-gold">
				Basic Information
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
							<input type="text" class="form-control"  name="product_name" value="{{old('product_name')}}" required>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="text-gold">Display Price: (Enter the lowest price on this item).</label>
							<input type="number" min="0" step="any" class="form-control text-right" value="{{old('product_price')}}"  name="product_price" required>
						</div>
					</div>
				
					<div class="col-md-4">
						<div class="form-group">
							<label class="text-gold">Brands</label>
							<select class="form-control" name="brand_id" required>
								<option value="">Select Brand</option>
								@foreach($_brands as $brand)
								<option value="{{$brand->brand_id}}" {{old('brand_id') == $brand->brand_id ? 'selected="selected"' : ''}}>{{$brand->brand_name}}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label class="text-gold">SKU (optional)</label>
							<input type="text" class="form-control" value="{{old('product_identifier')}}"  name="product_identifier">
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group">
							<label class="text-gold">Short Description</label>
							<input type="text" class="form-control" name="product_specification" value="{{old('product_specification')}}">
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group">
							<label class="text-gold">Description</label>
							<textarea class="text-html5-editor form-control" name="product_desc" rows="15" placeholder="Enter text ...">{!!old('product_desc')!!}</textarea>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="card">
			<div class="card-header text-gold">Inventory</div>
			<div class="card-body">
				<div class="row"> 
					<div class="col-md-12">
						<div class="form-group">
							<table class="table table-bordered table-condensed">
								<thead>
									<tr>
										<th class="text-gold">Size</th>
										<th class="text-gold">Unit Price</th>
										<th class="text-gold">Weight</th>
										<th class="text-gold">Stocks</th>
									</tr>
								</thead>
								<tbody>
									@foreach(attributes() as $key => $attributes)
									<tr>
										<td class="text-gold">{{$attributes}}</td>
										<td>
											<input type="hidden" name="sizes[]" value="{{$attributes}}">
											<input type="number" value="0" name="price[]" class="form-control text-right" step="any" min="0">
										</td>
										<td>
											<input type="number" value="0" class="form-control text-right" step="any" min="0" name="weight[]">
										</td>
										<td>
											<input type="number" value="0" class="form-control text-right" name="stocks[]">
										</td>
									</tr>
									@endforeach
								</tbody>
							</table>
						</div>	
					</div>
				</div>
			</div>
			<div class="card-footer text-right">
				<button class="btn btn-gold">Add to Product</button>
			</div>
		</div>
	</form>
</div>
@endsection

@section('js')
<script type="text/javascript" src="/plugin/image-uploader.js"></script>
<script src="/dark/plugins/html5-editor/wysihtml5-0.3.0.js"></script>
    <script src="/dark/plugins/html5-editor/bootstrap-wysihtml5.js"></script>
<script type="text/javascript">
	$(document).ready(function () {
		$('.input-images').imageUploader();
		$('.text-html5-editor').wysihtml5();
	});
</script>
@endsection