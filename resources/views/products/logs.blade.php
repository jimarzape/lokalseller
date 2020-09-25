@extends('layouts.app')
@section('content')
<div class="container-fluid">
	<div class="card">
		<div class="card-header">
			<h3 class="text-gold">{{$product->product_name}}</h3>
		</div>
		<div class="card-body">
			<div class="row">
				<div class="col-md-12">
					<div class="">
						<table class="table table-bordered table-condensed text-gold">
							<thead>
								<tr>
									<th>Size</th>
									<th class="text-center">Unit Price</th>
									<th class="text-center">Weight (grams)</th>
									<th class="text-center">Stock</th>
								</tr>
							</thead>
							<tbody>
								@foreach($_logs as $logs)
								<tr>
									<td>{{$logs->stocks_size}}</td>
									<td class="text-right">{{number_format($logs->stock_price, 2)}}</td>
									<td class="text-right">{{number_format($logs->stock_weight, 2)}}</td>
									<td class="text-right">{{number_format($logs->stock_qty)}}</td>
								</tr>
								@endforeach
							</tbody>
						</table>
						{!!$_logs->appends(request()->query())->links()!!}
			            <br><span class="text-gold">Records Found : {{ $_logs->total() }}. Showing {{ $_logs->firstItem() }} to {{ $_logs->lastItem() }} of total {{$_logs->total()}} entries</span>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection