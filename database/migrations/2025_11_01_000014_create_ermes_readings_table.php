// 2025_11_01_000014_create_ermes_readings_table.php
<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('ermes_readings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('device_integration_id')->constrained()->cascadeOnDelete();
            $table->decimal('ph', 4, 2)->nullable();
            $table->decimal('redox', 6, 2)->nullable();
            $table->decimal('chlorine_ppm', 5, 2)->nullable();
            $table->decimal('temperature', 5, 2)->nullable();
            $table->json('raw_data')->nullable();
            $table->timestamp('recorded_at');
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('ermes_readings'); }
};