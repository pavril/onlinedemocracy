@extends('layouts_new.guestBase')

@section('title', '403 - Unauthorized action')

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
		<h1 class="text-center"><strong>403</strong> - Unauthorized action.</h1>
		
	</div>

@stop