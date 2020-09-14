<?php $__env->startSection('css'); ?>
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" type="text/css" href="/plugin/image-uploader.css">
<link rel="stylesheet" href="/dark/plugins/html5-editor/bootstrap-wysihtml5.css" />
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="container-fluid">
	<?php if(count($errors) > 0): ?>
	<div class="alert alert-danger alert-dismissible">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<ul>
			<?php $__currentLoopData = $errors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $err): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<?php if(is_array ($err)): ?>
					<?php $__currentLoopData = $err; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<li><?php echo e($img); ?></li>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				<?php else: ?>
				<li><?php echo e($err); ?></li>
				<?php endif; ?>
			
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</ul>
	</div>
	<?php endif; ?>
	<form class="" action="<?php echo e(route('product.save')); ?>" method="POST" enctype="multipart/form-data">
		<?php echo csrf_field(); ?>
		<div class="card">
			<div class="card-header text-gold">
				Basic Information
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-md-12 ">
						<div class="form-group">
							<label class="text-gold">Product Image/s</label>
		                    <div class="input-images"></div>
	                    </div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="text-gold">Product Name</label>
							<input type="text" class="form-control"  name="product_name" required>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="text-gold">Display Price: (Enter the lowest price on this item).</label>
							<input type="number" min="0" step="any" class="form-control text-right"  name="product_price" required>
						</div>
					</div>
				
					<div class="col-md-4">
						<div class="form-group">
							<label class="text-gold">Brands</label>
							<select class="form-control" name="brand_id" required>
								<option value="">Select Brand</option>
								<?php $__currentLoopData = $_brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<option value="<?php echo e($brand->brand_id); ?>"><?php echo e($brand->brand_name); ?></option>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</select>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label class="text-gold">SKU</label>
							<input type="number" min="0" class="form-control text-right"  name="product_identifier">
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group">
							<label class="text-gold">Short Description</label>
							<input type="text" class="form-control" name="product_specification">
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group">
							<label class="text-gold">Description</label>
							<textarea class="text-html5-editor form-control" name="product_desc" rows="15" placeholder="Enter text ..."></textarea>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="card">
			<div class="card-header text-gold">Inventory</div>
			<div class="card-body">
				<div class="row"> 
					<div class="col-md-12">
						<div class="form-group">
							<table class="table table-bordered table-condensed">
								<thead>
									<tr>
										<th class="text-gold">Size</th>
										<th class="text-gold">Unit Price</th>
										<th class="text-gold">Weight</th>
										<th class="text-gold">Stocks</th>
									</tr>
								</thead>
								<tbody>
									<?php $__currentLoopData = attributes(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attributes): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<tr>
										<td class="text-gold"><?php echo e($attributes); ?></td>
										<td>
											<input type="hidden" name="sizes[]" value="<?php echo e($attributes); ?>">
											<input type="number" value="0" name="price[]" class="form-control text-right" step="any" min="0">
										</td>
										<td>
											<input type="number" value="0" class="form-control text-right" step="any" min="0" name="weight[]">
										</td>
										<td>
											<input type="number" value="0" class="form-control text-right" name="stocks[]">
										</td>
									</tr>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								</tbody>
							</table>
						</div>	
					</div>
				</div>
			</div>
			<div class="card-footer text-right">
				<button class="btn btn-gold">Add to Product</button>
			</div>
		</div>
	</form>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script type="text/javascript" src="/plugin/image-uploader.js"></script>
<script src="/dark/plugins/html5-editor/wysihtml5-0.3.0.js"></script>
    <script src="/dark/plugins/html5-editor/bootstrap-wysihtml5.js"></script>
<script type="text/javascript">
	$(document).ready(function () {
		$('.input-images').imageUploader();
		$('.text-html5-editor').wysihtml5();
	});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\lokalseller\resources\views/products/add.blade.php ENDPATH**/ ?>