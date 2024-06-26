<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Payment\PaymentController;
use App\Http\Controllers\User\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::POST('payment', [PaymentController::class, 'payment']);

Route::middleware('auth:api')->group(function () {
    Route::group(['prefix' => 'auth'], function () {
        Route::post('login', [AuthController::class, 'login'])->withoutMiddleware('auth:api');
        Route::post('register', [AuthController::class, 'register'])->withoutMiddleware('auth:api');
    });
    Route::group(['prefix' => 'user'], function () {
        Route::get('list', [UserController::class, 'index']);
        Route::post('create', [UserController::class, 'store']);
        Route::put('update/{id}', [UserController::class, 'update'])->middleware('checkRole');
        Route::delete('delete/{id}', [UserController::class, 'delete']);
    });
});
