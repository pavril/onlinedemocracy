<!DOCTYPE html>
<html lang="{{ App::getLocale() }}">
	<head>
		
		<title>@yield('title') - DirectDemocracy</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
    
        <link href="{{ asset('css_new/bootstrap.css') }}" rel="stylesheet" type="text/css">
        <link href="https://bootswatch.com/sandstone/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="{{ asset('css_new/font-awesome.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('css_new/app.css') }}" rel="stylesheet" type="text/css">
        
        @yield('header_scripts')
        
	    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	    <!--[if lt IE 9]>
	    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	    <![endif]-->
        
 	</head>
	<body>
	
        @yield('content_base')

	    <script src="{{ asset('js/jquery.js') }}" type="text/javascript"></script>
	    <script src="{{ asset('js/jquery-ui.js') }}" type="text/javascript"></script>
	    <script src="{{ asset('js/bootstrap.min.js') }}" type="text/javascript"></script>
    	<script>
	    $('.popover-info').popover({
			trigger: 'focus'
		})
		$(function () {
		  $('[data-toggle="tooltip"]').tooltip()
		})
	    </script>
	    @yield('footer_scripts')
	</body>
</html>