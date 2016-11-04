@extends('layouts_new.main')

@section('content_base')
<div class="container-fluid" style="min-height:100%; position:relative;">

	<div class="container-fluid" id="navigation">
    	<nav class="navbar navbar-inverse navbar-fixed-top">
      		<div class="container">
        		<!-- Brand and toggle get grouped for better mobile display -->
        		<div class="navbar-header">
          			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#topFixedNavbar1"><span class="sr-only">{{ Lang::get('messages.navigation.nav_toggle') }}</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
          			<a class="navbar-brand" href="{{ route('propositions') }}">
          				<img src="{{ asset('img/logo.svg') }}" alt="DirectDemocracy logo">
          				DirectDemocracy
          			</a>
          		</div>

        		<div class="collapse navbar-collapse" id="topFixedNavbar1">
	         		<ul class="nav navbar-nav">
	            		<li class="@if(Route::current()->getName() == 'propositions') active @endif"><a href="{{ route('propositions') }}">{{ Lang::get('messages.navigation.home') }}</a></li>
	          			<li class="@if(Route::current()->getName() == 'archived') active @endif"><a href="{{ route('archived') }}">{{ Lang::get('messages.navigation.archived') }}</a></li>
	          		</ul>

	          		<form class="navbar-form navbar-left" role="search" method="get" action="{{ route('search') }}">
				    	<div class="form-group">
				      		<input name="q" type="text" @if (isset($_GET["q"]) == true) @if ($_GET["q"] !== null) value="{{ $_GET["q"] }}" @endif @endif class="form-control" placeholder="{{ Lang::get('messages.search.search') }}" autocomplete="off">
				        </div>
				    </form>

	          		<ul class="nav navbar-nav navbar-right">
						<li>
						<a href="{{ route('profile.propositions.create') }}" class="btn btn-teal"><i class="material-icons" style="font-size: 15px; vertical-align: sub;">create</i><span class="hidden-sm"> {{Lang::get('messages.navigation.create_proposition')}}</span></a></li>
	            		<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><img alt="profile picture of {{ $user['fullName'] }}" src="{{ $user['avatar'] }}" class="profile-picture-navbar img-circle"> {{ $user['fullName'] }}<span class="caret"></span></a>
		              		<ul class="dropdown-menu" role="menu">
		                		<li><a href="{{ route('profile.propositions') }}">{{Lang::get('messages.navigation.propositions')}}</a></li>
		                		<li><a href="{{ route('profile.main') }}">{{Lang::get('messages.navigation.profile')}}</a></li>
		                		<li class="divider"></li>
		                		<li><a href="{{ route('profile.language') }}">{{Lang::get('messages.navigation.language')}}</a></li>
		                		<li class="divider"></li>
		                		<li><a href="{{ route('logout') }}">{{Lang::get('messages.navigation.logout')}}</a></li>
		             		</ul>
	            		</li>
	          		</ul>
	        	</div>
	        	<!-- /.navbar-collapse -->
	      	</div>
	      	<!-- /.container-fluid -->
    	</nav>
  	</div>

	<div style="padding-bottom:40px; padding-top: 90px;">
	<div class="container">
		@if ($user['belongsToSchool'] == false)
		<div class="alert alert-info" role="alert" id="link-info" style="display: none;">
			<button type="button" class="close" data-dismiss="alert" data-alert-box="link-info" style="margin-top: -6px;" aria-label="Close"><span aria-hidden="true"><i class="material-icons">close</i></span></button>
			<p>{{ Lang::get('messages.notifications.welcome_link_alert_1') }} <a href="{{ route('getLinkAuth') }}" class="alert-link">{{ Lang::get('messages.notifications.welcome_link_alert_2') }}</a> {{ Lang::get('messages.notifications.welcome_link_alert_3') }}</p>
		</div>
		@endif

		<div class="alert alert-info" role="alert" id="lang-info" style="display: none; background-color: #607D8B;">
			<button type="button" class="close" data-dismiss="alert" data-alert-box="link-info" style="margin-top: -6px;" aria-label="Close"><span aria-hidden="true"><i class="material-icons">close</i></span></button>
			@if (Lang::locale() == 'en')
			<p>{{ Lang::get('messages.notifications.available_in_fr') }} <a href="{{ route('profile.language.set', ['fr']) }}" class="alert-link">{{ Lang::get('messages.languages.fr') }}</a>!</p>
			@else
			<p>{{ Lang::get('messages.notifications.available_in_en') }} <a href="{{ route('profile.language.set', ['en']) }}" class="alert-link">{{ Lang::get('messages.languages.en') }}</a>!</p>
			@endif
		</div>


		@if (isset($modAlerts) == true)

			@if (empty($modAlerts["approval"]) == false)
            	<div class="alert alert-warning" role="alert" id="mod-approval" style="display: none;">
					<button type="button" class="close" data-dismiss="alert" data-alert-box="link-info" style="margin-top: -6px;" aria-label="Close"><span aria-hidden="true"><i class="material-icons">close</i></span></button>
					<p><a href="{{ route('moderator.approval') }}" class="alert-link">{{ Lang::get('messages.notifications.moderator_approval_queue')  }}</a></p>
            	</div>
       		@endif
            @if (empty($modAlerts["flag"]) == false)
                <div class="alert alert-warning" role="alert" id="mod-flag" style="display: none;">
                    <button type="button" class="close" data-dismiss="alert" data-alert-box="link-info" style="margin-top: -6px;" aria-label="Close"><span aria-hidden="true"><i class="material-icons">close</i></span></button>
					<p><a href="{{ route('moderator.handle_flags') }}" class="alert-link">{{ Lang::get('messages.notifications.moderator_flag_queue')  }}</a></p>
                </div>
            @endif
            
        @endif

    </div>


	@yield('content')
	</div>

	<div id="footer">
		<div class="container">
			<p class="text-center" style="display: none;" id="footer-app-iphone-link"><a href="#">Save on your home screen.</a></p>
			<p class="text-center"><small><small class="text-muted">{{Lang::get('messages.website.footer')}}</small></small></p>
		</div>
	</div>

	@include('homescreen_link.iphone')

