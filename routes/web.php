<?php

use Illuminate\Support\Facades\Route;
use App\Models\Category;
use App\Models\Product;

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

// Menu — tetap tampilkan stok & SOLD OUT
Route::get('/menu', function () {
    $categories = Category::all()->map(fn($cat) => [
        'id' => $cat->id,
        'name' => $cat->name,
        'color' => match ($cat->name) {
            'Teh Segar' => 'bg-[#D2B48C]',
            'Kopi' => 'bg-amber-800',
            'Smoothies' => 'bg-blue-400',
            'Milk Tea' => 'bg-orange-200',
            'Fruit Juice' => 'bg-yellow-400',
            'Sparkling' => 'bg-cyan-300',
            'Chocolate' => 'bg-rose-700',
            'Signature' => 'bg-brand-emerald',
            default => 'bg-gray-300',
        }
    ]);

    $products = Product::with('category')->get()->map(fn($pro) => [
        'id' => $pro->id,
        'name' => $pro->name,
        'price' => $pro->price,
        'stock' => $pro->stock,
        'category_id' => $pro->category_id,
        'category_name' => $pro->category?->name ?? 'Drink',
        'bgColor' => match ($pro->category?->name ?? '') {
            'Teh Segar' => 'bg-[#D2B48C]',
            'Kopi' => 'bg-amber-800',
            'Smoothies' => 'bg-blue-400',
            'Milk Tea' => 'bg-orange-200',
            'Fruit Juice' => 'bg-yellow-400',
            'Sparkling' => 'bg-cyan-300',
            'Chocolate' => 'bg-rose-700',
            'Signature' => 'bg-brand-emerald',
            default => 'bg-gray-300',
        }
    ]);

    return view('menu', compact('categories', 'products'));
})->name('menu');

// Halaman login (form UI saja)
Route::get('/login', fn () => view('auth.login'))->name('login');
Route::get('/register', fn () => view('auth.register'))->name('register');

// Halaman dashboard admin (UI saja — data dari API)
Route::get('/admin/dashboard', fn () => view('admin.dashboard'))->name('admin.dashboard');

// Halaman user dashboard
Route::get('/dashboard', fn () => view('user.dashboard'))->name('dashboard');

// Halaman checkout
Route::get('/checkout', fn () => view('checkout'))->name('checkout');

require __DIR__.'/auth.php';
