<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class MenuController extends Controller
{
    /**
     * Menampilkan daftar menu utama dengan kategori dan produk.
     */
    public function index()
    {
        $categories = Category::all()->map(function ($cat) {
            $colorMap = [
                1 => 'bg-[#D2B48C]',
                2 => 'bg-amber-800',
                3 => 'bg-blue-400',
                4 => 'bg-orange-200',
                5 => 'bg-yellow-400',
                6 => 'bg-cyan-300',
                7 => 'bg-rose-700',
                8 => 'bg-brand-emerald'
            ];
            $cat->color = $colorMap[$cat->id] ?? 'bg-gray-200';
            return $cat;
        });

        $products = Product::with('category')->get()->map(function ($product) {
            $colorMap = [
                1 => 'bg-[#D2B48C]',
                2 => 'bg-amber-800',
                3 => 'bg-blue-400',
                4 => 'bg-orange-200',
                5 => 'bg-yellow-400',
                6 => 'bg-cyan-300',
                7 => 'bg-rose-700',
                8 => 'bg-brand-emerald'
            ];
            $product->bgColor = $colorMap[$product->category_id] ?? 'bg-gray-200';
            $product->textColor = str_replace('bg-', 'text-', $product->bgColor);
            // Pastikan slug ikut dikirim ke view (untuk link detail)
            $product->slug = $product->slug;
            return $product;
        });

        return view('menu', compact('categories', 'products'));
    }

    /**
     * Menampilkan halaman detail produk berdasarkan slug.
     * Memenuhi kriteria UAP: "identifier unik berupa Slug sebagai parameter dinamis di URL".
     */
    public function show($slug)
    {
        // Cari produk berdasarkan slug (case-insensitive opsional, tapi tidak wajib)
        $product = Product::with('category')
            ->where('slug', $slug)
            ->firstOrFail(); // Otomatis kirim 404 jika tidak ditemukan

        return view('menu-detail', compact('product'));
    }
}
