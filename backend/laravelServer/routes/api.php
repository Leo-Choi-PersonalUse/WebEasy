<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\PublicHolidays;
use App\Http\Controllers\RedisController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->group(function () {
    // Route::get('{table}', [GenericController::class, 'index']);
    // Route::get('{table}/{id}', [GenericController::class, 'show']);
    // Route::patch('{table}/{id}', [GenericController::class, 'update']);
    // Route::post('{table}', [GenericController::class, 'store']);
    Route::get('/getPublicHolidays', [PublicHolidays::class, 'get']);
    Route::get('/checkRedisConnection', [RedisController::class, 'checkConnection']);
    Route::get('/getKey/{key}', [RedisController::class, 'getKey']);
    Route::get('/deleteKey/{key}', [RedisController::class, 'deleteKey']);
});
