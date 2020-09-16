var register = new register();

function register() {
	init();

	function init()
	{
		ajax_select();
	}

	function ajax_select()
	{
		$(".select-change").unbind("change");
		$(".select-change").bind("change", function(){
			var val = $(this).val();
			var target = $(this).data('target');
			var route = $(this).data('url');
			var oldhtml = $(target).html();
			var loading = '<option value="">Loading...</option>';
			$(target).html(loading);
			$.ajax({
				url : route,
				type : 'POST',
				data : {
					'code' : val
				},
				success : function(result)
				{
					var html = '';
					$.each(result.data, function(index, data){
						console.log(data);
						html += '<option value="'+data.code+'">'+data.label+'</option>';
					});
					
					$(target).html(html);
					init();
				},
				error : function(err)
				{
					$(target).html(oldhtml);
					init();
				}
			});
		});
	}
}