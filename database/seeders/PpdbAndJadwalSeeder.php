<?php

namespace Database\Seeders;

use App\Models\JadwalPelajaran;
use App\Models\PpdbSetting;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PpdbAndJadwalSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Inisialisasi PpdbSetting
        PpdbSetting::getActive();

        // 2. Tambahan Dewan Pengajar jika belum ada
        $ustNurul = User::where('email', 'pengajar@ulilalbab.ac.id')->first();
        if (! $ustNurul) {
            $ustNurul = User::create([
                'name' => 'Ustadzah Nurul Hidayah, Lc',
                'email' => 'pengajar@ulilalbab.ac.id',
                'password' => Hash::make('password123'),
                'role' => 'pengajar',
                'no_hp' => '081234567891',
                'jabatan' => 'Koordinator Tahfidz & Pengajar Bahasa Arab',
            ]);
        }

        $ustSyauqi = User::updateOrCreate(
            ['email' => 'syauqi@ulilalbab.ac.id'],
            [
                'name' => 'Ustadz Ahmad Syauqi, M.Pd',
                'password' => Hash::make('password123'),
                'role' => 'pengajar',
                'no_hp' => '081399887766',
                'jabatan' => 'Guru Pengampu Gramatika Arab (Nahwu-Sharaf)',
            ]
        );

        $ustSalman = User::updateOrCreate(
            ['email' => 'salman@ulilalbab.ac.id'],
            [
                'name' => 'Ustadz Salman Al-Farisi, S.Pd.I',
                'password' => Hash::make('password123'),
                'role' => 'pengajar',
                'no_hp' => '081255443322',
                'jabatan' => 'Guru Pengampu Fikih & Hadits Nabawi',
            ]
        );

        $pemilik = User::where('role', 'pemilik')->first();

        // 3. Inisialisasi Jadwal Mata Pelajaran & Acuan Kerja
        if (JadwalPelajaran::count() === 0) {
            $jadwals = [
                [
                    'user_id' => $ustNurul->id,
                    'hari' => 'Senin',
                    'jam_mulai' => '07:30',
                    'jam_selesai' => '09:00',
                    'mata_pelajaran' => 'Tahfidzul Qur\'an & Tahsin Terpadu',
                    'kelas' => 'VII-A MTs',
                    'ruangan' => 'Masjid Utama Lt. 1',
                    'tahun_ajaran' => '2026/2027',
                    'semester' => 'Ganjil',
                    'kitab_referensi' => 'Mushaf Al-Madinah & Matan Tuhfatul Athfal',
                    'target_capaian' => 'Santri mampu menuntaskan setoran hafalan Juz 30 dengan makharijul huruf tepat dan hukum tajwid mutqin.',
                    'metode_pembelajaran' => 'Talaqqi, Musyafahah, dan Tasmi\' berpasangan',
                    'silabus_ringkas' => 'Pekan 1-4: An-Naba s.d Al-Muthaffifin; Pekan 5-8: Al-Insyiqaq s.d Al-Balad; Pekan 9-14: Asy-Syams s.d An-Nas & Muroja\'ah kubro.',
                    'status_pelaksanaan' => 'aktif',
                    'jurnal_terakhir' => 'Alhamdulillah setoran hafalan QS. An-Naba ayat 1-20 tuntas dengan tajwid baik. Perlu penguatan mad wajib muttashil untuk 3 santri.',
                    'jurnal_updated_at' => now()->subDays(1),
                    'catatan_supervisi' => 'Target hafalan berjalan sangat baik. Harap pertahankan ketelitian tajwid santri putra.',
                    'status_verifikasi' => 'disetujui_mudir',
                    'supervisi_by' => $pemilik?->id,
                    'supervisi_at' => now()->subDays(1),
                ],
                [
                    'user_id' => $ustSyauqi->id,
                    'hari' => 'Senin',
                    'jam_mulai' => '09:30',
                    'jam_selesai' => '11:00',
                    'mata_pelajaran' => 'Ilmu Nahwu Dasar',
                    'kelas' => 'VII-A MTs',
                    'ruangan' => 'Kelas VII-A (Gedung Umar bin Khattab)',
                    'tahun_ajaran' => '2026/2027',
                    'semester' => 'Ganjil',
                    'kitab_referensi' => 'Matan Al-Jurumiyyah (Syaikh Ash-Shonhaji)',
                    'target_capaian' => 'Santri memahami konsep kalam, pembagian isim-fi\'il-huruf, serta tanda-tanda I\'rob rofa\' (dhommah, wawu, alif, nun).',
                    'metode_pembelajaran' => 'Bandongan, Sorogan Matan, dan Latihan I\'rob di papan tulis',
                    'silabus_ringkas' => 'Bab Kalam, Bab I\'rob, Bab Ma\'rifah \'Alamatil I\'rob, Bab Al-Af\'al (Madi, Mudhari, Amr), dan praktek bedah ayat.',
                    'status_pelaksanaan' => 'aktif',
                    'jurnal_terakhir' => 'Pembahasan Bab Al-Kalam dan tanda-tanda isim (tanwin, alif lam, huruf khofadh). Seluruh santri mencatat matan dengan rapi.',
                    'jurnal_updated_at' => now()->subDays(2),
                    'catatan_supervisi' => 'Metode sorogan efektif. Tambahkan latihan soal terapan agar santri terbiasa membaca kitab kuning.',
                    'status_verifikasi' => 'disetujui_mudir',
                    'supervisi_by' => $pemilik?->id,
                    'supervisi_at' => now()->subDays(2),
                ],
                [
                    'user_id' => $ustSalman->id,
                    'hari' => 'Selasa',
                    'jam_mulai' => '07:30',
                    'jam_selesai' => '09:00',
                    'mata_pelajaran' => 'Fikih Ibadah Praktis',
                    'kelas' => 'VIII-B MTs',
                    'ruangan' => 'Ruang Kelas VIII-B',
                    'tahun_ajaran' => '2026/2027',
                    'semester' => 'Ganjil',
                    'kitab_referensi' => 'Fathul Qorib Al-Mujib (Ibnu Qasim Al-Ghazi)',
                    'target_capaian' => 'Penguasaan bab Thaharah (wudhu, tayamum, mandi wajib, najis) dan kaifiyat shalat fardhu & sunnah muakkad secara amaliyah.',
                    'metode_pembelajaran' => 'Kajian Kitab Kuning, Diskusi Masa\'il, dan Praktik Ibadah di Masjid',
                    'silabus_ringkas' => 'Kitab Thaharah, Macam-macam Air, Najis & Cara Menyucikannya, Kaifiyat Shalat Berjamaah, Sujud Sahwi & Tilawah.',
                    'status_pelaksanaan' => 'aktif',
                    'jurnal_terakhir' => 'Praktik wudhu sempurna sesuai sunnah Rasulullah SAW di tempat wudhu asrama. Santri mempraktikkan satu per satu.',
                    'jurnal_updated_at' => now()->subDays(3),
                    'catatan_supervisi' => 'Pendekatan amaliyah sudah sesuai kurikulum kepesantrenan. Dilanjutkan materi shalat jenazah.',
                    'status_verifikasi' => 'disetujui_mudir',
                    'supervisi_by' => $pemilik?->id,
                    'supervisi_at' => now()->subDays(3),
                ],
                [
                    'user_id' => $ustNurul->id,
                    'hari' => 'Selasa',
                    'jam_mulai' => '09:30',
                    'jam_selesai' => '11:00',
                    'mata_pelajaran' => 'Bahasa Arab (Muhadatsah & Durusul Lughah)',
                    'kelas' => 'VIII-A MTs',
                    'ruangan' => 'Laboratorium Bahasa Arab',
                    'tahun_ajaran' => '2026/2027',
                    'semester' => 'Ganjil',
                    'kitab_referensi' => 'Durusul Lughah Al-\'Arabiyyah Juz 1 (Dr. V. Abdur Rahim)',
                    'target_capaian' => 'Santri terbiasa berbicara bahasa Arab fush-ha sehari-hari di lingkungan asrama dan menguasai minimal 250 mufrodat tematik.',
                    'metode_pembelajaran' => 'Direct Method (Thoriqoh Mubasyirah), Hiwar Interaktif, Roleplay Percakapan',
                    'silabus_ringkas' => 'Ad-Darsul Awwal s.d Ad-Darsul '."'Asyir, simulasi percakapan di asrama, kelas, perpustakaan, dan kantin.",
                    'status_pelaksanaan' => 'aktif',
                    'jurnal_terakhir' => 'Hiwar tema "Fi Gurfatil Julus wa Maktabah". Santri mempraktikkan dialog berpasangan di depan kelas tanpa teks.',
                    'jurnal_updated_at' => now()->subDays(2),
                    'catatan_supervisi' => 'Kreatif dan hidup. Pantau santri yang masih pasif dalam berbicara.',
                    'status_verifikasi' => 'disetujui_mudir',
                    'supervisi_by' => $pemilik?->id,
                    'supervisi_at' => now()->subDays(1),
                ],
                [
                    'user_id' => $ustSalman->id,
                    'hari' => 'Rabu',
                    'jam_mulai' => '07:30',
                    'jam_selesai' => '09:00',
                    'mata_pelajaran' => 'Hadits Nabawi & Akhlaq',
                    'kelas' => 'IX MTs',
                    'ruangan' => 'Aula Utama Abu Bakar',
                    'tahun_ajaran' => '2026/2027',
                    'semester' => 'Ganjil',
                    'kitab_referensi' => 'Al-Arba\'un An-Nawawiyyah & Taisirul Khalaq',
                    'target_capaian' => 'Hafalan 20 Hadits Arba\'in beserta syarah ringkas serta implementasi adab penuntut ilmu dalam kehidupan asrama.',
                    'metode_pembelajaran' => 'Hafalan Sanad & Matan, Syarah Hadits, Studi Kasus Akhlaq Santri',
                    'silabus_ringkas' => 'Hadits 1 (Innamal a\'malu binniyat) s.d Hadits 20 (Al-Haya\'u minal iman), pembacaan biografi perawi hadits.',
                    'status_pelaksanaan' => 'aktif',
                    'jurnal_terakhir' => 'Pengkajian Hadits Ke-2 (Hadits Jibril tentang Islam, Iman, dan Ihsan). Seluruh santri menyetorkan hafalan matan.',
                    'jurnal_updated_at' => now()->subDays(4),
                    'catatan_supervisi' => 'Target hafalan hadits sesuai rencana kerja. Bagus.',
                    'status_verifikasi' => 'disetujui_mudir',
                    'supervisi_by' => $pemilik?->id,
                    'supervisi_at' => now()->subDays(3),
                ],
                [
                    'user_id' => $ustSyauqi->id,
                    'hari' => 'Kamis',
                    'jam_mulai' => '07:30',
                    'jam_selesai' => '09:00',
                    'mata_pelajaran' => 'Sharaf & Tashrif Lughawi / Istilahi',
                    'kelas' => 'X MA Unggulan',
                    'ruangan' => 'Ruang X-Aliyah 1',
                    'tahun_ajaran' => '2026/2027',
                    'semester' => 'Ganjil',
                    'kitab_referensi' => 'Al-Amtsilah At-Tashrifiyyah (KH. Ma\'shum Ali)',
                    'target_capaian' => 'Menguasai wazan Tsulatsi Mujarrad (Bab 1 s.d 6) beserta shighat bina\' (Shohih, Misal, Ajwaf, Naqish, Lafif, Mudho\'af).',
                    'metode_pembelajaran' => 'Drill Tashrif Irama, Pembagian Tabel Morfologi Arab, Kuis Cepat',
                    'silabus_ringkas' => 'Wazan Fa\'ala-Yaf\'ulu s.d Fa\'ula-Yaf\'ulu, Tashrif Istilahi 22 shighat, dan Tashrif Lughawi 14 dhomir.',
                    'status_pelaksanaan' => 'aktif',
                    'jurnal_terakhir' => 'Drill Tashrif Bab 1 Fa\'ala Yaf\'ulu Nashoro Yanshuru. Santri mampu melafalkan dengan irama pesantren serentak.',
                    'jurnal_updated_at' => now()->subDays(3),
                    'catatan_supervisi' => 'Pertahankan kedisiplinan hafalan tashrif. Ini pondasi utama membaca kitab kuning.',
                    'status_verifikasi' => 'disetujui_mudir',
                    'supervisi_by' => $pemilik?->id,
                    'supervisi_at' => now()->subDays(2),
                ],
                [
                    'user_id' => $ustNurul->id,
                    'hari' => 'Sabtu',
                    'jam_mulai' => '08:00',
                    'jam_selesai' => '10:00',
                    'mata_pelajaran' => 'Takhasus Tahfidz Al-Qur\'an 30 Juz',
                    'kelas' => 'Takhasus Tahfidz Aliyah',
                    'ruangan' => 'Saung Tahfidz Putri & Selasar Masjid',
                    'tahun_ajaran' => '2026/2027',
                    'semester' => 'Ganjil',
                    'kitab_referensi' => 'Mushaf Al-Qur\'an Rasm Utsmani',
                    'target_capaian' => 'Sabaq (hafalan baru) 1 halaman/hari, Sabqi (hafalan kemarin) 5 halaman, dan Manzil (muroja\'ah berkala) 1 juz/hari.',
                    'metode_pembelajaran' => 'Sistem Mudarosah & Tasmi\' bil Ghoib',
                    'silabus_ringkas' => 'Target capaian minimal 5 Juz baru dalam 1 semester dan kelulusan tasmi\' 5 Juz sekali duduk.',
                    'status_pelaksanaan' => 'aktif',
                    'jurnal_terakhir' => 'Ujian tasmi\' 3 santriwati tuntas 2 juz sekali duduk. Hasil sangat memuaskan, nilai rata-rata 92.',
                    'jurnal_updated_at' => now(),
                    'catatan_supervisi' => 'Luar biasa capaian takhasus tahfidz. Mohon dipersiapkan untuk seleksi MTQ tingkat Kabupaten.',
                    'status_verifikasi' => 'disetujui_mudir',
                    'supervisi_by' => $pemilik?->id,
                    'supervisi_at' => now(),
                ],
            ];

            foreach ($jadwals as $jadwal) {
                JadwalPelajaran::create($jadwal);
            }
        }
    }
}
