<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        return response()->json(Category::all());
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100|unique:categories'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $category = Category::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name)
        ]);

        return response()->json($category, 201);
    }

    public function show(Category $category)
    {
        return response()->json($category);
    }

    public function update(Request $request, Category $category)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100|unique:categories,name,' . $category->id
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $category->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name)
        ]);

        return response()->json($category);
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return response()->json(null, 204);
    }
}
