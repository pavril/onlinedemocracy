@extends('layouts.authBase')

@section('content')
<div class="container-fluid">
            	
	<div class="row">
		<div class="col-sm-2">
			<div class="list-group">
				<a href="{{ route('profile.main') }}" class="list-group-item @if(Route::current()->getName() == 'profile.main') active @endif">{{ Lang::get('messages.profile.menu.account') }}</a>
				<a href="{{ route('profile.propositions') }}" class="list-group-item @if(Route::current()->getName() == 'profile.propositions') active @endif"><!-- <span class="label label-default label-pill pull-right">2</span> -->{{ Lang::get('messages.profile.menu.propositions') }}</a>
			</div>

			@if ($user['role'] === 2)
			<div class="list-group" style="margin-top: 20px;">
				<h2 class="list-group-item">{{ Lang::get('messages.moderator.menu.title') }}</h2>
				<a href="{{ route('moderator.approval') }}" class="list-group-item @if(Route::current()->getName() == 'moderator.approval') active @endif">{{ Lang::get('messages.moderator.menu.for_approval') }}</a>
			</div>
			@endif
		</div>
		
		@yield('form')
		
	</div>
</div>
@stop