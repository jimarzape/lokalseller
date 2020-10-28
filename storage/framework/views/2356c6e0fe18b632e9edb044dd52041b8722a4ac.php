<form action="<?php echo e(route('product.update_sale')); ?>" method="POST" class="form-submit">
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
                    <label>Saling Price</label>
                    <input type="number" name="product_price" class="form-control text-right" step="any" min="1" value="<?php echo e($product_price); ?>" required>
                </div>
                <div class="form-group">
                    <label>Slash Price</label>
                    <input type="number" name="slash" class="form-control text-right" min="0" step="any" value="<?php echo e($slash_price); ?>">
                </div>
                <div class="form-group">
                    <i>Leaving <b>SLASH PRICE</b> to zero means item won't be on any sale discount price and saling price will treat as <b>ORIGINAL</b> price</i>
                </div>
            </div>
    	</div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-gold waves-effect waves-light btn-save">Save</button>
    </div>
</form><?php /**PATH C:\laragon\www\lokalseller\resources\views/products/sale.blade.php ENDPATH**/ ?>