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
        Schema::table('santris', function (Blueprint $table) {
            if (! Schema::hasColumn('santris', 'usia')) {
                $table->unsignedSmallInteger('usia')->nullable()->after('tanggal_lahir');
            }
            if (! Schema::hasColumn('santris', 'nama_orang_tua')) {
                $table->string('nama_orang_tua')->nullable()->after('usia');
            }
            if (! Schema::hasColumn('santris', 'no_hp')) {
                $table->string('no_hp')->nullable()->after('nama_orang_tua');
            }
            if (! Schema::hasColumn('santris', 'alamat')) {
                $table->text('alamat')->nullable()->after('no_hp');
            }
            if (! Schema::hasColumn('santris', 'tanggal_lahir')) {
                $table->date('tanggal_lahir')->nullable()->after('tempat_lahir');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('santris', function (Blueprint $table) {
            $columnsToDrop = [];
            foreach (['usia', 'nama_orang_tua', 'no_hp'] as $col) {
                if (Schema::hasColumn('santris', $col)) {
                    $columnsToDrop[] = $col;
                }
            }
            if (! empty($columnsToDrop)) {
                $table->dropColumn($columnsToDrop);
            }
        });
    }
};
