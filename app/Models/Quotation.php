<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
{
    protected $fillable = [
        'cart_id','user_id','address','request_details','response_details','admin_id'
    ];
    public function cart(){ return $this->belongsTo(Cart::class); }
    public function user(){ return $this->belongsTo(User::class); }
    public function admin(){ return $this->belongsTo(User::class, 'admin_id'); }
}
