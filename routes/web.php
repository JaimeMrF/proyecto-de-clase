<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;

// HOME

Route::get('/', HomeController::class);


// PRODUCT

Route::prefix("product")->controller(ProductController::class)->group(function () {
    Route::get('/',        'index')  ->name('product.index');
    Route::get('/create',  'create') ->name('product.create');
    Route::post('/store',  'store')  ->name('product.store');
    Route::get('/{producto}', 'show')->name('product.show');
    Route::delete("/{product}", 'destroy')->name('product.destroy');
    
});

Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.index');



Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [App\Http\Controllers\AdminController::class, 'index'])->name('index');
    Route::resource('categories', CategoryController::class)->except(['show']);
});



Route::prefix('cart')->name('cart.')->group(function () {
    Route::get('/',              [CartController::class, 'index'])  ->name('index');
    Route::post('/add/{id}',     [CartController::class, 'add'])    ->name('add');
    Route::post('/update/{id}',  [CartController::class, 'update']) ->name('update');
    Route::delete('/remove/{id}',[CartController::class, 'remove']) ->name('remove');
    Route::post('/clear',        [CartController::class, 'clear'])  ->name('clear');
});