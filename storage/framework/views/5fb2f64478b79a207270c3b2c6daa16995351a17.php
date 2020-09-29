<?php $__env->startSection('content'); ?>
<div class="container-fluid">
	<div class="card">
		<div class="card-header">
			<h5 >
				Total Sales&nbsp;> <span class=""><?php echo e(number_format($_total, 2)); ?></span>
				<a class="btn btn-success pull-right" href="<?php echo e(route('reports.sales.export')); ?>?from=<?php echo e(Request::input('from')); ?>&to=<?php echo e(Request::input('to')); ?>"><i class="mdi mdi-file-excel"></i>&nbsp;Export to Excel</a>
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
													<input type="date" name="from" class="form-control" value="<?php echo e(Request::input('from')); ?>">
												</div>
												<div class="col-md-4">
													<input type="date" name="to" class="form-control" value="<?php echo e(Request::input('to')); ?>">
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
								<?php $__currentLoopData = $_sales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sales): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<tr>
									<td><a href="<?php echo e(route('orders.view',Crypt::encrypt($sales->seller_order_id))); ?>"><?php echo e($sales->order_number); ?></a></td>
									<td><?php echo e($sales->seller_order_number); ?></td>
									<td class="text-right"><?php echo e(number_format($sales->seller_sub_total, 2)); ?></td>
									<td class="text-right"><?php echo e(number_format($sales->seller_delivery_fee, 2)); ?></td>
									<td class="text-right"><?php echo e(number_format(($sales->seller_pouch_amount * $sales->seller_pouch_qty), 2)); ?></td>
									<td class="text-right"><?php echo e(number_format($sales->seller_share, 2)); ?></td>
									<td class="text-right"><?php echo e(number_format($sales->seller_net, 2)); ?></td>
									<td><?php echo e(date('M d, Y', strtotime($sales->created_at))); ?></td>
								</tr>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</tbody>
						</table>
						<?php echo $_sales->appends(request()->query())->links(); ?>

			            <br><span class="text-gold">Records Found : <?php echo e($_sales->total()); ?>. Showing <?php echo e($_sales->firstItem()); ?> to <?php echo e($_sales->lastItem()); ?> of total <?php echo e($_sales->total()); ?> entries</span>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\lokalseller\resources\views/reports/sales.blade.php ENDPATH**/ ?>