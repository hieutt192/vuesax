<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/', function(){
    return view('home');
});

//auth
Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');

});

Route::controller(PostController::class)->group(function(){
    Route::get('post/','index');
    Route::post('post/store/','store');
    Route::get('post/{id}','show');
    Route::put('post/{id}','update');
    Route::delete('post/{id}','destroy');
    // Route::apiResource('post',PostController::class);

});

Route::controller(UserController::class)->group(function () {
    Route::get('user/','index');
    Route::post('user/store/','store');
    Route::get('user/{id}','show');
    Route::put('user/{id}','update');
    Route::delete('user/{id}','destroy');
    // Route::apiResource('user',PostController::class);


});



