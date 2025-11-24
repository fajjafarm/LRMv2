// 2025_11_01_000003_create_sub_facilities_table.php
<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('sub_facilities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('facility_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->string('type');
            $table->integer('check_interval_minutes')->nullable();
            $table->json('default_parameters')->nullable();
            $table->text('notes')->nullable();
            $table->boolean('requires_check')->default(false);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('sub_facilities'); }
};