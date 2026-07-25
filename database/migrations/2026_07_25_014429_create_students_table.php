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
       Schema::create('students', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->constrained()->cascadeOnDelete();
    $table->foreignId('class_id')->constrained()->cascadeOnDelete();
    $table->string('nis', 20)->unique();
    $table->string('full_name', 100);
    $table->enum('gender', ['L', 'P']);
    $table->string('birth_place')->nullable();
    $table->date('birth_date');
    $table->text('address')->nullable();
    $table->string('parent_name', 100)->nullable();
    $table->string('parent_phone', 20)->nullable();
    $table->string('blood_type', 5)->nullable();
    $table->text('allergy_history')->nullable();
    $table->timestamps();
    $table->softDeletes();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
