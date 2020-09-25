@extends('layouts.app')
@section('content')
<div class="container-fluid">
	<div class="card">
		<div class="card-header text-gold">
			<h5 >Total Orders&nbsp;<span class="text-white bg-success badge">{{ $_orders->total() }}</span>
			
		</div>
		<div class="card-body">
			<div class="col-md-12">
				<div class="table-responsive">
					<table class="table table-bordered table-condensed text-gold">
						<thead>

							<tr>
								<th>Order No.</th>
								<th>Order Date</th>
								<th>Payment Type</th>
								<th>Courrier</th>
								<th>Retail Price</th>
								<th>Order Status</th>
								<th>Actions</th>
							</tr>
							<form>
								<tr>
									<th>
										<input type="search" class="form-control" name="order_no" placeholder="Search order no. here." value="{{Request::input('order_no')}}">
									</th>
									<th></th>
									<th>
										<select class="form-control" name="payment_method">
											<option value="all" {{Request::input('payment_method') == 'all' ? 'selected="selected"' : ''}}>All</option>
											@foreach($_payment as $payment)
											<option value="{{$payment->id}}"  {{Request::input('payment_method') == $payment->id ? 'selected="selected"' : ''}}>{{$payment->payment_method}}</option>
											@endforeach
										</select>
									</th>
									<th>
										<select class="form-control" name="delivery_type">
											<option value="all" {{Request::input('delivery_type') == 'all' ? 'selected="selected"' : ''}}>All</option>
											@foreach($_courrier as $cour)
											<option value="{{$cour->id}}"  {{Request::input('delivery_type') == $cour->id ? 'selected="selected"' : ''}}>{{$cour->delivery_type}}</option>
											@endforeach
										</select>
									</th>
									<th></th>
									<th>
										<select class="form-control" name="order_status">
											<option value="all" {{Request::input('order_status') == 'all' ? 'selected="selected"' : ''}}>All</option>
											@foreach($_status as $status)
											<option value="{{$status->id}}" {{Request::input('order_status') == $status->id ? 'selected="selected"' : ''}}>{{$status->status_name}}</option>
											@endforeach
										</select>
									</th>
									<th>
										<button class="btn btn-gold">Search</button>
									</th>
								</tr>
							</form>
						</thead>
						<tbody>
							@foreach($_orders as $orders)
							<tr>
								<td>
									<a href="{{route('orders.view', Crypt::encrypt($orders->order_id))}}">{{$orders->order_number}}</a>
								</td>
								<td>{{date_norm(order_date($orders->order_date),'M d, y h:i a')}}</td>
								<td>{{$orders->payment_method}}</td>
								<td>{{$orders->delivery_type}}</td>
								<td class="text-right">{{number_format($orders->seller_total, 2)}}</td>
								<td>{{$orders->status_name}}</td>
								<td class="text-center">
									<a href="{{route('orders.view', Crypt::encrypt($orders->order_id))}}" title="view details"><i class="mdi mdi-pencil-box"></i></a>
									@if($orders->seller_delivery_status == 2)
									<a href="{{route('orders.print', Crypt::encrypt($orders->order_id))}}" class="pull-right btn-print-pdf" title="print receipt"><i class="mdi mdi-printer"></i></a>
									@endif
								</td>
							</tr>
							@endforeach
							@if($_orders->total() == 0)
							<tr>
								<td colspan="7" class="text-gold text-center"><i>No record found.</i></td>
							</tr>
							@endif
						</tbody>
					</table>
					{!!$_orders->appends(request()->query())->links()!!}
			        <br><span class="text-gold">Records Found : {{ $_orders->total() }}. Showing {{ $_orders->firstItem() }} to {{ $_orders->lastItem() }} of total {{$_orders->total()}} entries</span>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('js')
<script type="text/javascript" src="/js/order.js?{{time()}}"></script>
@endsection