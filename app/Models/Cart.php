<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'quotation_id'];

    // A cart belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // A cart has many items
    public function items()
    {
        return $this->hasMany(CartItem::class);
    }
}