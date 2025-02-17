<?php

// use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;

Route::post('login', [AuthController::class, 'login'])->name('login');
Route::post('logout', [AuthController::class, 'logout']);

Route::middleware('auth:sanctum')->group( function () {
    Route::prefix('users')->group(function () {
        Route::get('/', [UserController::class, 'index']);
        Route::post('/', [UserController::class, 'store']);
        Route::get('{user}', [UserController::class, 'show']);
        Route::put('{user}', [UserController::class, 'update']);
        Route::delete('{user}', [UserController::class, 'destroy']);
    });
});

Route::middleware('auth:sanctum')->group( function () {
    Route::prefix('categories')->group(function () {
        Route::get('/', [CategoryController::class, 'index']);
        Route::post('/', [CategoryController::class, 'store']);
        Route::get('{category}', [CategoryController::class, 'show']);
        Route::get('products/by-category/{categoryId}', [CategoryController::class, 'getProductsByCategory']);
        Route::put('{category}', [CategoryController::class, 'update']);
        Route::delete('{category}', [CategoryController::class, 'destroy']);
    });
});

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/products', [ProductController::class, 'store']);
    Route::get('/products', [ProductController::class, 'index']);
    Route::get('/products/{id}', [ProductController::class, 'show']);
    Route::put('/products/{id}', [ProductController::class, 'update']);
    Route::delete('/products/{id}', [ProductController::class, 'destroy']);
});

