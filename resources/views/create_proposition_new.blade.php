@extends('layouts_new.authBase')

@section('title', Lang::get('messages.profile.create_proposition.create_proposition'))

@section('content')

@if ($user['belongsToSchool'] == true)
  
<div class="container" id="main">
  	<div class="row m-scene ">
  	  <div class="col-md-8 col-md-offset-2 scene_element scene_element--fadein">
  	  
  	  	@if (count($errors) > 0)<div class="alert alert-danger">
	      	<p class="text-center">{{Lang::get('messages.profile.create_proposition.errors')}}</p>
	      	<p><ul>
	      	@foreach ($errors->all() as $error)
	      		<li>{{ $error }}</li>
	      	@endforeach
	      	</ul></p>
	      </div>@endif
  	  
      
        <div class="section">
        	
            <div class="row bs-wizard" style="border-bottom:0;">
                
                <div id="progress-1" class="col-xs-3 bs-wizard-step active">
                  <div class="text-center bs-wizard-stepnum">{{ Lang::choice('messages.profile.create_proposition.step', 1, ['step' => 1]) }}</div>
                  <div class="progress no-animation"><div class="progress-bar"></div></div>
                  <a href="#" class="bs-wizard-dot step-btn" data-target-step="1"></a>
                  <div class="bs-wizard-info text-center @if ($errors->has('proposition_sort')) text-danger @endif">{{Lang::get('messages.profile.create_proposition.proposition_sort')}}</div>
                </div>
                
                <div id="progress-2" class="col-xs-3 bs-wizard-step disabled">
                  <div class="text-center bs-wizard-stepnum">{{ Lang::choice('messages.profile.create_proposition.step', 2, ['step' => 2]) }}</div>
                  <div class="progress no-animation"><div class="progress-bar"></div></div>
                  <a href="#" class="bs-wizard-dot step-btn" data-target-step="2"></a>
                  <div class="bs-wizard-info text-center @if ($errors->has('proposition_long')) text-danger @endif">{{Lang::get('messages.profile.create_proposition.proposition_long')}}</div>
                </div>
                
                <div id="progress-3" class="col-xs-3 bs-wizard-step disabled">
                  <div class="text-center bs-wizard-stepnum">{{ Lang::choice('messages.profile.create_proposition.step', 3, ['step' => 3]) }}</div>
                  <div class="progress no-animation"><div class="progress-bar"></div></div>
                  <a href="#" class="bs-wizard-dot step-btn" data-target-step="3"></a>
                  <div class="bs-wizard-info text-center @if ($errors->has('deadline')) text-danger @endif">{{Lang::get('messages.profile.create_proposition.deadline')}}</div>
                </div>
                
                <div id="progress-4" class="col-xs-3 bs-wizard-step disabled">
                  <div class="text-center bs-wizard-stepnum">{{ Lang::choice('messages.profile.create_proposition.step', 4, ['step' => 4]) }}</div>
                  <div class="progress no-animation"><div class="progress-bar"></div></div>
                  <a href="#" class="bs-wizard-dot step-btn" data-target-step="4"></a>
                  <div class="bs-wizard-info text-center">{{Lang::get('messages.profile.create_proposition.confirm')}}</div>
                </div>
            </div>
        
	</div>
	
    <form method="post" action="{{ route('profile.propositions.store') }}">
      <div id="step1">	
  	    <div class="proposition section">
            <textarea name="proposition_sort" id="preview_heading_entry" class="form-control input-lg input-proposition" rows="4" placeholder="{{Lang::get('messages.profile.create_proposition.proposition_sort')}}">{{ old('proposition_sort') }}</textarea>
        </div>
        
        <div class="btn-group btn-group-justified section">
          <a href="#" class="btn btn-info step-btn" data-target-step="2">{{Lang::get('messages.profile.create_proposition.next')}} <i class="fa fa-angle-right"></i></a>
        </div>
      </div>
      
      <div id="step2">
      	<div class="proposition section">
            <textarea name="proposition_long" id="preview_subheading_entry" class="form-control input-lg input-proposition" rows="4" placeholder="{{Lang::get('messages.profile.create_proposition.proposition_long')}}">{{ old('proposition_long') }}</textarea>
        </div>
        
        <div class="btn-group btn-group-justified section">
          <a href="#" class="btn btn-info step-btn" data-target-step="1"><i class="fa fa-angle-left"></i> {{Lang::get('messages.profile.create_proposition.previous')}}</a>
          <a href="#" class="btn btn-info step-btn" data-target-step="3">{{Lang::get('messages.profile.create_proposition.next')}} <i class="fa fa-angle-right"></i></a>
        </div>
      </div>
      
      <div id="step3">
      	<div class="proposition section">
            <select name="deadline" id="preview_deadline_entry" class="form-control input-lg input-proposition" class="form-control">
							<option value="null" disabled @if (old('deadline') == null) selected @endif>{{ Lang::get('messages.form.select.please_select_deadline') }}</option>
							<option value="1" @if (old('deadline') == 1) selected @endif>{{ Lang::get('messages.form.select.2weeks') }}</option>
							<option value="2" @if (old('deadline') == 2) selected @endif>{{ Lang::get('messages.form.select.1month') }}</option>
							<option value="3" @if (old('deadline') == 3) selected @endif>{{ Lang::get('messages.form.select.2months') }}</option>
						</select>
        </div>
        
        <div class="btn-group btn-group-justified section">
          <a href="#" class="btn btn-info step-btn" data-target-step="2"><i class="fa fa-angle-left"></i> {{Lang::get('messages.profile.create_proposition.previous')}}</a>
          <a href="#" class="btn btn-info step-btn" data-target-step="4">{{Lang::get('messages.profile.create_proposition.next')}} <i class="fa fa-angle-right"></i></a>
        </div>
      </div>
      
      <div id="step4">
      	
      	<div class="thumbnail proposition section">
         	<div class="caption">
  	        	<h1 id="preview_heading"></h1>
  	        	<p class="lead" id="preview_subheading"></p>
          	    <small id="preview_deadline" class="text-muted"></small>
        	</div>
        </div>
        
        <div class="btn-group btn-group-justified section">
          <a href="#" class="btn btn-info step-btn" data-target-step="3"><i class="fa fa-angle-left"></i> {{Lang::get('messages.profile.create_proposition.previous')}}</a>
          <div class="btn-group" role="group">
          	<button type="submit" class="btn btn-success"><i class="fa fa-check"></i> {{Lang::get('messages.profile.create_proposition.submit')}}</button>
          </div>
        </div>
        
        <small class="text-muted">{{Lang::get('messages.profile.create_proposition.agree')}} <a href="{{ route('terms') }}" target="_blank">{{Lang::get('messages.profile.create_proposition.more')}}</a>.</small>
      </div>
      {!! csrf_field() !!}
      </form>
      
      </div>
	</div>
