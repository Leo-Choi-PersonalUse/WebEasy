<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\PublicHolidays;
use App\Http\Controllers\RedisController;
use App\Http\Controllers\MysqlController;

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

Route::prefix('v1/test/redis')->group(function () {
    Route::get('/checkConnection', [RedisController::class, 'checkConnection']);
    Route::get('/getKey/{key}', [RedisController::class, 'getKey']);
    Route::get('/deleteKey/{key}', [RedisController::class, 'deleteKey']);
});

Route::prefix('v1/test/mysql')->group(function () {
    Route::get('/checkConnection', [MysqlController::class, 'checkConnection']);
});
