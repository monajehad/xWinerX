<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'target', 'price', 'image', 'close_campaign_after','status'
    ];

    public function features()
    {
        return $this->hasMany(CampaignFeature::class);
    }
    public function subscribers()
    {
        return $this->hasMany(Subscription::class);
    }
    
    public function winners()
    {
        return $this->hasMany(Winner::class);
    }
}
