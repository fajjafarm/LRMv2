// 2025_11_01_000025_create_inventory_items_table.php
<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('inventory_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('business_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->string('sku')->unique();
            $table->integer('current_stock')->default(0);
            $table->integer('minimum_stock')->default(0);
            $table->string('unit');
            $table->decimal('cost_price', 8, 2)->nullable();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('inventory_items'); }
};