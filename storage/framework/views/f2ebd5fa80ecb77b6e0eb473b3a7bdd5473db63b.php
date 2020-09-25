<?php $__env->startSection('content'); ?>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					<h5 class="text-gold"><?php echo e($order->order_number); ?> <?php if($order->seller_delivery_status == 2): ?><a href="<?php echo e(route('orders.print', Crypt::encrypt($order->seller_order_id))); ?>" class="pull-right f24 btn-print-pdf"><i class="mdi mdi-printer"></i></a><?php endif; ?></h5>
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
							<p><span>Date</span> <span class="text-gold"><?php echo e(date_norm(order_date($order->order_date),'M d, Y h:i a')); ?></span></p>
							<p><span>Customer</span> <span class="text-gold"><?php echo e($order->userFullName); ?></span></p>
							<p><span>Phone Number</span> <span class="text-gold"><?php echo e($order->userMobile); ?></span></p>
							<p><span>Payment Method</span> <span class="text-gold"><?php echo e($order->payment_method); ?></span></p>
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
							<p><span>Sub Total</span><span class="text-gold pull-right"><?php echo e(number_format($order->order_subtotal, 2)); ?></span></p>
							<p><span>Shipping Fee</span><span class="text-gold pull-right"><?php echo e(number_format($order->order_delivery_fee, 2)); ?></span></p>
							<p><span>Grand Total</span><span class="text-gold pull-right"><?php echo e(number_format($order->order_amount_due, 2)); ?></span></p>
							<p><span>Courrier</span><span class="text-gold pull-right"><?php echo e($order->delivery_type); ?></span></p>
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
							<p class="text-gold"><?php echo e($order->userFullName); ?></p>
							<p class="text-gold"><?php echo e($order->userShippingAddress); ?></p>
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
							<p><span>Lokal Share (<?php echo e(number_format($order->lokal_com, 2)); ?>%)</span><span class="text-gold pull-right"><?php echo e(number_format($order->lokal_com_amount, 2)); ?></span></p>
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
					<form class="row form-submit" action="<?php echo e(route('orders.status')); ?>" method="POST">
						<?php echo csrf_field(); ?>
						<input type="hidden" value="<?php echo e(Crypt::encrypt($order->seller_order_id)); ?>" class="order_id" name="order_id">
						<div class="col-md-12">
							<div class="form-group">
								<label class="text-gold">Status</label>
								<select class="form-control" name="status" required>
									<option value="">Select Status</option>
									<?php $__currentLoopData = $_status; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<option value="<?php echo e($status->id); ?>" <?php echo e($status->id == $order->seller_delivery_status  ? 'selected="selected"' : ''); ?>><?php echo e($status->status_name); ?></option>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
				<form class="card-body form-submit" action="<?php echo e(route('orders.pouch')); ?>" method="POST">
					<div class="row">
						<?php echo csrf_field(); ?>
						<input type="hidden" value="<?php echo e(Crypt::encrypt($order->seller_order_id)); ?>" name="order_id">
						<div class="col-md-12">
							<div class="form-group">
								<label class="text-gold">Pouch Size</label>
								<select class="form-control pouch-size pouch-change" name="pouch_id" required>
									<option value="">Select Size</option>
									<?php $__currentLoopData = $_pouches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pouch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<option value="<?php echo e($pouch->id); ?>" <?php echo e($order->pouch_id == $pouch->seller_pouch_id ? 'selected="selected"' : ''); ?> data-amount=<?php echo e($pouch->pouch_price); ?>><?php echo e($pouch->pouch_size); ?></option>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								</select>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="text-gold">Quantity</label>
								<input type="number" name="pouch_qty" class="form-control text-right pouch-qty pouch-change" value="<?php echo e($order->seller_pouch_qty); ?>" placeholder="0" min="1" required>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="text-gold">Pouch Amount</label>
								<input type="text" readonly class="form-control text-right pouch-total text-gold" value="<?php echo e(number_format($order->seller_pouch_amount * $order->seller_pouch_qty, 2)); ?>">
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
									<?php $__currentLoopData = $_items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $items): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<tr>
										<td><a href="<?php echo e(route('product.edit',Crypt::encrypt ($items->product_id))); ?>"><?php echo e($items->product_identifier); ?></a></td>
										<td><?php echo e($items->product_name); ?></td>
										<td><?php echo e($items->size); ?></td>
										<td class="text-right"><?php echo e(number_format($items->quantity)); ?></td>
										<td class="text-right"><?php echo e(number_format($items->product_price, 2)); ?></td>
									</tr>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script type="text/javascript" src="/js/order.js?<?php echo e(time()); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\lokalseller\resources\views/orders/view.blade.php ENDPATH**/ ?>