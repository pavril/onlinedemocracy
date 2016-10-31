@extends('layouts_new.authBase')

@section('header_scripts')
@include('layouts_new.proposition_share_info')
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
		
      
      	<div class="section" style="height: 32px;display: block;">
        	<a href="{{ route('propositions') }}" class="btn btn-default btn-sm hidden-xs"><i class="fa fa-angle-left"></i> {{Lang::get('messages.proposition.back')}}</a>
            <span class="pull-right">
                <div class="btn-group">
                  <a href="#" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown"><i class="fa fa-share"></i> {{Lang::get('messages.proposition.share.share')}} <span class="badge" id="shares-count">0</span></a>
                  <ul class="dropdown-menu" id="social_links">
                    <li><a href="{{ $shareLinks['facebook'] }}"><i class="fa fa-facebook-square"></i> {{Lang::get('messages.proposition.share.facebook')}}</a></li>
                    <li><a href="{{ $shareLinks['twitter'] }}"><i class="fa fa-twitter-square"></i> {{Lang::get('messages.proposition.share.twitter')}}</a></li>
                    <li><a href="{{ $shareLinks['plus'] }}"><i class="fa fa-google-plus-square"></i> {{Lang::get('messages.proposition.share.gplus')}}</a></li>
                    <li><a href="{{ $shareLinks['pinterest'] }}"><i class="fa fa-pinterest-square"></i> {{Lang::get('messages.proposition.share.pin')}}</a></li>
                  </ul>
                </div>
                
                <div class="btn-group">
	                @if ($proposition['ending_in'] <= 0)
	                <p class="label label-info label-btn">{{ Lang::get('messages.proposition.status.expired') }}</p> 
		         	@else
		         	<p class="label label-info label-btn">{{ Lang::choice('messages.proposition.status.ending_in', $proposition['ending_in'], ['daysleft' => $proposition['ending_in']]) }}</p> 
		         	@endif
	         	</div>
                
                <div class="btn-group pull-right pull-right-left-margin">
				  <button type="button" class="btn btn-default btn-text-lg btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-toggle="tooltip" data-placement="right" title="{{Lang::get('messages.proposition.flagging.flag')}}">
				    <i class="material-icons" style="transform: translateY(3px); font-size: 16px;">sentiment_dissatisfied</i>
				  </button>
				  <ul class="dropdown-menu">
				    <li><a href="{{ route('flag', [$proposition['propositionId'], 1]) }}">{{Lang::get('messages.proposition.flagging.offensive')}}</a></li>
				    <li><a href="{{ route('flag', [$proposition['propositionId'], 3]) }}">{{Lang::get('messages.proposition.flagging.incomprehensible')}}</a></li>
				  </ul>
				</div>
                
            </span>
        </div>
      
  	    <div class="thumbnail proposition section @if (empty($proposition['marker']) == false) 
	          		 @if ($proposition['marker']->relationMarkerId() == \App\Marker::SUCCESS) success
	          		 @elseif ($proposition['marker']->relationMarkerId() == \App\Marker::UNDER_DISCUSSION) info
	          		 @elseif ($proposition['marker']->relationMarkerId() == \App\Marker::FAILED) warning
	          		 @endif
	          		 @endif ">
         	<div class="caption">
  	        	@if ($user['role'] === 2) <h1 style="margin-bottom: 0;"><a data-toggle="modal" data-target="#mark" class="label label-gray label-icon pull-right" href="#"> @if (empty($proposition['marker']) == false) <i class="material-icons">edit</i> @else <i class="material-icons">add</i> @endif </a></h1> @endif 
  	        	<h1 class="linkHashtags">@if (empty($proposition['marker']) == false) 
	          		 @if ($proposition['marker']->relationMarkerId() == \App\Marker::SUCCESS)<span class="label label-success label-icon"><i class="material-icons">check</i></span>
	          		 @elseif ($proposition['marker']->relationMarkerId() == \App\Marker::UNDER_DISCUSSION) <span class="label label-info label-icon"><i class="material-icons">speaker_notes</i></span>
	          		 @elseif ($proposition['marker']->relationMarkerId() == \App\Marker::FAILED) <span class="label label-warning label-icon"><i class="material-icons">announcement</i></span>
	          		 @endif
	          		 @endif {{{ $proposition['propositionSort'] }}}</h1>
	            <p class="lead linkHashtags">{{{ $proposition['propositionLong'] }}}</p>
  	        	
  	        	<!-- Future tags -->
  	        	
           		<small class="text-muted">{{ Lang::choice('messages.proposition.voting.stats.upvotes', $votes['upvotes'], ['votes' => $votes['upvotes']]) }} | {{ Lang::choice('messages.proposition.voting.stats.downvotes', $votes['downvotes'], ['votes' => $votes['downvotes']]) }} | {{ Lang::choice('messages.proposition.voting.stats.comments', $proposition['commentsCount'], ['comments' => $proposition['commentsCount']]) }}</small>
        	</div>
        	
        	@if (empty($proposition['marker']) == false)
        	@if ($proposition['marker']->relationMarkerId() == \App\Marker::SUCCESS)
	        <div class="alert alert-success">
				<strong>{{Lang::get('messages.proposition.marker.1')}}!</strong> {{ $proposition['marker']->markerText() }}
			</div>
			@elseif ($proposition['marker']->relationMarkerId() == \App\Marker::UNDER_DISCUSSION)
	        <div class="alert alert-info">
				<strong>{{Lang::get('messages.proposition.marker.2')}}!</strong> {{ $proposition['marker']->markerText() }}
			</div>
			@elseif ($proposition['marker']->relationMarkerId() == \App\Marker::FAILED)
			<div class="alert alert-warning">
				<strong>{{Lang::get('messages.proposition.marker.3')}}!</strong> {{ $proposition['marker']->markerText() }}
			</div>
			@endif
			@endif
			
        </div>
        
        @if ($proposition['ending_in'] <= 0)
        <div class="btn-group btn-group-justified section">
			<a href="#" class="btn btn-primary" disabled>{{ Lang::get('messages.proposition.voting.expired') }}</a>
		</div>
        @elseif ($votes['userHasVoted'] == false)
                    
		@if ($user['belongsToSchool'] == true)
		<div class="btn-group btn-group-justified section">
          <a href="{{ route('upvote', $proposition['propositionId']) }}" class="btn btn-success btn-text-lg"><i class="material-icons" style="vertical-align: inherit;">thumb_up</i> {{ Lang::get('messages.proposition.voting.actions.upvote') }}</a>
          <a href="{{ route('downvote', $proposition['propositionId']) }}" class="btn btn-danger btn-text-lg"><i class="material-icons" style="vertical-align: middle;">thumb_down</i> {{ Lang::get('messages.proposition.voting.actions.downvote') }}</a>
        </div>
		@else
		<div class="btn-group btn-group-justified section">
          <a href="#" class="btn btn-success btn-text-lg" disabled><i class="material-icons" style="vertical-align: inherit;">thumb_up</i> {{ Lang::get('messages.proposition.voting.actions.upvote') }}</a>
          <a href="#" class="btn btn-danger btn-text-lg" disabled><i class="material-icons" style="vertical-align: middle;">thumb_down</i> {{ Lang::get('messages.proposition.voting.actions.downvote') }}</a>
        </div>
		<p class="text-primary text-center"><small>{{Lang::get('messages.proposition.voting.link')}}</small></p>
		<div class="btn-group btn-group-justified section">
			<a href="{{ route('getLinkAuth') }}" class="btn btn-info btn-text-lg">{{ Lang::get('messages.profile.account.school_link_actions.link_now') }}</a>
		</div>
		@endif
					
		@else
		<div class="btn-group btn-group-justified section">
			<a href="#" class="btn btn-success btn-text-lg" disabled>{{ Lang::get('messages.proposition.voting.already_voted') }}</a>
		</div>
		@endif
        
        <div class="section">
        	<div class="thumbnail section">
            	<div class="caption">
                	<small class="text-muted" style="font-size: 90%;">{{ Lang::get('messages.proposition.voting.credits') }} <a href="{{ route('search') . '?q=' . $proposition['proposer']['fullName'] }}"><img class="img-circle text-sized-picture" src="{{ $proposition['proposer']['avatar'] }}"> {{ $proposition['proposer']['fullName'] }}</a> {{ $proposition['date_created'] }}</small>
                </div>
            </div>
        </div>
        
        @if (($proposition['ending_in'] > 0))
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
							<input class="btn btn-primary" type="submit" value="{{ Lang::get('messages.proposition.voting.actions.post_comment') }}" @if ($user['belongsToSchool'] == false) disabled="disabled" @endif/> <button class="btn btn-default" type="button" data-toggle="collapse" data-target="#comment" aria-expanded="false" aria-controls="comment">{{Lang::get('messages.proposition.comments.cancel')}}</button>
		                	</form>
        			</div>
        		</div>
        	</div>
        </div>
        @endif
        <div class="section comments" id="comments">
        	<div class="thumbnail section">
        		
        		@if ($comments ==! 0)
        			@foreach ($comments as $comment)
                	<div class="comment">
                        <span class="name"><strong><img class="img-circle text-sized-picture" src="{{ $comment['commenter']['avatar'] }}"> <a href="{{ route('search') . '?q=' . $comment['commenter']['fullName'] }}">{{ $comment['commenter']['fullName'] }}</a></strong></span>
                        <small class="pull-right text-muted" style="font-size: 90%">@if ($comment['commenter']['id'] == $user['userId']) <a href="{{ route('comment.delete', ['comment' => $comment['commentId']]) }}" class="text-muted">{{ Lang::get('messages.proposition.comments.delete') }}</a> - @endif {{ $comment['date_created'] }}</small>
                        <p>{{ $comment['commentBody'] }}</p>
                       	<p class="meta"><a href="#" class="@if ($comment['userHasLiked'] == 1) text-primary @else text-muted @endif like" data-comment-id="{{ $comment['commentId'] }}" data-user-liked="{{ $comment['userHasLiked'] }}"><i class="material-icons">thumb_up</i> <span class="btn-inner">@if ($comment['userHasLiked'] == 1) {{Lang::get('messages.proposition.comments.liked')}} @else {{Lang::get('messages.proposition.comments.like')}} @endif</span></a> 
                       		@if($comment['likes'] > 0) <span class="text-muted">&bull; 
                       		<a href="#" onclick="return false;" class="text-muted" data-toggle="popover" data-placement="top" data-html="true" data-template='<div class="popover likes" role="tooltip"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>' data-content=' @include('layouts_new.people_likes', ['likes' => $comment['people_likes']]) '>{{ Lang::choice('messages.proposition.comments.likes_count', $comment['likes'], ['likes' => $comment['likes']]) }}</a></span> @endif </p>
                    </div>
                	@endforeach
                @else
	            	<div class="caption">
	                	<small class="text-muted">{{Lang::get('messages.proposition.comments.no_comments')}} @if ($proposition['ending_in'] >= 0 or $user['belongsToSchool'] == true) {{Lang::get('messages.proposition.comments.no_comments_part2')}} <a href="#comment" type="button" data-toggle="collapse" data-target="#comment" aria-expanded="false" aria-controls="comment">{{Lang::get('messages.proposition.comments.add')}}</a>@endif .</small>
	                </div>
                @endif
                
			</div>
        </div>
       
        
      </div>
	</div>
