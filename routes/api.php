<?php

use App\Enums\TokenAbility;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedController;
use App\Http\Controllers\Auth\UserUpdateController;

// Authentication
Route::post('register', [\App\Http\Controllers\Auth\UserRegisterController::class, 'register']);
Route::controller(AuthenticatedController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('refresh-token', 'refreshToken');
});
Route::middleware(['auth:sanctum'])
    ->group(function () {
        Route::post('logout', [AuthenticatedController::class, 'logout']);
        Route::put('user/update', [UserUpdateController::class, 'update']);
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
