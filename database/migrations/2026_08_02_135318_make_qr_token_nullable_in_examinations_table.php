<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('examinations', function (Blueprint $table) {
            // Ubah kolom qr_token menjadi boleh kosong (nullable)
            $table->string('qr_token')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('examinations', function (Blueprint $table) {
            // Kembalikan ke kondisi semula jika di-rollback
            $table->string('qr_token')->nullable(false)->change();
        });
    }
};