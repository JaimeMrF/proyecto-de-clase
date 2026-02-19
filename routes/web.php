<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;


// HOME

Route::get('/', HomeController::class);

// PRODUCT 

Route::get('/product', [ProductController::class, "index"]);

Route::get('/product', [ProductController::class, "create"]);

Route::get('/product/{producto}', [ProductController::class, "show"]);


