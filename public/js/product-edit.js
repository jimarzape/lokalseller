var product_edit = new product_edit();

function product_edit()
{
	init();
	var loader = '<center><div class="spinner-border text-warning spinnger-7" role="status"> <span class="sr-only">Loading...</span></div> </center>'; 
    
	function init()
	{
		btn_function();
	}

	function btn_function()
	{
		$(".btn-modal").unbind("click");
		$(".btn-modal").bind("click", function(){
			var id 		= $(this).data('id');
			var link 	= $(this).data('url');
			var target 	= $(this).data('container');
			$(target).html(loader);
			$.ajax({
				url 	: 	link,
				type 	: 	'POST',
				data 	: 	{
					'id' : id,
				},
				success : 	function(result)
				{
					$(target).html(result);
					form_submit();
				},
				error 	: 	function(err)
				{
					error_handler();
				}
			});
		});
	}

	function form_submit()
	{
		$(".form-submit").unbind('submit');
		$(".form-submit").bind("submit", function(e){
			e.preventDefault();
			var formdata = $(this).serialize();
			var link	 = $(this).attr('action');
			var method 	 = $(this).attr('method');
			var btn 	 = $(this).find('.btn-save');
			var btn_html = btn.html();
			btn.html('Saving...');
			$.ajax({
				url 	: 	link,
				type 	: 	method,
				data 	: 	formdata,
				success : 	function(result)
				{
					$("#stock-modal").modal('toggle');
					alert_toast("success","Stocks has been updated");
					reload();
				},
				error 	: 	function(Err){
					btn.html(btn_html);
					alert_toast("error","Error",err.responseText);
				}
			});
		});
	}

	function error_handler(err_msg = 'Error, something went wrong.')
	{
		alert(err_msg);
	}

	function alert_toast(type, header, message)
	{
		var bg = {
			"success" 	: "#ff6849",
			"error"		: "#ff6849",
			"info" 		: "#ff6849",
			"warning"	: "#ff6849"
	 	}

	 	$.toast({
			heading: header,
		    text: message,
		    position: 'top-right',
		    loaderBg: bg[type],
		    icon: type,
		    hideAfter: 3500
		});

	}


	function reload()
	{
		$(".reload-content").load(document.URL + ' .reload-content', function(){
            btn_function();
        });
	}
}