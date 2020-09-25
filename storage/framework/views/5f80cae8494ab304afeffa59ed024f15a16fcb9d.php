<?php $__env->startSection('content'); ?>
<div class="container-fluid">
	<div class="card">
		<div class="card-header">
			<h3 class="text-gold"><?php echo e($product->product_name); ?></h3>
		</div>
		<div class="card-body">
			<div class="row">
				<div class="col-md-12">
					<div class="">
						<table class="table table-bordered table-condensed text-gold">
							<thead>
								<tr>
									<th>Size</th>
									<th class="text-center">Unit Price</th>
									<th class="text-center">Weight (grams)</th>
									<th class="text-center">Stock</th>
								</tr>
							</thead>
							<tbody>
								<?php $__currentLoopData = $_logs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $logs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<tr>
									<td><?php echo e($logs->stocks_size); ?></td>
									<td class="text-right"><?php echo e(number_format($logs->stock_price, 2)); ?></td>
									<td class="text-right"><?php echo e(number_format($logs->stock_weight, 2)); ?></td>
									<td class="text-right"><?php echo e(number_format($logs->stock_qty)); ?></td>
								</tr>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</tbody>
						</table>
						<?php echo $_logs->appends(request()->query())->links(); ?>

			            <br><span class="text-gold">Records Found : <?php echo e($_logs->total()); ?>. Showing <?php echo e($_logs->firstItem()); ?> to <?php echo e($_logs->lastItem()); ?> of total <?php echo e($_logs->total()); ?> entries</span>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\lokalseller\resources\views/products/logs.blade.php ENDPATH**/ ?>