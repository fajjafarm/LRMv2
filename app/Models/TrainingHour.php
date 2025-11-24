// 010 app/Models/TrainingHour.php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrainingHour extends Model
{
    protected $fillable = [
        'user_id', 'user_qualification_id', 'training_date',
        'hours', 'topic', 'provider', 'notes'
    ];

    protected $casts = [
        'training_date' => 'date',
        'hours' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}