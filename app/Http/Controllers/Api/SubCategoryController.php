<?php

namespace App\Http\Controllers\Api;

use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubCategoryController extends Controller
{
    // Get all subcategories
    public function index()
    {
        return SubCategory::with('category')->get();
    }

    // Store a new subcategory
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        return SubCategory::create($request->all());
    }

    // Show single subcategory
    public function show($id)
    {
        return SubCategory::with('category')->findOrFail($id);
    }

    // Update subcategory
    public function update(Request $request, $id)
    {
        $subcategory = SubCategory::findOrFail($id);
        $subcategory->update($request->all());
        return $subcategory;
    }

    // Delete subcategory
    public function destroy($id)
    {
        return SubCategory::destroy($id);
    }
}
