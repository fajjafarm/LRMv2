// 012 app/Models/Chemical.php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chemical extends Model
{
    protected $fillable = [
        'business_id', 'name', 'un_number', 'hazard_symbol',
        'minimum_stock_level', 'unit'
    ];

    public function business()
    {
        return $this->belongsTo(Business::class);
    }

    public function coshhRecords()
    {
        return $this->hasMany(CoshhRecord::class);
    }
}