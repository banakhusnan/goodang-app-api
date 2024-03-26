<?php

use App\Enums\TokenAbility;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedController;

// Authentication
Route::post('register', [\App\Http\Controllers\Auth\UserRegisterController::class, 'register']);
Route::post('login', [AuthenticatedController::class, 'login']);
Route::post('refresh-token', [AuthenticatedController::class, 'refreshToken']);
Route::middleware(['auth:sanctum'])
    ->controller(AuthenticatedController::class)
    ->group(function () {
        Route::post('logout', 'logout');
    });

// Product
Route::middleware('auth:sanctum')
    ->controller(\App\Http\Controllers\ProductController::class)
    ->group(function () {
        Route::get('product', 'index');
        Route::post('product', 'store');
        Route::get('product/{id}', 'show');
        Route::put('product/{id}', 'update');
        Route::delete('product/{id}', 'destroy');
    });
