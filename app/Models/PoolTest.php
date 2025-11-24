// 007 app/Models/PoolTest.php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PoolTest extends Model
{
    protected $fillable = [
        'sub_facility_id', 'performed_by', 'temperature', 'free_chlorine',
        'total_chlorine', 'ph', 'alkalinity', 'calcium_hardness',
        'cyanuric_acid', 'tds', 'notes', 'tested_at'
    ];

    protected $casts = [
        'tested_at' => 'datetime',
    ];

    public function subFacility()
    {
        return $this->belongsTo(SubFacility::class);
    }

    public function performedBy()
    {
        return $this->belongsTo(User::class, 'performed_by');
    }

    public function isOutOfRange(): bool
    {
        return $this->ph < 7.2 || $this->ph > 7.8 ||
               $this->free_chlorine < 1.0 || $this->free_chlorine > 5.0;
    }
}