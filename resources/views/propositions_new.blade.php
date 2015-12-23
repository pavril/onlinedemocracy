@extends('layouts_new.authBase')

@section('title', 'Propositions')

@section('content')
<div class="container" id="main">
	
	@if (count($endingSoonPropositions) !== 0)
	<h3 class="propositions-section">{{ Lang::get('messages.propositions.ending_soon') }}</h3>
	<div class="pinBoot" id="expiring">
		@foreach($endingSoonPropositions as $proposition)
		<a class="thumbnail" href="{{ route('proposition', [$proposition['id']]) }}">
         		<div class="caption">
  	        		<p>{{{ $proposition['propositionSort'] }}}</p>
           			<small class="text-muted text-">{{ Lang::choice('messages.proposition.voting.stats.upvotes', $proposition['upvotes'], ['votes' => $proposition['upvotes']]) }} | {{ Lang::choice('messages.proposition.voting.stats.downvotes', $proposition['downvotes'], ['votes' => $proposition['downvotes']]) }} | {{ Lang::choice('messages.proposition.voting.stats.comments', $proposition['comments'], ['comments' => $proposition['comments']]) }}</small>
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
	  	        	<p>{{{ $proposition['propositionSort'] }}}</p>
           			<small class="text-muted text-">{{ Lang::choice('messages.proposition.voting.stats.upvotes', $proposition['upvotes'], ['votes' => $proposition['upvotes']]) }} | {{ Lang::choice('messages.proposition.voting.stats.downvotes', $proposition['downvotes'], ['votes' => $proposition['downvotes']]) }} | {{ Lang::choice('messages.proposition.voting.stats.comments', $proposition['comments'], ['comments' => $proposition['comments']]) }}</small>
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
  	        		<p>{{{ $proposition['propositionSort'] }}}</p>
           			<small class="text-muted text-">{{ Lang::choice('messages.proposition.voting.stats.upvotes', $proposition['upvotes'], ['votes' => $proposition['upvotes']]) }} | {{ Lang::choice('messages.proposition.voting.stats.downvotes', $proposition['downvotes'], ['votes' => $proposition['downvotes']]) }} | {{ Lang::choice('messages.proposition.voting.stats.comments', $proposition['comments'], ['comments' => $proposition['comments']]) }}</small>
        		</div>
       		</a>
		@endforeach
	</div>
	@endif
	
	@if (count($expiredPropositions) !== 0)
	<h3 class="propositions-section">{{ Lang::get('messages.propositions.expired_propositions') }}</h3>
	<div class="pinBoot" id="expired">
		@foreach($expiredPropositions as $proposition)
  	    	<a class="thumbnail" href="{{ route('proposition', [$proposition['id']]) }}">
         		<div class="caption">
  	        		<p>{{{ $proposition['propositionSort'] }}}</p>
           			<small class="text-muted text-">{{ Lang::choice('messages.proposition.voting.stats.upvotes', $proposition['upvotes'], ['votes' => $proposition['upvotes']]) }} | {{ Lang::choice('messages.proposition.voting.stats.downvotes', $proposition['downvotes'], ['votes' => $proposition['downvotes']]) }} | {{ Lang::choice('messages.proposition.voting.stats.comments', $proposition['comments'], ['comments' => $proposition['comments']]) }}</small>
        		</div>
        	</a>
		@endforeach
	</div>
	@endif
</div>
@stop