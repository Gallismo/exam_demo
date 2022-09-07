<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class userController extends Controller
{

    public function register(Request $request) {
        $request=$request->all();
        $val = Validator::make($request, [
            'name' => 'required|string|max:255|unique:users',
            'email' => 'required|string|max:255|unique:users|email',
            'password' => 'required|string|max:255|min:6|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/',
            'password_repeat' => 'required|string|max:255|same:password',
        ]);

        if ($val->fails()) {
            return response()->json($val->errors(), 422);
        }

        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password'])
        ]);

        Auth::login($user);

        return redirect('/profile');
    }

    public function login(Request $request) {
        $request=$request->all();
        $val = Validator::make($request, [
            'name' => 'required|string|max:255|exists:users,name',
            'password' => 'required|string|max:255|min:6|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/'
        ]);

        if ($val->fails()) {
            return response()->json($val->errors(), 422);
        }

        $user = User::where('name', $request['name'])->first();

        if (Hash::check($request['password'], $user->password)) {
            Auth::login($user);
            return redirect('/profile');
        }

        return response('Invalid login or password', 422);
    }

    public function logout(Request $request) {
        if (Auth::check()) {
            Auth::logout();
        }

        return redirect('login');
    }
    public function videos(Request $request) {
        return view('my_videos');
    }
    public function add_video(Request $request) {
        return view('add_video');
    }
}
