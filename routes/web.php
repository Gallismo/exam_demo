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
    return view('index');
});
Route::middleware('isAuth')->group(function () {
    Route::get('/profile', function () {
        return view('profile');
    });
});
Route::middleware('isGuest')->group(function () {
    Route::get( '/register',function (){
        return view( 'register');
    });
    Route::get('/login', function () {
        return view('login');
    });
});


Route::get('/logout', [\App\Http\Controllers\userController::class, 'logout']);
Route::post('/web/api/register',[\App\Http\Controllers\userController::class,'register']);
Route::post('/web/api/login',[\App\Http\Controllers\userController::class,'login']);
<<<<<<< HEAD
Route::get('/videos', [\App\Http\Controllers\userController::class,'videos']);
Route::get('/add_video',[\App\Http\Controllers\userController::class,'add_video']);
Route::get('/index',[\App\Http\Controllers\userController::class,'index']);
Route::get('/view_video',[\App\Http\Controllers\userController::class,'view_video']);
Route::get('/admin_panel',[\App\Http\Controllers\userController::class,'admin_panel']);
=======
Route::get('/videos', [\App\Http\Controllers\VideoController::class,'userVideos']);
Route::get('/add_video', function () {
    return view('add_video');
});
Route::post('/add_video', [\App\Http\Controllers\VideoController::class, 'addVideo']);
>>>>>>> aebbe60eb4cfc9b18a976163342b2d3a0847e1a3
