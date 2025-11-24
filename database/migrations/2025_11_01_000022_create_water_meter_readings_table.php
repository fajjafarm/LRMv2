<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWaterMeterReadingsTable extends Migration
{
    public function up(): void
    {
        Schema::create('water_meter_readings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('facility_id')->constrained()->cascadeOnDelete();
            $table->string('meter_name');
            $table->bigInteger('reading');
            $table->date('reading_date');
            $table->foreignId('recorded_by')->constrained('users');
            $table->timestamps();
            $table->unique(['facility_id', 'meter_name', 'reading_date']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('water_meter_readings');
    }
}