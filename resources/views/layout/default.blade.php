<!doctype html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Weibo App') - Laravel新手入门教程</title>
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
</head>
<body>
@include('layout._header')
<div class="container mt-3">
    @yield('content')
    @include('layout._footer')
</div>
<script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
