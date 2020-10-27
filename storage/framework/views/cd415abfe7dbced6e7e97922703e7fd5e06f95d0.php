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
				<?php $__currentLoopData = $err; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<li><?php echo e($img); ?></li>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</ul>
	</div>
	<?php endif; ?>
	<form class="" action="<?php echo e(route('product.update')); ?>" method="POST" enctype="multipart/form-data">
		<?php echo csrf_field(); ?>
		<input type="hidden" name="product_id" value="<?php echo e($product->product_id); ?>">
		<div class="card">
			<div class="card-header text-gold">
				<h3 class="text-gold">Basic Information</h3>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-md-12 ">
						<div class="form-group">
							<label class="text-gold">Product Image(s)</label>
		                    <div class="input-images"></div>
	                    </div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="text-gold">Product Name</label>
							<input type="text" class="form-control"  name="product_name" value="<?php echo e(old('product_name',$product->product_name)); ?>" required>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="text-gold">Brands</label>
									<select class="form-control" name="brand_id" required>
										<option value="">Select Brand</option>
										<?php $__currentLoopData = $_brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<option value="<?php echo e($brand->brand_id); ?>" <?php echo e(old('brand_id',$product->brand_id) == $brand->brand_id ? 'selected="selected"' : ''); ?>><?php echo e($brand->brand_name); ?></option>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</select>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="text-gold">SKU</label>
									<input type="text" class="form-control" value="<?php echo e(old('sku',$product->sku)); ?>"  name="sku">
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-2"></div>
					<div class="col-md-4">
						<div class="form-group">
							<label class="text-gold">Display Price:</label>
							<input type="number" min="0" step="any" class="form-control text-right" value="<?php echo e(old('product_price',$product->product_price)); ?>"  name="product_price" required>
						</div>
						<div class="form-group">
							<button class="btn btn-primary btn-block btn-modal" type="button" data-toggle="modal" data-target="#sale-modal" data-id="<?php echo e($product->product_id); ?>" data-container=".modal-content" data-url="<?php echo e(route('product.put_sale')); ?>">Put on Sale</button>
						</div>
					</div>
				
					
					<div class="col-md-12">
						<div class="form-group">
							<label class="text-gold">Short Description</label>
							<input type="text" class="form-control" name="product_specification" value="<?php echo e(old('product_specification',$product->product_specification)); ?>">
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group">
							<label class="text-gold">Description</label>
							<textarea text-html5-editor class=" form-control" name="product_desc" rows="15" placeholder="Enter text ..."><?php echo old('product_desc',$product->product_desc); ?></textarea>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="card">
			<div class="card-header text-gold">
				<h3 class="text-gold">
					<span>Inventory</span>

					<button type="button" class="btn btn-gold pull-right btn-modal ml-5" data-target="#stock-modal" data-toggle="modal" data-id="<?php echo e($product->product_id); ?>" data-container=".modal-content" data-url="<?php echo e(route('product.new_stocks')); ?>">Manage Stocks</button>
					<a href="<?php echo e(route('product.stock.logs', Crypt::encrypt($product->product_id))); ?>" class="btn btn-gold pull-right ">View Stock Logs</a> 
				</h3>
			</div>
			<div class="card-body">
				<div class="row"> 
					<div class="col-md-12">
						<div class="form-group">
							<div class="reload-content">
								<table class="table table-bordered table-condensed">
									<thead>
										<tr>
											<th class="text-gold">Size</th>
											<th class="text-gold">Unit Price</th>
											<th class="text-gold">Weight (grams)</th>
											<th class="text-gold">Stocks</th>
										</tr>
									</thead>
									<tbody>
										<?php $__currentLoopData = $_attr; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $attr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<tr>
											<td class="text-gold"><?php echo e($attr['size']); ?></td>
											<td class="text-gold text-right"><?php echo e(number_format($attr['price'], 2)); ?></td>
											<td class="text-gold text-right"><?php echo e(number_format($attr['weight'], 2)); ?></td>
											<td class="text-gold text-right"><?php echo e(number_format($attr['stocks'])); ?></td>
										</tr>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</tbody>
								</table>
							</div>
						</div>	
					</div>
				</div>
			</div>
			<div class="card-footer text-right">
				<a class="btn btn-danger" href="<?php echo e(route('product.manage')); ?>">Cancel</a>
				<button class="btn btn-gold" type="submit">Update Product</button>
			</div>
		</div>
	</form>
</div>
<div id="stock-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            
        </div>
    </div>
</div>
<div id="sale-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script type="text/javascript" src="/plugin/image-uploader.js"></script>
<script src="/dark/plugins/html5-editor/wysihtml5-0.3.0.js"></script>
    <script src="/dark/plugins/html5-editor/bootstrap-wysihtml5.js"></script>
<script type="text/javascript">
	$(document).ready(function () {
		$('.input-images').imageUploader({
			preloaded : [
				<?php $__currentLoopData = $_images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $imgs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				{
					id : "<?php echo e($imgs->product_image_id.'-img'); ?>",
					src : "<?php echo e($imgs->image_url); ?>"
				},
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			]
		});
		$('.text-html5-editor').wysihtml5();
	});
</script>
<script type="text/javascript" src="/js/product-edit.js?<?php echo e(time()); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\lokalseller\resources\views/products/edit.blade.php ENDPATH**/ ?>