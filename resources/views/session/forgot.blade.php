@extends('layouts.guestBase')

@section('title', 'Forgot password')

@section('content')

<div class="container">
		<h1 class="login-screen" >Reset password</h1>
		
		<form class="login-form" action="/password/email" method="POST">
		
			@if (session('status'))
	      	<div class="alert alert-success">
	             {{ session('status') }}
	     	</div>
	   		@endif
			
			<div class="form-group row @if ($errors->has('email')) has-error @endif">
				<label for="email" class="col-sm-2 form-control-label">Email</label>
				<div class="col-sm-10">
					<input id="email" type="email" class="form-control form-control-sm" name="email" value="{{ old('email') }}">
					@if ($errors->has('email')) <small class="text-muted">{{ $errors->first('email') }}</small>@endif
				</div>
			</div>
			
			{!! csrf_field() !!}
			
			<div class="form-group row">
				<div class="col-sm-offset-2 col-sm-10">
					<button type="submit" class="btn btn-secondary btn-sm">Send Password Reset Link</button>
					<a class="btn-link" href="{{ route('login') }}">Return to login</a>
				</div>
			</div>
			
		</form>
		
		<div class="login-footer">
			<p>Developed by Photis Avrilionis</p>
		</div>
	</div>

@stop