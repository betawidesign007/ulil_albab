<?php

namespace Database\Seeders;

use App\Models\Santri;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Akun Admin
        User::updateOrCreate(
            ['email' => 'admin@ulilalbab.ac.id'],
            [
                'name' => 'Ustadz M. Faruq, S.Kom',
                'password' => Hash::make('password123'),
                'role' => 'admin',
                'no_hp' => '081234567890',
                'jabatan' => 'Kepala Tata Usaha & IT',
            ]
        );

        // 2. Akun Pengajar (Ustadz/Guru)
        User::updateOrCreate(
            ['email' => 'pengajar@ulilalbab.ac.id'],
            [
                'name' => 'Ustadzah Nurul Hidayah, Lc',
                'password' => Hash::make('password123'),
                'role' => 'pengajar',
                'no_hp' => '081234567891',
                'jabatan' => 'Dewan Asatidz & Bimbingan Tahfidz',
            ]
        );

        // 3. Akun Pemilik (Mudir / Yayasan)
        User::updateOrCreate(
            ['email' => 'pemilik@ulilalbab.ac.id'],
            [
                'name' => 'KH. Dr. Abdullah Syukri, M.Ag',
                'password' => Hash::make('password123'),
                'role' => 'pemilik',
                'no_hp' => '081234567892',
                'jabatan' => 'Pengasuh & Pimpinan Pondok Pesantren',
            ]
        );

        // 4. Sample Santri jika belum ada
        if (Santri::count() < 4) {
            $sampleSantris = [
                [
                    'nis' => '2026001',
                    'nama_lengkap' => 'Muhammad Al-Fatih Pratama',
                    'jenis_kelamin' => 'Laki-laki',
                    'tempat_lahir' => 'Surabaya',
                    'tanggal_lahir' => '2010-04-12',
                    'kamar' => 'Al-Ghazali',
                    'kelas' => '1 Tsanawiyah',
                    'alamat' => 'Jl. Ketintang Baru No. 12, Surabaya',
                ],
                [
                    'nis' => '2026002',
                    'nama_lengkap' => 'Aisyah Putri Azzahra',
                    'jenis_kelamin' => 'Perempuan',
                    'tempat_lahir' => 'Malang',
                    'tanggal_lahir' => '2009-08-25',
                    'kamar' => 'Aisyah',
                    'kelas' => '2 Tsanawiyah',
                    'alamat' => 'Jl. Ijen No. 45, Malang',
                ],
                [
                    'nis' => '2026003',
                    'nama_lengkap' => 'Ahmad Zaki Mubarak',
                    'jenis_kelamin' => 'Laki-laki',
                    'tempat_lahir' => 'Jombang',
                    'tanggal_lahir' => '2008-01-18',
                    'kamar' => 'Ali bin Abi Thalib',
                    'kelas' => '1 Aliyah',
                    'alamat' => 'Jl. Merdeka No. 8, Jombang',
                ],
                [
                    'nis' => '2026004',
                    'nama_lengkap' => 'Fatimah Az-Zahra Ramadhani',
                    'jenis_kelamin' => 'Perempuan',
                    'tempat_lahir' => 'Gresik',
                    'tanggal_lahir' => '2008-11-03',
                    'kamar' => 'Fatimah',
                    'kelas' => '2 Aliyah',
                    'alamat' => 'Jl. Veteran No. 19, Gresik',
                ],
                [
                    'nis' => '2026005',
                    'nama_lengkap' => 'Rizky Rayhan Maulana',
                    'jenis_kelamin' => 'Laki-laki',
                    'tempat_lahir' => 'Sidoarjo',
                    'tanggal_lahir' => '2007-06-15',
                    'kamar' => 'Al-Ghazali',
                    'kelas' => '3 Aliyah',
                    'alamat' => 'Jl. Pahlawan No. 77, Sidoarjo',
                ],
            ];

            foreach ($sampleSantris as $santri) {
                Santri::updateOrCreate(['nis' => $santri['nis']], $santri);
            }
        }

        // 5. Seed Kegiatan dan Video
        $this->call(KegiatanVideoSeeder::class);

        // 6. Seed Pengaturan PPDB Landing Page & Jadwal Acuan Kerja Asatidz
        $this->call(PpdbAndJadwalSeeder::class);
    }
}
