// 013 app/Models/RecurringServiceSchedule.php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class RecurringServiceSchedule extends Model
{
    protected $fillable = [
        'business_id', 'created_by', 'schedulable_id', 'schedulable_type',
        'title', 'description', 'frequency', 'interval',
        'first_due_date', 'next_due_date', 'last_completed_at', 'is_active'
    ];

    protected $casts = [
        'first_due_date' => 'date',
        'next_due_date' => 'date',
        'last_completed_at' => 'datetime',
        'is_active' => 'boolean',
    ];

    public function schedulable()
    {
        return $this->morphTo();
    }

    public function calculateNextDueDate(): ?Carbon
    {
        if (!$this->last_completed_at) return $this->first_due_date;

        return match ($this->frequency) {
            'daily'     => $this->last_completed_at->addDays($this->interval ?? 1),
            'weekly'    => $this->last_completed_at->addWeeks($this->interval ?? 1),
            'monthly'   => $this->last_completed_at->addMonths($this->interval ?? 1),
            'quarterly' => $this->last_completed_at->addMonths(($this->interval ?? 1) * 3),
            'annually'  => $this->last_completed_at->addYears($this->interval ?? 1),
            default     => null,
        };
    }

    public function updateNextDueDate(): void
    {
        $this->next_due_date = $this->calculateNextDueDate();
        $this->saveQuietly();
    }
}