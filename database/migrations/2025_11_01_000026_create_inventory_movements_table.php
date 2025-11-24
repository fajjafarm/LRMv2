// 2025_11_01_000026_create_inventory_movements_table.php
<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('inventory_movements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('inventory_item_id')->constrained()->cascadeOnDelete();
            $table->integer('quantity');
            $table->enum('type', ['in','out','adjustment']);
            $table->text('reason')->nullable();
            $table->foreignId('user_id')->constrained();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('inventory_movements'); }
};