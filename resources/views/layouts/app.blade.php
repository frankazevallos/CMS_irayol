<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="icon" href="{{asset('manager/images/favicon.ico')}}" sizes="16x16 32x32" type="image/ico">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <!-- baseRoute -->
        <meta name="current-route" content="{{ url()->current() }}" />

        <title>@stack('title')</title>

        <!-- Styles -->
        <link rel="stylesheet" href="{{asset('manager/vendor/css/main.css')}}">
        
        @stack('css')
    </head>
    <body class="hold-transition sidebar-mini layout-fixed">
        <div class="wrapper" id="app">
            @include('layouts.partials.navbar')

            <div class="content-wrapper">
                <div class="content-header">
                    <div class="container-fluid">
                        @include('layouts.partials.alert')
                        @yield('content')
                    </div>
                </div>
            </div>
            @include('layouts.partials.select-file-modal')
        </div>

        <!-- Main Footer -->
		<footer class="main-footer">
			<strong>Copyright &copy; <?php echo date("Y"); ?> <a href="http://irayol.com">IRAYOL</a>.</strong>
			{{__('All rights reserved.')}}
			<div class="float-right d-none d-sm-inline-block"><b>Version</b> 1.0.0</div>
		</footer>

        <!-- Javascript -->
        <script src="{{asset('manager/vendor/js/main.js')}}"></script>
        <!-- Javascript -->

        @stack('js')
        <!-- Javascript -->
    </body>
</html>
