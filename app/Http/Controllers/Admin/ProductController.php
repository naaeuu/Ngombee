<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->get();
        $categories = \App\Models\Category::all();

        $totalStock = $products->sum('stock');
        $outOfStock = $products->where('stock', 0)->count();

        return view('admin.dashboard', compact('products', 'categories', 'totalStock', 'outOfStock'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|integer|min:1000',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id'
        ]);

        Product::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'price' => $request->price,
            'stock' => $request->stock,
            'category_id' => $request->category_id
        ]);

        return redirect()->back()->with('success', 'Produk berhasil ditambahkan!');
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|integer|min:1000',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id'
        ]);

        $product->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'price' => $request->price,
            'stock' => $request->stock,
            'category_id' => $request->category_id
        ]);

        return redirect()->back()->with('success', 'Produk berhasil diperbarui!');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->back()->with('success', 'Produk berhasil dihapus!');
    }
}
