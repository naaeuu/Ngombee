<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\Admin\ProductController as AdminProductController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// 🔓 Routes Publik
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

// 🔒 Routes Terproteksi (Butuh JWT Token)
Route::middleware('auth:api')->group(function () {

    Route::get('/me', [AuthController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'logout']);

    // 🛡️ Menggunakan alias 'role.api' sesuai yang ada di Kernel.php
    Route::middleware('role.api:admin')->prefix('admin')->group(function () {

        // Dashboard Data
        Route::get('/dashboard', [AdminProductController::class, 'index']);

        // CRUD Produk
        Route::post('/products', [AdminProductController::class, 'store']);
        Route::put('/products/{product}', [AdminProductController::class, 'update']);
        Route::delete('/products/{product}', [AdminProductController::class, 'destroy']);
    });
});
