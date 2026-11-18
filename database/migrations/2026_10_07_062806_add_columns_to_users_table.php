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
        Schema::table('users', function (Blueprint $table) {
            if (! Schema::hasColumn('users', 'no_hp')) {
                $table->string('no_hp')->nullable()->after('email');
            }
            if (! Schema::hasColumn('users', 'tanggal_lahir')) {
                $table->date('tanggal_lahir')->nullable()->after('no_hp');
            }
            if (! Schema::hasColumn('users', 'usia')) {
                $table->unsignedSmallInteger('usia')->nullable()->after('tanggal_lahir');
            }
            if (! Schema::hasColumn('users', 'nama_orang_tua')) {
                $table->string('nama_orang_tua')->nullable()->after('usia');
            }
            if (! Schema::hasColumn('users', 'alamat')) {
                $table->text('alamat')->nullable()->after('nama_orang_tua');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $columnsToDrop = [];
            foreach (['tanggal_lahir', 'usia', 'nama_orang_tua', 'alamat'] as $col) {
                if (Schema::hasColumn('users', $col)) {
                    $columnsToDrop[] = $col;
                }
            }
            if (! empty($columnsToDrop)) {
                $table->dropColumn($columnsToDrop);
            }
        });
    }
};
