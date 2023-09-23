<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionTimeline extends Model
{
    use HasFactory;
    protected $fillable = ['transaction_id', 'time_spent', 'attempts', 'authentication', 'errors', 'success', 'mobile', 'channel', 'input', 'history'];

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }
}
