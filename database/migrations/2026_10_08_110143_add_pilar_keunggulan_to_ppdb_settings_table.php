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
            $table->string('pilar_keunggulan_judul')->nullable()->after('filosofi_nama');
            $table->text('pilar_keunggulan_deskripsi')->nullable()->after('pilar_keunggulan_judul');
            $table->longText('pilar_keunggulan')->nullable()->after('pilar_keunggulan_deskripsi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ppdb_settings', function (Blueprint $table) {
            $table->dropColumn([
                'pilar_keunggulan_judul',
                'pilar_keunggulan_deskripsi',
                'pilar_keunggulan',
            ]);
        });
    }
};
