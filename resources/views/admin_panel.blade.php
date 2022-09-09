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
                        <h3 class="categories_vid">{{\App\Models\Category::find($video->category_id)->name}}</h3>
                        <h3 class="data_vid">{{$video->created_at}}</h3>
                        <h3 class="like_vid">Лайки: {{$video->likes}}</h3>
                        <h3 class="dislike_vid">Дизлайки: {{$video->dislikes}}</h3>
                        <h3 class="description_vid">Описание: {{$video->description ?? 'Описание отсутсвует'}}</h3>
                        <h3 class="description_vid">Ограничения: {{['Нет ограничений', 'Нарушение', 'Теневой бан', 'Бан'][$video->ban_status]}}</h3>
                    </div>
                    <div class="buttons">
                        @if($video->ban_status !== 0)
                            <form method="post" action="/web/api/ban">
                                @csrf
                                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                <input type="hidden" name="video_id" value="{{ $video->id }}" />
                                <input type="hidden" name="ban" value="0" />
                                <p>
                                    <button type="submit">Снять ограничения</button>
                                </p>
                            </form>
                        @endif
                        @if($video->ban_status === 0)
                            <form method="post" action="/web/api/ban">
                                @csrf
                                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                <input type="hidden" name="video_id" value="{{ $video->id }}" />
                                <input type="hidden" name="ban" value="1" />
                                <p>
                                    <button type="submit">Нарушение</button>
                                </p>
                            </form>
                            <form method="post" action="/web/api/ban">
                                @csrf
                                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                <input type="hidden" name="video_id" value="{{ $video->id }}" />
                                <input type="hidden" name="ban" value="2" />
                                <p>
                                    <button type="submit">Теневой бан</button>
                                </p>
                            </form>
                            <form method="post" action="/web/api/ban">
                                @csrf
                                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                <input type="hidden" name="video_id" value="{{ $video->id }}" />
                                <input type="hidden" name="ban" value="3" />
                                <p>
                                    <button type="submit">Бан</button>
                                </p>
                            </form>
                        @endif
                    </div>
                </a>
            @endforeach
        @endif
    </div>
</div>
