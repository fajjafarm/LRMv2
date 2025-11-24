<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    protected $fillable = ['business_id', 'name', 'slug', 'address', 'is_active'];

    protected $casts = ['is_active' => 'boolean'];

    public function business()
    {
        return $this->belongsTo(Business::class);
    }

    public function subFacilities()
    {
        return $this->hasMany(SubFacility::class);
    }

    public function poolTests()
    {
        return $this->hasManyThrough(PoolTest::class, SubFacility::class);
    }

    public function latestPoolTest()
    {
        return $this->hasOneThrough(PoolTest::class, SubFacility::class)->latestOfMany();
    }
}