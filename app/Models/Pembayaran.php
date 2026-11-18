<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pembayaran extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_transaksi',
        'santri_id',
        'user_id',
        'kategori_pembayaran',
        'bulan_dibayar',
        'tahun_dibayar',
        'jumlah',
        'tanggal_pembayaran',
        'metode_pembayaran',
        'status',
        'bukti_bayar',
        'catatan',
    ];

    /**
     * The attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'tanggal_pembayaran' => 'date',
            'jumlah' => 'decimal:2',
        ];
    }

    /**
     * Relasi ke data Santri.
     */
    public function santri(): BelongsTo
    {
        return $this->belongsTo(Santri::class, 'santri_id');
    }

    /**
     * Relasi ke Petugas / Admin yang memproses pembayaran.
     */
    public function petugas(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Badge status pembayaran
     */
    public function getStatusBadgeClassAttribute(): string
    {
        return match ($this->status) {
            'Lunas' => 'bg-success',
            'Pending' => 'bg-warning text-dark',
            'Batal' => 'bg-danger',
            default => 'bg-secondary',
        };
    }

    /**
     * Format Rupiah untuk nominal pembayaran
     */
    public function getRupiahAttribute(): string
    {
        return 'Rp '.number_format((float) $this->jumlah, 0, ',', '.');
    }

    /**
     * Generate otomatis nomor/kode transaksi unik
     * Format: TRX-YYYYMM-XXXX (contoh: TRX-202610-0001)
     */
    public static function generateKodeTransaksi(): string
    {
        $prefix = 'TRX-'.date('Ym').'-';
        $latest = static::where('kode_transaksi', 'like', "{$prefix}%")
            ->orderBy('id', 'desc')
            ->value('kode_transaksi');

        if ($latest) {
            $number = (int) substr($latest, strrpos($latest, '-') + 1);
            $nextNumber = str_pad((string) ($number + 1), 4, '0', STR_PAD_LEFT);
        } else {
            $nextNumber = '0001';
        }

        return $prefix.$nextNumber;
    }
}
