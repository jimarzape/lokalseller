<?php $__env->startSection('content'); ?>
<div class="container-fluid">
	<div class="card">
		<div class="card-header">
			<h5>Total Logs <span class="text-white bg-success badge"><?php echo e(number_format($_logs->total())); ?></span></h5>
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
								<?php $__currentLoopData = $_logs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $logs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<tr>
									<td><?php echo e($logs->name); ?></td>
									<td><?php echo $logs->logs; ?></td>
									<td><?php echo e(date('M d, Y', strtotime($logs->created_at))); ?></td>
								</tr>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								<?php if($_logs->total() == 0): ?>
								<tr>
									<td colspan="3" class="text-center">
										<i>No record found.</i>
									</td>
								</tr>
								<?php endif; ?>
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
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\lokalseller\resources\views/systems/logs.blade.php ENDPATH**/ ?>