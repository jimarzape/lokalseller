<?php $__env->startSection('css'); ?>
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" type="text/css" href="/plugin/image-uploader.css">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

<div class="container-fluid">
	<?php if(count($errors) > 0): ?>
	<div class="alert alert-danger alert-dismissible">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<ul>
			<?php $__currentLoopData = $errors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $errors): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<li><?php echo e($errors); ?></li>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</ul>
	</div>
	<?php endif; ?>
	<div class="card">
		<div class="card-header text-gold">
			<h5 >Total Brands&nbsp;<span class="text-white bg-success badge"><?php echo e($_brand->total()); ?></span>
			<button class="btn btn-gold pull-right btn-modal" data-toggle="modal" data-target="#brand-modal" data-container=".modal-content" data-url="<?php echo e(route('product.brand.new')); ?>" data-id="0"><i class="mdi mdi-plus"></i>&nbsp;New Brand</button></h5>
		</div>
		<div class="card-body">
			<div class="col-md-12">
				<div class="table-reponsive">
					<div class="reload-content">
						<table class="table table-bordered table-condensed">
							<thead>
								<tr>
									<th class="text-gold">Brand Name</th>
									<th class="text-gold">Brand Image</th>
									<th class="text-gold text-center">Actions</th>
								</tr>
							</thead>
							<tbody>
								<?php $__currentLoopData = $_brand; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<tr>
									<td class="text-gold"><?php echo e($brand->brand_name); ?></td>
									<td class="text-center">
										<img src="<?php echo e($brand->brand_image); ?>" class="img-75">
									</td>
									<td class="text-center">
										<button class="btn btn-modal btn-sm btn-info" data-toggle="modal" data-target="#brand-modal" data-url="<?php echo e(route('product.brand.view')); ?>" data-container=".modal-content" data-id="<?php echo e($brand->brand_id); ?>"><i class="ti-pencil"></i></button>
	                                    <button class="btn btn-sm btn-danger btn-archived" data-url="<?php echo e(route('product.brand.archived')); ?>" data-id="<?php echo e($brand->brand_id); ?>" data-name="<?php echo e($brand->brand_name); ?>"><i class="ti-trash"></i></button>
									</td>
								</tr>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								<?php if($_brand->total() == 0): ?>
								<tr>
									<td colspan="3" class="text-gold text-center"><i>No record found.</i></td>
								</tr>
								<?php endif; ?>
							</tbody>
						</table>
						<?php echo $_brand->appends(request()->query())->links(); ?>

			            <br><span class="text-gold">Records Found : <?php echo e($_brand->total()); ?>. Showing <?php echo e($_brand->firstItem()); ?> to <?php echo e($_brand->lastItem()); ?> of total <?php echo e($_brand->total()); ?> entries</span>
		            </div>
				</div>
			</div>
		</div>
	</div>
</div>
<div id="brand-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script type="text/javascript" src="/plugin/image-uploader.js"></script>
<script type="text/javascript" src="/js/brand.js?<?php echo e(time()); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\lokalseller\resources\views/products/brands/index.blade.php ENDPATH**/ ?>