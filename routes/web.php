<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CheckoutController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\Product;

/* |--------------------------------------------------------------------------
| Akses Publik
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('home', [
        'categories' => Category::all(),
        'products' => Product::with('category')->get()
    ]);
})->name('home');

Route::get('/about', function () { return view('about'); })->name('about');

Route::get('/menu', function () {
    $categories = Category::all()->map(function ($cat) {
        $cat->color = match ($cat->name) {
            'Teh Segar' => 'bg-[#D2B48C]',
            'Kopi' => 'bg-amber-800',
            'Smoothies' => 'bg-blue-400',
            'Milk Tea' => 'bg-orange-200',
            'Fruit Juice' => 'bg-yellow-400',
            'Sparkling' => 'bg-cyan-300',
            'Chocolate' => 'bg-rose-700',
            'Signature' => 'bg-brand-emerald',
            default => 'bg-gray-300',
        };
        return $cat;
    });

    $products = Product::with('category')->get()->map(function ($pro) {
        $pro->bgColor = match ($pro->category->name ?? '') {
            'Teh Segar' => 'bg-[#D2B48C]',
            'Kopi' => 'bg-amber-800',
            'Smoothies' => 'bg-blue-400',
            'Milk Tea' => 'bg-orange-200',
            'Fruit Juice' => 'bg-yellow-400',
            'Sparkling' => 'bg-cyan-300',
            'Chocolate' => 'bg-rose-700',
            'Signature' => 'bg-brand-emerald',
            default => 'bg-gray-300',
        };

        return [
            'id' => $pro->id,
            'name' => $pro->name,
            'price' => $pro->price,
            'stock' => $pro->stock,
            'category_id' => $pro->category_id,
            'category_name' => $pro->category->name ?? 'Drink',
            'bgColor' => $pro->bgColor,
            'textColor' => 'text-white'
        ];
    });

    return view('menu', [
        'categories' => $categories,
        'products' => $products
    ]);
})->name('menu');

Route::get('/promo', function () { return view('promo'); })->name('promo');
Route::get('/store', function () { return view('store'); })->name('store');

/* |--------------------------------------------------------------------------
| Akses Terproteksi (Auth + Role)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        if (Auth::user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }
        return view('user.dashboard');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Checkout untuk user
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
    Route::post('/direct-checkout', [CheckoutController::class, 'directStore'])->name('direct.checkout');
});

/* |--------------------------------------------------------------------------
| Dashboard Admin (Session + Role)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\Admin\ProductController::class, 'index'])->name('admin.dashboard');

    Route::post('/products/store', [\App\Http\Controllers\Admin\ProductController::class, 'store'])->name('admin.products.store');
    Route::put('/products/{product}', [\App\Http\Controllers\Admin\ProductController::class, 'update'])->name('admin.products.update');
    Route::delete('/products/delete/{product}', [\App\Http\Controllers\Admin\ProductController::class, 'destroy'])->name('admin.products.delete');
});

// Halaman login admin (opsional, tapi tetap ke /login)
Route::get('/admin/login', function () {
    return redirect()->route('login');
})->name('admin.login');

require __DIR__.'/auth.php';
