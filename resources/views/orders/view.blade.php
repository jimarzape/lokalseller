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
				<div class="card-body"></div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="card">
				<div class="card-header">
					<h4>Transaction Info</h4>
				</div>
				<div class="card-body"></div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="card">
				<div class="card-header">
					<h4>Shipping Address</h4>
				</div>
				<div class="card-body"></div>
			</div>
		</div>
	</div>
	
</div>
@endsection