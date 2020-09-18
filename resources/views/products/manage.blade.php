@extends('layouts.app')
@section('css')
<link rel="stylesheet" type="text/css" href="/dark/scss/icons/font-awesome/css/font-awesome.css">
@endsection
@section('content')

<div class="container-fluid">
	
	<div class="card">
		<div class="card-header text-gold">
			<h5 >Total Products&nbsp;<span class="text-white bg-success badge">{{ $_items->total() }}</span>
			<a class="btn btn-gold pull-right "  href="{{route('product.add')}}"><i class="mdi mdi-plus"></i>&nbsp;New Product</a></h5>
		</div>
		<div class="card-body">
			<div class="col-md-12">
				<div class="table-reponsive">
					<div class="reload-content">
						<table class="table table-bordered table-condensed">
							<thead>
								<tr>
									<th class="text-gold">Product Name</th>
									<th class="text-gold">Brand</th>
									<th class="text-gold">Retail Price</th>
									<th class="text-gold">Stocks</th>
									<th class="text-gold text-center">Active</th>
									<th class="text-gold text-center">Actions</th>
								</tr>
							</thead>
							<tbody>
								@foreach($_items as $item)
								<tr>
									<td class="text-gold">{{$item->product_name}}</td>
									<td class="text-gold">{{$item->brand_name}}</td>
									<td class="text-gold text-right">{{number_format($item->product_price, 2)}}</td>
									<td class="text-gold text-right">
										{{number_format($item->stocks)}}
									</td>
									<td class="text-center ">
										<a href="javascript:void(0)" class="btn-status" data-id="{{$item->product_id}}" data-url="{{route('product.status')}}">
											<i class="fa fa-{{ $item->product_active == 1 ? 'check' : 'times'}} text-gold" aria-hidden="true"></i>
										</a>
									</td>
									<td class="text-center">
										<a class="btn btn-sm btn-info" href="{{route('product.edit',Crypt::encrypt ($item->product_id))}}"><i class="ti-pencil"></i></a>
	                                    <button class="btn btn-sm btn-danger btn-archived" data-url="{{route('product.archived')}}" data-id="{{$item->product_id}}" data-name="{{$item->product_name}}"><i class="ti-trash"></i></button>
									</td>
								</tr>
								@endforeach
								@if($_items->total() == 0)
								<tr>
									<td colspan="6" class="text-gold text-center"><i>No record found.</i></td>
								</tr>
								@endif
							</tbody>
						</table>
						{!!$_items->appends(request()->query())->links()!!}
			            <br><span class="text-gold">Records Found : {{ $_items->total() }}. Showing {{ $_items->firstItem() }} to {{ $_items->lastItem() }} of total {{$_items->total()}} entries</span>
		            </div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('js')
<script type="text/javascript" src="/js/product-manage.js?{{time()}}"></script>
@endsection