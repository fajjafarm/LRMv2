// 2025_11_01_000035_create_invoices_table.php (Cashier)
<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->morphs('billable');
            $table->string('stripe_id')->unique();
            $table->decimal('total', 15, 2);
            $table->timestamp('paid_at')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('invoices'); }
};