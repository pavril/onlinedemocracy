@extends('layouts_new.profileBase')

@section('title', $fullName)

@section('form')

<form class="form-horizontal scene_element scene_element--fadein" id="account_form" method="POST" action="{{ route('profile.password.update') }}">
	
	<div class="form-group form-group-sm">
		<div class="col-sm-10 col-sm-offset-2">
			<a href="{{ route('profile.main') }}" class="btn btn-default btn-sm"><i class="fa fa-angle-left"></i> {{ Lang::get('messages.proposition.back') }}</a>
		</div>
	</div>
	
	
	@if (session('status'))
	<div class="form-group form-group-sm">
		<div class="col-sm-10 col-sm-offset-2">
			<div class="alert alert-success">
		    	{{ session('status') }}
			</div>
		</div>
	</div>
	@endif
	
	<div class="form-group form-group-sm @if ($errors->has('old_password')) has-error @endif">
		<label for="old_password" class="col-sm-2 control-label">{{ Lang::get('messages.profile.password.old') }}</label>
		<div class="col-sm-10">
			<input type="password" class="form-control" id="old_password" name="old_password" placeholder="{{ Lang::get('messages.profile.password.enter_old') }}">
			@if ($errors->has('old_password')) <small class="text-danger">{{ $errors->first('old_password') }}</small>@endif
		</div>
	</div>
             
	<br/>
	
	<div class="form-group form-group-sm @if ($errors->has('new_password')) has-error @endif">
		<label for="new_password" class="col-sm-2 control-label">{{ Lang::get('messages.profile.password.new') }}</label>
		<div class="col-sm-10">
			<input type="password" class="form-control" id="new_password" name="new_password" placeholder="{{ Lang::get('messages.profile.password.enter_new') }}">
			@if ($errors->has('new_password')) <small class="text-danger">{{ $errors->first('new_password') }}</small>@endif
		</div>
	</div>
	
	<div class="form-group form-group-sm @if ($errors->has('new_password_confirmation')) has-error @endif">
		<label for="new_password_confirmation" class="col-sm-2 control-label">{{ Lang::get('messages.profile.password.new_confirm') }}</label>
		<div class="col-sm-10">
			<input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation" placeholder="{{ Lang::get('messages.profile.password.enter_new_confirm') }}">
			@if ($errors->has('new_password_confirmation')) <small class="text-danger">{{ $errors->first('new_password_confirmation') }}</small>@endif
		</div>
	</div>

    {{ csrf_field() }}
       
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-default">{{ Lang::get('messages.profile.password.submit') }}</button>
		</div>
	</div>
</form>
@stop