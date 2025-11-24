<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('document_templates', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // "NOP", "EAP", "Risk Assessment"
            $table->string('version'); // "2025-v1"
            $table->longText('content'); // Blade/HTML with variables
            $table->json('variables'); // Required fields
            $table->boolean('is_current')->default(false);
            $table->date('valid_from');
            $table->date('valid_to')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('document_templates');
    }
};