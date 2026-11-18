<?php

namespace Database\Seeders;

use App\Models\Pembayaran;
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
                'tanggal_lahir' => '1992-05-14',
                'usia' => 34,
                'nama_orang_tua' => 'H. Ahmad Marzuqi',
                'alamat' => 'Komplek Pondok Pesantren Li Ulil Albab',
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
                'tanggal_lahir' => '1995-09-20',
                'usia' => 31,
                'nama_orang_tua' => 'Drs. H. Miftahurrahman',
                'alamat' => 'Perumahan As-Salam Blok C-12',
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
                'tanggal_lahir' => '1970-03-10',
                'usia' => 56,
                'nama_orang_tua' => 'KH. Muhammad Hasan',
                'alamat' => 'Ndalam Pimpinan Pondok Pesantren Li Ulil Albab',
            ]
        );

        // 4. Sample Santri jika belum ada atau update
        $sampleSantris = [
            [
                'nis' => '2026001',
                'nama_lengkap' => 'Muhammad Al-Fatih Pratama',
                'jenis_kelamin' => 'Laki-laki',
                'tempat_lahir' => 'Surabaya',
                'tanggal_lahir' => '2010-04-12',
                'usia' => 16,
                'nama_orang_tua' => 'Bambang Supriyanto',
                'no_hp' => '081233445566',
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
                'usia' => 17,
                'nama_orang_tua' => 'H. Hendra Gunawan',
                'no_hp' => '081299887766',
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
                'usia' => 18,
                'nama_orang_tua' => 'H. Ridwan Mansyur',
                'no_hp' => '081344556677',
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
                'usia' => 17,
                'nama_orang_tua' => 'Drs. Suherman',
                'no_hp' => '081277889900',
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
                'usia' => 19,
                'nama_orang_tua' => 'Agus Wahyudi',
                'no_hp' => '081388991122',
                'kamar' => 'Al-Ghazali',
                'kelas' => '3 Aliyah',
                'alamat' => 'Jl. Pahlawan No. 77, Sidoarjo',
            ],
        ];

        foreach ($sampleSantris as $santri) {
            Santri::updateOrCreate(['nis' => $santri['nis']], $santri);
        }

        // 5. Seed Kegiatan dan Video
        $this->call(KegiatanVideoSeeder::class);

        // 6. Seed Pengaturan PPDB Landing Page & Jadwal Acuan Kerja Asatidz
        $this->call(PpdbAndJadwalSeeder::class);

        // 7. Seed 50 Butir Soal Ujian Masuk Akademik PPDB
        $this->call(PpdbSoalSeeder::class);

        // 7. Seed Sample Transaksi Pembayaran
        if (Pembayaran::count() === 0) {
            $adminUser = User::where('role', 'admin')->first();
            $s1 = Santri::where('nis', '2026001')->first();
            $s2 = Santri::where('nis', '2026002')->first();
            $s3 = Santri::where('nis', '2026003')->first();

            if ($s1 && $adminUser) {
                Pembayaran::create([
                    'kode_transaksi' => 'TRX-202610-0001',
                    'santri_id' => $s1->id,
                    'user_id' => $adminUser->id,
                    'kategori_pembayaran' => 'Syahriah / SPP Bulanan',
                    'bulan_dibayar' => 'Oktober',
                    'tahun_dibayar' => '2026',
                    'jumlah' => 350000,
                    'tanggal_pembayaran' => '2026-10-01',
                    'metode_pembayaran' => 'Tunai',
                    'status' => 'Lunas',
                    'catatan' => 'Pembayaran SPP Syahriah bulan Oktober 2026 lunas di loket TU.',
                ]);
            }

            if ($s2 && $adminUser) {
                Pembayaran::create([
                    'kode_transaksi' => 'TRX-202610-0002',
                    'santri_id' => $s2->id,
                    'user_id' => $adminUser->id,
                    'kategori_pembayaran' => 'Uang Gedung / Pangkal',
                    'bulan_dibayar' => null,
                    'tahun_dibayar' => '2026/2027',
                    'jumlah' => 2500000,
                    'tanggal_pembayaran' => '2026-10-02',
                    'metode_pembayaran' => 'Transfer Bank',
                    'status' => 'Lunas',
                    'catatan' => 'Cicilan uang pangkal gedung tahun pertama via Bank Syariah.',
                ]);
            }

            if ($s3 && $adminUser) {
                Pembayaran::create([
                    'kode_transaksi' => 'TRX-202610-0003',
                    'santri_id' => $s3->id,
                    'user_id' => $adminUser->id,
                    'kategori_pembayaran' => 'Kitab & Modul Pelajaran',
                    'bulan_dibayar' => null,
                    'tahun_dibayar' => '2026/2027',
                    'jumlah' => 450000,
                    'tanggal_pembayaran' => '2026-10-03',
                    'metode_pembayaran' => 'QRIS',
                    'status' => 'Lunas',
                    'catatan' => 'Paket kitab kuning dan modul pembelajaran semester ganjil.',
                ]);
            }
        }
    }
}
