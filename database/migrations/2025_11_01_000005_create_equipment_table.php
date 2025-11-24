// 2025_11_01_000005_create_equipment_table.php
<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('equipment', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sub_facility_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->string('type');
            $table->string('manufacturer')->nullable();
            $table->string('model')->nullable();
            $table->string('serial_number')->nullable();
            $table->date('install_date')->nullable();
            $table->date('warranty_expiry')->nullable();
            $table->text('notes')->nullable();
            $table->boolean('requires_maintenance')->default(true);
            $table->integer('maintenance_interval_months')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('equipment'); }
};