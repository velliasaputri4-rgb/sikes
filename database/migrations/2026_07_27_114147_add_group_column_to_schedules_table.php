<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('schedules', function (Blueprint $table) {
            $table->string('group_name')->nullable()->after('officer_name'); // Nama Kelompok
            $table->text('members')->nullable()->after('group_name'); // Daftar Anggota (JSON atau text)
        });
    }

    public function down(): void
    {
        Schema::table('schedules', function (Blueprint $table) {
            $table->dropColumn(['group_name', 'members']);
        });
    }
};