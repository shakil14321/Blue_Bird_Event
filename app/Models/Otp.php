<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Otp extends Model
{
    use HasFactory;

    protected $fillable = ['phone', 'code', 'expired_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
