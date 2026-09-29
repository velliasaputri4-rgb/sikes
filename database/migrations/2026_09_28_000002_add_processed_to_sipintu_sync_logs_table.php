<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('sipintu_sync_logs', function (Blueprint $table) {
            $table->unsignedInteger('processed')->default(0)->after('total');
        });
    }

    public function down(): void
    {
        Schema::table('sipintu_sync_logs', function (Blueprint $table) {
            $table->dropColumn('processed');
        });
    }
};
