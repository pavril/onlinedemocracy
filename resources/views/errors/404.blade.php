@extends('layouts_new.guestBase')

@section('title', '404 - Not found')

@section('content')

	<style>
	html, body {
		height: 100%;
	}

	body {
		margin: 0;
		padding: 0;
		width: 100%;
		display: table;
	}

	.container {
		text-align: center;
		display: table-cell;
		vertical-align: middle;
	}

	.content {
		text-align: center;
		display: inline-block;
	}
	img {
		width: 100px;
		height: 100px;
		margin-bottom: 50px;
	}
	</style>
	
	<div class="container">
		
		<img src="{{ asset('img/logo.svg') }}" alt="DirectDemocracy logo">
		<h1 class="text-center"><strong>404</strong> - Not found.</h1>
		
		<form class="col-md-6 col-md-offset-3" role="search" method="get" action="{{ route('search') }}" style="margin-top: 30px;">
			<div class="form-group">
				<input name="q" type="text" class="form-control text-center input-lg" placeholder="🔍 Try searching instead" autocomplete="off">
			</div>
		</form>
		
	</div>

@stop