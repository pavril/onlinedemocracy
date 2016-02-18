<meta property="fb:app_id" content="{{ env('FACEBOOK_CLIENT_ID') }}" />
<meta property="og:url" content="{{ route('proposition', [$proposition['propositionId']]) }}" />
<meta property="og:title" content="{{ $proposition['propositionSort'] }}" />
@if (empty($proposition['propositionLong']) == false) <meta property="og:description" content="{{ $proposition['propositionLong'] }}" />
@else <meta property="og:description" content="You have finally got the power to change things! Take part in your school's decision making" />
@endif
<meta property="og:image" content="{{ asset('img/logo.png') }}" />
<meta property="og:site_name" content="DirectDemocracy.Online">