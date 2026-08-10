<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('anggota_pikets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kelompok_piket_id')
                ->constrained('kelompok_pikets')
                ->cascadeOnDelete();

            $table->string('nama');
            $table->string('telepon')->nullable();
            $table->boolean('is_kontak')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('anggota_pikets');
    }
};