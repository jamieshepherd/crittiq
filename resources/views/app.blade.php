<!DOCTYPE html>
<html>
<head>
    <!-- Title -->
    <title>@if(isset($node)) {{ $node->title }} ({{ $node->year }}) - @endif crittiq</title>

    <!-- Meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="Crittiq is a micro review site for TV, Film, and Games">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Styles -->
    <link media="all" type="text/css" rel="stylesheet" href="{{ elixir("css/app.css") }}">
    <link media="all" type="text/css" rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="/js/vendor/jquery-2.1.4.js"></script>
    <script src="/js/vendor/vue-0.12.6.js"></script>
    <script src="/js/vendor/vue-resource.js"></script>
    <script src="/js/vendor/rangeslider.js"></script>
</head>
<body>
    {{-- Preloader on every page --}}
    <div id="loading">
        <div id="preloader"><span></span><span></span><span></span><span></span></div>
    </div>

    {{-- Modal background fader on every page --}}
    <div id="modal"></div>

    {{-- Account login box on every page --}}
    <div id="account">
        <form method="POST" action="/auth/login">
            <img class="logo" src="/images/logo-dark.svg">
            <span>Sign in to your Crittiq Account</span>
            {!! csrf_field() !!}
            <input type="text" name="email" placeholder="Email address">
            <input type="password" name="password" placeholder="Password">
            <input class="btn green full" type="submit" value="Sign in">
        </form>
    </div>

    {{-- Yield the main page content --}}
    <div id="page">
        @yield('body')
    </div>

    {{-- Include any custom javascript at the end --}}
    <script src="/js/app/app.js"></script>
</body>
</html>
