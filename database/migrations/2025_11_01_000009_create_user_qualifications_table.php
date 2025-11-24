// 2025_11_01_000009_create_user_qualifications_table.php
<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('user_qualifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('qualification_id')->constrained()->cascadeOnDelete();
            $table->date('award_date');
            $table->date('expiry_date')->nullable();
            $table->string('certificate_number')->nullable();
            $table->boolean('is_current')->default(true);
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('user_qualifications'); }
};