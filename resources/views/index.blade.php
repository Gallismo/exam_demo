<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('style.css')}}">
    <link rel="stylesheet" href="{{asset('grid.css')}}">
    <title>Document</title>
</head>
<body>
    <div class="menu" style="margin-bottom: 50px">
        <a href="/">Главная</a>
        @if(!\Illuminate\Support\Facades\Auth::check())
            <a href="/register">Регистрация</a>
            <a href="/login">Войти</a>
        @else
            <a href="/videos">Мои видео</a>
            <a href="/add_video" class="button_add_videos">Добавить видео</a>
            <a href="/logout" class="bt_log" style="float: right; margin-right: 10px">Выход</a>
            @if(\Illuminate\Support\Facades\Auth::user()->role === 1)
                <a href="/admin" class="button_add_videos">Админ панель</a>
            @endif
            <h1 style="float: right; margin-right: 100px; font-size: 20px">{{\Illuminate\Support\Facades\Auth::user()->name}}</h1>
        @endif
    </div>
    @include($view);
</body>
</html>
