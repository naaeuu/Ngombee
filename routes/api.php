<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\Api\Admin\ProductController as AdminProductController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// 🔓 Routes Publik (Tidak perlu autentikasi)
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

// 🔒 Routes Terproteksi (Butuh JWT Token)
Route::middleware('auth:api')->group(function () {

    // ✅ Endpoint Umum
    Route::get('/me', [AuthController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'logout']);

    // 👤 User biasa
    Route::prefix('user')->group(function () {
        Route::post('/checkout', [CheckoutController::class, 'store']);
    });

    // ✅ Route eksplisit untuk direct-checkout — pastikan Auth::id() tersedia
    Route::post('/user/direct-checkout', [CheckoutController::class, 'directStore']);

    // 👑 Admin only
    Route::middleware('role.api:admin')->prefix('admin')->group(function () {
        Route::get('/dashboard', [AdminProductController::class, 'index']);
        Route::post('/products', [AdminProductController::class, 'store']);
        Route::put('/products/{product}', [AdminProductController::class, 'update']);
        Route::delete('/products/{product}', [AdminProductController::class, 'destroy']);
    });
});
