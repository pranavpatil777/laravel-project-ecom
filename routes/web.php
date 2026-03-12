<?php

use App\Http\Controllers\Customer\CartController;
use App\Http\Controllers\Customer\CheckoutController;
use App\Http\Controllers\Customer\ProductCatalogController;
use App\Http\Controllers\Customer\WishlistController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ProductCatalogController::class, 'index'])->name('catalog.index');
Route::get('/products/{slug}', [ProductCatalogController::class, 'show'])->name('catalog.show');

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart', [CartController::class, 'store'])->name('cart.store');
Route::delete('/cart/{rowId}', [CartController::class, 'destroy'])->name('cart.destroy');

Route::middleware('auth')->group(function (): void {
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'pay'])->name('checkout.pay');
    Route::get('/orders/{order}/track', [CheckoutController::class, 'track'])->name('orders.track');

    Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
    Route::post('/wishlist/{product}', [WishlistController::class, 'store'])->name('wishlist.store');
});

require __DIR__.'/auth.php';
