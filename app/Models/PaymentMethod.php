<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'method_type',
        'card_last_four', // Only for card payments
        'usdt_address',   // Only for USDT payments
        // Add other columns as needed
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
