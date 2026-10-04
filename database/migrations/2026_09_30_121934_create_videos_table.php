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
        Schema::create('videos', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('kategori');
            $table->string('youtube_id');
            $table->string('durasi')->nullable()->default('10:00');
            $table->string('thumbnail')->nullable();
            $table->text('deskripsi')->nullable();
            $table->boolean('is_hero_slider')->default(false); // Untuk 4 slide show teratas
            $table->boolean('is_featured')->default(false);    // Untuk video utama terpilih
            $table->integer('urutan')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('videos');
    }
};
