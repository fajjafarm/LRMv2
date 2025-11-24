// 2025_11_01_000007_create_safety_documents_table.php
<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('safety_documents', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->enum('type', ['NOP','EAP','Risk Assessment','How-To Guide','SOP','Emergency Plan','RAMS']);
            $table->text('content')->nullable();
            $table->string('file_path')->nullable();
            $table->morphs('documentable');
            $table->date('review_date');
            $table->date('last_reviewed')->nullable();
            $table->foreignId('created_by')->constrained('users');
            $table->foreignId('approved_by')->nullable()->constrained('users');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('safety_documents'); }
};