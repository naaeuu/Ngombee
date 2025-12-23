<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display admin dashboard data.
     */
    public function index()
    {
        $products = Product::with('category')->get();
        $categories = Category::all();

        $totalStock = $products->sum('stock');
        $outOfStock = $products->where('stock', 0)->count();

        return response()->json([
            'success' => true,
            'products' => $products,
            'categories' => $categories,
            'totalStock' => $totalStock,
            'outOfStock' => $outOfStock
        ]);
    }

    /**
     * Store a newly created product.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'price' => 'required|integer|min:1000',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id'
        ], [
            'category_id.exists' => 'Kategori yang dipilih tidak valid.'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        $product = Product::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'price' => $request->price,
            'stock' => $request->stock,
            'category_id' => $request->category_id
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Produk berhasil ditambahkan',
            'product' => $product
        ], 201);
    }

    /**
     * Update the specified product.
     */
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'price' => 'required|integer|min:1000',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id'
        ], [
            'category_id.exists' => 'Kategori yang dipilih tidak valid.'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        $product->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name), // Re-slug in case name changes
            'price' => $request->price,
            'stock' => $request->stock,
            'category_id' => $request->category_id
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Produk berhasil diperbarui',
            'product' => $product->fresh()
        ]);
    }

    /**
     * Remove the specified product.
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return response()->json([
            'success' => true,
            'message' => 'Produk berhasil dihapus'
        ]);
    }
}
