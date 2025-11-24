// 008 app/Models/Qualification.php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Qualification extends Model
{
    protected $fillable = ['name', 'required_hours_per_month', 'validity_years'];

    public function userQualifications()
    {
        return $this->hasMany(UserQualification::class);
    }
}