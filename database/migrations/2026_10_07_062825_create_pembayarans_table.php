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
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->id();
            $table->string('kode_transaksi')->unique();
            $table->foreignId('santri_id')->constrained('santris')->cascadeOnDelete();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('kategori_pembayaran');
            $table->string('bulan_dibayar')->nullable();
            $table->string('tahun_dibayar')->nullable();
            $table->decimal('jumlah', 14, 2);
            $table->date('tanggal_pembayaran');
            $table->string('metode_pembayaran')->default('Tunai'); // Tunai, Transfer Bank, QRIS
            $table->string('status')->default('Lunas'); // Lunas, Pending, Batal
            $table->string('bukti_bayar')->nullable();
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayarans');
    }
};
