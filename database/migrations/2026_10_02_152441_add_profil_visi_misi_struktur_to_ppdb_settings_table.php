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
        Schema::table('ppdb_settings', function (Blueprint $table) {
            // Profil & Sejarah
            $table->string('sambutan_pengasuh_nama')->nullable();
            $table->string('sambutan_pengasuh_jabatan')->nullable();
            $table->string('sambutan_pengasuh_quote')->nullable();
            $table->longText('sambutan_pengasuh_teks')->nullable();
            $table->longText('sejarah_singkat')->nullable();
            $table->longText('filosofi_nama')->nullable();
            $table->longText('sarana_prasarana')->nullable();

            // Visi & Misi
            $table->longText('visi_pesantren')->nullable();
            $table->longText('misi_pesantren')->nullable();
            $table->string('motto_pesantren')->nullable();
            $table->longText('standar_kelulusan')->nullable();

            // Struktur Kepengurusan
            $table->longText('struktur_organisasi')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ppdb_settings', function (Blueprint $table) {
            $table->dropColumn([
                'sambutan_pengasuh_nama',
                'sambutan_pengasuh_jabatan',
                'sambutan_pengasuh_quote',
                'sambutan_pengasuh_teks',
                'sejarah_singkat',
                'filosofi_nama',
                'sarana_prasarana',
                'visi_pesantren',
                'misi_pesantren',
                'motto_pesantren',
                'standar_kelulusan',
                'struktur_organisasi',
            ]);
        });
    }
};
