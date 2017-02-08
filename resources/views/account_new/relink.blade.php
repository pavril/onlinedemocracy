@extends('layouts_new.authBase')

@section('title', $fullName)

@section('content')

    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-6">
            <h1>{{ Lang::get('messages.profile.account.relink.heading') }}</h1>
        </div>
        <div class="col-md-4"></div>
    </div>


    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <a href="{{ route('getLinkAuthMsgraph') }}" class="btn btn-info btn-sm btn-block">{{ Lang::get('messages.profile.account.school_link_actions.link_now_msgraph') }}</a>
        </div>
        <div class="col-md-4"></div>
    </div>

@endsection