var manage = new manage();

function  manage() {
	init();
	var pulse = '<i class="fa fa-spinner fa-pulse fa-fw text-gold"></i>';

	function  init() {
		btn_function();
	}

	function btn_function()
	{
		$(".btn-status").unbind("click");
		$(".btn-status").bind("click", function(){
			var target 	= $(this);
			var route 	= target.data('url');
			var id 		= target.data('id');
			var html 	= target.html();
			target.html(pulse);
			$.ajax({
				url 	: 	route,
				type 	: 	'POST',
				data 	: 	{
					'id' : id,
				},
				success : 	function(result)
				{
					var icon = result.status == 1 ? 'check' : 'times';
					var font_icon = '<i class="fa fa-'+icon+' text-gold" aria-hidden="true">';
					$(target).html(font_icon);
					alert_toast("success","Product Status",result.message);
					init();
				},
				error 	: 	function(err)
				{
					alert_toast("error","Error",err.responseText);
					target.html(html);
				}
			});
		});

		$(".btn-archived").unbind("click");
		$(".btn-archived").bind("click", function(){
			var link 	= $(this).data('url');
			var id 		= $(this).data('id');
			var name 	= $(this).data('name');
			var con 	= confirm("Do you really want to remove " + name + "?");
			if(con)
			{
				$.ajax({
					url 	: 	link,
					type 	: 	'POST',
					data 	: 	{
						'id' : id
					},
					success : 	function(result)
					{
						alert_toast("success","Product Delete", name + ' has been deleted');
						window.location.reload();
					},
					error 	: 	function(Err)
					{
						alert_toast("error","Error",err.responseText);
					}
				});
			}	
		});
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


}