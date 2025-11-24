// 031 app/Models/VatRate.php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VatRate extends Model
{
    protected $fillable = ['country_code', 'rate', 'is_default', 'valid_from', 'valid_to'];
}