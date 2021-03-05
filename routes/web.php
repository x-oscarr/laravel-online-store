<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\IndexController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StaticPageController;

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
Route::get('/', [IndexController::class, 'index'])->name('index');

Route::get('favorites', [FavoritesController::class, 'index'])->name('favorites');

// Cart
Route::get('cart', [CartController::class, 'index'])->name('cart');
Route::post('cart/add', [CartController::class, 'add'])->name('cart.add');

Route::get('checkout', [CheckoutController::class, 'index'])->name('checkout');

Route::get('catalog', [CategoryController::class, 'catalog'])->name('catalog');
Route::get('catalog/{slug}', [CategoryController::class, 'category'])->name('category');
Route::get('product/{slug}', [ProductController::class, 'index'])->name('product');

Route::get('p/{slug}', [StaticPageController::class, 'view'])->name('staticPage');

Route::get('/tokens/create', function (\Symfony\Component\HttpFoundation\Request $request) {
    $token = $request->user()->createToken('test3', ['testq']);

    return ['token' => $token->plainTextToken];
});

Route::apiResource('aproduct', \App\Http\Controllers\Api\ProductController::class);

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia\Inertia::render('Dashboard');
})->name('dashboard');
