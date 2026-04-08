<!DOCTYPE HTML>
<html lang="en">
<head>
    <title>User</title>
    <meta charset="utf-8">
    <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Stylesheet -->
    <link rel="stylesheet" href="{{ asset('user/css/main.css') }}">
</head>
<body>

    @include('layouts.user.navbar')

    @yield('content')

    @include('layouts.user.footer')


    <!-- Scripts -->
    <script src="{{ asset('user/js/jquery.min.js') }}"></script>
    <script src="{{ asset('user/js/jquery.scrolly.min.js') }}"></script>
    <script src="{{ asset('user/js/skel.min.js') }}"></script>
    <script src="{{ asset('user/js/util.js') }}"></script>
    <script src="{{ asset('user/js/main.js') }}"></script>

</body>
</html>
