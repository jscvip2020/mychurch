<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png')}}">
    <link rel="shortcut icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png')}}">
    <link rel="manifest" href="{{ asset('site.webmanifest')}}">

    <title>{{ config('app.name', 'Laravel') }} @yield('titulo')</title>

    @include('layouts.__css')
</head>
<body>

<div id="app">
    {{--@include('layouts.__navSuperior')--}}

    <main class="py-4">
        @yield('content')
    </main>
</div>

@include('layouts.__js')

</body>
</html>
