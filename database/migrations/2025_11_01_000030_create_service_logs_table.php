// 2025_11_01_000030_create_service_logs_table.php
<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('service_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('recurring_service_schedule_id')->constrained()->cascadeOnDelete();
            $table->foreignId('performed_by')->constrained('users');
            $table->timestamp('completed_at')->useCurrent();
            $table->text('notes')->nullable();
            $table->boolean('was_overdue')->default(false);
            $table->json('readings')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('service_logs'); }
};