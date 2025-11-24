// 014 app/Models/ServiceLog.php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceLog extends Model
{
    protected $fillable = [
        'recurring_service_schedule_id', 'performed_by',
        'completed_at', 'notes', 'was_overdue', 'readings'
    ];

    protected $casts = [
        'completed_at' => 'datetime',
        'was_overdue' => 'boolean',
        'readings' => 'array',
    ];

    public function schedule()
    {
        return $this->belongsTo(RecurringServiceSchedule::class);
    }

    public function performedBy()
    {
        return $this->belongsTo(User::class, 'performed_by');
    }
}