<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController; 
use App\Http\Controllers\Admin\ProductCrudController;
use App\Http\Controllers\Admin\CategoryCrudController;
use App\Http\Controllers\OrderController; 
use App\Http\Controllers\Admin\OrderController as AdminOrderController; 
use Illuminate\Support\Facades\Auth; 


Route::get('/', function () {
    return view('index');
})->name('index');

Route::get('/map', function () {
    return view('map');
})->name('map');

Route::get('/catalog', [CatalogController::class, 'index'])->name('catalog');
Route::get('/product/{product:slug}', [ProductController::class, 'show'])->name('product.show');

Route::middleware(['web'])->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart');
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add')->middleware('auth'); // Убедитесь, что этот маршрут здесь
    Route::patch('/cart/{itemKey}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/remove/{itemKey}', [CartController::class, 'remove'])->name('cart.remove'); // <-- ДОБАВЛЕНО ЭТО
    Route::get('/cart/count', [CartController::class, 'getCartCount'])->name('cart.count');
});


Route::get('/dashboard', function () {
    if (Auth::check() && Auth::user()->is_admin) {
        return redirect()->route('admin.dashboard'); 
    }
    return view('dashboard'); 
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/profile/orders', [OrderController::class, 'index'])->name('profile.orders.index');
    Route::post('/profile/orders/{order}/cancel', [OrderController::class, 'cancel'])->name('profile.orders.cancel');

    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::post('/checkout', [CartController::class, 'placeOrder'])->name('checkout.placeOrder');
});



Route::middleware(['auth', \App\Http\Middleware\AdminMiddleware::class])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');

    Route::resource('products', ProductCrudController::class);

    Route::resource('categories', CategoryCrudController::class);

    Route::get('/orders', [AdminOrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [AdminOrderController::class, 'show'])->name('orders.show');
    Route::put('/orders/{order}/status', [AdminOrderController::class, 'updateStatus'])->name('orders.updateStatus');
});

require __DIR__.'/auth.php';