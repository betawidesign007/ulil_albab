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
        Schema::create('ppdb_soals', function (Blueprint $table) {
            $table->id();
            $table->integer('nomor_urut')->default(1);
            $table->string('kategori', 100);
            $table->text('pertanyaan');
            $table->text('opsi_a');
            $table->text('opsi_b');
            $table->text('opsi_c');
            $table->text('opsi_d');
            $table->string('kunci_jawaban', 5); // A, B, C, D
            $table->integer('bobot')->default(2);
            $table->text('penjelasan')->nullable();
            $table->boolean('is_aktif')->default(true);
            $table->timestamps();
        });

        Schema::create('ppdb_exam_results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ppdb_registration_id')->constrained('ppdb_registrations')->onDelete('cascade');
            $table->string('no_pendaftaran')->index();
            $table->string('nama_santri');
            $table->string('jenjang')->nullable();
            $table->integer('total_soal')->default(50);
            $table->integer('jawaban_benar')->default(0);
            $table->integer('jawaban_salah')->default(0);
            $table->integer('jawaban_kosong')->default(0);
            $table->decimal('nilai', 5, 2)->default(0.00);
            $table->string('status_kelulusan', 50)->default('Menunggu Penilaian');
            $table->text('catatan_admin')->nullable();
            $table->foreignId('dinilai_oleh')->nullable()->constrained('users')->nullOnDelete();
            $table->longText('detail_jawaban')->nullable();
            $table->timestamp('waktu_mulai')->nullable();
            $table->timestamp('waktu_selesai')->nullable();
            $table->integer('durasi_menit')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ppdb_exam_results');
        Schema::dropIfExists('ppdb_soals');
    }
};
