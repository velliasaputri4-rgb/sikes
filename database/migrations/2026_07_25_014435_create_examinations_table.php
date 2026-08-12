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
        Schema::create('examinations', function (Blueprint $table) {
            $table->id();
            $table->string('examination_number', 30)->unique(); // UKS-20260725-0001
            $table->foreignId('student_id')->constrained()->cascadeOnDelete();
            
            // Informasi Petugas
            $table->string('piket_group', 50)->nullable();
            $table->string('officer_name', 100);
            
            $table->date('examination_date');
            $table->time('arrival_time');
            $table->time('finish_time')->nullable();
            
            $table->text('complaint');
            $table->decimal('temperature', 4, 1)->nullable();
            $table->string('blood_pressure', 20)->nullable();
            $table->integer('pulse')->nullable();
            $table->decimal('weight', 5, 2)->nullable();
            $table->decimal('height', 5, 2)->nullable();
            $table->decimal('bmi', 5, 2)->nullable();
            
            $table->text('diagnosis');
            $table->string('medicine')->nullable();
            $table->text('notes')->nullable();
            
            $table->enum('status', ['rawat_jalan', 'istirahat_uks', 'pulang', 'rujuk_puskesmas', 'rujuk_rs', 'hubungi_ortu'])->default('pulang');
            
            $table->string('photo')->nullable();
            $table->string('qr_token', 64)->unique();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('examinations');
    }
};