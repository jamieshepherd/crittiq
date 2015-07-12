<!DOCTYPE html>
<html>
<head>
    <!-- Title -->
    <title>Inception (2010) - crittiq</title>

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
    @yield('body')
    <script src="/js/app/app.js"></script>
</body>
</html>
