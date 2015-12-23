@extends('layouts.authBase')

@section('title', 'Propositions')

@section('content')
		<div class="toolbox hidden-sm-down hidden-md-down">
                
        </div>
        
        <div class="container-fluid">
        	
	        <div class="card-columns propositions toolbox-margin">
	        	<a class="card proposition text-center" href="{{ route('profile.propositions.create') }}">
				  	<div class="card-block">
				    	<p class="card-text">+ {{ Lang::get('messages.propositions.create') }}</p>
				  	</div>
				</a>
			</div>
			
			@if (count($endingSoonPropositions) !== 0)
			<h2 class="section-title"><i class="fa fa-bullhorn"></i> {{ Lang::get('messages.propositions.ending_soon') }}</h2>
			<div class="card-columns propositions toolbox-margin">
	        	@foreach($endingSoonPropositions as $proposition)
	        	<a class="card proposition yellow" href="{{ route('proposition', [$proposition['id']]) }}">
				  	<div class="card-block">
				    	<p class="card-text">{{{ $proposition['propositionSort'] }}}</p>
				  	</div>
				  	@if ($proposition['userHasVoted'] == true)
				  	<div class="card-footer text-muted">{{ Lang::get('messages.proposition.voting.already_voted_sort') }}</div>
					@endif
				</a>
	        	@endforeach
	        </div>
	        @endif
	        
	        @if (count($propositions) !== 0)
	        <h2 class="section-title"><i class="fa fa-newspaper-o"></i> {{ Lang::get('messages.propositions.new_propositions') }}</h2>
			<div class="card-columns propositions toolbox-margin">
	        	@foreach($propositions as $proposition)
	        	<a class="card proposition yellow" href="{{ route('proposition', [$proposition['id']]) }}">
				  	<div class="card-block">
				    	<p class="card-text">{{{ $proposition['propositionSort'] }}}</p>
				  	</div>
				  	@if ($proposition['userHasVoted'] == true)
				  	<div class="card-footer text-muted">{{ Lang::get('messages.proposition.voting.already_voted_sort') }}</div>
					@endif
				</a>
	        	@endforeach
	        </div>
	        @endif
	        
	        @if (count($votedPropositions) !== 0)
	        <h2 class="section-title"><i class="fa fa-check"></i> {{ Lang::get('messages.propositions.voted_propositions') }}</h2>
			<div class="card-columns propositions toolbox-margin">
	        	@foreach($votedPropositions as $proposition)
	        	<a class="card proposition yellow" href="{{ route('proposition', [$proposition['id']]) }}">
				  	<div class="card-block">
				    	<p class="card-text">{{{ $proposition['propositionSort'] }}}</p>
				  	</div>
				  	@if ($proposition['userHasVoted'] == true)
				  	<div class="card-footer text-muted">{{ Lang::get('messages.proposition.voting.already_voted_sort') }}</div>
					@endif
				</a>
	        	@endforeach
	        </div>
	        @endif
	        
	        @if (count($expiredPropositions) !== 0)
	        <h2 class="section-title"><i class="fa fa-calendar-times-o"></i> {{ Lang::get('messages.propositions.expired_propositions') }}</h2>
			<div class="card-columns propositions toolbox-margin">
	        	@foreach($expiredPropositions as $proposition)
	        	<a class="card proposition yellow" href="{{ route('proposition', [$proposition['id']]) }}">
				  	<div class="card-block">
				    	<p class="card-text">{{{ $proposition['propositionSort'] }}}</p>
				  	</div>
				  	@if ($proposition['userHasVoted'] == true)
				  	<div class="card-footer text-muted">{{ Lang::get('messages.proposition.voting.already_voted_sort') }}</div>
					@endif
				</a>
	        	@endforeach
	        </div>
	        @endif
	        
	        
        </div>
        @stop