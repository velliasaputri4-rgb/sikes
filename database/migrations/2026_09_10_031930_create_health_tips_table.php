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
        Schema::create('health_tips', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Judul tips
            $table->string('category'); // Kategori (gizi, kebersihan, penyakit, dll)
            $table->text('content'); // Isi lengkap tips
            $table->string('image')->nullable(); // Opsional: gambar pendukung
            $table->boolean('is_active')->default(true); // Status aktif/tidak
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('health_tips');
    }
};