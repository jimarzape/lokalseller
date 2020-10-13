@extends('layouts.app')
@section('content')
<div class="container-fluid">
	<div class="card">
		<div class="card-header">
			<h5>Total Logs <span class="text-white bg-success badge">{{number_format($_logs->total())}}</span></h5>
		</div>
		<div class="card-body">
			<div class="row">
				<div class="col-md-12">
					<div class="">
						<table class="table table-condensed table-bordered text-gold">
							<thead>
								<tr>
									<th width="15%">User</th>
									<th>Logs</th>
									<th width="15%">Date</th>
								</tr>
							</thead>
							<tbody>
								@foreach($_logs as $logs)
								<tr>
									<td>{{$logs->name}}</td>
									<td>{!!$logs->logs!!}</td>
									<td>{{date('M d, Y', strtotime($logs->created_at))}}</td>
								</tr>
								@endforeach
								@if($_logs->total() == 0)
								<tr>
									<td colspan="3" class="text-center">
										<i>No record found.</i>
									</td>
								</tr>
								@endif
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