// 2025_11_01_000015_create_lifeguard_clock_ins_table.php
<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('lifeguard_clock_ins', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('facility_id')->constrained()->cascadeOnDelete();
            $table->timestamp('clock_in_at')->useCurrent();
            $table->timestamp('clock_out_at')->nullable();
            $table->decimal('hours_worked', 5, 2)->nullable();
            $table->boolean('synced')->default(false);
            $table->json('offline_data')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('lifeguard_clock_ins'); }
};