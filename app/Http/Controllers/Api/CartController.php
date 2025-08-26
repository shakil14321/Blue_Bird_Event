<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    // Get all carts
    public function index()
    {
        return Cart::with('items.subcategory')->get();
    }

    // Store a new cart
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'quotation_id' => 'nullable|integer',
        ]);

        return Cart::create($request->all());
    }

    // Show single cart
    public function show($id)
    {
        return Cart::with('items.subcategory')->findOrFail($id);
    }

    // Update cart
    public function update(Request $request, $id)
    {
        $cart = Cart::findOrFail($id);
        $cart->update($request->all());
        return $cart;
    }

    // Delete cart
    public function destroy($id)
    {
        return Cart::destroy($id);
    }
}