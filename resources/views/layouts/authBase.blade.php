@extends('layouts_new.main')

@section('content_base')

	<nav class="navbar navbar-light fixed-navbar">
		<a class="navbar-brand" href="{{ route('propositions') }}">Direct Democracy</a>
		<ul class="nav navbar-nav pull-right">
			<li class="nav-item">
				<a class="nav-link" href="{{ route('profile.main') }}"><img class="profile-picture" src="{{ $user['avatar'] }}" alt="profile picture">{{ $user['fullName'] }}</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="{{ route('logout') }}">Logout <i class="fa fa-sign-out"></i></a>
			</li>
		</ul>
	</nav>

	@yield('content')
@stop()