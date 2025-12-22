<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        return response()->json(Product::with('category')->get());
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100|unique:products',
            'price' => 'required|integer|min:1000',
            'category_id' => 'required|exists:categories,id'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $product = Product::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'price' => $request->price,
            'category_id' => $request->category_id
        ]);

        return response()->json($product->load('category'), 201);
    }

    public function show(Product $product)
    {
        return response()->json($product->load('category'));
    }

    public function update(Request $request, $id)
    {
        try {
            $product = Product::find($id);

            if (!$product) {
                return response()->json(['message' => 'Produk tidak ditemukan'], 404);
            }

            // Gunakan Validator agar tidak melempar Exception HTML 500
            $validator = Validator::make($request->all(), [
                'name' => 'required|string',
                'price' => 'required|numeric',
                'stock' => 'required|integer',
                'category_id' => 'required|exists:categories,id',
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }

            $product->update([
                'name' => $request->name,
                'price' => $request->price,
                'stock' => $request->stock,
                'category_id' => $request->category_id,
                // Slug otomatis terupdate via boot() di Model
            ]);

            return response()->json(['success' => true, 'data' => $product->load('category')]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }

    // Ubah parameter dari Product $product menjadi $id
    public function destroy($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Produk tidak ditemukan'], 404);
        }

        $product->delete();
        return response()->json(['success' => true, 'message' => 'Produk dihapus'], 200);
    }
}
