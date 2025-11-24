// 005 app/Models/Equipment.php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    protected $fillable = [
        'sub_facility_id', 'name', 'type', 'manufacturer', 'model',
        'serial_number', 'install_date', 'warranty_expiry', 'notes',
        'requires_maintenance', 'maintenance_interval_months'
    ];

    protected $casts = [
        'install_date' => 'date',
        'warranty_expiry' => 'date',
        'requires_maintenance' => 'boolean',
    ];

    public function subFacility()
    {
        return $this->belongsTo(SubFacility::class);
    }

    public function serviceSchedules()
    {
        return $this->morphMany(ServiceSchedule::class, 'schedulable');
    }
}