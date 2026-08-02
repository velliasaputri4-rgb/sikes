<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('examinations', function (Blueprint $table) {
            // 1. Hapus foreign key lama yang salah mengarah ke tabel 'officers'
            $table->dropForeign(['officer_id']);
            
            // 2. Buat foreign key baru yang benar, mengarah ke tabel 'users'
            $table->foreign('officer_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('examinations', function (Blueprint $table) {
            // Kembalikan ke kondisi semula jika di-rollback
            $table->dropForeign(['officer_id']);
            $table->foreign('officer_id')->references('id')->on('officers')->onDelete('cascade');
        });
    }
};