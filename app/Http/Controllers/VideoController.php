<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\File;

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
        $val = Validator::make($request->all(), [
            'name' => 'required|string',
            'description' => 'string|nullable',
            'category' => 'string|required|exists:categories,name',
            'add_vid' => [
                'required',
                File::types(['mp4'])->max(512 * 1024)
            ]
        ]);

        if ($val->fails()) {
            return view('add_video', ['errors' => $val->errors()]);
        }

        $path = explode('/', $request->file('add_vid')->store('public/videos'))[2];
        $path = 'storage/videos/'.$path;

        Video::create([
            'user_id' => Auth::id(),
            'category_id' => Category::where('name', $request->category)->first()->id,
            'name' => $request->name,
            'description'=> $request->description ?? null,
            'file' => $path
        ]);

        return view('add_video', ['errors' => 'Success create']);
    }
}
