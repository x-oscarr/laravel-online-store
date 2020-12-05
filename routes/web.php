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
Route::get('cart', [CartController::class, 'index'])->name('cart');
Route::get('checkout', [CheckoutController::class, 'index'])->name('checkout');

Route::get('catalog', [CategoryController::class, 'catalog'])->name('catalog');
Route::get('catalog/{slug}', [CategoryController::class, 'category'])->name('category');
Route::get('product/{slug}', [ProductController::class, 'index'])->name('product');

Route::get('p/{slug}', [StaticPageController::class, 'view'])->name('staticPage');

Route::any('test1', [IndexController::class, 'test'])->name('test');

Route::get('redirect', function (\Symfony\Component\HttpFoundation\Request $request) {
    $request->session()->put('state', $state = Str::random(40));

    $query = http_build_query([
        'client_id' => 'client-id',
        'redirect_uri' => 'http://127.0.0.1:8000/test',
        'response_type' => 'code',
        'scope' => '',
        'state' => $state,
    ]);

    return redirect('http://127.0.0.1:8000/oauth/authorize?'.$query);
});
