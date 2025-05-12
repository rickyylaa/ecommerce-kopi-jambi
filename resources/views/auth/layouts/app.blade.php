<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title')</title>

    <link rel="icon" href="{{ asset('assets/images/others/favicon.png') }}" type="image/x-icon" />

    <link rel="stylesheet" href="{{ asset('dist/css/bootstrap.min.css') }}" id="bootstrap-style" type="text/css" />
    <link rel="stylesheet" href="{{ asset('dist/css/icons.min.css') }}" type="text/css" />
    @yield('css')

    <link rel="stylesheet" href="{{ asset('dist/css/app.min.css') }}" id="app-style" type="text/css" />
</head>
<body class="auth-body-bg">
    <div>
        @yield('content')
    </div>

    <div class="rightbar-overlay"></div>

    <script src="{{ asset('dist/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('dist/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('dist/libs/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('dist/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('dist/libs/node-waves/waves.min.js') }}"></script>
    @yield('js')

    <script src="{{ asset('dist/js/app.js') }}"></script>

    @yield('script')
</body>
</html>
