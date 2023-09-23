<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CampaignFeature extends Model
{
    use HasFactory;

    protected $fillable = [
        'campaign_id', 'title', 'image', 'description'
    ];

    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }
}
