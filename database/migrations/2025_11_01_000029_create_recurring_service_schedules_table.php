// 2025_11_01_000029_create_recurring_service_schedules_table.php
<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('recurring_service_schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('business_id')->constrained()->cascadeOnDelete();
            $table->foreignId('created_by')->constrained('users');
            $table->string('schedulable_type', 191)->nullable();
	$table->unsignedBigInteger('schedulable_id')->nullable();
	$table->index(['schedulable_type', 'schedulable_id'], 'rec_sched_type_id_idx');
            $table->string('title');
            $table->text('description')->nullable();
            $table->enum('frequency', ['daily','weekly','monthly','quarterly','annually']);
            $table->unsignedInteger('interval')->default(1);
            $table->unsignedTinyInteger('day_of_week')->nullable();
            $table->unsignedTinyInteger('day_of_month')->nullable();
            $table->unsignedTinyInteger('month_of_year')->nullable();
            $table->date('first_due_date');
            $table->date('next_due_date')->nullable();
            $table->timestamp('last_completed_at')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('recurring_service_schedules'); }
};