<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Santri extends Model
{
    protected $fillable = [
        'nis',
        'nama_lengkap',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'usia',
        'nama_orang_tua',
        'no_hp',
        'kamar',
        'kelas',
        'alamat',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'tanggal_lahir' => 'date',
            'usia' => 'integer',
        ];
    }

    /**
     * Get the calculated age if usia is not explicitly stored.
     */
    public function getUsiaAttribute(?int $value): ?int
    {
        if ($value !== null) {
            return $value;
        }

        if ($this->tanggal_lahir) {
            return Carbon::parse($this->tanggal_lahir)->age;
        }

        return null;
    }

    /**
     * Riwayat transaksi pembayaran santri ini.
     */
    public function pembayarans(): HasMany
    {
        return $this->hasMany(Pembayaran::class, 'santri_id')->latest();
    }
}
