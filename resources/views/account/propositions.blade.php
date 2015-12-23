@extends('layouts.profileBase')

@section('title', $fullName)

@section('form')
		<div class="col-sm-10">
        	
        	<a href="{{ route('profile.propositions.create') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus-square-o"></i> {{ Lang::get('messages.profile.create_proposition.create_proposition') }}</a>
        	<div class="dropdown">
			  <button class="btn btn-secondary dropdown-toggle btn-sm" type="button" id="sort_dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			    {{ Lang::get('messages.profile.propositions.sort.sort_by') }}
			  </button>
			  <div class="dropdown-menu" aria-labelledby="sort_dropdown">
			    <a class="dropdown-item" href="#" id="alphasort"><i class="fa fa-sort-alpha-asc"></i> {{ Lang::get('messages.profile.propositions.sort.alphabetical') }}</a>
			    <a class="dropdown-item" href="#" id="datesort"><i class="fa fa-calendar"></i> {{ Lang::get('messages.profile.propositions.sort.creation_date') }}</a>
			    <a class="dropdown-item" href="#" id="endingsoon"><i class="fa fa-calendar"></i> {{ Lang::get('messages.profile.propositions.sort.ending_soon') }}</a>
			    <a class="dropdown-item" href="#" id="upvotessort"><i class="fa fa-thumbs-up"></i> {{ Lang::get('messages.profile.propositions.sort.upvotes') }}</a>
			    <a class="dropdown-item" href="#" id="downvotessort"><i class="fa fa-thumbs-down"></i> {{ Lang::get('messages.profile.propositions.sort.downvotes') }}</a>
			    <a class="dropdown-item" href="#" id="statussort"><i class="fa fa-sort-amount-desc"></i> {{ Lang::get('messages.profile.propositions.sort.status') }}</a>
			  </div>
			</div>
			<br/>
			
			<ul class="list-group advanced" id="propositions">
				@foreach ($propositions as $proposition)
				<li class="list-group-item">
					<a href="{{ route('proposition', [$proposition['id']]) }}" class="name" >{{{ $proposition['propositionSort'] }}} @if ($proposition['statusId'] == 3) <span class="label label-danger">{{ Lang::get('messages.profile.propositions.status.block_reason') }} {{ $proposition['blockReason'] }}</span> @endif</a>
					<span class="info">
						@if ($proposition['statusId'] == 1)
						@if ($proposition['ending_in'] <= 0)
						<span class="label label-warning" data-status="4">{{ Lang::get('messages.profile.propositions.status.expired') }}</span>
						@else
						<span class="label label-success live" data-status="{{ $proposition['statusId'] }}" data-daysleft="{{ $proposition['ending_in'] }}">{{ Lang::choice('messages.profile.propositions.status.ending_in', $proposition['ending_in'], ['daysleft' => $proposition['ending_in']]) }}</span>
						@endif
						@else
						<span class="label @if ($proposition['statusId'] == 2) label-info @else label-danger @endif" data-status="{{ $proposition['statusId'] }}">@if ($proposition['statusId'] == 2) {{ Lang::get('messages.proposition.status.pending') }} @elseif ($proposition['statusId'] == 3) {{ Lang::get('messages.proposition.status.blocked') }} @endif</span>
						@endif
						
						<span class="date" data-timestamp="{{ $proposition['propositionCreationDate'] }}">{{ $proposition['propositionCreationDate'] }}</span>
						<span class="upvotessort" data-upvotes="{{ $proposition['upvotes'] }}">{{ Lang::choice('messages.proposition.voting.stats.upvotes', $proposition['upvotes'], ['votes' => $proposition['upvotes']]) }}</span>
	                    <span class="downvotessort" data-downvotes="{{ $proposition['downvotes'] }}">{{ Lang::choice('messages.proposition.voting.stats.upvotes', $proposition['downvotes'], ['votes' => $proposition['downvotes']]) }}</span>
					</span>
				</li>
				@endforeach
		</div>
@stop

@section('footer_scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/tinysort/2.2.2/tinysort.min.js" type="text/javascript"></script>

			
			<script type="text/javascript">
			$(document).ready( function() {
				$("#alphasort").click( function() {
					tinysort('ul#propositions>li',{selector:'a.name'});
				});
				$("#datesort").click( function() {
					tinysort('ul#propositions>li',{selector:'span.date',data:'timestamp', order:'desc'});
				});
				$("#upvotessort").click( function() {
					tinysort('ul#propositions>li',{selector:'span.upvotessort',data:'upvotes', order:'desc'});
				});
				$("#downvotessort").click( function() {
					tinysort('ul#propositions>li',{selector:'span.downvotessort',data:'downvotes', order:'desc'});
				});
				$("#statussort").click( function() {
					tinysort('ul#propositions>li',{selector:'span.label',data:'status', order:'desc'});
				});
				$("#endingsoon").click( function() {
					tinysort('ul#propositions>li',{selector:'span.label',data:'status', order:'desc'});
					tinysort('ul#propositions>li',{selector:'span.live',data:'daysleft'});
				});
			});
			</script>
@stop