<form action="{{route('product.save_stock')}}" method="POST" class="form-submit">
	@csrf
    <input type="hidden" name="product_id" value="{{$product_id}}">
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
                            @foreach(attributes() as $key => $attributes)
                            <tr>
                                <td class="text-gold">{{$attributes}}</td>
                                <td>
                                    <input type="hidden" name="sizes[]" value="{{$attributes}}">
                                    <input type="number" value="0" name="price[]" class="form-control text-right" step="any" min="0">
                                </td>
                                <td>
                                    <input type="number" value="0" class="form-control text-right" step="any" min="0" name="weight[]">
                                </td>
                                <td>
                                    <input type="number" value="0" class="form-control text-right" name="stocks[]">
                                </td>
                            </tr>
                            @endforeach
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
</form>