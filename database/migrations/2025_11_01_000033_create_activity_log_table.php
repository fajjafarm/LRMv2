// 2025_11_01_000033_create_activity_log_table.php (Spatie Activitylog)
<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('activity_log', function (Blueprint $table) {
            $table->id();
            $table->string('log_name')->nullable();
            $table->text('description');
            $table->nullableMorphs('subject');
            $table->nullableMorphs('causer');
            $table->json('properties')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->index('log_name');
        });
    }
    public function down(): void { Schema::dropIfExists('activity_log'); }
};