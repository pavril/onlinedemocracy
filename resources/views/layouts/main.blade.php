<!DOCTYPE html>
<html lang="{{ App::getLocale() }}">
	<head>
		
		<title>@yield('title') - Direct Democracy</title>
        <!-- Required meta tags always come first -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
    
        <!-- Bootstrap CSS -->
        <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet" type="text/css">
        
        <!-- Custom CSS -->
        <link href="{{ asset('css/font-awesome.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css">
        
 	</head>
	<body>
	
  		<div class="container-fluid">
        
        @yield('content_base')
        
        </div>

	    <!-- jQuery first, then Bootstrap JS. -->
	    <script src="{{ asset('js/jquery.js') }}"></script>
	    <script src="{{ asset('js/jquery-ui.js') }}"></script>
	    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    	<script>
	    $('.popover-info').popover({
			trigger: 'focus'
		})
	    </script>
	    @yield('footer_scripts')
	</body>
</html>