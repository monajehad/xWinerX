<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionAuthorization extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_id',
        'authorization_code',
        'bin',
        'last4',
        'exp_month',
        'exp_year',
        'card_type',
        'bank',
        'country_code',
        'brand',
        'reusable',
        'signature',
        'account_name',
    ];

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }
}
