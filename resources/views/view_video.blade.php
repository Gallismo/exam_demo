<div class="container">
    <video class="vd" width="426" height="240" controls="controls">
        <source src="{{$video->file}}">
    </video>
    <h1 class="vd_name">
        {{$video->name}}
    </h1>
    <div class="dsp_vid">
        <h3 class="description_vid">{{$video->description ?? 'Описание отсутсвует'}}</h3>
        <div class="likes">
            <h3 class="like_vid">{{$video->likes}} лайков</h3>
            <form method="post" action="/web/api/likes">
                @csrf
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <input type="hidden" name="video_id" value="{{ $video->id }}" />
                <input type="hidden" name="action" value="like" />
                <p>
                    <button type="submit">Like</button>
                </p>
            </form>
        </div>
        <div class="likes">
            <h3 class="dislike_vid">{{$video->dislikes}} дизлайков</h3>
            <form method="post" action="/web/api/likes">
                @csrf
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <input type="hidden" name="video_id" value="{{ $video->id }}" />
                <input type="hidden" name="action" value="dislike" />
                <p>
                    <button type="submit">Dislike</button>
                </p>
            </form>
        </div>
        <h3 class="data_vid">{{$video->created_at}}</h3>
        <div>
            <form method="post" action="/web/api/comment">
                @csrf
                <label for="comments_vid" class="comments_h">Ком-рий:</label>
                <input type="text" name="comment" id="comments_vid" value="">
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <input type="hidden" name="video_id" value="{{ $video->id }}" />
                <button type="submit">Опубликовать</button>
            </form>
            <hr>
            @if($comments->isEmpty())
                Комментариев нет
            @else
                @foreach($comments as $comment)
                    <div class="comment">
                        <h3>{{\App\Models\User::find($comment->user_id)->name}}</h3>
                        <h4>{{$comment->created_at}}</h4>
                        <div>
                            <h3>{{$comment->text}}</h3>
                        </div>
                    </div>
                    <hr>
                @endforeach
            @endif
        </div>
    </div>
</div>