</div>
@stop

@section('footer_scripts')
@if ($user['role'] === 2)
@if (empty($proposition['marker']) == true)
<div class="modal fade" id="mark" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="material-icons">close</i></button>
        <h4 class="modal-title" id="myModalLabel">{{Lang::get('messages.proposition.marker.modal.create_title')}}</h4>
      </div>
      <div class="modal-body">
        <form id="marker">
		  <div class="form-group">
		    <label for="type">{{Lang::get('messages.proposition.marker.modal.type')}}</label>
		    <select name="type" class="form-control" id="type">
		    	<option disabled selected>{{Lang::get('messages.form.select.please_select')}}</option>
		    	<option value="{{ \App\Marker::SUCCESS }}">{{Lang::get('messages.proposition.marker.1')}}</option>
				<option value="{{ \App\Marker::UNDER_DISCUSSION }}">{{Lang::get('messages.proposition.marker.2')}}</option>
				<option value="{{ \App\Marker::FAILED }}">{{Lang::get('messages.proposition.marker.3')}}</option>
			</select>
		  </div>
		  <div class="form-group">
		    <label for="message">{{Lang::get('messages.proposition.marker.modal.message')}}</label>
		    <textarea class="form-control" name="message" rows="3" id="message"></textarea>
		  </div>
		  {{ csrf_field() }}
		  <div class="errors" id="errors"></div>
		</form>
      </div>
      <div class="modal-footer">
        <button type="button" id="marker_save" class="btn btn-primary btn-block">{{Lang::get('messages.proposition.marker.modal.set')}}</button>
      </div>
    </div>
  </div>
