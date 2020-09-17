@extends('layouts.app')
@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					<h5>{{$order->order_number}}</h5>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="card">
				<div class="card-header">
					<h4>Customer Info</h4>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-md-12">
							<p><span>Date</span> <span class="text-gold">{{date_norm(order_date($order->order_date),'M d, Y h:i a')}}</span></p>
							<p><span>Customer</span> <span class="text-gold">{{$order->userFullName}}</span></p>
							<p><span>Phone Number</span> <span class="text-gold">{{$order->userMobile}}</span></p>
							<p><span>Payment Method</span> <span class="text-gold">{{$order->payment_method}}</span></p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="card">
				<div class="card-header">
					<h4>Transaction Info</h4>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-md-12">
							<p><span>Sub Total</span><span class="text-gold pull-right">{{number_format($order->order_subtotal, 2)}}</span></p>
							<p><span>Shipping Fee</span><span class="text-gold pull-right">{{number_format($order->order_delivery_fee, 2)}}</span></p>
							<p><span>Grand Total</span><span class="text-gold pull-right">{{number_format($order->order_amount_due, 2)}}</span></p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="card">
				<div class="card-header">
					<h4>Shipping Address</h4>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-md-12">
							<p class="text-gold">{{$order->userFullName}}</p>
							<p class="text-gold">{{$order->userShippingAddress}}</p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<h4>Items</h4>
				</div>
				<div class="card-body">
					<div class="col-md-12">
						<div class="table-responsive">
							<table class="table table-condensed table-bordered text-gold">
								<thead>
									<tr>
										<th>SKU</th>
										<th>Item Name</th>
										<th>Size</th>
										<th>Order Qty</th>
										<th>Retail Price</th>
									</tr>
								</thead>
								<tbody>
									@foreach($_items as $items)
									<tr>
										<td>{{$items->product_identifier}}</td>
										<td>{{$items->product_name}}</td>
										<td>{{$items->size}}</td>
										<td class="text-right">{{number_format($items->quantity)}}</td>
										<td class="text-right">{{number_format($items->product_price, 2)}}</td>
									</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
</div>
@endsection