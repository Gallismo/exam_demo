<?php

namespace App\Http\Controllers;

use App\Models\User;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use function GuzzleHttp\Promise\all;

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

        User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password'])
        ]);

        return redirect('/congrate');
    }
}
