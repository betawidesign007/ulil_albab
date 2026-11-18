<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class PpdbSoal extends Model
{
    protected $fillable = [
        'nomor_urut',
        'kategori',
        'pertanyaan',
        'opsi_a',
        'opsi_b',
        'opsi_c',
        'opsi_d',
        'kunci_jawaban',
        'bobot',
        'penjelasan',
        'is_aktif',
    ];

    protected function casts(): array
    {
        return [
            'is_aktif' => 'boolean',
            'bobot' => 'integer',
            'nomor_urut' => 'integer',
        ];
    }

    /**
     * Scope soal yang aktif saja
     */
    public function scopeAktif(Builder $query): Builder
    {
        return $query->where('is_aktif', true);
    }

    /**
     * Cek apakah jawaban peserta cocok dengan kunci
     */
    public function isJawabanBenar(?string $jawaban): bool
    {
        if ($jawaban === null || trim($jawaban) === '') {
            return false;
        }

        return strtoupper(trim($jawaban)) === strtoupper(trim($this->kunci_jawaban));
    }

    /**
     * Dapatkan teks opsi berdasarkan huruf A, B, C, D
     */
    public function getTeksOpsi(string $huruf): ?string
    {
        $h = strtoupper(trim($huruf));

        return match ($h) {
            'A' => $this->opsi_a,
            'B' => $this->opsi_b,
            'C' => $this->opsi_c,
            'D' => $this->opsi_d,
            default => null,
        };
    }
}
