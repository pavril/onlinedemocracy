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
					@endif
					@endif
					
				</div>
                                
				<div class="col-md-2 text-right">
					<span class="label label-default">{{ $proposition['propositionCreationDate'] }}</span>
				</div>
			</div>
		</div>
		
		
		<div class="panel-footer panel-footer-gray @if ($proposition['statusId'] == 3) panel-footer-danger @endif">
		
			@if ($proposition['statusId'] !== 2)
			@if ($proposition['statusId'] !== 3)
			<a href="{{ route('proposition', [$proposition['id']]) }}" class="btn btn-primary btn-sm">{{ Lang::get('messages.profile.propositions.go_to') }}</a>
			@endif
			@endif
			
			@if ($proposition['statusId'] == 2)
			<a href="#" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#edit{{ $proposition['id'] }}">{{ Lang::get('messages.profile.propositions.edit') }}</a>
			@endif
			
			@if ($proposition['statusId'] == 3)
			{{ Lang::get('messages.profile.propositions.status.block_reason') }} {{ $proposition['blockReason'] }}
			@endif
		
		</div>
		
		@if ($proposition['statusId'] == 2)
		<!-- Edit proposition modal -->
		<div class="modal fade" id="edit{{ $proposition['id'] }}" data-edit-proposition="{{ $proposition['id'] }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="material-icons">close</i></span></button>
		        <h4 class="modal-title" id="myModalLabel">{{ Lang::get('messages.profile.propositions.edit_proposition') }}</h4>
		      </div>
		      <div class="modal-body">
		        <form id="editForm{{ $proposition['id'] }}">
				  <div class="form-group">
				    <textarea name="proposition" data-field="proposition" class="form-control" rows="4" placeholder="{{Lang::get('messages.profile.create_proposition.proposition_sort')}}">{{{ $proposition['propositionSort'] }}}</textarea>
				  </div>
				  <div class="form-group">
				    <textarea name="description" data-field="description" class="form-control" rows="4" placeholder="{{Lang::get('messages.profile.create_proposition.proposition_long')}}">{{{ $proposition['propositionLong'] }}}</textarea>
				  </div>
				  <div class="form-group">
				    <select class="form-control" disabled>
							<option disabled selected>{{ Lang::choice('messages.profile.propositions.deadline', $proposition['deadline'], ['days' => Carbon\Carbon::now()->diffInDays(Carbon\Carbon::createFromTimestamp(strtotime($proposition['deadline'])), false)]) }}</option>
					</select>
					<small class="helpBlock text-muted">{{ Lang::get('messages.profile.propositions.deadline_fixed') }}</small>
				  </div>
				  <input type="hidden" name="propositionId" value="{{ $proposition['id'] }}">
				  {{ csrf_field() }}
				  <div class="errors" id="errors"></div>
				</form>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal">{{ Lang::get('messages.close') }}</button>
		        <button type="button" class="btn btn-primary" data-form-id="editForm{{ $proposition['id'] }}" data-proposition-id="{{{ $proposition['id'] }}}">{{ Lang::get('messages.form.buttons.save') }}</button>
		      </div>
		    </div>
		  </div>
		</div>
		@endif
			
	</div>
</div>
@endforeach
@stop

@section('footer_scripts')
<script type="text/javascript" src="{{ asset('js/jquery.overlay.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/jquery.textcomplete.js') }}"></script>
<script type="text/javascript">
$('[data-field="description"], [data-field="proposition"]').textcomplete([{
	// Required
	match: /\B#(\w*)$/,
	search: function (term, callback, match) {
		$.getJSON('/api/tag_search', { q: term })
		  .done(function (resp) {
		  	callback(resp); // `resp` must be an Array
		  })
	      .fail(function () {
	      	callback([]); // Callback must be invoked even if something went wrong.
	      });
	},
	replace: function (value) {
		return '#' + value + ' ';
	},

	index: 1,
	context: function (text) { return text.toLowerCase(); }, // normalize input text
}], {
	onKeydown: function (e, commands) {
		if (e.keyCode === 13) {
			return commands.KEY_ENTER;
   		}
	},
}, { appendTo: 'body' }).overlay([
	{
		match: /\B#\w+/g,
		css: {'background-color': '#d8dfea'}
	}
]); 
</script>
<style>
#preview_heading_entry, #preview_subheading_entry {line-height: 50px !important;}.textoverlay span {border-radius: 5px;}.dropdown-menu.textcomplete-dropdown {display: block;}
</style>
<script type="text/javascript">
$('[data-edit-proposition]').on('show.bs.modal', function (event) {
	  var $modal = $(this);
	  $modal.find('.errors').html('');

	  $.getJSON('{{ route('api.proposition') }}', { id: $(this).data("edit-proposition") })
	  .done(function (data) {
		  
		$modal.find('[data-field="proposition"]').val(data['propositionSort']);
		$modal.find('[data-field="description"]').val(data['propositionLong']);
			
	  })
      .fail(function () {
      	callback([]);
      });
});

$('button[data-form-id]').click( function(e) {
	
	var propositionId = $(this).data("proposition-id");
	var formId = $(this).data("form-id");
	
	$.post("{{ route('proposition.update') }}", $("#" + formId).serialize())
	  .done(function(e) {
	    var errors = e;
		if (errors !== 'success') {
			errorsHtml = '<div class="alert alert-danger">';
		    $.each(errors, function(index, value) {
		        errorsHtml += '<p>' + value + '</p>';
		    });
		    errorsHtml += '</div>'; 

			$( '.errors' ).html( errorsHtml );
		} else {
			$( '.errors' ).html( '<div class="alert alert-success"><p>{{Lang::get('messages.profile.propositions.updated')}}</p></div>');
			setTimeout(function(){
				$('[data-edit-proposition]').modal('hide');
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
			$( '.errors' ).html( errorsHtml );
	  });
	
});
</script>
@stop