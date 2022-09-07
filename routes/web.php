<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get( '/register',function (){
    if (\Illuminate\Support\Facades\Auth::check()) {
        return redirect('/profile');
    }
    return view( 'register');
});
Route::get('/login', function () {
    if (\Illuminate\Support\Facades\Auth::check()) {
        return redirect('/profile');
    }
    return view('login');
});
Route::get('/profile', function () {
    if (!\Illuminate\Support\Facades\Auth::check()) {
        return redirect('/login');
    }
    return view('profile');
});
Route::get('/logout', [\App\Http\Controllers\userController::class, 'logout']);
Route::post('/web/api/register',[\App\Http\Controllers\userController::class,'register']);
Route::post('/web/api/login',[\App\Http\Controllers\userController::class,'login']);

