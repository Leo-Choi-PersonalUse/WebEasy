<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\HelloworldController;

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
    // Route::get('/', 'AuthController@me')->name('me');
    // Route::post('login', 'AuthController@login')->name('login');
    // Route::post('logout', 'AuthController@logout')->name('logout');
    //Route::post('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:api')->name('logout');
    //Route::post('/refresh', [AuthController::class, 'refresh'])->middleware('auth:api')->name('refresh');
    Route::post('/me', [AuthController::class, 'me'])->middleware('auth:api')->name('me');

    //Route::get('/helloworld', [HelloworldController::class, 'index']);
});

// Route::middleware('auth:api')->group(function(){
//     Route::get('/helloworld', 'App\Http\Controllers\Api\HelloworldController@index');
//  });
 //Route::get('/helloworld', 'App\Http\Controllers\Api\HelloworldController@index');
 //Route::get('/helloworld', [HelloworldController::class, 'index']);
