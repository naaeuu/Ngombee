<?php

use Illuminate\Support\Facades\Route;
use App\Models\Category;
use App\Models\Product;
use App\Http\Controllers\MenuController;

// Semua halaman publik — tidak ada proteksi session
Route::get('/', function () {
    return view('home', [
        'categories' => Category::all(),
        'products' => Product::with('category')->get()
    ]);
})->name('home');
Route::get('/about', fn () => view('about'))->name('about');
Route::get('/promo', fn () => view('promo'))->name('promo');
Route::get('/store', fn () => view('store'))->name('store');

Route::get('/menu', [MenuController::class, 'index'])->name('menu');

Route::get('/menu/{slug}', [MenuController::class, 'show'])->name('menu.detail');

// Halaman login
Route::get('/login', fn () => view('auth.login'))->name('login');
Route::get('/register', fn () => view('auth.register'))->name('register');

// Halaman dashboard admin 
Route::get('/admin/dashboard', fn () => view('admin.dashboard'))->name('admin.dashboard');

// Halaman user dashboard
Route::get('/dashboard', fn () => view('user.dashboard'))->name('dashboard');

// Halaman checkout
Route::get('/checkout', fn () => view('checkout'))->name('checkout');

require __DIR__.'/auth.php';
