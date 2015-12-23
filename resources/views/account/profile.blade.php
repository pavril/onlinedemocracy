@extends('layouts.profileBase')

@section('title', $fullName)

@section('form')
		<div class="col-sm-10">
		
        	<form class="profile-settings" method="POST" action="{{ route('profile.main.update') }}">
				<div class="form-group row @if ($errors->has('first') or $errors->has('last')) has-error @endif">
					<label for="name" class="col-sm-2 form-control-label">{{ Lang::get('messages.profile.account.name') }}</label>
					<div class="col-sm-7">
						<input type="text" class="form-control" style="float: left; width: 50%; margin-right: 10px;" id="name" name="first" value="{{ old('first') ? old('first') : $user['firstName'] }}">
						<input type="text" class="form-control" style="float: left; width: calc(50% - 10px);" id="name" name="last" value="{{ old('last') ? old('last') : $user['lastName'] }}">
						@if ($errors->has('first')) <small class="text-muted">{{ $errors->first('first') }}</small>@endif
						@if ($errors->has('last')) <small class="text-muted">{{ $errors->first('last') }}</small>@endif
					</div>
				</div>

				<div class="form-group row @if ($errors->has('contact')) has-error @endif">
					<label for="contactemail" class="col-sm-2 form-control-label">{{ Lang::get('messages.profile.account.contact_email') }}</label>
					<div class="col-sm-7">
						<input type="email" name="contact" class="form-control" id="contactemail" value="{{ old('contact') ? old('contact') : $user['contactEmail'] }}">
						@if ($errors->has('contact')) <small class="text-muted">{{ $errors->first('contact') }}</small><br/>@endif
						<small class="text-muted">{{ Lang::get('messages.profile.account.contact_email_info') }}</small>
					</div>
				</div>

				<div class="form-group row">
					<label for="email" class="col-sm-2 form-control-label">{{ Lang::get('messages.profile.account.email') }}</label>
					<div class="col-sm-7">
						<input type="email" class="form-control" disabled="disabled" id="email" value="{{ old('email') ? old('email') : $user['email'] }}">
					</div>
				</div>
                            
				<br/>
                            
				<div class="form-group row">
					<label class="col-sm-2 form-control-label">{{ Lang::get('messages.profile.account.avatar') }}</label>
					<div class="col-sm-7">
						<img class="profile-picture" src="{{ $user['avatar'] }}"/>
					</div>
				</div>
				
				<br/>
                
                <div class="form-group row">
					<label class="col-sm-2 form-control-label">{{ Lang::get('messages.profile.account.school_link') }}</label>
					
					@if ($user['belongsToSchool'] == false)
					<a href="{{ route('getLinkAuth') }}" class="col-sm-7 form-control-label">{{ Lang::get('messages.profile.account.school_link_actions.link_now') }}</a>
					@else
					<p class="col-sm-7 form-control-label">{{ Lang::get('messages.profile.account.school_link_actions.linked_with') }} <strong>{{ $user['schoolEmail'] }}</strong> - <a href="{{ route('unlinkGoogle') }}">{{ Lang::get('messages.profile.account.school_link_actions.unlink_now') }}</a> </p>
					@endif
					@if ($errors->has('linkState'))
					<small class="col-sm-offset-2 col-sm-10 form-control-label text-muted">{{ $errors->first('linkState') }}</small>
					@endif
					<small class="text-muted col-sm-7 form-control-label col-sm-offset-2">{{ Lang::get('messages.profile.account.school_link_info') }}</small>
				</div>
				  
				<br/>  
				
				{{ csrf_field() }}
                        
				<div class="form-group row">
					<div class="col-sm-offset-2 col-sm-10">
						<button type="submit" class="btn btn-primary btn-sm">{{ Lang::get('messages.profile.account.save') }}</button>
					</div>
				</div>
			</form>
			
		</div>
@stop