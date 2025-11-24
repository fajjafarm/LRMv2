// 2025_11_01_000019_create_swim_lesson_bookings_table.php
<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('swim_lesson_bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('swim_lesson_id')->constrained()->cascadeOnDelete();
            $table->string('child_name');
            $table->string('parent_name');
            $table->string('parent_email');
            $table->string('parent_phone');
            $table->date('date_of_birth');
            $table->text('medical_notes')->nullable();
            $table->string('access_token')->unique();
            $table->timestamp('last_viewed_at')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('swim_lesson_bookings'); }
};