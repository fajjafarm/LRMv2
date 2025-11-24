// 003 app/Models/SubFacility.php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubFacility extends Model
{
    protected $fillable = [
        'facility_id', 'name', 'type', 'check_interval_minutes',
        'default_parameters', 'notes', 'requires_check', 'is_active'
    ];

    protected $casts = [
        'default_parameters' => 'array',
        'requires_check' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function facility()
    {
        return $this->belongsTo(Facility::class);
    }

    public function poolTests()
    {
        return $this->hasMany(PoolTest::class);
    }

    public function needsCheck(): bool
    {
        if (!$this->requires_check) return false;
        $last = $this->poolTests()->latest()->first();
        return !$last || $last->tested_at->lt(now()->subMinutes($this->check_interval_minutes));
    }
}