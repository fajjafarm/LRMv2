<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('device_integrations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sub_facility_id')->constrained()->cascadeOnDelete();
            $table->enum('type', ['palintest', 'ermes']);
            $table->string('device_id');
            $table->string('api_key')->nullable();
            $table->string('cloud_id')->nullable();
            $table->timestamp('last_synced_at')->nullable();
            $table->boolean('is_active')->default(true);
            $table->json('config')->nullable();
            $table->timestamps();
        });  // ← Only ONE closing parenthesis here
    }

    public function down(): void
    {
        Schema::dropIfExists('device_integrations');
    }
};