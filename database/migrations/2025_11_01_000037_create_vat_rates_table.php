// 2025_11_01_000037_create_vat_rates_table.php
<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('vat_rates', function (Blueprint $table) {
            $table->id();
            $table->string('country_code', 2)->unique();
            $table->decimal('rate', 5, 3);
            $table->boolean('is_default')->default(false);
            $table->date('valid_from');
            $table->date('valid_to')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('vat_rates'); }
};