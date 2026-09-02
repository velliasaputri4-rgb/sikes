<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('documentations', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('excerpt')->nullable()->comment('Ringkasan singkat');
            $table->string('image')->nullable()->comment('Path gambar thumbnail');
            $table->string('video_link')->nullable()->comment('Link video (YouTube/Drive/dll)');
            $table->date('published_at');
            $table->boolean('is_published')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('documentations');
    }
};