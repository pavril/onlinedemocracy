@extends('layouts.guestBase')

@section('title', 'Password reset')

@section('content')

	<div class="container">
		<h1 class="login-screen" >Reset password</h1>
		
		<form class="login-form" action="/password/reset" method="POST">
			
			<input type="hidden" name="token" value="{{ $token }}">
		
			<div class="form-group row @if ($errors->has('email')) has-error @endif">
				<label for="email" class="col-sm-2 form-control-label">Email</label>
				<div class="col-sm-10">
					<input id="email" type="email" class="form-control form-control-sm" name="email" value="{{ old('email') }}">
					@if ($errors->has('email')) <small class="text-muted">{{ $errors->first('email') }}</small>@endif
				</div>
			</div>
			
			<div class="form-group row @if ($errors->has('password')) has-error @endif">
				<label for="password" class="col-sm-2 form-control-label">Password</label>
				<div class="col-sm-10">
					<input type="password" id="password" class="form-control form-control-sm" name="password">
					@if ($errors->has('password')) <small class="text-muted">{{ $errors->first('password') }}</small>@endif
				</div>
			</div>
			
			<div class="form-group row @if ($errors->has('password')) has-error @endif">
				<label for="password_confirmation" class="col-sm-2 form-control-label">Confirm</label>
				<div class="col-sm-10">
					<input type="password" class="form-control form-control-sm" name="password_confirmation" id="password_confirmation">
					@if ($errors->has('password_confirmation')) <small class="text-muted">{{ $errors->first('password_confirmation') }}</small>@endif
				</div>
			</div>
			
			
			
			{!! csrf_field() !!}
			
			<div class="form-group row">
				<div class="col-sm-offset-2 col-sm-10">
					<button type="submit" class="btn btn-secondary btn-sm">Reset password</button>
				</div>
			</div>
			
		</form>
		
		<div class="login-footer">
			<p>Developed by Photis Avrilionis</p>
		</div>
	</div>

@stop