// app/Models/FacilityDocument.php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FacilityDocument extends Model
{
    protected $fillable = [
        'facility_id', 'document_template_id', 'answers',
        'generated_file', 'signed_at', 'signed_by', 'qr_code_path'
    ];

    protected $casts = [
        'answers' => 'array',
        'signed_at' => 'datetime',
    ];

    public function facility()
    {
        return $this->belongsTo(Facility::class);
    }

    public function template()
    {
        return $this->belongsTo(DocumentTemplate::class);
    }

    public function signedBy()
    {
        return $this->belongsTo(User::class, 'signed_by');
    }
}