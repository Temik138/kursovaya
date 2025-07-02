<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Admin\ProductCrudController;
use App\Http\Controllers\Admin\CategoryCrudController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\OrderController;

Route::get('/', function () {
    return view('index');
})->name('index');

Route::get('/map', function () {
    return view('map');
})->name('map');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/profile/orders', [OrderController::class, 'index'])->name('profile.orders.index');
    Route::post('/checkout', [CartController::class, 'placeOrder'])->name('checkout.placeOrder');
});

Route::middleware(['web'])->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart');
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add')->middleware('auth');
    Route::patch('/cart/{itemKey}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/remove/{itemKey}', [CartController::class, 'remove'])->name('cart.remove');
    Route::get('/cart/count', [CartController::class, 'getCartCount'])->name('cart.count');
});

Route::get('/catalog', [CatalogController::class, 'index'])->name('catalog');
Route::get('/product/{product:slug}', [ProductController::class, 'show'])->name('product.show');

Route::middleware(['auth', \App\Http\Middleware\AdminMiddleware::class])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::resource('products', ProductCrudController::class);
    Route::resource('categories', CategoryCrudController::class);
});

require __DIR__.'/auth.php';