<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<style type="text/css">
	body
	{
		max-width: 720px;
		margin:auto;
		border: 1px solid #cdcdcd
	}
	.logo-header
	{
		text-align: center;
		padding:2em;
	}
	.logo-header img
	{
		margin: auto;
		width: 100px;
		height: auto;
	}
</style>
<body>
	<div class="logo-header">
		<img src="http://lokalseller.lokaldatph.com/dark/images/logo-icon.png">
	</div>
	@yield('header')
	@yield('body')
	@yield('footer')
</body>
</html>