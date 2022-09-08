<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class userController extends Controller
{

    public function register(Request $request) {
        $request=$request->all();
        $val = Validator::make($request, [
            'name' => 'required|string|max:255|unique:users',
            'email' => 'required|string|max:255|unique:users|email',
            'password' => ['required', 'string', Password::min(6)->letters()->mixedCase()->numbers()->symbols(), 'max:255'],
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

        return redirect('/');
    }

    public function login(Request $request) {
        $request=$request->all();
        $val = Validator::make($request, [
            'name' => 'required|string|max:255|exists:users,name',
            'password' => 'required|string'
        ]);

        if ($val->fails()) {
            return response()->json($val->errors(), 422);
        }

        $user = User::where('name', $request['name'])->first();

        if (Hash::check($request['password'], $user->password)) {
            Auth::login($user);
            return redirect('/');
        }

        return response('Invalid login or password', 422);
    }

    public function logout(Request $request) {
        if (Auth::check()) {
            Auth::logout();
        }

        return redirect('/');
    }


    public function admin_panel(Request $request){
        return view('index', ['view' => 'admin_panel']);
    }

}
