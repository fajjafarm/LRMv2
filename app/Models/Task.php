<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Task extends Model
{
    protected $fillable = [
        'business_id', 'facility_id', 'sub_facility_id', 'assigned_to',
        'created_by', 'title', 'description', 'priority', 'status',
        'due_at', 'completed_at', 'is_automated'
    ];

    protected $casts = [
        'due_at' => 'datetime',
        'completed_at' => 'datetime',
        'is_automated' => 'boolean',
    ];

    public function assignedTo()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function facility()
    {
        return $this->belongsTo(Facility::class);
    }

    // CORRECT SCOPES
    public function scopeOpen(Builder $query)
    {
        return $query->whereIn('status', ['open', 'in_progress']);
    }

    public function scopeOpenForUser(Builder $query, $userId)
    {
        return $query->open()
            ->where(function ($q) use ($userId) {
                $q->where('assigned_to', $userId)
                  ->orWhere('created_by', $userId)
                  ->orWhereNull('assigned_to');
            });
    }
}