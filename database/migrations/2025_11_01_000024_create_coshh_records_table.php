// 2025_11_01_000024_create_coshh_records_table.php
<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('coshh_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('chemical_id')->constrained()->cascadeOnDelete();
            $table->string('msds_file')->nullable();
            $table->text('storage_instructions');
            $table->text('handling_instructions');
            $table->text('first_aid_measures')->nullable();
            $table->date('review_date');
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('coshh_records'); }
};