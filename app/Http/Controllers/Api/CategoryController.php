<?php

namespace App\Http\Controllers\api;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    // Get all categories
    public function index()
    {
        return response()->json(Category::all(), 200);
    }

    // Store a new category
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:25'
        ]);

        $category = Category::create($request->only('name'));

        return response()->json($category, 201);
    }

    // Show single category
    public function show($id)
    {
        $category = Category::findOrFail($id);
        return response()->json($category, 200);
    }

    // Update category
    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        $category->update($request->only('name'));

        return response()->json($category, 200);
    }

    // Delete category
    public function destroy($id)
    {
        $deleted = Category::destroy($id);
        return response()->json(['deleted' => $deleted], 200);
    }
}
