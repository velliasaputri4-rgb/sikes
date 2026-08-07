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
        Schema::table('examinations', function (Blueprint $table) {
            // 1. Hapus foreign key constraint terlebih dahulu
            $table->dropForeign(['officer_id']);
            
            // 2. Baru hapus kolomnya
            $table->dropColumn('officer_id');
            
            // 3. Tambahkan kolom baru untuk nama petugas
            $table->string('officer_name')->nullable()->after('student_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('examinations', function (Blueprint $table) {
            // Hapus kolom baru
            $table->dropColumn('officer_name');
            
            // Kembalikan kolom dan foreign key seperti semula
            $table->foreignId('officer_id')->nullable()->after('student_id')->constrained('users')->nullOnDelete();
        });
    }
};