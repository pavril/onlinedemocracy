@extends('layouts.guestBase')

@section('title', 'Login')

@section('content')
        
	<div class="container">
		<h1 class="login-screen" >Direct Democracy</h1>
		<form class="login-form" action="{{ route('authenticate') }}" method="POST">
			<div class="form-group row @if ($errors->has('email')) has-error @endif">
				<label for="inputEmail3" class="col-sm-2 form-control-label">Email</label>
				<div class="col-sm-10">
					<input name="email" type="email" value="{{ old('email') }}" class="form-control form-control-sm" id="inputEmail3">
					@if ($errors->has('email')) <small class="text-muted">{{ $errors->first('email') }}</small>@endif
				</div>
			</div>
			
			<div class="form-group row @if ($errors->has('password')) has-error @endif">
				<label for="inputPassword3" class="col-sm-2 form-control-label">Password</label>
				<div class="col-sm-10">
					<input name="password" type="password" value="{{ old('password') }}" class="form-control form-control-sm" id="inputPassword3">
					@if ($errors->has('password')) <small class="text-muted">{{ $errors->first('password') }}</small>@endif
				</div>
			</div>
			
			<div class="form-group row">
				<div class="col-sm-offset-2 col-sm-10">
					<div class="checkbox">
						<label>
							<input name="remember" type="checkbox" value="1" {{ old('remember') ? 'checked' : '' }}> Remember me
						</label>
					</div>
				</div>
			</div>
			
			{!! csrf_field() !!}
			
			<div class="form-group row">
				<div class="col-sm-offset-2 col-sm-10">
					<button type="submit" class="btn btn-secondary btn-sm">Log in</button>
					<a class="btn btn-secondary btn-facebook btn-sm" href="{{ route('auth.getSocialAuth', ['provider' => 'facebook']) }}">Connect with Facebook</a>
					@if ($errors->has('social')) <p><small class="text-muted">{{ $errors->first('social') }}</small></p> @endif
					<a class="btn-link" href="/password/email">Forgotten password?</a>
					<a class="btn-link" href="{{ route('register') }}">Don't have an account? Sign up</a>
				</div>
			</div>
			
		</form>
		
		<div class="login-footer">
			<p>Developed by Photis Avrilionis</p>
		</div>
	</div>

@stop