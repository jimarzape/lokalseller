<?php $__env->startSection('content'); ?>
<div class="container-fluid">
	<div class="card">
		<div class="card-header text-gold">
			<h5 >Total Orders&nbsp;<span class="text-white bg-success badge"><?php echo e($_orders->total()); ?></span>
			
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
										<input type="search" class="form-control" name="order_no" placeholder="Search order no. here." value="<?php echo e(Request::input('order_no')); ?>">
									</th>
									<th></th>
									<th>
										<select class="form-control" name="payment_method">
											<option value="all" <?php echo e(Request::input('payment_method') == 'all' ? 'selected="selected"' : ''); ?>>All</option>
											<?php $__currentLoopData = $_payment; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<option value="<?php echo e($payment->id); ?>"  <?php echo e(Request::input('payment_method') == $payment->id ? 'selected="selected"' : ''); ?>><?php echo e($payment->payment_method); ?></option>
											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
										</select>
									</th>
									<th>
										<select class="form-control" name="delivery_type">
											<option value="all" <?php echo e(Request::input('delivery_type') == 'all' ? 'selected="selected"' : ''); ?>>All</option>
											<?php $__currentLoopData = $_courrier; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cour): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<option value="<?php echo e($cour->id); ?>"  <?php echo e(Request::input('delivery_type') == $cour->id ? 'selected="selected"' : ''); ?>><?php echo e($cour->delivery_type); ?></option>
											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
										</select>
									</th>
									<th></th>
									<th>
										<select class="form-control" name="order_status">
											<option value="all" <?php echo e(Request::input('order_status') == 'all' ? 'selected="selected"' : ''); ?>>All</option>
											<?php $__currentLoopData = $_status; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<option value="<?php echo e($status->id); ?>" <?php echo e(Request::input('order_status') == $status->id ? 'selected="selected"' : ''); ?>><?php echo e($status->status_name); ?></option>
											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
										</select>
									</th>
									<th>
										<button class="btn btn-gold">Search</button>
									</th>
								</tr>
							</form>
						</thead>
						<tbody>
							<?php $__currentLoopData = $_orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $orders): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<tr>
								<td>
									<a href="<?php echo e(route('orders.view', Crypt::encrypt($orders->order_id))); ?>"><?php echo e($orders->order_number); ?></a>
								</td>
								<td><?php echo e(date_norm(order_date($orders->order_date),'M d, y h:i a')); ?></td>
								<td><?php echo e($orders->payment_method); ?></td>
								<td><?php echo e($orders->delivery_type); ?></td>
								<td class="text-right"><?php echo e(number_format($orders->seller_total, 2)); ?></td>
								<td><?php echo e($orders->status_name); ?></td>
								<td class="text-center">
									<a href="<?php echo e(route('orders.view', Crypt::encrypt($orders->order_id))); ?>" title="view details"><i class="mdi mdi-pencil-box"></i></a>
									<?php if($orders->delivery_status == 2): ?>
									<a href="<?php echo e(route('orders.print', Crypt::encrypt($orders->order_id))); ?>" class="pull-right btn-print-pdf" title="print receipt"><i class="mdi mdi-printer"></i></a>
									<?php endif; ?>
								</td>
							</tr>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							<?php if($_orders->total() == 0): ?>
							<tr>
								<td colspan="7" class="text-gold text-center"><i>No record found.</i></td>
							</tr>
							<?php endif; ?>
						</tbody>
					</table>
					<?php echo $_orders->appends(request()->query())->links(); ?>

			        <br><span class="text-gold">Records Found : <?php echo e($_orders->total()); ?>. Showing <?php echo e($_orders->firstItem()); ?> to <?php echo e($_orders->lastItem()); ?> of total <?php echo e($_orders->total()); ?> entries</span>
				</div>
			</div>
		</div>
	</div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script type="text/javascript" src="/js/order.js?<?php echo e(time()); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\lokalseller\resources\views/orders/index.blade.php ENDPATH**/ ?>