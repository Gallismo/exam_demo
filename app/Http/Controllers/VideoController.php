<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\File;

class VideoController extends Controller
{
    public function index(Request $request) {
        return view('index', ['videos' => Video::where('ban_status', 0)->limit(10)->get(), 'view' => 'main']);
    }
    public function userVideos(Request $request) {
        $videos = DB::table('videos')->select('*', DB::raw('(likes + dislikes) as sum_likes'))
            ->where('user_id', Auth::id())->whereIn('ban_status', [0,1,2])
            ->orderBy('sum_likes', 'desc')->get();
//        $videos = Video::where('user_id', Auth::id())->whereIn('ban_status', [0,1,2])->get();

        return view('index', ['videos' => $videos, 'view' => 'my_videos']);
    }

    public function addVideo(Request $request) {
        $val = Validator::make($request->all(), [
            'name' => 'required|string|unique:videos,name',
            'description' => 'string|nullable',
            'category' => 'integer|required|exists:categories,id',
            'add_vid' => [
                'required',
                File::types(['mp4'])->max(512 * 1024)
            ]
        ]);

        if ($val->fails()) {
            return view('index', ['errors' => $val->errors(), 'view' => 'add_video']);
        }

        $path = explode('/', $request->file('add_vid')->store('public/videos'))[2];
        $path = '/storage/videos/'.$path;

        Video::create([
            'user_id' => Auth::id(),
            'category_id' => $request->category,
            'name' => $request->name,
            'description'=> $request->description ?? null,
            'file' => $path
        ]);

        return redirect('/videos');
    }

    public function view(Request $request, $file) {
        $video = Video::where('file', '/storage/videos/'.$file)->first();

        if (($video->ban_status === 1 || $video->ban_status === 3) || is_null($video)) {
            return abort(404);
        }

        $comments = Comment::where('video_id', $video->id)->get();

        return view('index', ['video' => $video, 'view' => 'view_video', 'comments' => $comments]);
    }

    public function comment(Request $request) {
        $val = Validator::make($request->all(), [
            'video_id' => 'integer|exists:videos,id|required',
            'comment' => 'string|required'
        ]);

        if ($val->fails()) {
            return abort(422, $val->errors());
        }

        Comment::create([
            'user_id' => Auth::id(),
            'video_id' => $request->video_id,
            'text' => $request->comment
        ]);

        return back();
    }
    public function likes(Request $request) {
        $val = Validator::make($request->all(), [
            'video_id' => 'integer|exists:videos,id|required',
            'action' => 'string|required',
        ]);

        if ($val->fails()) {
            return abort(422, $val->errors());
        }

        $video = Video::find($request->video_id);
        if ($request->action === 'like') {
            $video->likes++;
        }

        if ($request->action === 'dislike') {
            $video->dislikes++;
        }

        $video->save();

        return back();
    }

    public function ban(Request $request) {
        $val = Validator::make($request->all(), [
            'video_id' => 'integer|exists:videos,id|required',
            'ban' => 'integer|required',
        ]);

        if ($val->fails()) {
            return abort(422, $val->errors());
        }

        $video = Video::find($request->video_id);
        $video->ban_status = $request->ban;

        $video->save();

        return back();
    }
}
