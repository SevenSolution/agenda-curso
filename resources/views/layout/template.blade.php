<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{config('app.name')}}</title>
    @stack('css')
</head>
<body>

@yield('content')
@yield('doubts')

    <p>Padronização Laravel: <a href="https://github.com/alexeymezenin/laravel-best-practices#follow-laravel-naming-conventions" target="_blank"> Padronizações </a></p>

@stack('scripts')
</body>
</html>