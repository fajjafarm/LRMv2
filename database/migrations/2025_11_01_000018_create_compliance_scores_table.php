// 2025_11_01_000018_create_compliance_scores_table.php
<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('compliance_scores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('business_id')->constrained()->cascadeOnDelete();
            $table->foreignId('facility_id')->nullable()->constrained()->nullOnDelete();
            $table->unsignedTinyInteger('score');
            $table->json('breakdown');
            $table->unsignedInteger('total_checks');
            $table->unsignedInteger('passed_checks');
            $table->date('date');
            $table->timestamps();
            $table->unique(['business_id', 'facility_id', 'date']);
        });
    }
    public function down(): void { Schema::dropIfExists('compliance_scores'); }
};