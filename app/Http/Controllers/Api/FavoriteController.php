<?php

namespace App\Http\Controllers\Api;

use App\Models\Favorite;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FavoriteController extends Controller
{
    public function index()
    {
        return Favorite::with(['user','subcategory'])->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'subcategory_id' => 'required|exists:subcategories,id'
        ]);

        return Favorite::create($request->all());
    }

    public function show($id)
    {
        return Favorite::with(['user','subcategory'])->findOrFail($id);
    }

    public function destroy($id)
    {
        return Favorite::destroy($id);
    }
}
