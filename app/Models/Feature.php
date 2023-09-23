<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    use HasFactory;

    protected $fillable = [
         'title', 'image', 'description','direction'
    ];

    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }
}
