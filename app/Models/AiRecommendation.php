<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AiRecommendation extends Model
{
    protected $fillable = [
        'facility_id', 'user_id', 'title', 'description',
        'priority', 'category', 'data', 'dismissed', 'dismissed_at'
    ];

    protected $casts = [
        'data' => 'array',
        'dismissed_at' => 'datetime',
    ];

    public function scopeActive($query)
    {
        return $query->where('dismissed', false);
    }
}