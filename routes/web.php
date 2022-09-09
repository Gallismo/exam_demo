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


Route::middleware('isAuth')->group(function () {
    Route::get('/videos', [\App\Http\Controllers\VideoController::class,'userVideos']);
    Route::get('/logout', [\App\Http\Controllers\userController::class, 'logout']);
    Route::get('/add_video', function () {
        return view('index', ['view' => 'add_video', 'categories' => \App\Models\Category::all()]);
    });
    Route::post('/add_video', [\App\Http\Controllers\VideoController::class, 'addVideo']);
    Route::post('/web/api/comment',[\App\Http\Controllers\VideoController::class,'comment']);
    Route::post('/web/api/likes',[\App\Http\Controllers\VideoController::class,'likes']);
});
Route::middleware('isGuest')->group(function () {
    Route::get( '/register',function (){
        return view( 'index', ['view' => 'register']);
    });
    Route::get('/login', function () {
        return view('index', ['view' => 'login']);
    });
});
Route::middleware('isAdmin')->group(function () {
    Route::get('/admin',[\App\Http\Controllers\userController::class,'admin_panel']);
    Route::post('/web/api/ban',[\App\Http\Controllers\VideoController::class,'ban']);
});

Route::get('/', [\App\Http\Controllers\VideoController::class, 'index']);
Route::post('/web/api/register',[\App\Http\Controllers\userController::class,'register']);
Route::post('/web/api/login',[\App\Http\Controllers\userController::class,'login']);
Route::get('/view/{file}',[\App\Http\Controllers\VideoController::class,'view']);
