<form action="<?php echo e(route('product.brand.update')); ?>" method="POST" enctype="multipart/form-data">
	<?php echo csrf_field(); ?>
    <input type="hidden" name="brand_id" value="<?php echo e($brand->brand_id); ?>">
	<div class="modal-header">
        <h4 class="modal-title">Brand</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    </div>
    <div class="modal-body">
    	<div class="row">
    		<div class="col-md-12">
    			<div class="form-group">
    				<label class="text-gold">Item Image/s</label>
		            <div class="input-images"></div>
    			</div>
    		</div>
    		<div class="col-md-12">
    			<div class="form-group">
    				<label class="text-gold">Brand Name</label>
    				<input type="text" class="form-control" name="brand_name" value="<?php echo e($brand->brand_name); ?>" required>
    			</div>
    		</div>
    	</div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-gold waves-effect waves-light">Save changes</button>
    </div>
</form>
<script type="text/javascript">
	$(document).ready(function () {
		$('.input-images').imageUploader({
            preloaded : [
                {id : 1, src : "<?php echo e($brand->brand_image); ?>" }
            ]
        });
	});
</script><?php /**PATH C:\laragon\www\lokalseller\resources\views/products/brands/view.blade.php ENDPATH**/ ?>