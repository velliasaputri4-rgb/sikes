<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('medicine_out', function (Blueprint $table) {
            $table->id();
            $table->foreignId('medicine_id')->constrained()->cascadeOnDelete();
            $table->foreignId('medicine_batch_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('examination_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('user_id')->constrained('users');
            $table->date('transaction_date');
            $table->integer('qty');
            $table->enum('source', ['examination', 'damage', 'lost', 'donation', 'destruction', 'correction', 'opname']);
            $table->text('reason')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('medicine_out');
    }
};