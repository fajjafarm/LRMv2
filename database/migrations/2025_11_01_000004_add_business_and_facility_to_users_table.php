// 2025_11_01_000004_add_business_and_facility_to_users_table.php
<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('business_id')->nullable()->after('id')->constrained()->nullOnDelete();
            $table->foreignId('current_facility_id')->nullable()->after('business_id')->constrained('facilities')->nullOnDelete();
            $table->boolean('is_super_admin')->default(false);
        });
    }
    public function down(): void {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['business_id']);
            $table->dropForeign(['current_facility_id']);
            $table->dropColumn(['business_id', 'current_facility_id', 'is_super_admin']);
        });
    }
};