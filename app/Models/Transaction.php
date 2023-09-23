<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'domain', 'status', 'reference', 'amount', 'message',
        'gateway_response', 'paid_at', 'channel', 'currency',
        'ip_address', 'metadata', 'fees', 'requested_amount',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function logs()
    {
        return $this->hasMany(TransactionLog::class);
    }

    public function authorizations()
    {
        return $this->hasMany(TransactionAuthorization::class);
    }

    public function timeline()
    {
        return $this->hasOne(TransactionTimeline::class);
    }

}
