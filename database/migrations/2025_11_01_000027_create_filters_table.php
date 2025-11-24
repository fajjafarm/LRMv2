// 2025_11_01_000027_create_filters_table.php
<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('filters', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sub_facility_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->string('type');
            $table->date('last_backwash')->nullable();
            $table->integer('max_hours_between_backwash')->default(720);
            $table->decimal('current_pressure', 5, 2)->nullable();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('filters'); }
};