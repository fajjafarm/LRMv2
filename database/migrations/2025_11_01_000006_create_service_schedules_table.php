// 2025_11_01_000006_create_service_schedules_table.php
<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('service_schedules', function (Blueprint $table) {
            $table->id();
            $table->morphs('schedulable');
            $table->string('title');
            $table->text('description')->nullable();
            $table->enum('frequency', ['daily','weekly','monthly','quarterly','annually']);
            $table->integer('interval')->default(1);
            $table->date('next_due');
            $table->date('last_completed')->nullable();
            $table->foreignId('completed_by')->nullable()->constrained('users');
            $table->boolean('is_overdue')->default(false);
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('service_schedules'); }
};