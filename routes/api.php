<?php

use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\WishlistController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\SliderController;

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

Route::group(['middleware' => 'auth:sanctum', /*'domain' => 'api.'.env('APP_DOMAIN')*/], function () {
    Route::apiResource('category', CategoryController::class);
    Route::apiResource('product', ProductController::class);
    Route::apiResource('order', OrderController::class);
    Route::apiResource('user', UserController::class);
    Route::apiResource('slider', SliderController::class);

    Route::group(['prefix' => 'cart'], function () {
        Route::get('/', [CartController::class, 'index']);
        Route::delete('/', [CartController::class, 'destroy']);
        Route::put('/item', [CartController::class, 'updateItem']);
        Route::put('/item/quantity', [CartController::class, 'updateQuantity']);
    });
    Route::group(['prefix' => 'wishlist'], function () {
        Route::get('/', [WishlistController::class, 'index']);
        Route::delete('/', [WishlistController::class, 'destroy']);
        Route::post('/item', [WishlistController::class, 'updateItem']);
        Route::put('/item', [WishlistController::class, 'updateQuantity']);
        Route::delete('/item', [WishlistController::class, 'deleteItem']);
    });
});


