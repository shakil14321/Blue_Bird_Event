<?php

namespace App\Http\Controllers\Api;

use App\Models\Cart;
use App\Models\Quotation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class QuotationController extends Controller
{
    // 1. User: List all their quotations / Admin: all quotations
    public function index(Request $request)
    {
        $query = Quotation::with(['cart.items.subcategory', 'user', 'admin'])->latest();

        if ($request->user()->role !== 'admin') {
            $query->where('user_id', $request->user()->id);
        }

        return $query->paginate(20);
    }

    // 2. User: Create a quotation request
    public function store(Request $request)
    {
        $data = $request->validate([
            'cart_id' => 'required|exists:carts,id',
            'address' => 'required|string',
            'request_details' => 'nullable|string'
        ]);

        $cart = Cart::with('items')->findOrFail($data['cart_id']);

        // Ensure cart belongs to the user
        abort_unless($cart->user_id === $request->user()->id, 403, 'Unauthorized action.');

        if ($cart->items->isEmpty()) {
            return response()->json(['message' => 'Cart has no items. Add subcategories first.'], 422);
        }

        $quotation = Quotation::create([
            'cart_id' => $cart->id,
            'user_id' => $request->user()->id,
            'address' => $data['address'],
            'request_details' => $data['request_details'] ?? null,
        ]);

        return response()->json(
            $quotation->load('cart.items.subcategory', 'user'),
            201
        );
    }

    // 3. Show a single quotation
    public function show(Request $request, Quotation $quotation)
    {
        // Restrict access: user sees only their own, admin sees all
        if ($request->user()->role !== 'admin') {
            abort_unless($quotation->user_id === $request->user()->id, 403, 'Unauthorized action.');
        }

        return $quotation->load('cart.items.subcategory', 'user', 'admin');
    }

    // 4. Admin: Respond to quotation
    public function respond(Request $request, Quotation $quotation)
    {
        abort_unless($request->user()->role === 'admin', 403, 'Only admin can respond.');

        $data = $request->validate([
            'response_details' => 'required|string'
        ]);

        $quotation->update([
            'response_details' => $data['response_details'],
            'admin_id' => $request->user()->id,
        ]);

        return $quotation->load('cart.items.subcategory', 'user', 'admin');
    }
}
