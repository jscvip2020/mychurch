<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset('favicon.png') }}">

    <title>{{ config('app.name', 'Laravel') }} @yield('titulo')</title>

    @include('layouts.__css')

</head>
<body>
<div id="appMaster">
    <div class="page-wrapper toggled default-theme bg1">
        @include('layouts.__sidebar')

        <main class="page-content py-2">
            @yield('content')
        </main>
    </div>
</div>

@include('layouts.__js')

</body>
</html>
