<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class VideoController extends Controller
{
    public function index(Request $request) {
        return view('videos', ['videos' => Video::all()]);
    }
    public function userVideos(Request $request) {
        $videos = Video::where('user_id', Auth::user()->id)->get();

        return view('my_videos', ['videos' => $videos]);
    }

    public function addVideo(Request $request) {
        $request = $request->all();
        $val = Validator::make($request, [

        ]);
    }
}
