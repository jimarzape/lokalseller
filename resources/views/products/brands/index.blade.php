@extends('layouts.app')
@section('css')
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" type="text/css" href="/plugin/image-uploader.css">
@endsection
@section('content')

<div class="container-fluid">
	@if (count($errors) > 0)
	<div class="alert alert-danger alert-dismissible">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<ul>
			@foreach($errors as $errors)
			<li>{{$errors}}</li>
			@endforeach
		</ul>
	</div>
	@endif
	<div class="card">
		<div class="card-header text-gold">
			<h5 >Total Brands&nbsp;<span class="text-white bg-success badge">{{ $_brand->total() }}</span>
			<button class="btn btn-gold pull-right btn-modal" data-toggle="modal" data-target="#brand-modal" data-container=".modal-content" data-url="{{route('product.brand.new')}}" data-id="0"><i class="mdi mdi-plus"></i>&nbsp;New Brand</button></h5>
		</div>
		<div class="card-body">
			<div class="col-md-12">
				<div class="table-reponsive">
					<div class="reload-content">
						<table class="table table-bordered table-condensed">
							<thead>
								<tr>
									<th class="text-gold">Brand Name</th>
									<th class="text-gold">Brand Image</th>
									<th class="text-gold text-center">Actions</th>
								</tr>
							</thead>
							<tbody>
								@foreach($_brand as $brand)
								<tr>
									<td class="text-gold">{{$brand->brand_name}}</td>
									<td class="text-center">
										<img src="{{$brand->brand_image}}" class="img-75">
									</td>
									<td class="text-center">
										<button class="btn btn-modal btn-sm btn-info" data-toggle="modal" data-target="#brand-modal" data-url="{{route('product.brand.view')}}" data-container=".modal-content" data-id="{{$brand->brand_id}}"><i class="ti-pencil"></i></button>
	                                    <button class="btn btn-sm btn-danger btn-archived" data-url="{{route('product.brand.archived')}}" data-id="{{$brand->brand_id}}" data-name="{{$brand->brand_name}}"><i class="ti-trash"></i></button>
									</td>
								</tr>
								@endforeach
								@if($_brand->total() == 0)
								<tr>
									<td colspan="3" class="text-gold text-center"><i>No record found.</i></td>
								</tr>
								@endif
							</tbody>
						</table>
						{!!$_brand->appends(request()->query())->links()!!}
			            <br><span class="text-gold">Records Found : {{ $_brand->total() }}. Showing {{ $_brand->firstItem() }} to {{ $_brand->lastItem() }} of total {{$_brand->total()}} entries</span>
		            </div>
				</div>
			</div>
		</div>
	</div>
</div>
<div id="brand-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            
        </div>
    </div>
</div>
@endsection

@section('js')
<script type="text/javascript" src="/plugin/image-uploader.js"></script>
<script type="text/javascript" src="/js/brand.js?{{time()}}"></script>
@endsection