@extends('layouts.app')
@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					<h5 class="text-gold">{{$order->order_number}}<a href="{{route('orders.print', Crypt::encrypt($order->order_id))}}" class="pull-right f24 btn-print-pdf"><i class="mdi mdi-printer"></i></a></h5>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="card">
				<div class="card-header">
					<h4>Customer Info </h4>
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
							<p><span>Courrier</span><span class="text-gold pull-right">{{$order->delivery_type}}</span></p>
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
		<div class="col-md-4">
			<div class="card">
				<div class="card-header">
					<h5 class="">LOKALDATPH</h5>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-md-12">
							<p><span>Lokal Share ({{number_format($order->lokal_com, 2)}}%)</span><span class="text-gold pull-right">{{number_format($order->lokal_com_amount, 2)}}</span></p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="card">
				<div class="card-header">
					<h4>Order Status</h4>
				</div>
				<div class="card-body">
					<form class="row form-submit" action="{{route('orders.status')}}" method="POST">
						@csrf
						<input type="hidden" value="{{Crypt::encrypt($order->order_id)}}" name="order_id">
						<div class="col-md-12">
							<div class="form-group">
								<label class="text-gold">Status</label>
								<select class="form-control" name="status" required>
									<option value="">Select Status</option>
									@foreach($_status as $status)
									<option value="{{$status->id}}" {{$status->id == $order->delivery_status  ? 'selected="selected"' : ''}}>{{$status->status_name}}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="col-md-12">
							<button class="btn btn-gold btn-block btn-submit" type="submit">Update Order Status</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		
		<div class="col-md-4">
			<div class="card">
				<div class="card-header">
					<h4>Pouch Info</h4>
				</div>
				<form class="card-body form-submit" action="{{route('orders.pouch')}}" method="POST">
					<div class="row">
						@csrf
						<input type="hidden" value="{{Crypt::encrypt($order->order_id)}}" name="order_id">
						<div class="col-md-12">
							<div class="form-group">
								<label class="text-gold">Pouch Size</label>
								<select class="form-control pouch-size pouch-change" name="pouch_id" required>
									<option value="">Select Size</option>
									@foreach($_pouches as $pouch)
									<option value="{{$pouch->id}}" {{$order->pouch_id == $pouch->id ? 'selected="selected"' : ''}} data-amount={{$pouch->pouch_price}}>{{$pouch->pouch_size}}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="text-gold">Quantity</label>
								<input type="number" name="pouch_qty" class="form-control text-right pouch-qty pouch-change" value="{{$order->pouch_qty}}" placeholder="0" min="1" required>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="text-gold">Pouch Amount</label>
								<input type="text" readonly class="form-control text-right pouch-total" value="{{number_format($order->pouch_amount * $order->pouch_qty, 2)}}">
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-groupm">
								<button class="btn btn-gold btn-block btn-submit" type="submit">Update Pouch</button>
							</div>
						</div>
					</div>
				</form>
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