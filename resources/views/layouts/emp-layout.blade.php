<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ mix('js/app.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/client.css') }}" rel="stylesheet">

    {{-- Pusher --}}
    {{-- <script src="https://js.pusher.com/8.0.1/pusher.min.js"></script> --}}
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>

</head>

<body>
    <!-- Nav part -->
    <nav class="py-0 shadow-sm navbar navbar-expand-md navbar-light" style="background-color: #0d8517;">
        <div class="container">
            <a class="mx-auto navbar-brand d-block">
                <img src="{{ asset('assets/header.png') }}" alt="Header" class="img-fluid" style="max-height: 90px;">
            </a>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>
</body>

</html>
