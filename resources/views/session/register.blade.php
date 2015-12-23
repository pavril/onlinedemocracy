@extends('layouts.guestBase')

@section('title', 'Sign up')

@section('content')
        
	<div class="container">
		<h1 class="login-screen" >Direct Democracy</h1>
		<form class="login-form" action="{{ route('registrate') }}" method="POST">
		
			<div class="form-group row @if ($errors->has('first_name')) has-error @endif">
				<label for="first_name" class="col-sm-3 form-control-label">First name</label>
				<div class="col-sm-9">
					<input name="first_name" type="text" value="{{ old('first_name') }}" class="form-control form-control-sm" id="first_name">
					@if ($errors->has('first_name')) <small class="text-muted">{{ $errors->first('first_name') }}</small>@endif
				</div>
			</div>
			
			<div class="form-group row @if ($errors->has('last_name')) has-error @endif">
				<label for="last_name" class="col-sm-3 form-control-label">Last name</label>
				<div class="col-sm-9">
					<input name="last_name" type="text" value="{{ old('last_name') }}" class="form-control form-control-sm" id="last_name">
					@if ($errors->has('last_name')) <small class="text-muted">{{ $errors->first('last_name') }}</small>@endif
				</div>
			</div>
		
			<div class="form-group row @if ($errors->has('email')) has-error @endif">
				<label for="email" class="col-sm-3 form-control-label">Email</label>
				<div class="col-sm-9">
					<input name="email" type="email" value="{{ old('email') }}" class="form-control form-control-sm" id="email">
					@if ($errors->has('email')) <small class="text-muted">{{ $errors->first('email') }}</small>@endif
				</div>
			</div>
			
			<div class="form-group row @if ($errors->has('password')) has-error @endif">
				<label for="password" class="col-sm-3 form-control-label">Password</label>
				<div class="col-sm-9">
					<input name="password" type="password" value="{{ old('password') }}" class="form-control form-control-sm" id="password">
					@if ($errors->has('password')) <small class="text-muted">{{ $errors->first('password') }}</small>@endif
				</div>
			</div>
			
			<div class="form-group row @if ($errors->has('password_confirmation')) has-error @endif">
				<label for="password_confirmation" class="col-sm-3 form-control-label">Confirm password</label>
				<div class="col-sm-9">
					<input name="password_confirmation" type="password" class="form-control form-control-sm" id="password_confirmation">
					@if ($errors->has('password_confirmation')) <small class="text-muted">{{ $errors->first('password_confirmation') }}</small>@endif
				</div>
			</div>
			
			{!! csrf_field() !!}
			
			<div class="form-group row">
				<div class="col-sm-offset-3 col-sm-10">
					<button type="submit" class="btn btn-secondary btn-sm">Sign up</button>
					<a class="btn btn-secondary btn-facebook btn-sm" href="{{ route('auth.getSocialAuth', ['provider' => 'facebook']) }}">Sign up with Facebook</a>
					<a class="btn-link" href="{{ route('login') }}">Already have an account? Login</a>
				</div>
			</div>
			
		</form>
		
		<div class="login-footer">
			<p>Developed by Photis Avrilionis</p>
		</div>
	</div>

@stop