// 2025_11_01_000028_create_backwashes_table.php
<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('backwashes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('filter_id')->constrained()->cascadeOnDelete();
            $table->foreignId('performed_by')->constrained('users');
            $table->decimal('pre_pressure', 5, 2);
            $table->decimal('post_pressure', 5, 2);
            $table->integer('duration_minutes');
            $table->timestamp('backwashed_at')->useCurrent();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('backwashes'); }
};