<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jadwal_pikets', function (Blueprint $table) {
            $table->id();

            $table->foreignId('kelompok_piket_id')
                ->constrained('kelompok_pikets')
                ->cascadeOnDelete();

            $table->date('tanggal');
            $table->string('jenis', 40)->default('kebersihan_uks');
            $table->string('keterangan')->nullable();

            $table->timestamps();

            // Satu jenis jadwal hanya diisi satu kelompok pada tanggal yang sama
            $table->unique(['tanggal', 'jenis']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jadwal_pikets');
    }
};