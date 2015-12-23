@extends('layouts.profileBase')

@section('title', 'Propositions moderation')

@section('form')
	<div class="col-sm-10">
		<h2 class="advanced-list-title">{{ Lang::get('messages.moderator.for_approval') }}</h2>
	
		<div class="toolbox hidden-sm-down hidden-md-down">
        	<h4 class="toolbox-title">{{ Lang::get('messages.moderator.criteria.title') }}</h4>
        	<ul class="small">
        		<li>{{ Lang::get('messages.moderator.criteria.no_offensive_words') }}</li>
        		<li>{{ Lang::get('messages.moderator.criteria.no_mentions') }}</li>
        		<li>{{ Lang::get('messages.moderator.criteria.grammar_and_spelling') }}</li>
        	</ul>
        </div>
        
       	<ul class="list-group advanced toolbox-margin" id="propositions">
       		@if (count($propositions) !== 0)
			@foreach ($propositions as $proposition)
			<div class="list-group-item">
				<span class="info action-btns">
					<a href="{{ route('moderator.approve', $proposition['id']) }}" class="btn btn-sm btn-success">{{ Lang::get('messages.moderator.approve') }}</a>
					<a class="btn btn-sm btn-danger" data-toggle="collapse" href="#proposition{{$proposition['id']}}" aria-expanded="false" aria-controls="proposition{{$proposition['id']}}">{{ Lang::get('messages.moderator.block') }}</a>
				</span>
				
				<span class="proposition-sort">{{$proposition['propositionSort']}} <span class="label label-info"">{{ Lang::choice('messages.moderator.days_left', $proposition['ending_in'], ['daysleft' => $proposition['ending_in']]) }}</span></span>
				<span class="proposition-long">{{$proposition['propositionLong']}}</span>
			</div>
			<div class="list-group-form collapse" id="proposition{{$proposition['id']}}">
				<form class="form-inline" method="post" action="{{ route('moderator.block') }}">
		  			<input type="text" name="reason" class="form-control form-control-sm" placeholder="{{ Lang::get('messages.moderator.reason_placeholder') }}">
		  			<input type="hidden" name="propositionId" value="{{$proposition['id']}}">
		  			{!! csrf_field() !!}
		  			<button type="submit" class="btn btn-danger btn-sm">{{ Lang::get('messages.moderator.block') }}</button>
				</form>
		    </div>
			@endforeach
			@else
			{{ Lang::get('messages.moderator.all_ok') }}
			@endif
		</ul>
	</div>
@stop

@section('footer_scripts')
<script type="text/javascript" src="http://v4-alpha.getbootstrap.com/dist/js/bootstrap.min.js"></script>
@stop