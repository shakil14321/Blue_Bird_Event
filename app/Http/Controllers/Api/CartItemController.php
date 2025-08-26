<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use Illuminate\Http\Request;

class CartItemController extends Controller
{
    // Get all cart items
    public function index()
    {
        return CartItem::with(['cart', 'subcategory'])->get();
    }

    // Store a new cart item
    public function store(Request $request)
    {
        $request->validate([
            'cart_id' => 'required|exists:carts,id',
            'sub_category_id' => 'required|exists:subcategories,id',
        ]);

        return CartItem::create($request->all());
    }

    // Show single cart item
    public function show($id)
    {
        return CartItem::with(['cart', 'subcategory'])->findOrFail($id);
    }

    // Update cart item
    public function update(Request $request, $id)
    {
        $cartItem = CartItem::findOrFail($id);
        $cartItem->update($request->all());
        return $cartItem;
    }

    // Delete cart item
    public function destroy($id)
    {
        return CartItem::destroy($id);
    }
}
