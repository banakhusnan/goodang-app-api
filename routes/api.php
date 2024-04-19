<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Auth\UserUpdateController;
use App\Http\Controllers\Auth\AuthenticatedController;

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
Route::controller(\App\Http\Controllers\ProductController::class)
    // middleware('auth:sanctum')
    ->group(function () {
        Route::get('product', 'index');
        Route::post('product', 'store');
        Route::get('product/{code}', 'show');
        Route::put('product/{code}', 'update');
        Route::delete('product/{code}', 'destroy');
    });

Route::get('/get-categories', [CategoryController::class, 'getCategories']);
