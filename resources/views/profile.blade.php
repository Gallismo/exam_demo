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
    <header>
        <h1 class="h1 jb">
            ТУТ ДОЛЖНО БЫТЬ ВАшЕ ИМЯ
            <div class="bt_st">
                <a href="/videos"  class="bt_log">Мои видео</a>
                <a href="/logout" class="bt_log">logout</a>
            </div>
        </h1>
    </header>
    <section>
        <h1 class="h1">your profile
            {!! \Illuminate\Support\Facades\Auth::user() !!}

            <button class="button_add_videos" id="" type="button">
                ДОБАВИТЬ ВИДЕО
            </button></h1>
    </section>
</body>
</html>
