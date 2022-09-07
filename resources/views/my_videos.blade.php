<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{asset('style.css')}}">
    <link rel="stylesheet" href="{{asset('grid.css')}}">
</head>
<body>
    <div class="add_video">
        <a href="/add_video" class="button_add_videos">+</a>
        <a href="/logout" class="bt_log">logout</a>
    </div>
    <div class="container">
<<<<<<< HEAD

            <a href="/view_video" class="vd">
                <video class="vd">
                </video>
            </a>

        <h1 class="vd_name">
            Маша и медведь новые серии
        </h1>
        <div class="dsp_vid">
            <h3 class="categories_vid">для детей</h3>
            <h3 class="data_vid">11:10 01.09.2022</h3>
            <h3 class="like_vid">5</h3>
            <h3 class="dislike_vid">2</h3>
            <h3 class="description_vid">Детский мультик созданный для детей с целью просмотра мультика детьми </h3>
=======
        <div class="grid-3 grid-gap-4">
            @if($videos->isEmpty())
                <h1>Вы не выкладывали видео</h1>
            @else
                @foreach($videos as $video)
                    <div class="video">
                        <video class="vd" width="400" height="300" controls="controls">
                            <source src="{{$video->file}}">
                        </video>
                        <h1 class="vd_name">
                            {{$video->name}}
                        </h1>
                        <div class="dsp_vid">
                            <h3 class="categories_vid">{{\App\Models\Category::find($video->category_id)->name}}</h3>
                            <h3 class="data_vid">{{$video->created_at}}</h3>
                            <h3 class="like_vid">Лайки: {{$video->likes}}</h3>
                            <h3 class="dislike_vid">Дизлайки: {{$video->dislikes}}</h3>
                            <h3 class="description_vid">Описание: {{$video->description ?? 'Описание отсутсвует'}}</h3>
>>>>>>> aebbe60eb4cfc9b18a976163342b2d3a0847e1a3

                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</body>
</html>
