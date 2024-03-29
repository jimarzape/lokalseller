@extends('layouts.app')
@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					<h5 class="text-gold">{{$order->order_number}} @if($order->seller_delivery_status == 2)<a href="{{route('orders.print', Crypt::encrypt($order->seller_order_id))}}" class="pull-right f24 btn-print-pdf"><i class="mdi mdi-printer"></i></a>@endif</h5>
				</div>
			</div>
		</div>
		<div class="col-md-8 row">
			<div class="col-md-6">
				<div class="card">
					<div class="card-header">
						<h4>Customer Info </h4>
					</div>
					<div class="card-body">
						<div class="row">
							<div class="col-md-12">
								<p><span>Date</span> <span class="text-gold pull-right">{{date_norm(order_date($order->order_date),'M d, Y h:i a')}}</span></p>
								<p><span>Customer</span> <span class="text-gold pull-right">{{$order->userFullName}}</span></p>
								<p><span>Phone Number</span> <span class="text-gold pull-right">{{$order->userMobile}}</span></p>
								<p><span>Payment Method</span> <span class="text-gold pull-right">{{$order->payment_method}}</span></p>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="card">
					<div class="card-header">
						<h4>Transaction Info</h4>
					</div>
					<div class="card-body">
						<div class="row">
							<div class="col-md-12">
								<p><span>Sub Total</span><span class="text-gold pull-right">{{number_format($order->seller_sub_total, 2)}}</span></p>
								<p><span>Shipping Fee</span><span class="text-gold pull-right">{{number_format($order->seller_delivery_fee, 2)}}</span></p>
								<p><span>Grand Total</span><span class="text-gold pull-right">{{number_format($order->seller_total, 2)}}</span></p>
								<p><span>Courier</span><span class="text-gold pull-right">{{$order->delivery_type}}</span></p>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="card">
					<div class="card-header">
						<h4>Shipping Address</h4>
					</div>
					<div class="card-body">
						<div class="row">
							<div class="col-md-12">
								<p class="text-gold">{{$order->userFullName}}</p>
								<p class="text-gold">{{strtoupper($order->userShippingAddress.', '.$order->userBarangay.', '.$order->userCityMunicipality.', '.$order->userProvince)}}</p>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="card">
					<div class="card-header">
						<h5 class="">LOKALDATPH</h5>
					</div>
					<div class="card-body">
						<div class="row">
							<div class="col-md-12">
								<p><span>Lokal Share ({{number_format($order->seller_share_rate, 2)}}%)</span><span class="text-gold pull-right">{{number_format($order->seller_share, 2)}}</span></p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="">
				<div class="card">
					<div class="card-header">
						<h4>Order Updates</h4>
					</div>
					<div class="card-body">
						<form class=" form-submit" action="{{route('orders.status')}}" method="POST">
							@csrf
							<input type="hidden" value="{{Crypt::encrypt($order->seller_order_id)}}" class="order_id" name="order_id">
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label class="text-gold">Order Status</label>
										@if(order_allow($order->seller_delivery_status))
										<select class="form-control" name="status" required>
											<option value="">Select Status</option>
											@foreach($_status as $status)
											<option value="{{$status->id}}" {{$status->id == $order->seller_delivery_status  ? 'selected="selected"' : ''}}>{{$status->status_name}}</option>
											@endforeach
										</select>
										@else
										<span class="text-gold pull-right">{{$order->status_name}}</span>
										@endif
									</div>
								</div>
								<hr>
								<div class="col-md-12">
									<div class="form-group">
										<label class="text-gold">Pouch Size</label>
										<select class="form-control pouch-size pouch-change" name="pouch_id" required>
											<option value="">Select Size</option>
											@foreach($_pouches as $pouch)
											<option value="{{$pouch->id}}" data-amount={{$pouch->pouch_price}} {{$order->seller_pouch_id == $pouch->id ? 'selected=selected' : ''}} >{{$pouch->pouch_size}}</option>
											@endforeach
										</select>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-gold">Quantity</label>
										<input type="number" name="pouch_qty" class="form-control text-right pouch-qty pouch-change" value="{{$order->seller_pouch_qty}}" placeholder="0" min="1" required>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-gold">Pouch Amount</label>
										<input type="text" readonly class="form-control text-right pouch-total text-gold" value="{{number_format($order->seller_pouch_amount * $order->seller_pouch_qty, 2)}}">
									</div>
								</div>
							
								@if(order_allow($order->seller_delivery_status))
								<div class="col-md-12">
									<button class="btn btn-gold btn-block btn-submit" type="submit">Update Order</button>
								</div>
								@endif
							</div>
						</form>
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
										<td><a href="{{route('product.edit',Crypt::encrypt ($items->product_id))}}">{{$items->product_identifier}}</a></td>
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

@section('js')
<script type="text/javascript" src="/js/order.js?{{time()}}"></script>
@endsection