<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{asset('style.css')}}">
</head>
<body>
<form class="login">
    @csrf
    <p>
        <label for="name">Название:</label>
        <input type="text" name="name" id="name" value="">
    </p>

    <p>
        <label for="description">Описание:</label>
        <input type="text" name="description" id="description_vid" value="">
    </p>
    <p>
        <label for="category">Категория:</label>
        <input type="text" name="category" id="category_vid" value="">
    </p>
    <p>
        <label for="add_vid">Выберите файл:</label>
        <input type="file" name="add_vid" id="add_vid" value="" accept="video/mp4" class="add_vid">
    </p>
    <p>
        <button type="submit" class="button_add_videos add_vid">Добавить видео</button>
    </p>
    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
</form>
</body>
</html>
