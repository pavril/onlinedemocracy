@extends('layouts_new.websiteBase')

@section('title', 'An online voting platform for schools')

@section('content')
<div class="background-header">
  	<div class="container">
        <div class="row">
          <div class="col-md-7 col-sm-12 padding-top">
          	<h1>{{Lang::get('messages.website.home.title')}}</h1>
            <p class="lead">{{Lang::get('messages.website.home.subtitle')}}</p>
            <a href="{{ route('auth.getSocialAuth', ['provider' => 'facebook']) }}" class="btn btn-info btn-lg">{{Lang::get('messages.session.sign_up.use_fb')}}</a>
            <a href="{{ route('register') }}" class="btn btn-default btn-secondary btn-lg">{{Lang::get('messages.session.sign_up.sign_up')}}</a>
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
                    <p class="panel-title">{{Lang::get('messages.website.home.able_to')}}</p>
                    <h2>{{Lang::get('messages.website.home.vote')}}</h2>
                    <hr/>
                    <img src="{{ asset('img/vote.svg') }}">
                    <p>{{Lang::get('messages.website.home.vote_text')}}</p>
                  </div>
                </div>
            </div>
            <div class="col-md-4 text-center">
                <div class="panel panel-default">
                  <div class="panel-heading"></div>
                  <div class="panel-body">
                    <p class="panel-title">{{Lang::get('messages.website.home.able_to')}}</p>
                    <h2>{{Lang::get('messages.website.home.suggest')}}</h2>
                    <hr/>
                    <img src="{{ asset('img/suggest.svg') }}">
                    <p>{{Lang::get('messages.website.home.suggest_text')}}</p>
                  </div>
                </div>
            </div>
            <div class="col-md-4 text-center">
                <div class="panel panel-default">
                  <div class="panel-heading"></div>
                  <div class="panel-body">
                    <p class="panel-title">{{Lang::get('messages.website.home.able_to')}}</p>
                    <h2>{{Lang::get('messages.website.home.comment')}}</h2>
                    <hr/>
                    <img src="{{ asset('img/comment.svg') }}">
                    <p>{{Lang::get('messages.website.home.comment_text')}}</p>
                  </div>
                </div>
            </div>
        </div>
  	</div>
  </div>
@stop

@section('footer_scripts')
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-72457439-1', 'auto');
  ga('send', 'pageview');

</script>
@stop