@extends('layouts.authBase')

@section('title', $proposition['propositionSort'])

@section('content')

        <div class="container-fluid toolbox-margin large">
	        <div class="card card-block proposition yellow">
	        
	         		@if ($proposition['ending_in'] <= 0)
	         		<p class="pull-right"><span class="label label-info">{{ Lang::get('messages.proposition.status.expired') }}</span></p>
	         		@elseif ($votes['userHasVoted'] == false)
	        		<p class="pull-right"><span class="label label-info">{{ Lang::choice('messages.proposition.status.ending_in', $proposition['ending_in'], ['daysleft' => $proposition['ending_in']]) }}</span></p>
                    @endif
                    
                    <p class="card-text">{{ $proposition['propositionSort'] }}</p>
                    @if ($proposition['ending_in'] <= 0)
					<p class="card-link" style="text-decoration: none">{{ Lang::get('messages.proposition.voting.expired') }}</p>
                    @elseif ($votes['userHasVoted'] == false)
                    
                    @if ($user['belongsToSchool'] == true)
					<a href="{{ route('upvote', $proposition['propositionId']) }}" class="card-link"><i class="fa fa-angle-up"></i> {{ Lang::get('messages.proposition.voting.actions.upvote') }}</a>
					<a href="{{ route('downvote', $proposition['propositionId']) }}" class="card-link"><i class="fa fa-angle-down"></i> {{ Lang::get('messages.proposition.voting.actions.downvote') }}</a>
					@else
					<a href="{{ route('getLinkAuth') }}" class="card-link">{{ Lang::get('messages.proposition.voting.link') }}</a>
					@endif
					
					@else
					<p class="card-link" style="text-decoration: none">{{ Lang::get('messages.proposition.voting.already_voted') }}</p>
					@endif
                    
                    
                    <div class="extension" id="extension" style="display:none;">
                        <p>{{ $proposition['propositionLong'] }}</p>
                    </div>
                    <a href="#" class="extend-btn" id="extend"><i class="fa fa-angle-down"></i></a>
                </div>
                
                <div class="proposition-info">
                    <p class="text-success"><i class="fa fa-angle-up"></i> {{ Lang::choice('messages.proposition.voting.stats.upvotes', $votes['upvotes'], ['votes' => $votes['upvotes']]) }}</p>
                    <p class="text-danger"><i class="fa fa-angle-down"></i> {{ Lang::choice('messages.proposition.voting.stats.downvotes', $votes['downvotes'], ['votes' => $votes['downvotes']]) }}</p>
                    <p class="text-default">{{ Lang::choice('messages.proposition.voting.stats.comments', $proposition['commentsCount'], ['comments' => $proposition['commentsCount']]) }}</p>
                    @if ($proposition['ending_in'] > 0) <a href="#" class="btn btn-sm btn-secondary" id="commentBtn">{{ Lang::get('messages.proposition.voting.actions.comment') }}</a> @endif
                    <p class="text-default pull-right">{{ Lang::get('messages.proposition.voting.credits') }} <img src="{{ $proposition['proposer']['avatar'] }}" class="profile-picture"> {{ $proposition['proposer']['fullName'] }} on {{ $proposition['date_created'] }}</p>
                </div>
                
                @if ($proposition['ending_in'] > 0)
                <div class="comment" id="commentSection" style="display:none;">
                	<form action="{{ route('comment') }}" method="POST">
	                	<div class="form-group row">
							<div class="col-sm-7">
								<textarea name="commentBody" class="form-control form-control-sm" placeholder="{{ Lang::get('messages.proposition.voting.actions.comment_placeholder') }}"></textarea>
							</div>
						</div>
						<input type="hidden" name="propositionId" value="{{ $proposition['propositionId'] }}"/>
						{!! csrf_field() !!}
						<input class="btn btn-sm btn-primary" type="submit" value="{{ Lang::get('messages.proposition.voting.actions.post_comment') }}">
                	</form>
                </div>
                @endif
                
                <div class="comments">
                
                	@foreach ($comments as $comment)
                	<div class="comment">
                    	<img src="{{ $comment['commenter']['avatar'] }}" class="profile-picture">
                        <h2>{{ $comment['commenter']['fullName'] }}</h2>
                        <p class="time">{{ $comment['date_created'] }}</p>
                        <p>{{ $comment['commentBody'] }}</p>
                    </div>
                	@endforeach
                	
                </div>
        </div>
@stop
        
@section('footer_scripts')
    <script>
	$(document).ready(function(e) {
        
		$("#extend").click( function(e) {
			
			if ($(this).children("i").hasClass('fa-angle-down')) {
				$(this).children("i").removeClass("fa-angle-down");
				$(this).children("i").addClass('fa-angle-up');
			} else {
				$(this).children("i").removeClass("fa-angle-up");
				$(this).children("i").addClass('fa-angle-down');
			}
			
			$( "#extension" ).toggle( "blind" );
		});

		$("#commentBtn").click( function(e) {
			$( "#commentSection" ).toggle( "blind" );
		});
		
    });
	</script>
@stop