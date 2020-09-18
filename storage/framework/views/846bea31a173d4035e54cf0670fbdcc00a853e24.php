<?php $__env->startSection('css'); ?>
<link rel="stylesheet" type="text/css" href="/dark/scss/icons/font-awesome/css/font-awesome.css">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

<div class="container-fluid">
	
	<div class="card">
		<div class="card-header text-gold">
			<h5 >Total Products&nbsp;<span class="text-white bg-success badge"><?php echo e($_items->total()); ?></span>
			<a class="btn btn-gold pull-right "  href="<?php echo e(route('product.add')); ?>"><i class="mdi mdi-plus"></i>&nbsp;New Product</a></h5>
		</div>
		<div class="card-body">
			<div class="col-md-12">
				<div class="table-reponsive">
					<div class="reload-content">
						<table class="table table-bordered table-condensed">
							<thead>
								<tr>
									<th class="text-gold">Product Name</th>
									<th class="text-gold">Brand</th>
									<th class="text-gold">Retail Price</th>
									<th class="text-gold">Stocks</th>
									<th class="text-gold text-center">Active</th>
									<th class="text-gold text-center">Actions</th>
								</tr>
							</thead>
							<tbody>
								<?php $__currentLoopData = $_items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<tr>
									<td class="text-gold"><?php echo e($item->product_name); ?></td>
									<td class="text-gold"><?php echo e($item->brand_name); ?></td>
									<td class="text-gold text-right"><?php echo e(number_format($item->product_price, 2)); ?></td>
									<td class="text-gold text-right">
										<?php echo e(number_format($item->stocks)); ?>

									</td>
									<td class="text-center ">
										<a href="javascript:void(0)" class="btn-status" data-id="<?php echo e($item->product_id); ?>" data-url="<?php echo e(route('product.status')); ?>">
											<i class="fa fa-<?php echo e($item->product_active == 1 ? 'check' : 'times'); ?> text-gold" aria-hidden="true"></i>
										</a>
									</td>
									<td class="text-center">
										<a class="btn btn-sm btn-info" href="<?php echo e(route('product.edit',Crypt::encrypt ($item->product_id))); ?>"><i class="ti-pencil"></i></a>
	                                    <button class="btn btn-sm btn-danger btn-archived" data-url="<?php echo e(route('product.archived')); ?>" data-id="<?php echo e($item->product_id); ?>" data-name="<?php echo e($item->product_name); ?>"><i class="ti-trash"></i></button>
									</td>
								</tr>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								<?php if($_items->total() == 0): ?>
								<tr>
									<td colspan="6" class="text-gold text-center"><i>No record found.</i></td>
								</tr>
								<?php endif; ?>
							</tbody>
						</table>
						<?php echo $_items->appends(request()->query())->links(); ?>

			            <br><span class="text-gold">Records Found : <?php echo e($_items->total()); ?>. Showing <?php echo e($_items->firstItem()); ?> to <?php echo e($_items->lastItem()); ?> of total <?php echo e($_items->total()); ?> entries</span>
		            </div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script type="text/javascript" src="/js/product-manage.js?<?php echo e(time()); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\lokalseller\resources\views/products/manage.blade.php ENDPATH**/ ?>