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
        Schema::create('jadwal_pelajarans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('hari'); // Senin, Selasa, Rabu, Kamis, Jumat, Sabtu, Ahad
            $table->string('jam_mulai'); // 07:30
            $table->string('jam_selesai'); // 09:00
            $table->string('mata_pelajaran');
            $table->string('kelas');
            $table->string('ruangan')->default('Ruang Kelas');
            $table->string('tahun_ajaran')->default('2026/2027');
            $table->string('semester')->default('Ganjil');

            // Konsep Acuan Kerja & Ketercapaian Kurikulum
            $table->string('kitab_referensi')->nullable();
            $table->text('target_capaian')->nullable();
            $table->string('metode_pembelajaran')->nullable();
            $table->text('silabus_ringkas')->nullable();
            $table->string('status_pelaksanaan')->default('aktif'); // aktif, tuntas, diganti, kendala
            $table->text('jurnal_terakhir')->nullable();
            $table->timestamp('jurnal_updated_at')->nullable();

            // Supervisi & Kontrol Mudir / Pemilik
            $table->text('catatan_supervisi')->nullable();
            $table->string('status_verifikasi')->default('disetujui_mudir'); // disetujui_mudir, menunggu_verifikasi, perlu_revisi
            $table->foreignId('supervisi_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('supervisi_at')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_pelajarans');
    }
};