</div>
@else
<div class="modal fade" id="mark" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="material-icons">close</i></button>
        <h4 class="modal-title" id="myModalLabel">{{Lang::get('messages.proposition.marker.modal.edit_title')}}</h4>
      </div>
      <div class="modal-body">
        <form id="marker">
		  <div class="form-group">
		    <label for="type">{{Lang::get('messages.proposition.marker.modal.type')}}</label>
		    <select name="type" class="form-control" id="type">
		    	<option disabled>{{Lang::get('messages.form.select.please_select')}}</option>
		    	<option value="{{ \App\Marker::SUCCESS }}" @if ($proposition['marker']->relationMarkerId() == \App\Marker::SUCCESS) selected @endif >{{Lang::get('messages.proposition.marker.1')}}</option>
				<option value="{{ \App\Marker::UNDER_DISCUSSION }}" @if ($proposition['marker']->relationMarkerId() == \App\Marker::UNDER_DISCUSSION) selected @endif >{{Lang::get('messages.proposition.marker.2')}}</option>
				<option value="{{ \App\Marker::FAILED }}" @if ($proposition['marker']->relationMarkerId() == \App\Marker::FAILED) selected @endif >{{Lang::get('messages.proposition.marker.3')}}</option>
			</select>
		  </div>
		  <div class="form-group">
		    <label for="message">{{Lang::get('messages.proposition.marker.modal.message')}}</label>
		    <textarea class="form-control" name="message" rows="3" id="message">{{ $proposition['marker']->markerText() }}</textarea>
		  </div>
		  {{ csrf_field() }}
		  <div class="errors" id="errors"></div>
		</form>
      </div>
      <div class="modal-footer">
        <button type="button" id="marker_save" class="btn btn-primary btn-block">{{Lang::get('messages.proposition.marker.modal.update')}}</button>
      	<a href="{{ route('marker.delete', [$proposition['propositionId']]) }}" class="btn btn-danger btn-block">{{Lang::get('messages.proposition.marker.modal.delete')}}</a>
      </div>
    </div>
  </div>
