@extends('layouts.app')
@section('content')
<div class="container-fluid">
	<div class="card">
		<div class="card-header">
			<h5 >
				Total Sales&nbsp;> <span class="">{{number_format($_total, 2)}}</span>
				<a class="btn btn-success pull-right" href="{{route('reports.sales.export')}}?from={{Request::input('from')}}&to={{Request::input('to')}}"><i class="mdi mdi-file-excel"></i>&nbsp;Export to Excel</a>
			</h5>
		</div>
		<div class="card-body">
			<div class="row">
				<div class="col-md-12">
					<div class="table-responsive">
						<table class="table table-condensed table-bordered text-gold">
							<thead>
								<tr>
									<form action="" method="GET">
										<th colspan="3" class="text-right">
											<label>Filter By Date</label>
										</th>
										<th colspan="5">
											<div class="row">
												<div class="col-md-4">
													<input type="date" name="from" class="form-control" value="{{Request::input('from')}}">
												</div>
												<div class="col-md-4">
													<input type="date" name="to" class="form-control" value="{{Request::input('to')}}">
												</div>
												<div class="col-md-4">
													<button type="submit" class="btn btn-gold btn-block">Search</button>
												</div>
											</div>
										</th>
									</form>
								</tr>
								<tr>
									<th>Lokal Order Number</th>
									<th>Seller O.N.</th>
									<th width="125">Sub Total</th>
									<th width="125">Delivery Fee</th>
									<th>Pouch</th>
									<th>Lokal Share</th>
									<th>Net</th>
									<th width="125"></th>
								</tr>
							</thead>
							<tbody>
								@foreach($_sales as $sales)
								<tr>
									<td><a href="{{route('orders.view',Crypt::encrypt($sales->seller_order_id))}}">{{$sales->order_number}}</a></td>
									<td>{{$sales->seller_order_number}}</td>
									<td class="text-right">{{number_format($sales->seller_sub_total, 2)}}</td>
									<td class="text-right">{{number_format($sales->seller_delivery_fee, 2)}}</td>
									<td class="text-right">{{number_format(($sales->seller_pouch_amount * $sales->seller_pouch_qty), 2)}}</td>
									<td class="text-right">{{number_format($sales->seller_share, 2)}}</td>
									<td class="text-right">{{number_format($sales->seller_net, 2)}}</td>
									<td>{{date('M d, Y', strtotime($sales->created_at))}}</td>
								</tr>
								@endforeach
							</tbody>
						</table>
						{!!$_sales->appends(request()->query())->links()!!}
			            <br><span class="text-gold">Records Found : {{ $_sales->total() }}. Showing {{ $_sales->firstItem() }} to {{ $_sales->lastItem() }} of total {{$_sales->total()}} entries</span>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection