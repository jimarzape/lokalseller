<?php $__env->startSection('content'); ?>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<form class="card-body" action="<?php echo e(route('courier.ninja.save')); ?>" method="POST">
					<?php echo csrf_field(); ?>
					<div class="row">
						<div class="col-md-6">
							<img src="/images/ninjavan.png" class="img-100">
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>API CLIENT NAME</label>
								<input type="text" class="form-control" value="<?php echo e($ninja['ninja_client_name']); ?>" name="ninja_client_name" required>
							</div>
							<div class="form-group">
								<label>API CLIENT ID</label>
								<input type="text" class="form-control" value="<?php echo e($ninja['ninja_client_id']); ?>" name="ninja_client_id" required>
							</div>
							<div class="form-group">
								<label>API CLIENT SECRET</label>
								<input type="text" class="form-control" value="<?php echo e($ninja['ninja_client_secret']); ?>" name="ninja_client_secret" required>
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
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\lokalseller\resources\views/courier/ninja.blade.php ENDPATH**/ ?>