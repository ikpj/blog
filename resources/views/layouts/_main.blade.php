<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ \Illuminate\Support\Facades\Config::get('app.name') }} - @yield('title')</title>
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />

    @include('layouts._css')
    @yield('css')
</head>
<body>

@include('layouts._navbar')

@yield('content')

@include('layouts._footer')

@include('layouts._js')
@yield('js')
</body>
</html>
