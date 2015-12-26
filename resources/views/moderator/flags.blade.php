@extends('layouts_new.profileBase')

@section('title', Lang::get('messages.moderator.head_title.handle_flags'))

@section('form')

<div class="panel-group" id="propositions" role="tablist" aria-multiselectable="true" aria-expanded="true">
      
@foreach ($propositions as $proposition)
<div class="panel panel-default">
	<div class="panel-heading" role="tab" id="heading{{ $proposition['id'] }}">
		
		<span class="label label-danger pull-right" style="line-height: 18px;">{{ Lang::choice('messages.moderator.flags.count', $proposition['flagsCount'], ['flags' => $proposition['flagsCount']]) }}</span>
		
		<a class="panel-title" role="button" data-toggle="collapse" data-parent="#propositions" href="#collapse{{ $proposition['id'] }}" aria-controls="collapse{{ $proposition['id'] }}">{{{ $proposition['propositionSort'] }}}</a>
	</div>
	       
	<div id="collapse{{ $proposition['id'] }}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading{{ $proposition['id'] }}">
		<div class="panel-body">
			<div class="row">
				<div class="col-md-10">
					<p style="font-size: 15px;">{{{ $proposition['propositionSort'] }}}</p>
					<p style="font-size: 11px;">{{{ $proposition['propositionLong'] }}}</p>
					
					<p class="text-muted"><span class="label label-warning">{{ Lang::choice('messages.moderator.flags.offensive_count', $proposition['offensiveCount'], ['flags' => $proposition['offensiveCount']]) }}</span> <span class="label label-info">{{ Lang::choice('messages.moderator.flags.incomprehensible_count', $proposition['incomprehensibleCount'], ['flags' => $proposition['incomprehensibleCount']]) }}</span></p>
					
					<p><a class="btn btn-sm btn-danger" data-toggle="collapse" href="#proposition{{$proposition['id']}}" aria-expanded="false" aria-controls="proposition{{$proposition['id']}}">{{Lang::get('messages.moderator.block')}}</a></p>
					
					<div class="list-group-form collapse" id="proposition{{$proposition['id']}}">
						<form class="form-inline" method="post" action="{{ route('moderator.block') }}">
							  <div class="form-group">
							    <input type="text" name="reason" class="form-control input-sm" id="reason" placeholder="{{Lang::get('messages.moderator.reason_placeholder')}}">
							  </div>
							  <input type="hidden" name="propositionId" value="{{$proposition['id']}}">
							  {!! csrf_field() !!}
							  <button type="submit" class="btn btn-danger btn-sm">{{ Lang::get('messages.moderator.block')}}</button>
						</form>
					</div>
					
					<p><small>{{ Lang::get('messages.moderator.flags.avoid')}}</small></p>
					
					
				</div>
			</div>
		</div>
	</div>
</div>
@endforeach
@stop