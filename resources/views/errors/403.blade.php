<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }} - 403</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style>
        body{
            background-color: #1a202c;
            color: #95999c;
        }
        .caixa {
            width: 100%;
            height: 90vh;
            align-items: center;
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
            justify-content: center;
        }
        .erro{
            width: 200px;
            align-items: center;
            justify-content: flex-end;
            display: flex;
            border-right: 1px solid;
            padding-right: 10px;
        }
        .desc-erro{
            font-size: 1.3rem;
            width: 400px;
            align-items: center;
            justify-content: center;
            display: flex;
            padding-left: 10px;
            flex-direction: column;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row">
                <div class="caixa">
                    <div class="d-flex">
                    <div class="erro" style="font-size: 5rem;">403</div>
                    <div class="desc-erro">
                        <p>{{ __($exception->getMessage()) }}</p>
                        <a class="d-block btn btn-dark" href="{{route('dashboard')}}">Retornar</a>
                    </div>
                    </div>
                </div>
    </div>
</div>
</body>
</html>