</div>
@stop()

@section('cookies')
<script type="text/javascript" src="{{ asset('js/cookie.js') }}"></script>
<script>
jQuery(function( $ ){
	@if ($user['belongsToSchool'] == false)
    $('#link-info.alert .close').click(function( e ){
        createCookie('link-info-alert-closed',true,2);
    });
	@endif

	$('#lang-info.alert .close, #lang-info.alert .alert-link').click(function( e ){
    	createCookie('lang-info-alert-closed',true,365);
	});

	$('#open-app-icon, #close-app-iphone-introduce').click(function( e ){
    	createCookie('app-introduce-closed',true,365);
	});

	$('#mod-approval .close').click(function( e ){
    	createCookie('mod-approval-alert',true,1);
	});
	$('#mod-flag .close').click(function( e ){
    	createCookie('mod-flag-alert',true,1);
	});
});


jQuery(function( $ ){

	if( (readCookie('link-info-alert-closed') === 'false') || (readCookie('link-info-alert-closed') == null) ){
        $('#link-info.alert').show();
    }
    if( (readCookie('lang-info-alert-closed') === 'false') || (readCookie('lang-info-alert-closed') == null) ){
        $('#lang-info.alert').show();
    }
    if( (readCookie('app-introduce-closed') === 'false') || (readCookie('app-introduce-closed') == null) ){
    	if (navigator.userAgent.match(/(iPod|iPhone|iPad)/)) {
        	$('#app-iphone-introduce').show();

    	}
    }
    if (navigator.userAgent.match(/(iPod|iPhone|iPad)/)) {
    	$('#footer-app-iphone-link a').show();
    }
    
    if( (readCookie('mod-approval-alert') === 'false') || (readCookie('mod-approval-alert') == null) ){
        $('#mod-approval.alert').show();
    }
    if( (readCookie('mod-flag-alert') === 'false') || (readCookie('mod-flag-alert') == null) ){
        $('#mod-flag.alert').show();
    }
});
</script>

<script>
oldtitle = document.title;
$('#cancel-app-icon').click(function( e ){
	document.title = oldtitle;
	$('#app-icon').hide();
});

$('#open-app-icon').click(function( e ){
	document.title = 'DirectDemocracy';
	$('#app-iphone-introduce').hide();
	$('#app-icon').show();
});
$('#close-app-iphone-introduce').click(function( e ){
	$('#app-iphone-introduce').hide();
});
$('#footer-app-iphone-link').click(function( e ){
	$('#app-iphone-introduce').show();
});
</script>

<!-- Floating feedback -->
<div class="float-btn-feedback" style="position: fixed;bottom: 0;right: 0;text-align: right;">
	<button style="
    display: inline-block;
    background: #607D8B;
    color: #fff;
    padding: 10px 20px;
    border-top-left-radius: 4px;
    border-top-right-radius: 4px;
    margin: 0 30px;
    border: none;
	" data-toggle="collapse" data-target="#feedback-floating" aria-expanded="false" aria-controls="collapseExample"><i class="material-icons" style="
	    vertical-align: sub;
	">message</i><span> {{Lang::get('messages.feedback.feedback')}}</span></button>
	<div class="collapse" id="feedback-floating">
	  <div class="well" style="display: inline-block; margin: 0 30px; border-radius: 0; border-top-left-radius: 4px; background: #78909c; color: #fff; min-width: 200px; max-width: 500px; text-align: left;">
	    
	    <form class="form-vertical" id="floating-feedback-form" method="POST" action="{{ route('feedback.send') }}">
			
			<p>{{Lang::get('messages.feedback.reason')}}</p>
			
			<div class="alert-populate"></div>
		 
			<div class="form-group @if ($errors->has('feedback')) has-error @endif">
				<textarea class="form-control" name="feedback" style="max-height: 120px;" placeholder="{{Lang::get('messages.feedback.placeholder')}}" required>{{ old('feedback') }}</textarea>
			</div>
			
			<div class="checkbox">
				<label>
					<input type="checkbox" name="anonymous"> {{Lang::get('messages.feedback.anonymous')}}
				</label>
			</div>
			
			{{ csrf_field() }}
			
			<div class="form-group">
				<button type="submit" class="btn btn-default">{{Lang::get('messages.feedback.submit')}}</button>
			</div>
			
		</form>
		
	  </div>
	</div>
</div>
<script>
$(function() {
	$('#feedback-floating').on('show.bs.collapse', function () {
		document.getElementById('floating-feedback-form').reset();
	    $(this).find('.alert-populate').html('');
	});
	
	$('form#floating-feedback-form').submit(function(event) {
		event.preventDefault(); // Prevent the form from submitting via the browser
		var form = $(this);
		$.ajax({
	      type: form.attr('method'),
	      url: form.attr('action'),
	      data: form.serialize()
	    }).done(function(data) {
		    form.find('.alert-populate').html('<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" style="margin-top: -6px;" aria-label="Close"><span aria-hidden="true"><i class="material-icons">close</i></span></button> {{ Lang::get("messages.feedback.thanks") }}</div>');
	    }).fail(function(data) {
		    form.find('.alert-populate').html('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" style="margin-top: -6px;" aria-label="Close"><span aria-hidden="true"><i class="material-icons">close</i></span></button> {{ Lang::get("messages.feedback.error") }}</div>');
	    });
	  });
	});
</script>
@stop