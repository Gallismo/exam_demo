    <div class="container">
        <div class="grid-3 grid-gap-4">
            @if($videos->isEmpty())
                <h1>Вы не выкладывали видео</h1>
            @else
                @foreach($videos as $video)
                    <a class="video" href="/view/{{explode('/videos/', $video->file)[1]}}">
                        <video class="vd" width="426" height="240">
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
                        </div>
                    </a>
                @endforeach
            @endif
        </div>
    </div>
