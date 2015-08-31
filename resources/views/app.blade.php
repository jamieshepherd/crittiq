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
    <link media="all" type="text/css" rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

    <!-- Scripts -->
    <script src="{{ elixir('js/vendor.js') }}"></script>
</head>
<body>
    {{-- Preloader on every page --}}
    <div id="loading">
        <div id="preloader">
            <img src="/images/q.svg">
            <span>LOADING</span>
        </div>
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
        <br>
        {{--
        <a href='/auth/login/facebook'>Sign in with Facebook</a><br><br>
        <a href='/auth/login/twitter'>Sign in with Twitter</a>
        --}}
    </div>

    {{-- Yield the main page content --}}
    <div id="page">
        @yield('body')
    </div>

    {{-- Include any custom javascript at the end --}}
    <script src="{{ elixir('js/app.js') }}"></script>
</body>
</html>
