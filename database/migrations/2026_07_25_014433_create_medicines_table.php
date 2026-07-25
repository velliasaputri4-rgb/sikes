<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('medicines', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('medicine_categories')->cascadeOnDelete();
            $table->foreignId('supplier_id')->nullable()->constrained()->nullOnDelete();
            
            $table->string('code', 30)->unique();
            $table->string('name', 100);
            $table->string('generic_name', 100)->nullable();
            $table->string('brand', 100)->nullable();
            $table->string('unit', 30); // Tablet, Strip, Botol
            
            // Kolom Stok (WAJIB ADA)
            $table->integer('stock')->default(0);
            $table->integer('minimum_stock')->default(10);
            
            $table->text('usage_rule')->nullable();
            $table->text('side_effects')->nullable();
            $table->text('contraindications')->nullable();
            $table->text('benefits')->nullable();
            $table->string('storage_location', 100)->nullable();
            
            $table->decimal('buy_price', 12, 2)->default(0);
            $table->decimal('sell_price', 12, 2)->default(0);
            $table->string('image')->nullable();
            
            $table->enum('status', ['available', 'low_stock', 'empty', 'near_expired', 'expired'])->default('available');
            
            $table->timestamps();
            $table->softDeletes();
            
            $table->index(['name', 'code']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('medicines');
    }
};