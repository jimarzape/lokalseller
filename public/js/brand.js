var brand = new brand();

function brand()
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
						reload();
					},
					error 	: 	function(Err)
					{
						error_handler();
					}
				});
			}	
		});
	}

	function upload_picture()
	{
		$(".btn-upload").unbind("click");
		$(".btn-upload").bind("click", function(){
			var target = $(this).data('target');
			$(target).click();
		});
		$(".main-upload").unbind('change');
		$(".main-upload").bind('change', function(){
			var image   = $(this)[0].files[0];
			var url     = $(this).data('url');
			var token  	= $("._token").val();
			// var token   = $(this).data('token');
			var formdata    = new FormData();
			var ajax        = new XMLHttpRequest();
			var parent 		= $(this).parents('.icon-container');
			var progress 	= parent.find('.progress-container');
			var _progress   = progress.find('.progress-bar');
			var target 		= parent.find('.img-main');
			var input 		= parent.find('.img-main-input');
			progress.removeClass('hide');

			formdata.append("image", image);
			formdata.append('_token',token);

			ajax.upload.addEventListener('progress', function(e){
			_progress.css("width",Math.ceil(e.loaded/e.total) * 100 + '%');
			}, false);
			ajax.addEventListener("load", function(e){
				var link = e.target.responseText;
				target.attr("src",ajax.responseText);
				input.val(ajax.responseText);
				progress.addClass('hide');
				upload_picture();

			}, false);
			ajax.open('POST', url);
			ajax.send(formdata);
		});
	}

	function form_submit()
	{
		// upload_picture();
		
		// $('.input-images').bind('imageUploader');

		$(".form-submit").unbind('submit');
		$(".form-submit").bind("submit", function(e){
			e.preventDefault();
			var formdata = $(this).serialize();
			var link	 = $(this).attr('action');
			var method 	 = $(this).attr('method');
			$.ajax({
				url 	: 	link,
				type 	: 	method,
				data 	: 	formdata,
				success : 	function(result)
				{
					// reload();
					// $("#modal-category").modal('toggle');
				},
				error 	: 	function(Err){
					error_handler();
				}
			});
		});
	}

	function error_handler(err_msg = 'Error, something went wrong.')
	{
		alert(err_msg);
	}


	function reload()
	{
		$(".reload-content").load(document.URL + ' .reload-content', function(){
            btn_function();
        });
	}
}