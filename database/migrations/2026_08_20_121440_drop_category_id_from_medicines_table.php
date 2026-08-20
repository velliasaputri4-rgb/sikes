<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('medicines', function (Blueprint $table) {
            // 1. Drop foreign key constraint dulu
            $table->dropForeign(['category_id']);
            
            // 2. Baru drop kolomnya
            $table->dropColumn('category_id');
        });
    }

    public function down()
    {
        Schema::table('medicines', function (Blueprint $table) {
            // Kembalikan kolom dan foreign key jika rollback
            $table->unsignedBigInteger('category_id')->nullable();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('set null');
        });
    }
};