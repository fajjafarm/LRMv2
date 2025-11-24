// 020 app/Models/VoiceLog.php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VoiceLog extends Model
{
    protected $fillable = [
        'user_id', 'facility_id', 'audio_file',
        'transcription', 'ai_response', 'status', 'processed_at'
    ];

    protected $casts = [
        'ai_response' => 'array',
        'processed_at' => 'datetime',
    ];
}