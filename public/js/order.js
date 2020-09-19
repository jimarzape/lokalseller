var order = new order();

function order()
{
	init();

	function init()
	{
		form_submit();
		pouch();
		btn_function()
	}

	function btn_function()
	{
		$(".btn-print-pdf").unbind("click");
		$(".btn-print-pdf").bind("click", function(e){
			e.preventDefault();
			var route = $(this).attr('href');
			createPopupWin(route, '',700,700);
		});
	}

	function form_submit()
	{
		$(".form-submit").unbind("submit");
		$(".form-submit").bind("submit", function(e){
			e.preventDefault();
			var formdata 	= $(this).serialize();
			var action 		= $(this).attr('action');
			var method 		= $(this).attr('method');
			var btn 		= $(this).find('.btn-submit');
			var btn_val  	= btn.html();
			btn.html('Updating...');
			$.ajax({
				url 	: 	action,
				type 	: 	method,
				data 	: 	formdata,
				success : 	function(result)
				{
					btn.html(btn_val);
					alert_toast("success",'Success',result.message);
					init();
				},
				error 	 : function(err)
				{
					btn.html(btn_val);
					alert_toast("error","Error",err.responseText);
					init();
				}
			});
		});	
	}	

	function pouch()
	{
		$(".pouch-change").unbind("change");
		$(".pouch-change").bind("change", function(){
			var amount = $(".pouch-size").find(':selected').attr('data-amount');
			var qty = $(".pouch-qty").val();
			var total = parseFloat(amount) * parseFloat(qty);
			total = isNaN(total) ? 0 : total;
			$(".pouch-total").val(number_format(total.toFixed(2)));
		});
	}

	function number_format(number) {
	    // return parseFloat(number).toLocaleString('en');
	    return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
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

	function createPopupWin(pageURL, pageTitle, popupWinWidth, popupWinHeight) { 
        var left = (screen.width - popupWinWidth) / 2; 
        var top = (screen.height - popupWinHeight) / 4; 
          
        var myWindow = window.open(pageURL, pageTitle,  
                'resizable=yes, width=' + popupWinWidth 
                + ', height=' + popupWinHeight + ', top=' 
                + top + ', left=' + left); 
    } 
}