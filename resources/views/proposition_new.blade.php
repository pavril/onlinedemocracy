@extends('layouts_new.authBase')

@section('header_scripts')
<meta property="og:url" content="{{ route('proposition', [$proposition['propositionId']]) }}" />
<meta property="og:type" content="article" />
<meta property="og:title" content="{{{ $proposition['propositionSort'] }}}" />
<meta property="og:description" content="How about voting for this proposition?" />
<meta property="fb:app_id" content="1653131541598762" />
@stop

@section('title', $proposition['propositionSort'])

@section('content')

<div class="container" id="main">
  	<div class="row m-scene ">
  	  <div class="col-md-8 col-md-offset-2 scene_element scene_element--fadein">
      
      	@if (session('status'))
      	<div class="section">
			<div class="form-group form-group-sm">
				<div class="alert alert-warning" role="alert">
				    {{ session('status') }}
				    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
			</div>
		</div>
		@endif
      
      	<div class="section">
        	<a href="{{ route('propositions') }}" class="btn btn-default btn-sm"><i class="fa fa-angle-left"></i> {{Lang::get('messages.proposition.back')}}</a>
            <span class="pull-right">
                <div class="btn-group">
                  <a href="#" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown"><i class="fa fa-share"></i> {{Lang::get('messages.proposition.share.share')}}</a>
                  <ul class="dropdown-menu" id="social_links">
                    <li><a href="{{ $shareLinks['facebook'] }}"><i class="fa fa-facebook-square"></i> {{Lang::get('messages.proposition.share.facebook')}}</a></li>
                    <li><a href="{{ $shareLinks['twitter'] }}"><i class="fa fa-twitter-square"></i> {{Lang::get('messages.proposition.share.twitter')}}</a></li>
                    <li><a href="{{ $shareLinks['plus'] }}"><i class="fa fa-google-plus-square"></i> {{Lang::get('messages.proposition.share.gplus')}}</a></li>
                    <li><a href="{{ $shareLinks['pinterest'] }}"><i class="fa fa-pinterest-square"></i> {{Lang::get('messages.proposition.share.pin')}}</a></li>
                  </ul>
                </div>
                @if ($proposition['ending_in'] <= 0)
                <p class="label label-info label-btn">{{ Lang::get('messages.proposition.status.expired') }}</p> 
	         	@else
	         	<p class="label label-info label-btn">{{ Lang::choice('messages.proposition.status.ending_in', $proposition['ending_in'], ['daysleft' => $proposition['ending_in']]) }}</p> 
	         	@endif
                
                <div class="btn-group">
				  <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-toggle="tooltip" data-placement="right" title="{{Lang::get('messages.proposition.flagging.flag')}}">
				    <i class="glyphicon glyphicon-flag"></i>
				  </button>
				  <ul class="dropdown-menu">
				    <li><a href="{{ route('flag', [$proposition['propositionId'], 1]) }}">{{Lang::get('messages.proposition.flagging.offensive')}}</a></li>
				    <li><a href="{{ route('flag', [$proposition['propositionId'], 2]) }}">{{Lang::get('messages.proposition.flagging.inappropriate')}}</a></li>
				    <li><a href="{{ route('flag', [$proposition['propositionId'], 3]) }}">{{Lang::get('messages.proposition.flagging.incomprehensible')}}</a></li>
				  </ul>
				</div>
                
            </span>
        </div>
      
  	    <div class="thumbnail proposition section">
         	<div class="caption">
  	        	<h1>{{{ $proposition['propositionSort'] }}}</h1>
  	        	<p class="lead">{{{ $proposition['propositionLong'] }}}</p>
           		<small class="text-muted">{{ Lang::choice('messages.proposition.voting.stats.upvotes', $votes['upvotes'], ['votes' => $votes['upvotes']]) }} | {{ Lang::choice('messages.proposition.voting.stats.downvotes', $votes['downvotes'], ['votes' => $votes['downvotes']]) }} | {{ Lang::choice('messages.proposition.voting.stats.comments', $proposition['commentsCount'], ['comments' => $proposition['commentsCount']]) }}</small>
        	</div>
        </div>
      
        @if ($proposition['ending_in'] <= 0)
        <div class="btn-group btn-group-justified section">
			<a href="#" class="btn btn-primary" disabled>{{ Lang::get('messages.proposition.voting.expired') }}</a>
		</div>
        @elseif ($votes['userHasVoted'] == false)
                    
		@if ($user['belongsToSchool'] == true)
		<div class="btn-group btn-group-justified section">
          <a href="{{ route('upvote', $proposition['propositionId']) }}" class="btn btn-success"><i class="fa fa-thumbs-o-up"></i> {{ Lang::get('messages.proposition.voting.actions.upvote') }}</a>
          <a href="{{ route('downvote', $proposition['propositionId']) }}" class="btn btn-danger"><i class="fa fa-thumbs-o-down"></i> {{ Lang::get('messages.proposition.voting.actions.downvote') }}</a>
        </div>
		@else
		<div class="btn-group btn-group-justified section">
			<a href="{{ route('getLinkAuth') }}" class="btn btn-primary">{{ Lang::get('messages.proposition.voting.link') }}</a>
		</div>
		@endif
					
		@else
		<div class="btn-group btn-group-justified section">
			<a href="#" class="btn btn-success" disabled>{{ Lang::get('messages.proposition.voting.already_voted') }}</a>
		</div>
		@endif
        
        <div class="section">
        	<div class="thumbnail section">
            	<div class="caption">
                	<small class="text-muted">{{ Lang::get('messages.proposition.voting.credits') }} <a href="#"><img class="img-circle text-sized-picture" src="{{ $proposition['proposer']['avatar'] }}"> {{ $proposition['proposer']['fullName'] }}</a> {{ $proposition['date_created'] }}</small>
                </div>
            </div>
        </div>
        
        @if ($proposition['ending_in'] > 0)
        <div class="section">
        	<button class="btn btn-white btn-block" type="button" data-toggle="collapse" data-target="#comment" aria-expanded="false" aria-controls="comment">{{ Lang::get('messages.proposition.voting.actions.comment') }}</button>
        </div>
        
        <div class="collapse" id="comment">
 			<div class="section">
        		<div class="thumbnail section">
              		<div class="caption">
	              			<form action="{{ route('comment') }}" method="POST">
	              			<div class="form-group">
	                     		<textarea  name="commentBody" class="form-control" rows="3" id="textArea" placeholder="{{ Lang::get('messages.proposition.voting.actions.comment_placeholder') }}"></textarea>
	              			</div>
			                <input type="hidden" name="propositionId" value="{{ $proposition['propositionId'] }}"/>
							{!! csrf_field() !!}
							<input class="btn btn-primary" type="submit" value="{{ Lang::get('messages.proposition.voting.actions.post_comment') }}" /> <button class="btn btn-default" type="button" data-toggle="collapse" data-target="#comment" aria-expanded="false" aria-controls="comment">{{Lang::get('messages.proposition.comments.cancel')}}</button>
		                	</form>
        			</div>
        		</div>
        	</div>
        </div>
        @endif

        <div class="section comments">
        	<div class="thumbnail section">
        		
        		@if ($comments ==! 0)
        			@foreach ($comments as $comment)
                	<div class="comment">
