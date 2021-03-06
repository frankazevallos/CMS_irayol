<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="@stack('keywordseo')">
    <meta name="description" content="@stack('descseo')">
    <meta name="author" content="@stack('author')">
    <meta name="title" content="@stack('titleseo')">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>@stack('title', setting('site_name'))</title>


    <link href="{{ asset('themes/' . setting('theme_active') . '/css/default.css') }}" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{ asset('themes/' . setting('theme_active') . '/css/landing-page.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('manager/css/themes.css')}}">

    <!-- Custom Fonts -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"/>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body class="d-flex flex-column" style="min-height: 100vh">
    <main class="flex-fill">
        @include('partials.navbar')
        @yield('content')
    </main>
    @include('partials.footer')

    <!-- Javascript -->
    <script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
    <script src="{{ asset('themes/' . setting('theme_active') . '/js/app.js') }}"></script>
    <script src="{{ asset('themes/' . setting('theme_active') . '/js/custom.js') }}" type="text/javascript"></script>
    @stack('js')
</body>

</html>