</div>
@endif
@endif
<script>
$(document).ready( function() {


	@if ($user['role'] === 2)
	@if (empty($proposition['marker']) == true)
	$('#mark').on('show.bs.modal', function (event) {
		  var $modal = $(this);
		  $modal.find('.errors').html('');
		  $modal.find('#type').val(null);
		  $modal.find('#message').val(null);
	});
	@else
	$('#mark').on('show.bs.modal', function (event) {
		  var $modal = $(this);
		  $modal.find('.errors').html('');
	});
	@endif

	$("#marker_save").click( function(e) {

		@if (empty($proposition['marker']) == true)
		var url = "{{ route('marker.create', [$proposition['propositionId']]) }}";
		@else
		var url = "{{ route('marker.edit', [$proposition['propositionId']]) }}";
		@endif

		$.post( url, $("#marker").serialize() )
		  .done(function(e) {
		    var errors = e;
			if (errors !== 'success') {
				errorsHtml = '<div class="alert alert-danger">';
			    $.each(errors, function(index, value) {
			        errorsHtml += '<p>' + value + '</p>';
			    });
			    errorsHtml += '</di>'; 
	
				$( '#errors' ).html( errorsHtml );
			} else {
				@if (empty($proposition['marker']) == true)
				$( '#errors' ).html( '<div class="alert alert-success"><p>{{Lang::get('messages.proposition.marker.modal.create_success')}}</p></div>' );
				@else
				$( '#errors' ).html( '<div class="alert alert-success"><p>{{Lang::get('messages.proposition.marker.modal.update_success')}}</p></div>' );
				@endif
				setTimeout(function(){
					$('#mark').modal('hide');
					location.reload();
				}, 700); 
			}
		  })
		  .fail(function(e) {
				var errors = $.parseJSON(e.responseText);
				errorsHtml = '<div class="alert alert-danger"><ul>';
			    $.each(errors, function(index, value) {
			        errorsHtml += '<li>' + value + '</li>';
			    });
			    errorsHtml += '</ul></di>';
				$( '#errors' ).html( errorsHtml );
		  });
		
	});
	@endif
	
	$("#social_links li a").click( function(e) {
		e.preventDefault();

		var link = $(this).attr('href');
		var myWindow = window.open(link, "MsgWindow", "width=550, height=500");
	});

	$URL = "{{ route('proposition', [$proposition['propositionId']]) }}";
	// Facebook Shares Count
	$.getJSON( 'https://graph.facebook.com/?id=' + $URL, function( fbdata ) {
		$('#shares-count').text(ReplaceNumberWithCommas(fbdata.shares));
	});

	$(".comment .like").click( function(e) {
		var $button = $(this);
		var commentId = $button.data('comment-id');

		var data = {'_token': "{{ Session::token() }}", 'commentId': commentId};
		
		if ($(this).data('user-liked') == 0) {
			$.post("{{ route('comment.like') }}", data)
			.done(function(e) {
				$button.data('user-liked', "1");
				$button.removeClass("text-muted");
				$button.addClass("text-primary");
				$button.find('.btn-inner').html("{{Lang::get('messages.proposition.comments.liked')}}");
			})
			.fail(function(XMLHttpRequest, textStatus, errorThrown) {
				alert(errorThrown);
		  	});
		} else {
			$.post("{{ route('comment.remove_like') }}", data)
			.done(function(e) {
				console.log(e);
				$button.data('user-liked',0);
				$button.removeClass("text-primary");
				$button.addClass("text-muted");
				$button.find('.btn-inner').html("{{Lang::get('messages.proposition.comments.like')}}");
			})
			.fail(function(XMLHttpRequest, textStatus, errorThrown) {
				alert(errorThrown);
				console.log(XMLHttpRequest.responseText);
		  	});
		}
		
		return false;
	});
			    
});
// Format Number functions
function ReplaceNumberWithCommas(yourNumber) {
	//Seperates the components of the number
	var components = yourNumber.toString().split(".");
	//Comma-fies the first part
	components [0] = components [0].replace(/\B(?=(\d{3})+(?!\d))/g, ".");
	//Combines the two sections
	return components.join(".");
}
</script>
@stop