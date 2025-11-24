// 2025_11_01_000010_create_training_hours_table.php
<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('training_hours', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_qualification_id')->nullable()->constrained()->nullOnDelete();
            $table->date('training_date');
            $table->decimal('hours', 5, 2);
            $table->string('topic');
            $table->string('provider')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('training_hours'); }
};