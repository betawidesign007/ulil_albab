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
            $table->string('sambutan_pengasuh_foto')->nullable()->after('sambutan_pengasuh_teks');
            $table->string('sejarah_foto')->nullable()->after('sejarah_singkat');
            $table->string('visi_misi_foto')->nullable()->after('standar_kelulusan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ppdb_settings', function (Blueprint $table) {
            $table->dropColumn([
                'sambutan_pengasuh_foto',
                'sejarah_foto',
                'visi_misi_foto',
            ]);
        });
    }
};
