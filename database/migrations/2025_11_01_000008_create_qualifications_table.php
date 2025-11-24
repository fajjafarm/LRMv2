// 2025_11_01_000008_create_qualifications_table.php
<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('qualifications', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('required_hours_per_month')->default(2);
            $table->integer('validity_years')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('qualifications'); }
};