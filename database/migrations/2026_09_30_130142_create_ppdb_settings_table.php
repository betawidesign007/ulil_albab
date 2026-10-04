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
        Schema::create('ppdb_settings', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pesantren')->default('Pondok Pesantren Li Ulil Albab');
            $table->string('tagline_pesantren')->default('Pendidikan Islam Modern Berbasis Tahfidzul Qur\'an & Bahasa Internasional');
            $table->string('telepon')->default('(+62) 877-9910-7735');
            $table->string('email')->default('ppdb@ulilalbab.ac.id');
            $table->string('alamat')->default('Jl. Pesantren Modern No. 99, Li Ulil Albab Center');
            $table->string('status_ppdb')->default('buka'); // buka, tutup, segera
            $table->string('tahun_ajaran')->default('2026/2027');
            $table->string('gelombang_aktif')->default('Gelombang I (Jalur Prestasi Tahfidz & Reguler)');
            $table->integer('kuota_penerimaan')->default(350);
            $table->string('biaya_pendaftaran')->default('Rp 250.000');
            $table->string('tanggal_buka_pendaftaran')->default('01 Januari 2026');
            $table->string('tanggal_tutup_pendaftaran')->default('30 Mei 2026');
            $table->string('tanggal_ujian_seleksi')->default('Sabtu & Minggu, 13 - 14 Juni 2026');
            $table->string('tanggal_pengumuman')->default('20 Juni 2026');
            $table->string('tanggal_daftar_ulang')->default('25 Juni - 05 Juli 2026');
            $table->string('jam_ujian')->default('08.00 - 11.30 WIB');
            $table->string('lokasi_ujian')->default('Gedung Rektorat Lt. 2 (Ruang Al-Fatih) & Online');
            $table->longText('persyaratan_santri')->nullable();
            $table->longText('berkas_wajib')->nullable();
            $table->longText('materi_ujian')->nullable();
            $table->longText('alur_pendaftaran')->nullable();
            $table->longText('biaya_rincian')->nullable();
            $table->text('pengumuman_banner')->nullable();
            $table->string('link_brosur')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ppdb_settings');
    }
};
