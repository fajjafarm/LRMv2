// 2025_11_01_000034_create_telescope_entries_table.php (Laravel Telescope – optional)
<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('telescope_entries', function (Blueprint $table) {
            $table->bigIncrements('sequence');
            $table->uuid('uuid');
            $table->uuid('batch_id');
            $table->string('family_hash')->nullable()->index();
            $table->string('type');
            $table->longText('content');
            $table->timestamp('created_at')->nullable();
            $table->index(['type', 'created_at']);
        });
    }
    public function down(): void { Schema::dropIfExists('telescope_entries'); }
};