<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SearchController extends Controller
{
    // Search by category or subcategory name
    public function search(Request $request)
    {
        $query = $request->input('query'); // user input

        if (!$query) {
            return response()->json(['message' => 'Please provide a search query'], 400);
        }

        // Search in categories
        $categories = Category::where('name', 'LIKE', "%{$query}%")
            ->with('subcategories')
            ->get();

        // Search in subcategories
        $subcategories = SubCategory::where('name', 'LIKE', "%{$query}%")
            ->with('category')
            ->get();

        return response()->json([
            'categories' => $categories,
            'subcategories' => $subcategories
        ]);
    }
}
