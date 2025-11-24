// 2025_11_01_000021_create_swim_lessons_table.php
<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('swim_lessons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('facility_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->string('day_of_week');
            $table->time('start_time');
            $table->time('end_time');
            $table->integer('max_swimmers');
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('swim_lessons'); }
};