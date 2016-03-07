@extends('layouts_new.main')

@section('content_base')
<div class="container-fluid">
	<style>body {padding-top: 90px}</style>
	<div class="container-fluid" id="navigation">
    	<nav class="navbar navbar-inverse navbar-fixed-top">
      		<div class="container">
        		<!-- Brand and toggle get grouped for better mobile display -->
        		<div class="navbar-header">
          			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#topFixedNavbar1"><span class="sr-only">{{ Lang::get('messages.navigation.nav_toggle') }}</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
          			<a class="navbar-brand" href="{{ route('propositions') }}">
          				<img src="{{ asset('img/logo.svg') }}" alt="DirectDemocracy logo">
          				DirectDemocracy
          			</a>
          		</div>

        		<div class="collapse navbar-collapse" id="topFixedNavbar1">
	         		<ul class="nav navbar-nav">
	            		<li class="@if(Route::current()->getName() == 'propositions') active @endif"><a href="{{ route('propositions') }}">{{ Lang::get('messages.navigation.home') }}</a></li>
	          		</ul>
	          
	          		<ul class="nav navbar-nav navbar-right">
						<li>
						<a href="{{ route('profile.propositions.create') }}" class="btn btn-teal" style="
						    padding: 10px;
						    margin: 10px;
/* 						    background: teal; */
/* 						    color: white; */
						    ">
<i class="glyphicon glyphicon-pencil"></i> {{Lang::get('messages.navigation.create_proposition')}}</a></li>
						
	            		<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><img alt="profile picture of {{ $user['fullName'] }}" src="{{ $user['avatar'] }}" class="profile-picture-navbar img-circle"> {{ $user['fullName'] }}<span class="caret"></span></a>
		              		<ul class="dropdown-menu" role="menu">
		                		<li><a href="{{ route('profile.propositions') }}">{{Lang::get('messages.navigation.propositions')}}</a></li>
		                		<li><a href="{{ route('profile.main') }}">{{Lang::get('messages.navigation.profile')}}</a></li>
		                		<li class="divider"></li>
		                		<li><a href="{{ route('profile.language') }}">{{Lang::get('messages.navigation.language')}}</a></li>
		                		<li class="divider"></li>
		                		<li><a href="{{ route('logout') }}">{{Lang::get('messages.navigation.logout')}}</a></li>
		             		</ul>
	            		</li>
	          		</ul>
	        	</div>
	        	<!-- /.navbar-collapse -->
	      	</div>
	      	<!-- /.container-fluid -->
    	</nav>
  	</div>

	@yield('content')
</div>
@stop()