<?php

use Illuminate\Support\Facades\Route;

Route::post('register', [\App\Http\Controllers\Auth\UserRegisterController::class, 'register']);
Route::post('login', [\App\Http\Controllers\Auth\AuthenticatedController::class, 'login']);
Route::post('logout', [\App\Http\Controllers\Auth\AuthenticatedController::class, 'logout'])->middleware('auth:sanctum');

Route::middleware('auth:sanctum')
    ->controller(\App\Http\Controllers\ProductController::class)
    ->group(function () {
        Route::get('product', 'index');
        Route::post('product', 'store');
        Route::get('product/{id}', 'show');
        Route::put('product/{id}', 'update');
        Route::delete('product/{id}', 'destroy');
    });
