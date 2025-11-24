// 2025_11_01_000020_create_ai_recommendations_table.php
<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('ai_recommendations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('facility_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->nullable()->constrained('users');
            $table->string('title');
            $table->text('description');
            $table->enum('priority', ['critical', 'high', 'medium', 'low']);
            $table->string('category');
            $table->json('data');
            $table->boolean('dismissed')->default(false);
            $table->timestamp('dismissed_at')->nullable();
            $table->timestamp('generated_at')->useCurrent();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('ai_recommendations'); }
};