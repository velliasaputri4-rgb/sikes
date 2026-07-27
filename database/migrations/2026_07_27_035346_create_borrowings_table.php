<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('borrowings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('item_id')->constrained()->cascadeOnDelete();
            $table->foreignId('student_id')->constrained()->cascadeOnDelete();
            $table->foreignId('borrowed_by')->constrained('users')->cascadeOnDelete(); // Petugas yang mencatat
            $table->date('borrow_date'); // Tanggal pinjam
            $table->date('expected_return_date')->nullable(); // Tanggal rencana kembali
            $table->date('return_date')->nullable(); // Tanggal aktual kembali
            $table->enum('status', ['borrowed', 'returned', 'overdue', 'lost'])->default('borrowed');
            $table->text('notes')->nullable(); // Catatan kondisi
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('borrowings');
    }
};