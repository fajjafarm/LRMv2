// 2025_11_01_000017_create_audit_reports_table.php
<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('audit_reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('facility_id')->constrained()->cascadeOnDelete();
            $table->foreignId('generated_by')->constrained('users');
            $table->string('report_type')->default('hse_pwtags');
            $table->string('file_path');
            $table->string('qr_code_path')->nullable();
            $table->json('metadata')->nullable();
            $table->timestamp('generated_at')->useCurrent();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('audit_reports'); }
};