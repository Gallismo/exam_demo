<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('style.css')}}">
    <title>Document</title>
</head>
<body>
<div class="menu">
    @if(!\Illuminate\Support\Facades\Auth::check())
        <a href="/register">Регистрация</a>
        <a href="/login">Войти</a>
    @else
        <a href="/profile">Личный кабинет/ Мои видео</a>
    @endif
</div>
<div class="container">
    <video class="vd">

    </video>
    <h1 class="vd_name">
        Маша и медведь новые серии
    </h1>
    <div class="dsp_vid">
        <h3 class="data_vid">11:10 01.09.2022</h3>
    </div>

</div>
</body>
</html>
