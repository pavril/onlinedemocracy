@extends('layouts_new.authBase')

@section('title', 'Propositions')

@section('content')
<div class="container" id="main">

	@if ((count($endingSoonPropositions) == 0) AND (count($propositions) == 0) AND (count($votedPropositions) == 0))
	<h3 class="propositions-section">{{ Lang::get('messages.propositions.no_active') }}</h3>
	<p class="lead text-center">{{ Lang::get('messages.propositions.no_active_desc') }}</p></br>
	<p class="text-center"><a href="{{ route('profile.propositions.create') }}" class="btn btn-lg btn-teal"><i class="glyphicon glyphicon-pencil"></i> {{Lang::get('messages.navigation.create_proposition')}}</a></p>
	@endif

	@if (count($endingSoonPropositions) !== 0)
	<h3 class="propositions-section">{{ Lang::get('messages.propositions.ending_soon') }}</h3>
	<div class="pinBoot" id="expiring">
		@foreach($endingSoonPropositions as $proposition)
		<a class="thumbnail" href="{{ route('proposition', [$proposition['id']]) }}">
         	<div class="caption">
	          	<p>@if (empty($proposition['marker']) == false) 
	          		 @if ($proposition['marker']->relationMarkerId() == \App\Marker::SUCCESS)<span class="label label-success label-icon"><i class="material-icons">check</i></span>
	          		 @elseif ($proposition['marker']->relationMarkerId() == \App\Marker::UNDER_DISCUSSION) <span class="label label-info label-icon"><i class="material-icons">speaker_notes</i></span>
	          		 @elseif ($proposition['marker']->relationMarkerId() == \App\Marker::FAILED) <span class="label label-warning label-icon"><i class="material-icons">announcement</i></span>
	          		 @endif
	          		{{{ $proposition['propositionSort'] }}} @else {{{ $proposition['propositionSort'] }}} @endif</p>
       			<small class="text-muted">{{ Lang::choice('messages.proposition.voting.stats.upvotes', $proposition['upvotes'], ['votes' => $proposition['upvotes']]) }} | {{ Lang::choice('messages.proposition.voting.stats.downvotes', $proposition['downvotes'], ['votes' => $proposition['downvotes']]) }} | {{ Lang::choice('messages.proposition.voting.stats.comments', $proposition['comments'], ['comments' => $proposition['comments']]) }}</small>
       		</div>
        </a>
      	@endforeach
	</div>
	@endif
	
    @if (count($propositions) !== 0)
    <h3 class="propositions-section" >{{ Lang::get('messages.propositions.new_propositions') }}</h3>
	<div class="pinBoot" id="recent">
		@foreach($propositions as $proposition)
		<a class="thumbnail" href="{{ route('proposition', [$proposition['id']]) }}">
         	<div class="caption">
	          	<p>@if (empty($proposition['marker']) == false) 
	          		 @if ($proposition['marker']->relationMarkerId() == \App\Marker::SUCCESS)<span class="label label-success label-icon"><i class="material-icons">check</i></span>
	          		 @elseif ($proposition['marker']->relationMarkerId() == \App\Marker::UNDER_DISCUSSION) <span class="label label-info label-icon"><i class="material-icons">speaker_notes</i></span>
	          		 @elseif ($proposition['marker']->relationMarkerId() == \App\Marker::FAILED) <span class="label label-warning label-icon"><i class="material-icons">announcement</i></span>
	          		 @endif
	          		{{{ $proposition['propositionSort'] }}} @else {{{ $proposition['propositionSort'] }}} @endif</p>
       			<small class="text-muted">{{ Lang::choice('messages.proposition.voting.stats.upvotes', $proposition['upvotes'], ['votes' => $proposition['upvotes']]) }} | {{ Lang::choice('messages.proposition.voting.stats.downvotes', $proposition['downvotes'], ['votes' => $proposition['downvotes']]) }} | {{ Lang::choice('messages.proposition.voting.stats.comments', $proposition['comments'], ['comments' => $proposition['comments']]) }}</small>
       		</div>
       	</a>
		@endforeach
	</div>
	@endif
	
	@if (count($votedPropositions) !== 0)
	<h3 class="propositions-section">{{ Lang::get('messages.propositions.voted_propositions') }}</h3>
	<div class="pinBoot" id="voted">
		@foreach($votedPropositions as $proposition)
  	    	<a class="thumbnail" href="{{ route('proposition', [$proposition['id']]) }}">
	         	<div class="caption">
		          	<p>@if (empty($proposition['marker']) == false) 
		          		 @if ($proposition['marker']->relationMarkerId() == \App\Marker::SUCCESS)<span class="label label-success label-icon"><i class="material-icons">check</i></span>
		          		 @elseif ($proposition['marker']->relationMarkerId() == \App\Marker::UNDER_DISCUSSION) <span class="label label-info label-icon"><i class="material-icons">speaker_notes</i></span>
		          		 @elseif ($proposition['marker']->relationMarkerId() == \App\Marker::FAILED) <span class="label label-warning label-icon"><i class="material-icons">announcement</i></span>
		          		 @endif
		          		{{{ $proposition['propositionSort'] }}} @else {{{ $proposition['propositionSort'] }}} @endif</p>
	       			<small class="text-muted">{{ Lang::choice('messages.proposition.voting.stats.upvotes', $proposition['upvotes'], ['votes' => $proposition['upvotes']]) }} | {{ Lang::choice('messages.proposition.voting.stats.downvotes', $proposition['downvotes'], ['votes' => $proposition['downvotes']]) }} | {{ Lang::choice('messages.proposition.voting.stats.comments', $proposition['comments'], ['comments' => $proposition['comments']]) }}</small>
	       		</div>
       		</a>
		@endforeach
	</div>
	@endif
	
</div>
@stop