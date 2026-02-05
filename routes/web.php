<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [App\Http\Controllers\WooCommerceController::class, 'index'])->name('products.index');
Route::get('/product/{id}', [App\Http\Controllers\WooCommerceController::class, 'show'])->name('products.show');
Route::get('/orders', [App\Http\Controllers\WooCommerceController::class, 'orders'])->name('orders.index');
Route::get('/orders/{id}', [App\Http\Controllers\WooCommerceController::class, 'showOrder'])->name('orders.show');
