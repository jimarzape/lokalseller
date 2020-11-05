@extends('layouts.app')
@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<form class="card-body" action="{{route('courier.ninja.save')}}" method="POST">
					@csrf
					<div class="row">
						<div class="col-md-6">
							<img src="/images/ninjavan.png" class="img-100">
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>API CLIENT NAME</label>
								<input type="text" class="form-control" value="{{$ninja['ninja_client_name']}}" name="ninja_client_name" required>
							</div>
							<div class="form-group">
								<label>API CLIENT ID</label>
								<input type="text" class="form-control" value="{{$ninja['ninja_client_id']}}" name="ninja_client_id" required>
							</div>
							<div class="form-group">
								<label>API CLIENT SECRET</label>
								<input type="text" class="form-control" value="{{$ninja['ninja_client_secret']}}" name="ninja_client_secret" required>
							</div>
							<div class="form-group">
								<button class="btn btn-primary pull-right">Save</button>
							</div>
						</div>
					</div>
				</form>
				
			</div>
		</div>
	</div>
</div>
@endsection

@section('js')
@endsection