<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('students', function (Blueprint $table) {
            $table->date('birth_date')->nullable()->change();
            $table->foreignId('classroom_id')->nullable()->change();
        });

        Schema::table('sipintu_sync_logs', function (Blueprint $table) {
            $table->json('warnings')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('sipintu_sync_logs', function (Blueprint $table) {
            $table->dropColumn('warnings');
        });

        Schema::table('students', function (Blueprint $table) {
            $table->date('birth_date')->nullable(false)->change();
            $table->foreignId('classroom_id')->nullable(false)->change();
        });
    }
};