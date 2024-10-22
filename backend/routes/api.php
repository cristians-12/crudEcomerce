<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::controller(UserController::class)->group(function(){
    Route::get('/users', 'index');
    Route::post('/users', 'store');
    Route::post('/users/login', 'login');
});

Route::controller(ProductController::class)->group(function(){
    Route::get('/products', 'index');
    Route::post('/products', 'store');
    Route::put('/products/{id}', 'update');
    Route::delete('/products/{id}', 'destroy');
});