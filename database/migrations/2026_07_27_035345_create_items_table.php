<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique(); // Kode barang (contoh: INV-001)
            $table->string('name'); // Nama barang
            $table->text('description')->nullable(); // Deskripsi
            $table->integer('quantity'); // Jumlah total
            $table->integer('available')->default(0); // Jumlah yang tersedia
            $table->string('condition')->default('good'); // good, damaged, lost
            $table->string('category')->nullable(); // Kategori (contoh: Alat Olahraga, P3K)
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};