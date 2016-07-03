@extends('layouts_new.authBase')

@section('title', 'Search')

@section('content')
<div class="container" id="main">

	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			
			<form class="form-horizontal" method="get">
				<input name="q" type="text" @if (isset($_GET["q"]) == true) @if ($_GET["q"] !== null) value="{{ $_GET["q"] }}" @endif @endif class="form-control input-lg" placeholder="{{ Lang::get('messages.search.search') }}" style="text-align: center; margin-top: 20px; margin-bottom: 60px;" autocomplete="off">
			</form>
			
			<div>
			@if (isset($_GET["q"]) == true)
			@if (empty($_GET["q"]) == false)
			
				@if (count($results) == 0)
					<h3 class="text-center">{{ Lang::get('messages.search.no_results_title') }}</h3>
					<p class="text-center">{{ Lang::get('messages.search.no_results_subtitle') }}</p>
				@else
				@foreach ($results as $proposition)
				<a class="thumbnail" href="{{ route('proposition', [$proposition['id']]) }}">
		         	<div class="caption">
			          	<p>@if (empty($proposition['marker']) == false) 
			          		 @if ($proposition['marker']->relationMarkerId() == \App\Marker::SUCCESS)<span class="label label-success label-icon"><i class="material-icons">check</i></span>
			          		 @elseif ($proposition['marker']->relationMarkerId() == \App\Marker::UNDER_DISCUSSION) <span class="label label-info label-icon"><i class="material-icons">speaker_notes</i></span>
			          		 @elseif ($proposition['marker']->relationMarkerId() == \App\Marker::FAILED) <span class="label label-warning label-icon"><i class="material-icons">announcement</i></span>
			          		 @endif
			          		{{{ $proposition['propositionSort'] }}} @else {{{ $proposition['propositionSort'] }}} @endif</p>
		       			<small class="text-muted">{{ Lang::choice('messages.proposition.voting.stats.upvotes', $proposition['upvotes'], ['votes' => $proposition['upvotes']]) }} | {{ Lang::choice('messages.proposition.voting.stats.downvotes', $proposition['downvotes'], ['votes' => $proposition['downvotes']]) }} | {{ Lang::choice('messages.proposition.voting.stats.comments', $proposition['comments'], ['comments' => $proposition['comments']]) }}</small>
		       			<small class="text-muted" style="margin-top: 10px; display: block;"><img class="img-circle text-sized-picture" src="{{ $proposition['proposer']['avatar'] }}"> {{ $proposition['proposer']['fullName'] }}</small>
		       		</div>
	       		</a>
        		@endforeach
        		<nav style="text-align: center;">
				  <ul class="pagination">
				  	@for ($i=1; $i <= $pages; $i++)
					    <li @if (isset($_GET["page"]) == true) @if ($i == $_GET["page"]) class="active" @endif @else @if ($i == 1) class="active" @endif @endif><a href="{{ route('search') . '?q=' . $_GET["q"] . '&page=' . $i }}">{{ $i }} @if (isset($_GET["page"]) == true) @if ($i == $_GET["page"]) <span class="sr-only">(current)</span> @endif @else @if ($i == 1) <span class="sr-only">(current)</span> @endif @endif</a></li>
					@endfor
				  </ul>
				</nav>
				@endif
				
			@else
			<p class="text-center lead">{{ Lang::get('messages.search.tip') }}</p>
        	@endif
        	@else
			<p class="text-center lead">{{ Lang::get('messages.search.tip') }}</p>
        	@endif
        	
			</div>
			
		</div>
	</div>
	
</div>
@stop