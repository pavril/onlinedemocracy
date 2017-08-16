@extends('layouts_new.profileBase')

@section('title', $fullName)

@section('form')

<form class="form-horizontal" id="account_form" method="POST" action="{{ route('profile.main.update') }}">

	<div class="form-group form-group-sm @if ($errors->has('first') or $errors->has('last')) has-error @endif">
		<label for="name" class="col-sm-2 control-label">{{ Lang::get('messages.profile.account.name') }}</label>
		<div class="col-sm-10">
			<div class="row">
				<span class="col-sm-6 col-xs-6">
					<input type="text" class="form-control" id="name" name="first" placeholder="First name" value="{{ old('first') ? old('first') : $user['firstName'] }}">
					@if ($errors->has('first')) <small class="text-danger">{{ $errors->first('first') }}</small>@endif
				</span>
				<span class="col-sm-6 col-xs-6">
					<input type="text" class="form-control" id="last" name="last" placeholder="Last name" value="{{ old('last') ? old('last') : $user['lastName'] }}">
					@if ($errors->has('last')) <small class="text-danger">{{ $errors->first('last') }}</small>@endif
				</span>
			</div>
				  
		</div>
	</div>
              
	<div class="form-group form-group-sm @if ($errors->has('email')) has-error @endif">
		<label for="email" class="col-sm-2 control-label">{{ Lang::get('messages.profile.account.email') }}</label>
		<div class="col-sm-10">
			<input type="email" class="form-control" id="email" placeholder="{{ Lang::get('messages.profile.account.email') }}" value="{{ old('email') ? old('email') : $user['email'] }}" disabled>
		</div>
	</div>
              
	<div class="form-group form-group-sm">
		<div class="col-sm-10 col-sm-offset-2">
			<a href="{{ route('profile.password') }}" class="btn btn-default btn-sm btn-block">{{ Lang::get('messages.profile.account.change_password') }}</a>
		</div>
	</div>
              
	<br/>

	<div class="form-group form-group-sm @if ($errors->has('language')) has-error @endif @if (isset($highlight['lang']) == true) focused @endif">
		<label for="inputPassword3" class="col-sm-2 control-label">{{ Lang::get('messages.profile.account.language') }}</label>
		<div class="col-sm-10">
			<select class="form-control" name="lang">
				<option value="en" @if ($user['lang'] == 'en') selected @endif >{{Lang::get('messages.languages.en')}}</option>
				<option value="fr" @if ($user['lang'] == 'fr') selected @endif >{{Lang::get('messages.languages.fr')}}</option>
			</select>
		</div>
	</div>
              
	<br/>
              
	<div class="form-group form-group-sm">
		<label class="col-sm-2 control-label">{{ Lang::get('messages.profile.account.school_link') }}</label>
		<div class="col-sm-10">
			
			@if ($user['belongsToSchool'] == false)
			<a href="{{ route('getLinkAuthMsgraph') }}" class="btn btn-info btn-sm btn-block">{{ Lang::get('messages.profile.account.school_link_actions.link_now_msgraph') }}</a>
			@else
			<p  style="color: #333;">{{ Lang::get('messages.profile.account.school_link_actions.linked_with') }} <strong>{{ $user['schoolEmail'] or $user['msgraphDisplayName'] }}</strong> <a class="btn btn-sm btn-danger" href="{{ route('unlinkGoogle') }}">{{ Lang::get('messages.profile.account.school_link_actions.unlink_now') }}</a></p>
			@endif
			
			@if ($errors->has('linkState'))
			<small class="form-control-label text-danger">{{ $errors->first('linkState') }}</small>
			@endif
			
			<small id="helpBlock" class="help-block">{{ Lang::get('messages.profile.account.school_link_help') }}</small>
		</div>
	</div>
	
    {{ csrf_field() }}
       
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-primary">{{ Lang::get('messages.profile.account.save') }}</button>
		</div>
	</div>
</form>
@stop