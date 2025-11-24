// 2025_11_01_000023_create_chemicals_table.php
<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('chemicals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('business_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->string('un_number')->nullable();
            $table->string('hazard_symbol')->nullable();
            $table->integer('minimum_stock_level')->default(0);
            $table->string('unit')->default('litres');
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('chemicals'); }
};