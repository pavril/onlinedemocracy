@extends('layouts_new.profileBase')

@section('title', $fullName)

@section('form')

<div class="panel-group" id="propositions" role="tablist" aria-multiselectable="true" aria-expanded="true">
      
@if (count($propositions) == 0)
	
	<h3>{{ Lang::get('messages.profile.create_proposition.begining') }}</h3>
	<p class="lead">{{ Lang::get('messages.profile.create_proposition.description') }}</p>
	<br>
	<p><a href="http://localhost:82/account/propositions/create" class="btn btn-teal btn-lg"><i class="glyphicon glyphicon-pencil"></i> {{ Lang::get('messages.profile.create_proposition.begining_btn') }}</a></p>
	
@endif

@foreach ($propositions as $proposition)
<div class="panel panel-default">
	<div class="panel-heading" role="tab" id="heading{{ $proposition['id'] }}">
		
		@if ($proposition['statusId'] == 1)
		@if ($proposition['ending_in'] <= 0)
		<span class="label label-warning pull-right" style="line-height: 18px;">{{ Lang::get('messages.profile.propositions.status.expired') }}</span>
		@else
		<span class="label label-success pull-right" style="line-height: 18px;">{{ Lang::choice('messages.profile.propositions.status.ending_in', $proposition['ending_in'], ['daysleft' => $proposition['ending_in']]) }}</span>
		@endif
		@else
		<span class="label @if ($proposition['statusId'] == 2) label-info @else label-danger @endif pull-right" style="line-height: 18px;">@if ($proposition['statusId'] == 2) {{ Lang::get('messages.proposition.status.pending') }} @elseif ($proposition['statusId'] == 3) {{ Lang::get('messages.proposition.status.blocked') }} @endif</span>
		@endif
		<a class="panel-title" role="button" data-toggle="collapse" data-parent="#propositions" href="#collapse{{ $proposition['id'] }}" aria-controls="collapse{{ $proposition['id'] }}">
		@if (empty($proposition['marker']) == false) 
			@if ($proposition['marker']->relationMarkerId() == \App\Marker::SUCCESS)<span class="label label-success label-icon pull-left"><i class="material-icons">check</i></span>
			@elseif ($proposition['marker']->relationMarkerId() == \App\Marker::UNDER_DISCUSSION) <span class="label label-info label-icon pull-left"><i class="material-icons">speaker_notes</i></span>
			@elseif ($proposition['marker']->relationMarkerId() == \App\Marker::FAILED) <span class="label label-warning label-icon pull-left"><i class="material-icons">announcement</i></span>
			@endif
		@endif
		{{{ $proposition['propositionSort'] }}}</a>
	</div>
	       
	<div id="collapse{{ $proposition['id'] }}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading{{ $proposition['id'] }}">
		<div class="panel-body">
			<div class="row">
				<div class="col-md-10">
					<p style="font-size: 15px;">{{{ $proposition['propositionSort'] }}}</p>
					<p style="font-size: 11px;">{{{ $proposition['propositionLong'] }}}</p>
					
					@if ($proposition['statusId'] !== 2)
					@if ($proposition['statusId'] !== 3)
					<p class="text-muted"><span class="label label-success">{{ Lang::choice('messages.proposition.voting.stats.upvotes', $proposition['upvotes'], ['votes' => $proposition['upvotes']]) }}</span> <span class="label label-danger">{{ Lang::choice('messages.proposition.voting.stats.downvotes', $proposition['downvotes'], ['votes' => $proposition['downvotes']]) }}</span> <span class="label label-info">{{ Lang::choice('messages.proposition.voting.stats.comments', $proposition['commentsCount'], ['comments' => $proposition['commentsCount']]) }}</span></p>
					<p><a href="{{ route('proposition', [$proposition['id']]) }}" class="btn btn-primary btn-sm">{{ Lang::get('messages.profile.propositions.go_to') }}</a></p>
					@endif
					@endif
					
				</div>
                                
				<div class="col-md-2 text-right">
					<span class="label label-default">{{ $proposition['propositionCreationDate'] }}</span>
				</div>
			</div>
			
					@if ($proposition['statusId'] == 3)
					<p class="alert alert-danger full-width"><small  role="alert">{{ Lang::get('messages.profile.propositions.status.block_reason') }} {{ $proposition['blockReason'] }}</small></p>
					@endif
		</div>
	</div>
</div>
@endforeach
@stop