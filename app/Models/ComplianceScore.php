// 016 app/Models/ComplianceScore.php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ComplianceScore extends Model
{
    protected $fillable = [
        'business_id', 'facility_id', 'score', 'breakdown',
        'total_checks', 'passed_checks', 'date'
    ];

    protected $casts = [
        'breakdown' => 'array',
        'date' => 'date',
    ];
}