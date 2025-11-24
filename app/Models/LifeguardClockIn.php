// 018 app/Models/LifeguardClockIn.php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LifeguardClockIn extends Model
{
    protected $fillable = [
        'user_id', 'facility_id', 'clock_in_at', 'clock_out_at',
        'hours_worked', 'synced', 'offline_data'
    ];

    protected $casts = [
        'clock_in_at' => 'datetime',
        'clock_out_at' => 'datetime',
        'offline_data' => 'array',
    ];
}