// 009 app/Models/UserQualification.php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserQualification extends Model
{
    protected $fillable = [
        'user_id', 'qualification_id', 'award_date',
        'expiry_date', 'certificate_number', 'is_current'
    ];

    protected $casts = [
        'award_date' => 'date',
        'expiry_date' => 'date',
        'is_current' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function qualification()
    {
        return $this->belongsTo(Qualification::class);
    }
}