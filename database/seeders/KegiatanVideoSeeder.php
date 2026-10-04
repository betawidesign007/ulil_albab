<?php

namespace Database\Seeders;

use App\Models\Kegiatan;
use App\Models\Video;
use Illuminate\Database\Seeder;

class KegiatanVideoSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Data Galeri Konten Kegiatan
        $kegiatans = [
            [
                'judul' => "Wisuda Tahfidzul Qur'an & Ujian Tasmi' 30 Juz",
                'kategori' => 'tahfidz',
                'tanggal' => '2026-05-18',
                'lokasi' => "Masjid Jami' Li Ulil Albab",
                'gambar' => 'https://images.unsplash.com/photo-1609599006353-e629aaabfeae?auto=format&fit=crop&w=800&q=80',
                'deskripsi' => "Sebanyak 75 santri putra dan putri berhasil menuntaskan ujian tasmi' Al-Qur'an 30 juz bil-ghaib sekali duduk dan menerima sanad qira'ah dari tim masyayikh. Seluruh wisudawan telah melalui ujian tasmi' bil-ghaib di hadapan dewan juri bersanad internasional. Momentum haru terjadi saat para santri menyematkan mahkota kemuliaan kepada kedua orang tua mereka.",
            ],
            [
                'judul' => "Kajian Kitab Fathul Qorib & Ihya' Ulumuddin",
                'kategori' => 'tahfidz',
                'tanggal' => '2026-05-22',
                'lokasi' => 'Selasar Utama Asrama',
                'gambar' => 'https://images.unsplash.com/photo-1542838132-92c53300491e?auto=format&fit=crop&w=800&q=80',
                'deskripsi' => "Pembacaan dan bedah kaidah fiqih madzhab Syafi'i secara bandongan dan sorogan yang dipimpin langsung oleh Mudir Pesantren KH. Dr. Abdullah Syukri, M.Ag. Kegiatan kajian kitab kuning merupakan urat nadi pendidikan salafiyah di Pondok Pesantren Li Ulil Albab.",
            ],
            [
                'judul' => 'Muhadharah Kubro & Debat Tiga Bahasa',
                'kategori' => 'ekskul',
                'tanggal' => '2026-05-27',
                'lokasi' => 'Gedung Auditorium',
                'gambar' => 'https://images.unsplash.com/photo-1577495508048-b635879837f1?auto=format&fit=crop&w=800&q=80',
                'deskripsi' => 'Asah kepemimpinan santri dalam berorasi ilmiah menggunakan bahasa Arab, Inggris, dan Indonesia di hadapan ratusan santri dan dewan asatidz. Santri dilatih berfikir kritis dan menyampaikan gagasan secara terstruktur di podium publik.',
            ],
            [
                'judul' => 'Malam Gema Shalawat & Tabligh Akbar',
                'kategori' => 'phbi',
                'tanggal' => '2026-06-01',
                'lokasi' => 'Lapangan Hijau Kampus',
                'gambar' => 'https://images.unsplash.com/photo-1564769625905-50e93615e769?auto=format&fit=crop&w=800&q=80',
                'deskripsi' => 'Lantunan qashidah shalawat Simtudduror dan Burdah bersama grup hadrah santri, dilanjutkan tausiyah kebangsaan oleh ulama tamu dari Tarim Yaman. Ribuan jamaah santri dan wali santri larut dalam kekhusyukan malam cinta Rasulullah SAW.',
            ],
            [
                'judul' => 'Santri Tech Expo: Coding & Robotika MTs-MA',
                'kategori' => 'ekskul',
                'tanggal' => '2026-06-05',
                'lokasi' => 'Lab Sains & Komputer',
                'gambar' => 'https://images.unsplash.com/photo-1531482615713-2afd69097998?auto=format&fit=crop&w=800&q=80',
                'deskripsi' => 'Pameran inovasi teknologi santri, meliputi website manajemen zakat, sensor IoT penyiram tanaman hidroponik pesantren, dan aplikasi tajwid interaktif karya santri generasi milenial.',
            ],
            [
                'judul' => 'Bakti Sosial & Layanan Kesehatan Masyarakat',
                'kategori' => 'sosial',
                'tanggal' => '2026-06-08',
                'lokasi' => 'Desa Binaan Pesantren',
                'gambar' => 'https://images.unsplash.com/photo-1593113598332-cd288d649433?auto=format&fit=crop&w=800&q=80',
                'deskripsi' => 'Santri relawan Pos Kesehatan Pesantren (Poskestren) menyalurkan 500 paket sembako dan mengadakan pemeriksaan tensi dan kesehatan gratis bagi lansia dan dhuafa di lingkungan sekitar pondok.',
            ],
        ];

        foreach ($kegiatans as $k) {
            Kegiatan::firstOrCreate(
                ['judul' => $k['judul']],
                $k
            );
        }

        // 2. Data Video Kegiatan & Slideshow 4 Video Teratas
        $videos = [
            // Video 1 (Hero Slider #1)
            [
                'judul' => 'Dokumenter 24 Jam Kehidupan Santri di Pesantren',
                'kategori' => 'Kehidupan Santri',
                'youtube_id' => 'fD3_P_V0Q3Y',
                'durasi' => '14:20',
                'thumbnail' => 'https://images.unsplash.com/photo-1542838132-92c53300491e?auto=format&fit=crop&w=800&q=80',
                'deskripsi' => "Mulai dari qiyamul lail pukul 03.30 WIB, shalat subuh berjamaah, halaqah tahfidz shubuh, sekolah formal MTs/MA, pengajian kitab kuning sore, hingga muthola'ah malam asrama.",
                'is_hero_slider' => true,
                'is_featured' => true,
                'urutan' => 1,
            ],
            // Video 2 (Hero Slider #2)
            [
                'judul' => "Murottal Syahdu & Tasmi' 30 Juz Sekali Duduk",
                'kategori' => "Tahfidz Qur'an",
                'youtube_id' => 'fD3_P_V0Q3Y',
                'durasi' => '08:45',
                'thumbnail' => 'https://images.unsplash.com/photo-1609599006353-e629aaabfeae?auto=format&fit=crop&w=800&q=80',
                'deskripsi' => 'Ujian kelulusan hafalan juz 30 dengan tartil, mahraj fasih, dan tajwid mutqin oleh santri program takhasus.',
                'is_hero_slider' => true,
                'is_featured' => false,
                'urutan' => 2,
            ],
            // Video 3 (Hero Slider #3)
            [
                'judul' => 'Pidato Bahasa Arab Santriwati Juara 1 Nasional',
                'kategori' => 'Bahasa Asing',
                'youtube_id' => 'fD3_P_V0Q3Y',
                'durasi' => '06:12',
                'thumbnail' => 'https://images.unsplash.com/photo-1577495508048-b635879837f1?auto=format&fit=crop&w=800&q=80',
                'deskripsi' => 'Kefasihan penguasaan kosakata bahasa Arab dan dialek fushah santriwati di panggung Festival Bahasa Nasional.',
                'is_hero_slider' => true,
                'is_featured' => false,
                'urutan' => 3,
            ],
            // Video 4 (Hero Slider #4)
            [
                'judul' => 'Grup Hadrah Santri: Lantunan Qasidah Burdah',
                'kategori' => 'Seni Rebana',
                'youtube_id' => 'fD3_P_V0Q3Y',
                'durasi' => '11:05',
                'thumbnail' => 'https://images.unsplash.com/photo-1564769625905-50e93615e769?auto=format&fit=crop&w=800&q=80',
                'deskripsi' => 'Harmoni tabuhan terbang dan vokal merdu shalawat para santri mengiringi peringatan maulid akbar.',
                'is_hero_slider' => true,
                'is_featured' => false,
                'urutan' => 4,
            ],
            // Video 5 (Video Galeri Lainnya)
            [
                'judul' => 'Inovasi Robotika & Coding Santri Milenial',
                'kategori' => 'Sains & IT',
                'youtube_id' => 'fD3_P_V0Q3Y',
                'durasi' => '09:30',
                'thumbnail' => 'https://images.unsplash.com/photo-1531482615713-2afd69097998?auto=format&fit=crop&w=800&q=80',
                'deskripsi' => 'Santri mempresentasikan ciptaan robot line follower, sensor IoT, dan aplikasi web untuk masyarakat.',
                'is_hero_slider' => false,
                'is_featured' => false,
                'urutan' => 5,
            ],
            // Video 6 (Video Galeri Lainnya)
            [
                'judul' => 'Latihan Silat Pagar Nusa & Olahraga Memanah',
                'kategori' => 'Bela Diri & Olahraga',
                'youtube_id' => 'fD3_P_V0Q3Y',
                'durasi' => '07:18',
                'thumbnail' => 'https://images.unsplash.com/photo-1593113598332-cd288d649433?auto=format&fit=crop&w=800&q=80',
                'deskripsi' => 'Menempa fisik yang tangguh, ketangkasan, dan kedisiplinan santri sesuai ajaran sunnah Rasulullah SAW.',
                'is_hero_slider' => false,
                'is_featured' => false,
                'urutan' => 6,
            ],
        ];

        foreach ($videos as $v) {
            Video::firstOrCreate(
                ['judul' => $v['judul']],
                $v
            );
        }
    }
}
