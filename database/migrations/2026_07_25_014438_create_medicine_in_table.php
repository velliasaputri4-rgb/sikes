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
      Schema::create('medicines', function (Blueprint $table) {
    $table->id();
    $table->foreignId('category_id')->constrained('medicine_categories')->cascadeOnDelete();
    $table->string('code', 30)->unique();
    $table->string('name', 100);
    $table->string('unit', 30); // Tablet, Strip, Botol
    $table->integer('stock')->default(0);
    $table->integer('minimum_stock')->default(10);
    $table->date('expired_date')->nullable();
    $table->enum('status', ['available', 'low_stock', 'empty', 'near_expired', 'expired'])->default('available');
    $table->timestamps();
    $table->softDeletes();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medicine_in');
    }
};
