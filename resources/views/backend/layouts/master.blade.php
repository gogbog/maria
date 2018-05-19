<!DOCTYPE html>

<!--[if IE 8]>         <html class="ie8"> <![endif]-->
<!--[if IE 9]>         <html class="ie9 gt-ie8"> <![endif]-->
<!--[if gt IE 9]><!--> <html class="gt-ie8 gt-ie9 not-ie"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>@yield('title') - Мария Официален сайт</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">

	<!-- Open Sans font from Google CDN -->
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,400,600,700,300&subset=latin" rel="stylesheet" type="text/css">
	<meta name="csrf-token" content="{{ csrf_token() }}" />
		@yield('css')

	<!-- Pixel Admin's stylesheets -->
	<link href="{{ Config::get('view.backend.css') }}/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="{{ Config::get('view.backend.css') }}/pixel-admin.min.css" rel="stylesheet" type="text/css">
	<link href="{{ Config::get('view.backend.css') }}/widgets.min.css" rel="stylesheet" type="text/css">
	<link href="{{ Config::get('view.backend.css') }}/rtl.min.css" rel="stylesheet" type="text/css">
	<link href="{{ Config::get('view.backend.css') }}/themes.min.css" rel="stylesheet" type="text/css">
	<link href="{{ Config::get('view.backend.css') }}/custom.css" rel="stylesheet" type="text/css">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.1.0/css/flag-icon.css" rel="stylesheet" type="text/css">




	<!--[if lt IE 9]>
		<script src="{{ Config::get('view.backend.js') }}/ie.min.js"></script>
	<![endif]-->
</head>


<!-- 1. $BODY ======================================================================================
	
	Body

	Classes:
	* 'theme-{THEME NAME}'
	* 'right-to-left'      - Sets text direction to right-to-left
	* 'main-menu-right'    - Places the main menu on the right side
	* 'no-main-menu'       - Hides the main menu
	* 'main-navbar-fixed'  - Fixes the main navigation
	* 'main-menu-fixed'    - Fixes the main menu
	* 'main-menu-animated' - Animate main menu
-->
<body class="theme-default main-menu-animated">
<script>var init = [];</script>


<div id="main-wrapper">

	@include('backend.layouts.header')
	@include('backend.layouts.left-menu')
	@yield('content')

	
	<div id="main-menu-bg"></div>
</div> <!-- / #main-wrapper -->

<!-- Get jQuery from Google CDN -->
<!--[if !IE]> -->
	<script type="text/javascript"> window.jQuery || document.write('<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js">'+"<"+"/script>"); </script>
<!-- <![endif]-->
<!--[if lte IE 9]>
	<script type="text/javascript"> window.jQuery || document.write('<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js">'+"<"+"/script>"); </script>
<![endif]-->


<!-- Pixel Admin's javascripts -->
<script src="{{ Config::get('view.backend.js') }}/bootstrap.min.js"></script>
<script src="{{ Config::get('view.backend.js') }}/pixel-admin.js?321312"></script>
<script type="text/javascript">
		 	var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
	</script>

@yield('javascript')

<script type="text/javascript">
	init.push(function () {
		// Javascript code here
	})
	window.PixelAdmin.start(init);
</script>

</body>
</html>