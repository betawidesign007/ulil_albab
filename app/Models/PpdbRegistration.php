<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PpdbRegistration extends Model
{
    protected $fillable = [
        'no_pendaftaran',
        'nama_lengkap',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'nisn',
        'asal_sekolah',
        'jenjang',
        'nama_wali',
        'no_wa',
        'pekerjaan_wali',
        'pendidikan_wali',
        'alamat',
        'jalur',
        'model_ujian',
        'catatan_prestasi',
        'jadwal_ujian',
        'ruang_ujian',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_lahir' => 'date',
        ];
    }
}
