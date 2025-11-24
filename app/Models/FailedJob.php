// 032 app/Models/FailedJob.php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FailedJob extends Model
{
    protected $fillable = ['uuid', 'connection', 'payload', 'exception', 'failed_at'];
}