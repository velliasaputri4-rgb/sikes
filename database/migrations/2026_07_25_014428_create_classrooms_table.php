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
        // UBAH 'classes' MENJADI 'classrooms' (atau 'classroom' kalau maunya singular)
        Schema::create('classrooms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('major_id')->constrained()->cascadeOnDelete();
            $table->string('name'); 
            $table->string('code', 20)->unique();
            $table->integer('grade'); // 10, 11, 12
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // UBAH 'classes' MENJADI 'classrooms'
        Schema::dropIfExists('classrooms');
    }
};