<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;


// HOME

Route::get('/', HomeController::class);


// PRODUCT

Route::prefix("product")->controller(ProductController::class)->group(function () {
    Route::get('/',        'index')  ->name('product.index');
    Route::get('/create',  'create') ->name('product.create');
    Route::post('/store',  'store')  ->name('product.store');
    Route::get('/{producto}', 'show')->name('product.show');
});

