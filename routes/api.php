<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\ProductController;
use Illuminate\Support\Facades\Route;

Route::controller(CategoryController::class)->group(function () {
    Route::post('/categories', 'store');
    Route::get('/categories/menu/{perPage?}', 'menuList');
});

Route::controller(ProductController::class)->group(function () {
    Route::post('/products', 'store');
});

Route::controller(OrderController::class)->group(function () {
    Route::post('/orders', 'store');
    Route::get('/orders/{perPage?}', 'list');
});
