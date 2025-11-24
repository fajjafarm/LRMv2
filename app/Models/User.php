<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use OwenIt\Auditing\Contracts\Auditable;

class User extends Authenticatable implements Auditable
{
    use HasRoles, \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'name', 'email', 'password', 'business_id',
        'current_facility_id', 'is_super_admin'
    ];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_super_admin' => 'boolean',
    ];

    public function business()
    {
        return $this->belongsTo(Business::class);
    }

    public function currentFacility()
    {
        return $this->belongsTo(Facility::class, 'current_facility_id');
    }

    public function qualifications()
    {
        return $this->hasMany(UserQualification::class);
    }
    
// ADD THIS METHOD TO USER MODEL
public function openTasks()
{
    return Task::openForUser($this->id);
}
}