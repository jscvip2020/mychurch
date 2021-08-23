<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset('favicon.png') }}">

    <title>{{ config('app.name', 'Laravel') }} @yield('titulo')</title>

    @include('layouts.__cssfront')
</head>
<body>
<div class="container-fluid">
    @include('layouts.__topFront')
</div>
<div class="container-fluid bg-faded fh5co_padd_mediya padding_786">
    <div class="container padding_786">
        @include('layouts.__menuFront')
    </div>
</div>

@yield('content')


@include('layouts.__js')
<div class="gototop js-top">
    <a href="#" class="js-gotop"><i class="fa fa-arrow-up"></i></a>
</div>
</body>
</html>
