<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController as Auth;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\AutoController;
use App\Http\Controllers\RateController;
use App\Http\Controllers\OrderController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login',[Auth::class, 'Login']);
Route::post('/register', [Auth::class, 'Register']);

Route::middleware('auth:api')->group( function () {
Route::post('/driver/add', [DriverController::class, 'create']);
Route::post('/driver/delete', [DriverController::class, 'delete']);
Route::post('/driver/update', [DriverController::class, 'update']);
Route::post('/driver/add/auto', [DriverController::class, 'addDriverAuto']);
Route::post('/driver/get', [DriverController::class, 'get']);
Route::post('/auto/add', [AutoController::class, 'create']);
Route::post('/auto/delete', [AutoController::class, 'delete']);
Route::post('/auto/update', [AutoController::class, 'update']);
Route::post('/auto/add/rate', [AutoController::class, 'addRate']);
Route::post('/auto/get', [AutoController::class, 'get']);
Route::post('/rate/add', [RateController::class, 'create']);
Route::post('/rate/delete', [RateController::class, 'delete']);
Route::post('/rate/update', [RateController::class, 'update']);
Route::post('/rate/get', [RateController::class, 'get']);
Route::post('/order/add', [OrderController::class, 'create']);
Route::post('/order/get', [OrderController::class, 'get']);
});
