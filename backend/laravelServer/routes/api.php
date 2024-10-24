<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\GenericController;
use App\Http\Controllers\Api\PostController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Route::group(['prefix' => 'auth', 'namespace' => 'App\Http\Controllers\Api'], function () {
//     Route::get('/', 'AuthController@me')->name('me');
//     Route::post('login', 'AuthController@login')->name('login');
//     Route::post('logout', 'AuthController@logout')->name('logout');
// });

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:api')->name('logout');
    //Route::post('/refresh', [AuthController::class, 'refresh'])->middleware('auth:api')->name('refresh');
    Route::post('/me', [AuthController::class, 'me'])->middleware('auth:api')->name('me');

    //Route::get('/helloworld', [HelloworldController::class, 'index']);
});


Route::group([
    //Api for authentication  
    //'middleware' => ['auth:api'],
    //Open For all 
    'middleware' => ['api'],
    'prefix' => 'v1'
], function ($router) {

    Route::get('posts', [PostController::class, 'index']);
    Route::post('posts', [PostController::class, 'store']);
    Route::patch('posts/{id}', [PostController::class, 'update']);
      

    Route::get('{table}', [GenericController::class, 'index']);
    Route::get('{table}/{id}', [GenericController::class, 'show']);
    Route::patch('{table}/{id}', [GenericController::class, 'update']);
    Route::post('{table}', [GenericController::class, 'store']);
});



// Route::middleware('auth:api')->group(function(){
//     Route::get('/helloworld', 'App\Http\Controllers\Api\HelloworldController@index');
//  });
//Route::get('/helloworld', 'App\Http\Controllers\Api\HelloworldController@index');
//Route::get('/helloworld', [HelloworldController::class, 'index']);



Route::get('/helloworld',function(){
    return "Hello World!";
});
