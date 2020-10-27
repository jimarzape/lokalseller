<form action="<?php echo e(route('product.save_stock')); ?>" method="POST" class="form-submit">
	<?php echo csrf_field(); ?>
    <input type="hidden" name="product_id" value="<?php echo e($product_id); ?>">
	<div class="modal-header">
        <h4 class="modal-title">Put on SALE</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    </div>
    <div class="modal-body">
    	<div class="row">
    		<div class="col-md-12">
                <div class="form-group">
                    <label>Sale Price</label>
                    <input type="number" name="" class="form-control">
                </div>
                <div class="form-group">
                    <label>Original Price</label>
                    <input type="number" name="" class="form-control">
                </div>
                <div class="form-group">
                    <i>Leaving <b>Sale Price</b> to zero means item won't be on any sale discount price.</i>
                </div>
            </div>
    	</div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-gold waves-effect waves-light btn-save">Save</button>
    </div>
</form><?php /**PATH C:\laragon\www\lokalseller\resources\views/products/sale.blade.php ENDPATH**/ ?>