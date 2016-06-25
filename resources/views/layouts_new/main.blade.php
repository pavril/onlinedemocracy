<!DOCTYPE html>
<html lang="{{ App::getLocale() }}">
	<head>
		
		<title>@yield('title') - DirectDemocracy</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        
	    <link rel="icon" type="image/svg+xml" href="{{ asset('img/logo.svg') }}" />
	    <link rel="alternate icon" type="image/png" href="{{ asset('img/logo.png') }}">
	    
	    <meta property="fb:admins" content="100002828091107" />
    
        <link href="{{ asset('css_new/bootstrap.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('css_new/sandstone.min.css') }}" rel="stylesheet" type="text/css">
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
		!function(e,t,n,r,a,s,i,l){n&&(s=n[r],s&&(i=e.createElement("style"),i.innerHTML=s,e.getElementsByTagName("head")[0].appendChild(i)),l=t.setAttribute,t.setAttribute=function(e,p,u,o){"string"==typeof p&&p.indexOf(a)>-1&&(u=new XMLHttpRequest,u.open("GET",p,!0),u.onreadystatechange=function(){if(4===u.readyState){o=u.responseText.replace(/url\(\//g,"url("+a+"/");try{o!==s&&(n[r]=o)}catch(e){s&&(s=i.innerHTML="")}}},u.send(null),t.setAttribute=l,s)||l.apply(this,arguments)})}(document,Element.prototype,localStorage,"tk","https://use.typekit.net");
		(function(d) {
		    var config = {
		      kitId: 'she3ccr',
		      scriptTimeout: 3000,
		      async: true
		    },
		    h=d.documentElement,t=setTimeout(function(){h.className=h.className.replace(/\bwf-loading\b/g,"")+" wf-inactive";},config.scriptTimeout),tk=d.createElement("script"),f=false,s=d.getElementsByTagName("script")[0],a;h.className+=" wf-loading";tk.src='https://use.typekit.net/'+config.kitId+'.js';tk.async=true;tk.onload=tk.onreadystatechange=function(){a=this.readyState;if(f||a&&a!="complete"&&a!="loaded")return;f=true;clearTimeout(t);try{Typekit.load(config)}catch(e){}};s.parentNode.insertBefore(tk,s)
		  })(document);
		</script>
		<script type="text/javascript">
	    $('.popover-info').popover({
			trigger: 'focus'
		})
		$(function () {
		  $('[data-toggle="tooltip"]').tooltip()
		})
		
		hashtag_regexp = /#([a-zA-Z0-9_]+)/g;
		function linkHashtags(text) {
			$link = "{{ route('search') . '?q=%23to_replace' }}";
		    return text.replace(
		        hashtag_regexp,
		        '<a class="hashtag" href="'+$link.replace('to_replace', '$1')+'">#$1</a>'
		    );
		}
		$(document).ready( function() {
			$('.linkHashtags').each(function() {
			    $(this).html(linkHashtags($(this).html()));
			});
		});
	    </script>
	    @yield('footer_scripts')
	</body>
</html>