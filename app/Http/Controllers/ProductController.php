<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|integer|min:1000',
            'category_id' => 'required|exists:categories,id'
        ]);

        Product::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'price' => $request->price,
            'category_id' => $request->category_id
        ]);

        return redirect()->back()->with('success', 'Produk berhasil ditambahkan!');
    }

    public function destroy($id)
    {
        Product::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Produk berhasil dihapus!');
    }
}