</div>
@else
<div class="container">
	
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<h1>{{Lang::get('messages.profile.create_proposition.inactive')}}</h1>
			<p class="lead">{{ Lang::get('messages.profile.account.school_link_help') }}</p>
			<br/>
			<a href="{{ route('getLinkAuth') }}" class="btn btn-lg btn-info btn-block">{{ Lang::get('messages.profile.account.school_link_actions.link_now') }}</a>
		</div>
	</div>
</div>

@endif
@stop

@section('footer_scripts')
<script type="text/javascript" src="{{ asset('js/jquery.overlay.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/jquery.textcomplete.js') }}"></script>
<script type="text/javascript">
$('#preview_heading_entry, #preview_subheading_entry').textcomplete([{
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
<script>
var current = 1;
@if (count($errors) > 0) current = 4; @endif

var maxStep = current;

$(document).ready( function() {
	
	updateStep(current);

	$(".step-btn").click( function() {
		var requestedStep = $(this).data('target-step');
		var current = requestedStep;
		updateStep(current);
	});

	$("#preview_heading_entry").keyup( function() {
		$("#preview_heading").html($(this).val());
	});
	$("#preview_subheading_entry").keyup( function() {
		$("#preview_subheading").html($(this).val());
	});

	$("#preview_deadline_entry").change( function() {
		$("#preview_deadline").html($("#preview_deadline_entry option:selected").text());
	});
});

function updateStep(stenNum) {
	$('#step1, #step2, #step3, #step4').hide();
	$('#step' + stenNum).show();		
	if (maxStep <= stenNum) {
		maxStep = stenNum;
		updateProgressBarFromArray(updateProgress(stenNum, 1));
	}
}

function updateProgress(stepNum, state) {

	var progressBar = getProgressNum();
	for (i = 1; i < stepNum; i++) {
		progressBar[i] = 2;
	}
	for (i = stepNum; i <= 4; i++) {
		progressBar[i] = 0;
	}
	for (i = stepNum; i <= maxStep; i++) {
		progressBar[i] = 2;
	}
	progressBar[stepNum] = state;
	return progressBar;
}

function updateProgressBarFromArray(progressBar) {
	console.log(progressBar);
	for (i = 1; i <= 4; i++) {
		clearClassState(i)
		if (progressBar[i] == 1) {
			$("#progress-" + i).addClass('active');
		} else if (progressBar[i] == 2) {
			$("#progress-" + i).addClass('complete');
		} else {
			$("#progress-" + i).addClass('disabled');
		}
	}
}

function clearClassState(stepNum) {
	$("#progress-" + stepNum).removeClass('active');
	$("#progress-" + stepNum).removeClass('complete');
	$("#progress-" + stepNum).removeClass('disabled');
}

function getProgressNum() {
	var progressBar = new Array();
	for (i = 1; i <= 4; i++) {
		if ($("#progress-" + i).hasClass('complete') == true) {
			progressBar[i] = 2;
		} else if ($("#progress-" + i).hasClass('active') == true) {
			progressBar[i] = 1;
		} else {
			progressBar[i] = 0;
		}
	}
	return progressBar;
}
</script>
@stop