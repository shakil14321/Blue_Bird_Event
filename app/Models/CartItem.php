<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    protected $fillable = ['cart_id', 'sub_category_id'];

    // A cart item belongs to a cart
    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    // A cart item belongs to a subcategory
    public function subcategory()
    {
        return $this->belongsTo(SubCategory::class);
    }
}
