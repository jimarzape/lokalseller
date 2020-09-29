var fix_order = new fix_order();

function fix_order()
{
	init();

	function init()
	{
		btn_function();
		form_submit();
	}

	function btn_function()
	{
		$(".btn-check-order").unbind("click");
		$(".btn-check-order").bind("click", function() {
			var btn = $(this);
			var route = $(this).data('url');
			var btn_html = btn.html();
			btn.html('checking....');
			$.ajax({
				url 	: 	route,
				type 	: 'POST',
				data 	: {},
				success : function(result)
				{
					btn.html(btn_html);
					$(".checker-container").html(result);
				},
				error 	: 	function(err)
				{
					btn.html(btn_html);
					alert('Error something went wrong');
				}
			});
		});
	}

	function form_submit()
	{
		$(".form-submit").unbind("submit");
		$(".form-submit").bind("submit", function(e){
			e.preventDefault();
			var btn = $(this).find('.btn-submit');
			var btn_html = btn.html();
			btn.html('Checking...');
			var formdata = $(this).serialize();
			var route = $(this).attr('action');
			var method = $(this).attr('method');
			var content = $(this).parent('.card-body').find('.submit-result');
			$.ajax({
				url : route,
				type : method,
				data : formdata,
				success : function(result)
				{
					btn.html(btn_html);
					content.html(result);
				},
				error 	: function(err)
				{
					btn.html(btn_html);
					alert('Error');
					content.html(err);
				}
			});
		});
	}
}