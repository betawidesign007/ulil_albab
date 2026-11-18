<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PpdbExamResult extends Model
{
    protected $fillable = [
        'ppdb_registration_id',
        'no_pendaftaran',
        'nama_santri',
        'jenjang',
        'total_soal',
        'jawaban_benar',
        'jawaban_salah',
        'jawaban_kosong',
        'nilai',
        'status_kelulusan',
        'catatan_admin',
        'dinilai_oleh',
        'detail_jawaban',
        'waktu_mulai',
        'waktu_selesai',
        'durasi_menit',
    ];

    protected function casts(): array
    {
        return [
            'detail_jawaban' => 'array',
            'waktu_mulai' => 'datetime',
            'waktu_selesai' => 'datetime',
            'nilai' => 'decimal:2',
            'total_soal' => 'integer',
            'jawaban_benar' => 'integer',
            'jawaban_salah' => 'integer',
            'jawaban_kosong' => 'integer',
            'durasi_menit' => 'integer',
        ];
    }

    public function registration(): BelongsTo
    {
        return $this->belongsTo(PpdbRegistration::class, 'ppdb_registration_id');
    }

    public function penilai(): BelongsTo
    {
        return $this->belongsTo(User::class, 'dinilai_oleh');
    }

    public function getStatusBadgeClassAttribute(): string
    {
        return match ($this->status_kelulusan) {
            'Lulus' => 'bg-success text-white',
            'Dipertimbangkan' => 'bg-warning text-dark',
            'Tidak Lulus' => 'bg-danger text-white',
            default => 'bg-info text-dark',
        };
    }
}
