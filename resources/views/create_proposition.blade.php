@extends('layouts.profileBase')

@section('title', Lang::get('messages.profile.create_proposition.create_proposition'))

@section('form')
        <div class="col-sm-10">
        	<form class="profile-settings" method="post" action="{{ route('profile.propositions.store') }}">
			
				<div class="form-group row @if ($errors->has('proposition_sort')) has-error @endif">
					<label for="proposition_sort" class="col-sm-2 form-control-label">{{ Lang::get('messages.profile.create_proposition.proposition_sort') }}</label>
					<div class="col-sm-7">
						<input name="proposition_sort" type="text" value="{{ old('proposition_sort') }}" class="form-control" id="proposition_sort">
						@if ($errors->has('proposition_sort')) <small class="text-muted">{{ $errors->first('proposition_sort') }}</small>@endif
					</div>
				</div>

				<div class="form-group row @if ($errors->has('proposition_long')) has-error @endif">
					<label for="proposition_long" class="col-sm-2 form-control-label">{{ Lang::get('messages.profile.create_proposition.proposition_long') }}</label>
					<div class="col-sm-7">
						<textarea name="proposition_long" class="form-control" id="proposition_long">{{ old('proposition_long') }}</textarea>
						@if ($errors->has('proposition_long')) <small class="text-muted">{{ $errors->first('proposition_long') }}</small>@endif
					</div>
				</div>
				
				<div class="form-group row @if ($errors->has('deadline')) has-error @endif">
					<label for="deadline" class="col-sm-2 form-control-label">{{ Lang::get('messages.profile.create_proposition.deadline') }}</label>
					<div class="col-sm-7">
						<select name="deadline" id="deadline" class="form-control">
							<option value="null" disabled @if (old('deadline') == null) selected @endif>{{ Lang::get('messages.form.select.please_select') }}</option>
							<option value="1" @if (old('deadline') == 1) selected @endif>{{ Lang::get('messages.form.select.2weeks') }}</option>
							<option value="2" @if (old('deadline') == 2) selected @endif>{{ Lang::get('messages.form.select.1month') }}</option>
							<option value="3" @if (old('deadline') == 3) selected @endif>{{ Lang::get('messages.form.select.2months') }}</option>
						</select>
						@if ($errors->has('deadline')) <small class="text-muted">{{ $errors->first('deadline') }}</small>@endif
					</div>
				</div>
				
				{!! csrf_field() !!}
				
				@if ($user['belongsToSchool'] == true)
				<div class="form-group row">
					<div class="col-sm-offset-2 col-sm-7">
						<button type="submit" class="btn btn-primary btn-sm">{{ Lang::get('messages.profile.create_proposition.create_proposition') }}</button>
					</div>
				</div>
				@else
				<div class="form-group row">
					<div class="col-sm-offset-2 col-sm-7">
						<a href="#" class="btn btn-primary btn-sm disabled">{{ Lang::get('messages.profile.create_proposition.create_proposition') }}</a><p><br/><b><a href="{{ route('getLinkAuth') }}">{{ Lang::get('messages.profile.create_proposition.need_to_link') }}</a></b></p>
					</div>
				</div>
				@endif
				
				<div class="form-group row">
					<small class="col-sm-offset-2 col-sm-7 text-muted">{{ Lang::get('messages.profile.create_proposition.will_be_queued') }}</small>
					<small class="col-sm-offset-2 col-sm-7 text-muted">{{ Lang::get('messages.profile.create_proposition.no_offensive_words') }}</small>
				</div>
			</form>
		</div> 
@stop