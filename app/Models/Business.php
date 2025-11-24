<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Cashier\Billable;
use OwenIt\Auditing\Contracts\Auditable;

class Business extends Model implements Auditable
{
    use Billable, \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'name', 'slug', 'contact_email', 'phone', 'address',
        'monthly_price', 'enabled_modules', 'trial_ends_at',
        'is_lifetime', 'is_active'
    ];

    protected $casts = [
        'enabled_modules' => 'array',
        'trial_ends_at' => 'datetime',
        'monthly_price' => 'decimal:2',
        'is_lifetime' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function facilities()
    {
        return $this->hasMany(Facility::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function hasModule(string $module): bool
    {
        return in_array($module, $this->enabled_modules ?? []);
    }
}