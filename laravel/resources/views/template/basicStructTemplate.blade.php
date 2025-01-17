<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('customFavicon/apple-touch-icon.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('customFavicon/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('customFavicon/favicon-16x16.png')}}">
    <link rel="icon" type="image/x-icon" href="{{asset('customFavicon/favicon.ico')}}">
    <link rel="manifest" href="{{asset('customFavicon/site.webmanifest')}}">
    <link rel="mask-icon" href="{{asset('customFavicon/safari-pinned-tab.svg')}}" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    @yield('title')
    @stack('style')
    <link rel="stylesheet" href="{{asset('styles.css')}}">
</head>
<body>
    @yield('container')
</body>
    @stack('script')
</html>
