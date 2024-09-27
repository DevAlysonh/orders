<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ProductController;
use Illuminate\Support\Facades\Route;

Route::controller(CategoryController::class)->group(function () {
    Route::post('/categories', 'store');
});

Route::controller(ProductController::class)->group(function () {
    Route::post('/products', 'store');
});