<!--                     	<img src="{{ $comment['commenter']['avatar'] }}" class="profile-picture"> -->
                        <small class="name"><strong>{{ $comment['commenter']['fullName'] }}</strong></small>
                        <small class="pull-right text-muted">{{ $comment['date_created'] }}</small>
                        <p>{{ $comment['commentBody'] }}</p>
                        <p>
<!-- <!--                         Show only if comment user id = authenticated user -->
<!--                         <a href="#" class="btn btn-default btn-xs">Delete</a> -->
<!-- <!--                         Show all the time -->
<!--                         <a href="#" class="btn btn-default btn-xs">Flag</a> -->
                        </p>
                    </div>
                	@endforeach
                @else
	            	<div class="caption">
	                	<small class="text-muted">{{Lang::get('messages.proposition.comments.no_comments')}} @if ($proposition['ending_in'] >= 0) {{Lang::get('messages.proposition.comments.no_comments_part2')}} <a href="#comment" type="button" data-toggle="collapse" data-target="#comment" aria-expanded="false" aria-controls="comment">{{Lang::get('messages.proposition.comments.add')}}</a>@endif .</small>
	                </div>
                @endif
                
			</div>
        </div>
       
        
      </div>
	</div>
</div>
@stop

@section('footer_scripts')
<script>
$(document).ready( function() {
	$("#social_links li a").click( function(e) {
		e.preventDefault();

		var link = $(this).attr('href');
		var myWindow = window.open(link, "MsgWindow", "width=550, height=500");
	});
});
</script>
@stop