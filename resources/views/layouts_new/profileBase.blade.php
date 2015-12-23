@extends('layouts_new.authBase')

@section('content')
<div class="container" id="account">
  	<div class="row m-scene">
    	
        <div class="col-md-3 text-center" id="profile_navigation">
       		<img alt="profile picture of {{ $user['fullName'] }}" src="{{ $user['avatar'] }}" class="profile-picture img-circle" />
            <br/>
            @if ($user['belongsToSchool'] == true)
            <p><small data-toggle="tooltip" data-placement="bottom" data-original-title="{{ Lang::get('messages.profile.menu.linked_with_school') }}"><span class="active_account_indicator"></span> {{ Lang::get('messages.profile.menu.active') }}</small>
            @else
            <p><small data-toggle="tooltip" data-placement="bottom" data-original-title="{{ Lang::get('messages.profile.menu.not_linked_with_school') }}"><span class="disabled_account_indicator"></span> {{ Lang::get('messages.profile.menu.inactive') }}</small>
            @endif
            <br/>
            <small class="text-muted"><small>{{ Lang::choice('messages.profile.account.propositionsCount', $user['propositionsCount'], ['propositions' => $user['propositionsCount']]) }}</small></small></p>
            <br/>
            
<!--             <div class="list-group account-settings"> -->
<!--               <p class="list-group-item" data-toggle="collapse" data-target="#demo"><strong>Get started</strong></p> -->
<!--               <a href="#" class="list-group-item" style="text-decoration: line-through;">Link your school account</a>-->
<!--               <a href="#" class="list-group-item" style="text-decoration: line-through;">Set up your account</a>-->
<!--               <a href="#" class="list-group-item">Make your first proposition</a> -->
<!--             </div> -->
            
            <div class=" list-group account-settings" >
              <p class="list-group-item"><strong>{{ Lang::get('messages.profile.menu.account') }}</strong></p>
              <a href="{{ route('profile.main') }}" class="list-group-item @if(Route::current()->getName() == 'profile.main') active @endif">{{ Lang::get('messages.profile.menu.overview') }}</a>
              <a href="{{ route('profile.language') }}" class="list-group-item">{{ Lang::get('messages.profile.menu.language') }}</a>
              <a href="{{ route('profile.propositions') }}" class="list-group-item @if(Route::current()->getName() == 'profile.propositions') active @endif">{{ Lang::get('messages.profile.menu.propositions') }}</a>
            </div>
            
            @if ($user['role'] === 2)
			<div class="list-group account-settings">
              <p class="list-group-item"><strong>{{ Lang::get('messages.moderator.menu.title') }}</strong></p>
              <a href="{{ route('moderator.approval') }}" class="list-group-item @if(Route::current()->getName() == 'moderator.approval') active @endif">{{ Lang::get('messages.moderator.menu.for_approval') }}</a>
              <a href="{{ route('moderator.handle_flags') }}" class="list-group-item @if(Route::current()->getName() == 'moderator.handle_flags') active @endif">{{ Lang::get('messages.moderator.menu.handle_flags') }}</a>
            </div>
			@endif
			
            <div class="list-group account-settings">
              <p class="list-group-item"><strong>{{ Lang::get('messages.profile.menu.contribute') }}</strong></p>
<!--               <a href="#" class="list-group-item">{{ Lang::get('messages.profile.menu.translate') }} <i class="fa fa-external-link"></i></a> -->
              <a href="https://github.com/pavril/onlinedemocracy" target="_blank" class="list-group-item">{{ Lang::get('messages.profile.menu.github') }} <i class="fa fa-external-link"></i></a>
              <a href="{{ route('feedback') }}" class="list-group-item @if(Route::current()->getName() == 'feedback') active @endif">{{ Lang::get('messages.profile.menu.feedback') }}</a>
            </div>
            
        </div>
        
        <div class="col-md-9" id="account_form">
       		@yield('form')
        </div>
	</div>
</div>
@stop