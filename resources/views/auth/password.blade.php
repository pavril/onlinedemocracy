@extends('layouts_new.guestBase')

@section('title', Lang::get('messages.session.login.forgot_pass'))

@section('content')

	<div class="container" id="login">
		
		<div class="row" style="margin-top:110px">
			<div class="col-md-6 col-md-offset-3">
				@if (session('status'))
		      	<div class="alert alert-success">
		             {{ session('status') }}
		     	</div>
	   			@endif
				<div class="panel panel-default">
					<div class="panel-heading"><h1 class="panel-title"><strong><center>{{ Lang::get('messages.session.forgot.reset')}}</center></strong></h1></div>
					<div class="panel-body">
						<form role="form" action="/password/email" method="POST">
							<div class="form-group @if ($errors->has('email')) has-error @endif">
								@if ($errors->has('email')) <small class="text-danger pull-right">{{ $errors->first('email') }}</small>@endif
								<label for="email">{{ Lang::get('messages.session.forgot.email')}}</label>
								<input type="email" name="email" class="form-control" id="email" placeholder="{{ Lang::get('messages.session.forgot.email_placeholder')}}" value="{{ old('email') }}">
							</div>
							
							{!! csrf_field() !!}
							<button type="submit" class="btn btn-default btn-block">{{ Lang::get('messages.session.forgot.email_link')}}</button>
							<a class="btn btn-block btn-link" href="{{ route('login') }}">{{ Lang::get('messages.session.return_to_login')}}</a>
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
@stop