<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JadwalPelajaran extends Model
{
    protected $fillable = [
        'user_id',
        'hari',
        'jam_mulai',
        'jam_selesai',
        'mata_pelajaran',
        'kelas',
        'ruangan',
        'tahun_ajaran',
        'semester',
        'kitab_referensi',
        'target_capaian',
        'metode_pembelajaran',
        'silabus_ringkas',
        'status_pelaksanaan',
        'jurnal_terakhir',
        'jurnal_updated_at',
        'catatan_supervisi',
        'status_verifikasi',
        'supervisi_by',
        'supervisi_at',
    ];

    protected function casts(): array
    {
        return [
            'jurnal_updated_at' => 'datetime',
            'supervisi_at' => 'datetime',
        ];
    }

    /**
     * Relasi ke Ustadz / Pengajar
     */
    public function pengajar(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Relasi ke Mudir / Pemilik yang melakukan supervisi
     */
    public function supervisor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'supervisi_by');
    }

    /**
     * Scope Filter
     */
    public function scopeHari(Builder $query, ?string $hari): Builder
    {
        if ($hari) {
            return $query->where('hari', $hari);
        }

        return $query;
    }

    public function scopeKelas(Builder $query, ?string $kelas): Builder
    {
        if ($kelas) {
            return $query->where('kelas', $kelas);
        }

        return $query;
    }

    public function scopePengajar(Builder $query, ?int $userId): Builder
    {
        if ($userId) {
            return $query->where('user_id', $userId);
        }

        return $query;
    }

    /**
     * Rentang Jam Belajar
     */
    public function getJamRentangAttribute(): string
    {
        return "{$this->jam_mulai} - {$this->jam_selesai} WIB";
    }

    /**
     * Urutan Hari untuk Sorting
     */
    public function getHariUrutanAttribute(): int
    {
        return match ($this->hari) {
            'Senin' => 1,
            'Selasa' => 2,
            'Rabu' => 3,
            'Kamis' => 4,
            'Jumat' => 5,
            'Sabtu' => 6,
            'Ahad' => 7,
            default => 8,
        };
    }

    /**
     * Badge Status Pelaksanaan Acuan Kerja
     */
    public function getStatusBadgeAttribute(): string
    {
        return match ($this->status_pelaksanaan) {
            'aktif' => 'bg-primary text-white',
            'tuntas' => 'bg-success text-white',
            'diganti' => 'bg-warning text-dark',
            'kendala' => 'bg-danger text-white',
            default => 'bg-secondary text-white',
        };
    }

    public function getStatusLabelAttribute(): string
    {
        return match ($this->status_pelaksanaan) {
            'aktif' => 'Berjalan Sesuai Jadwal',
            'tuntas' => 'Materi Selesai / Tuntas',
            'diganti' => 'Jadwal Pengganti (Inval)',
            'kendala' => 'Terkendala / Perlu Penyesuaian',
            default => ucfirst($this->status_pelaksanaan),
        };
    }

    /**
     * Badge Verifikasi Supervisi Mudir/Pemilik
     */
    public function getVerifikasiBadgeAttribute(): string
    {
        return match ($this->status_verifikasi) {
            'disetujui_mudir' => 'bg-success text-white',
            'menunggu_verifikasi' => 'bg-warning text-dark',
            'perlu_revisi' => 'bg-danger text-white',
            default => 'bg-secondary text-white',
        };
    }

    public function getVerifikasiLabelAttribute(): string
    {
        return match ($this->status_verifikasi) {
            'disetujui_mudir' => 'Disetujui Mudir / Sesuai Target',
            'menunggu_verifikasi' => 'Menunggu Evaluasi Mudir',
            'perlu_revisi' => 'Perlu Evaluasi & Revisi Acuan',
            default => ucfirst(str_replace('_', ' ', $this->status_verifikasi)),
        };
    }
}
