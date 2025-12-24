<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::table('alumni', function (Blueprint $table) {
        if (!Schema::hasColumn('alumni', 'graduation_year')) {
            $table->string('graduation_year')->nullable();
        }
        if (!Schema::hasColumn('alumni', 'major')) {
            $table->string('major')->nullable();
        }
        if (!Schema::hasColumn('alumni', 'phone')) {
            $table->string('phone')->nullable();
        }
        // TAMBAHKAN INI: Kolom untuk verifikasi di dashboard
        if (!Schema::hasColumn('alumni', 'status')) {
            $table->string('status')->default('pending'); 
        }
    });
}

public function down(): void
{
    Schema::table('alumni', function (Blueprint $table) {
        // Tambahkan juga dropColumn agar bisa di-rollback
        $columns = ['graduation_year', 'major', 'phone', 'status'];
        foreach($columns as $col) {
            if (Schema::hasColumn('alumni', $col)) {
                $table->dropColumn($col);
            }
        }
    });
}
};
