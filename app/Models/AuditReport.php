<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuditReport extends Model
{
    protected $fillable = [
        'facility_id', 'generated_by', 'report_type',
        'file_path', 'qr_code_path', 'metadata'
    ];

    protected $casts = [
        'metadata' => 'array',
        'generated_at' => 'datetime',
    ];
}