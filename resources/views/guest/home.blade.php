@extends('layouts_new.websiteBase')

@section('title', 'An online voting platform for schools')

@section('content')
<div class="background-header">
  	<div class="container">
        <div class="row">
          <div class="col-md-7 col-sm-12 padding-top">
          	<h1>You finally got the power to change things!</h1>
            <p class="lead">Take part in your school's descission making in less than 5 seconds. Join DirectDemocracy.</p>
            <a href="{{ route('auth.getSocialAuth', ['provider' => 'facebook']) }}" class="btn btn-info btn-lg">Register with Facebook</a>
            <a href="{{ route('register') }}" class="btn btn-default btn-secondary btn-lg">Sign up</a>
          </div>
          <div class="col-md-5 visible-lg visible-md"><img src="{{ asset('img/screenshot.png') }}" class="img-header" alt="DirectDemocracy screenshot"></div>
        </div>
  	</div>
  </div>
  
  <div class="section">
  	<div class="container">
        <div class="row">
            <div class="col-md-4 text-center">
                <div class="panel panel-default">
                  <div class="panel-heading"></div>
                  <div class="panel-body">
                    <p class="panel-title">You are able to</p>
                    <h2>Vote</h2>
                    <hr/>
                    <img src="{{ asset('img/vote.svg') }}">
                    <p>With DirectDemocracy, you are able to vote on suggestions made by other pupils concerning the school life.</p>
                  </div>
                </div>
            </div>
            <div class="col-md-4 text-center">
                <div class="panel panel-default">
                  <div class="panel-heading"></div>
                  <div class="panel-body">
                    <p class="panel-title">You are able to</p>
                    <h2>Suggest</h2>
                    <hr/>
                    <img src="{{ asset('img/suggest.svg') }}">
                    <p>With DirectDemocracy, you can make your own suggestions for everything concerning the school life. Everyone can vote on your propositions.</p>
                  </div>
                </div>
            </div>
            <div class="col-md-4 text-center">
                <div class="panel panel-default">
                  <div class="panel-heading"></div>
                  <div class="panel-body">
                    <p class="panel-title">You are able to</p>
                    <h2>Comment</h2>
                    <hr/>
                    <img src="{{ asset('img/comment.svg') }}">
                    <p>With DirectDemocracy, you can comment on suggestions made by other pupils and help improve your school life.</p>
                  </div>
                </div>
            </div>
        </div>
  	</div>
  </div>
@stop