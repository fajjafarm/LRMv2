// 2025_11_01_000012_create_pool_tests_table.php
<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('pool_tests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sub_facility_id')->constrained()->cascadeOnDelete();
            $table->foreignId('performed_by')->constrained('users');
            $table->decimal('temperature', 5, 2);
            $table->decimal('free_chlorine', 5, 2);
            $table->decimal('total_chlorine', 5, 2)->nullable();
            $table->decimal('ph', 4, 2);
            $table->decimal('alkalinity', 6, 2)->nullable();
            $table->decimal('calcium_hardness', 6, 2)->nullable();
            $table->decimal('cyanuric_acid', 6, 2)->nullable();
            $table->decimal('tds', 8, 2)->nullable();
            $table->text('notes')->nullable();
            $table->timestamp('tested_at')->useCurrent();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('pool_tests'); }
};