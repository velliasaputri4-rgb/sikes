<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('medicine_stock_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('medicine_id')->constrained()->cascadeOnDelete();
            $table->foreignId('medicine_batch_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->enum('transaction_type', ['in', 'out', 'opname', 'correction']);
            $table->integer('qty_in')->default(0);
            $table->integer('qty_out')->default(0);
            $table->integer('stock_before');
            $table->integer('stock_after');
            $table->text('notes')->nullable();
            $table->string('reference_type')->nullable(); // Contoh: App\Models\MedicineIn
            $table->unsignedBigInteger('reference_id')->nullable();
            $table->timestamps();
            
            $table->index(['medicine_id', 'created_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('medicine_stock_logs');
    }
};