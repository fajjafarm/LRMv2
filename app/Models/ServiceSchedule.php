// 006 app/Models/ServiceSchedule.php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceSchedule extends Model
{
    protected $fillable = [
        'schedulable_id', 'schedulable_type', 'title', 'description',
        'frequency', 'interval', 'next_due', 'last_completed',
        'completed_by', 'is_overdue'
    ];

    protected $casts = [
        'next_due' => 'date',
        'last_completed' => 'date',
        'is_overdue' => 'boolean',
    ];

    public function schedulable()
    {
        return $this->morphTo();
    }

    public function completedBy()
    {
        return $this->belongsTo(User::class, 'completed_by');
    }
}