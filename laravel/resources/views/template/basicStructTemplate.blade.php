<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @yield('title')
    @stack('style')
    <link rel="stylesheet" href="{{asset('styles.css')}}">
</head>
<body>
    @yield('container')
</body>
    @stack('script')
</html>
