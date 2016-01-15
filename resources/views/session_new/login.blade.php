@extends('layouts_new.guestBase')

@section('title', Lang::get('messages.session.login.login'))

@section('content')

	<div class="container" id="login">
		<div class="row" style="margin-top:110px">
			<div class="col-md-6 col-md-offset-3">
				<div class="panel panel-default">
					<div class="panel-heading"><h1 class="panel-title"><strong><center>Direct Democracy</center></strong></h1></div>
					<div class="panel-body">
						<form role="form" action="{{ route('authenticate') }}" method="POST">
							<div class="form-group @if ($errors->has('email')) has-error @endif">
								@if ($errors->has('email')) <small class="text-danger pull-right">{{ $errors->first('email') }}</small>@endif
								<label for="email">{{ Lang::get('messages.session.login.email')}}</label>
								<input type="email" name="email" class="form-control" id="email" placeholder="{{ Lang::get('messages.session.login.email_placeholder')}}" value="{{ old('email') }}">
							</div>
							<div class="form-group @if ($errors->has('password')) has-error @endif">
								@if ($errors->has('password')) <small class="text-danger pull-right">{{ $errors->first('password') }}</small>@endif
								<label for="password">{{ Lang::get('messages.session.login.password')}} <a href="/password/email">({{ Lang::get('messages.session.login.forgot_pass')}})</a></label>
								<input type="password" name="password" class="form-control" id="password" placeholder="{{ Lang::get('messages.session.login.password_placeholder')}}" value="{{ old('password') }}">
							</div>
							{!! csrf_field() !!}
							<button type="submit" class="btn btn-default btn-block">{{ Lang::get('messages.session.login.submit')}}</button>
							<a href="{{ route('auth.getSocialAuth', ['provider' => 'facebook']) }}" class="btn btn-primary btn-block">{{ Lang::get('messages.session.login.use_fb')}}</a>
							@if ($errors->has('social')) <p><small class="text-muted">{{ $errors->first('social') }}</small></p> @endif
							<hr>
							<a href="{{ route('register') }}" class="btn btn-info btn-block">{{ Lang::get('messages.session.login.sign_up')}}</a>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<div id="background-particles"></div>
@stop

@section('footer_scripts')
<script src="{{ asset('js/jquery.particleground.min.js') }}"></script>
<script>
$('#background-particles').particleground({
		directionX: 'center',
		directionY: 'up',
		minSpeedX: 0.1,
        maxSpeedX: 0.1,
        minSpeedY: 0.1,
        maxSpeedY: 0.1,
        density: 10000,
        proximity: 100,
		lineWidth: 0.4,
		particleRadius: 3.5,
		parallax: false,
});
</script>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-72457439-1', 'auto');
  ga('send', 'pageview');

</script>
@stop