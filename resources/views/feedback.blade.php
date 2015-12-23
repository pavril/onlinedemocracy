@extends('layouts_new.profileBase')

@section('title', Lang::get('messages.feedback.feedback'))

@section('form')

<form class="form-horizontal" id="account_form" method="POST" action="{{ route('feedback.send') }}">

	@if (session('status'))
	<div class="form-group form-group-sm">
		<div class="col-sm-10 col-sm-offset-2">
			<div class="alert alert-success">
		    	{{ session('status') }}
			</div>
		</div>
	</div>
	@endif
 
	<div class="form-group form-group-sm @if ($errors->has('feedback')) has-error @endif">
		<label for="feedback" class="col-sm-2 control-label">{{Lang::get('messages.feedback.feedback')}}</label>
		<div class="col-sm-10">
			<textarea class="form-control" name="feedback" id="feedback" rows="5" placeholder="Enter your feedback">{{ old('feedback') }}</textarea>
			<p class="help-block">{{Lang::get('messages.feedback.reason')}}</p>
		</div>
	</div>
    
    {{ csrf_field() }}
       
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-default">{{Lang::get('messages.feedback.submit')}}</button>
		</div>
	</div>
</form>
@stop