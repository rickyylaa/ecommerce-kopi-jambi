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
<body data-sidebar="dark">
    <div id="layout-wrapper">
        @include('admin.layouts.header')

        <div class="vertical-menu">
            @include('admin.layouts.sidebar')
        </div>

        <div class="main-content">
            @yield('content')
        </div>
    </div>

    @yield('modal')

    @include('sweetalert::alert')
    <div class="rightbar-overlay"></div>

    <script src="{{ asset('dist/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('dist/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('dist/libs/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('dist/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('dist/libs/node-waves/waves.min.js') }}"></script>
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    @yield('js')

    <script src="{{ asset('dist/js/app.js') }}"></script>

    @yield('script')

    <script>
        function markAsReadAndNavigate(notificationId) {
            console.log('Notification ID:', notificationId);

            $.ajax({
                type: 'POST',
                url: '{{ route("mark-as-read") }}',
                data: { id: notificationId },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    console.log('Notification marked as read:', response);
                    window.location.href = '{{ route("order.index") }}';
                },
                error: function(error) {
                    console.error('Error marking notification as read:', error);
                }
            });
        }
    </script>
</body>
</body>
</html>
