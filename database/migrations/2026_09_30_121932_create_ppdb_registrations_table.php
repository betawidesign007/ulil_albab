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
        Schema::create('ppdb_registrations', function (Blueprint $table) {
            $table->id();
            $table->string('no_pendaftaran')->unique();
            $table->string('nama_lengkap');
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->string('nisn')->nullable();
            $table->string('asal_sekolah')->nullable();
            $table->string('jenjang');
            $table->string('nama_wali');
            $table->string('no_wa');
            $table->string('pekerjaan_wali')->nullable();
            $table->string('pendidikan_wali')->nullable();
            $table->text('alamat');
            $table->string('jalur')->default('Reguler');
            $table->string('model_ujian')->default('Tatap Muka di Pesantren');
            $table->string('catatan_prestasi')->nullable();
            $table->string('jadwal_ujian')->nullable();
            $table->string('ruang_ujian')->nullable();
            $table->string('status')->default('Menunggu Ujian');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ppdb_registrations');
    }
};
