<div class="container">
    <div class="grid-3 grid-gap-4">
        @if($videos->isEmpty())
            <h1>Нет видео</h1>
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
                        <h3 class="data_vid">{{$video->created_at}}</h3>
                    </div>
                </a>
            @endforeach
        @endif
    </div>
</div>
