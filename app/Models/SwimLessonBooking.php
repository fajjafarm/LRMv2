// 019 app/Models/SwimLessonBooking.php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SwimLessonBooking extends Model
{
    protected $fillable = [
        'swim_lesson_id', 'child_name', 'parent_name', 'parent_email',
        'parent_phone', 'date_of_birth', 'medical_notes', 'access_token'
    ];

    protected $casts = [
        'date_of_birth' => 'date',
    ];

    public function lesson()
    {
        return $this->belongsTo(SwimLesson::class);
    }
}