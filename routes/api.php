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

Route::post('/login',[Auth::class, 'Login']); //name, email, password, password_confirm
Route::post('/register', [Auth::class, 'Register']); //email, password

Route::middleware('auth:api')->group( function () {
Route::post('/driver/add', [DriverController::class, 'create']); //name, birthday, cart_num, cart_data
Route::post('/driver/delete', [DriverController::class, 'delete']); // id
Route::post('/driver/update', [DriverController::class, 'update']); // id и что нужно поменять (name, birthday, cart_num, cart_data)
Route::post('/driver/add/auto', [DriverController::class, 'addDriverAuto']); //auto_id, driver_id
Route::post('/driver/get', [DriverController::class, 'get']); //id если одного, ничего если всех
Route::post('/auto/add', [AutoController::class, 'create']); //mark, model, reg_num, color,year
Route::post('/auto/delete', [AutoController::class, 'delete']); //id
Route::post('/auto/update', [AutoController::class, 'update']);//id и что нужно поменять (mark, model, reg_num, color,year)
Route::post('/auto/add/rate', [AutoController::class, 'addRate']);// привязка тарифа к авто (auto_id, rate_id)
Route::post('/auto/get', [AutoController::class, 'get']); //возвращает все авто
Route::post('/rate/add', [RateController::class, 'create']); //name, min_price, km_price, minut_price, free_km, free_min
Route::post('/rate/delete', [RateController::class, 'delete']); //id
Route::post('/rate/update', [RateController::class, 'update']);//id и что нужно поменять(min_price, km_price, minut_price, free_km, free_min)
Route::post('/rate/get', [RateController::class, 'get']); //возвращает все тарифы
Route::post('/order/add', [OrderController::class, 'create']);//from_adr, to_adr, from_coord, to_coord
Route::post('/order/get', [OrderController::class, 'get']);//возвращает заказы авторизованного пользователя
});
