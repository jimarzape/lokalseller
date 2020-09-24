<form action="<?php echo e(route('product.save_stock')); ?>" method="POST" class="form-submit">
	<?php echo csrf_field(); ?>
    <input type="hidden" name="product_id" value="<?php echo e($product_id); ?>">
	<div class="modal-header">
        <h4 class="modal-title">Add New Stocks</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    </div>
    <div class="modal-body">
    	<div class="row">
    		<div class="col-md-12">
                <div class="table-reponsive">
                    <table class="table table-bordred table-condensed table-hover text-gold">
                        <thead>
                            <tr>
                                <th>Size</th>
                                <th>Unit Price</th>
                                <th>Weight(grams)</th>
                                <th>Stocks</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = attributes(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $attributes): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
    <div class="modal-footer">
        <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-gold waves-effect waves-light btn-save">Save Stocks</button>
    </div>
</form><?php /**PATH C:\laragon\www\lokalseller\resources\views/products/stocks.blade.php ENDPATH**/ ?>