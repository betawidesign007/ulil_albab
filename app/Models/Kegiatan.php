<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Kegiatan extends Model
{
    protected $fillable = [
        'judul',
        'kategori',
        'tanggal',
        'lokasi',
        'gambar',
        'deskripsi',
    ];

    protected function casts(): array
    {
        return [
            'tanggal' => 'date',
        ];
    }

    /**
     * URL Gambar Kegiatan (URL eksternal atau file upload di storage)
     */
    public function getGambarUrlAttribute(): string
    {
        if (empty($this->gambar)) {
            return 'https://images.unsplash.com/photo-1542838132-92c53300491e?auto=format&fit=crop&w=800&q=80';
        }

        if (Str::startsWith($this->gambar, ['http://', 'https://'])) {
            return $this->gambar;
        }

        if (file_exists(public_path('images/'.$this->gambar)) || file_exists(base_path('../public_html/images/'.$this->gambar)) || file_exists(base_path('../../public_html/images/'.$this->gambar))) {
            return asset('images/'.$this->gambar);
        }

        if (file_exists(public_path('storage/'.$this->gambar)) || file_exists(base_path('../public_html/storage/'.$this->gambar)) || file_exists(base_path('../../public_html/storage/'.$this->gambar))) {
            return asset('storage/'.$this->gambar);
        }

        return asset('images/'.$this->gambar);
    }

    /**
     * Label Kategori yang Rapi
     */
    public function getKategoriLabelAttribute(): string
    {
        return match ($this->kategori) {
            'tahfidz' => "Kajian & Tahfidz Al-Qur'an",
            'phbi' => 'Hari Besar & Maulid',
            'ekskul' => 'Bahasa & Ekstrakurikuler',
            'sosial' => 'Sosial & Kemandirian',
            default => ucfirst($this->kategori),
        };
    }
}
