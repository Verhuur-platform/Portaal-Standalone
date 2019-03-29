
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta name="author" content="{{ config('app.name') }}">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name') }} - Verhuurportaal </title>

        {{-- Fonts --}}
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

        {{-- Styles --}}
        <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
        <link rel="shortcut icon" type="image/png" href="{{ asset('favicon.ico') }}">
    </head>
    <body class="my-login-page">
        <div id="app">
            @yield('content') {{-- Page content --}}
        </div>

        {{-- Javascript --}}
        <script src="{{ asset('js/auth.js') }}"></script>
    </body>
</html>