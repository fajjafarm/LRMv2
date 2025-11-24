// 2025_11_01_000036_create_invoice_items_table.php
<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('invoice_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('invoice_id')->constrained()->cascadeOnDelete();
            $table->string('description');
            $table->decimal('amount', 10, 2);
            $table->integer('quantity')->default(1);
            $table->string('stripe_price_id')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('invoice_items'); }
};