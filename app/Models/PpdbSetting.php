<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PpdbSetting extends Model
{
    protected $fillable = [
        'nama_pesantren',
        'logo',
        'tagline_pesantren',
        'telepon',
        'email',
        'alamat',
        'status_ppdb',
        'tahun_ajaran',
        'gelombang_aktif',
        'kuota_penerimaan',
        'biaya_pendaftaran',
        'tanggal_buka_pendaftaran',
        'tanggal_tutup_pendaftaran',
        'tanggal_ujian_seleksi',
        'tanggal_pengumuman',
        'tanggal_daftar_ulang',
        'jam_ujian',
        'lokasi_ujian',
        'persyaratan_santri',
        'berkas_wajib',
        'materi_ujian',
        'alur_pendaftaran',
        'biaya_rincian',
        'pengumuman_banner',
        'link_brosur',
        'sambutan_pengasuh_nama',
        'sambutan_pengasuh_jabatan',
        'sambutan_pengasuh_quote',
        'sambutan_pengasuh_teks',
        'sejarah_singkat',
        'filosofi_nama',
        'sarana_prasarana',
        'visi_pesantren',
        'misi_pesantren',
        'motto_pesantren',
        'standar_kelulusan',
        'struktur_organisasi',
        'sambutan_pengasuh_foto',
        'sejarah_foto',
        'visi_misi_foto',
    ];

    /**
     * Dapatkan instance pengaturan aktif (singleton)
     */
    public static function getActive(): self
    {
        return static::firstOrCreate([], [
            'nama_pesantren' => 'Pondok Pesantren Li Ulil Albab',
            'tagline_pesantren' => 'Pendidikan Islam Modern Berbasis Tahfidzul Qur\'an & Bahasa Internasional',
            'telepon' => '(+62) 877-9910-7735',
            'email' => 'ppdb@ulilalbab.ac.id',
            'alamat' => 'Jl. Pesantren Modern No. 99, Li Ulil Albab Center',
            'status_ppdb' => 'buka',
            'tahun_ajaran' => '2026/2027',
            'gelombang_aktif' => 'Gelombang I (Jalur Prestasi Tahfidz & Reguler)',
            'kuota_penerimaan' => 350,
            'biaya_pendaftaran' => 'Rp 250.000',
            'tanggal_buka_pendaftaran' => '01 Januari 2026',
            'tanggal_tutup_pendaftaran' => '30 Mei 2026',
            'tanggal_ujian_seleksi' => 'Sabtu & Minggu, 13 - 14 Juni 2026',
            'tanggal_pengumuman' => '20 Juni 2026',
            'tanggal_daftar_ulang' => '25 Juni - 05 Juli 2026',
            'jam_ujian' => '08.00 - 11.30 WIB',
            'lokasi_ujian' => 'Gedung Rektorat Lt. 2 (Ruang Al-Fatih) & Online',
            'pengumuman_banner' => 'Pendaftaran Santri Baru Tahun Ajaran 2026/2027 Resmi Dibuka! Segera amankan kuota pendaftaran putra-putri Anda sebelum batas akhir penutupan gelombang.',
            'persyaratan_santri' => "Beragama Islam serta memiliki akhlaq dan kepribadian yang santun.\nTamat SD/MI untuk jenjang MTs Terpadu, atau Tamat SMP/MTs untuk jenjang MA Unggulan / Takhasus Tahfidz.\nSanggup mukim di asrama pesantren selama masa pendidikan berlangsung.\nBersedia mematuhi disiplin dan tata tertib yang ditetapkan pimpinan pondok dan dewan pengasuh.\nSehat jasmani dan rohani, bebas dari penyakit menular kronis (dibuktikan surat dokter).",
            'berkas_wajib' => "Cetak Kartu Ujian Masuk PPDB yang diperoleh setelah mengisi formulir online di website ini.\nFotokopi Akta Kelahiran calon santri (2 lembar).\nFotokopi Kartu Keluarga (KK) dan KTP kedua Orang Tua / Wali (2 lembar).\nFotokopi Rapor 2 semester terakhir yang dilegalisir kepala sekolah asal.\nPasfoto Berwarna 3x4 terbaru (4 lembar, latar biru/merah, berbusana muslim rapi).\nPiagam / Sertifikat Prestasi (wajib bagi pendaftar Jalur Beasiswa Tahfidz min. 3 Juz).",
            'materi_ujian' => json_encode([
                [
                    'judul' => 'Baca Tulis Al-Qur\'an (BTQ)',
                    'deskripsi' => 'Kelancaran membaca mushaf, penguasaan hukum tajwid (nun mati, mad, waqaf), dan tes imla\' / menulis ayat.',
                    'icon' => 'bi-book-half',
                    'color' => 'text-success',
                ],
                [
                    'judul' => 'Hafalan Surat Pilihan',
                    'deskripsi' => 'Tes hafalan Juz 30 (Surat An-Naba s.d An-Nas). Bagi jalur beasiswa tahfidz diuji sesuai target juz yang diajukan.',
                    'icon' => 'bi-bookmark-star-fill',
                    'color' => 'text-warning',
                ],
                [
                    'judul' => 'Tes Potensi Akademik',
                    'deskripsi' => 'Matematika dasar, pemahaman nalar bahasa, pengetahuan agama Islam dasar (Fikih Thaharah, Shalat, Akhlaq).',
                    'icon' => 'bi-mortarboard',
                    'color' => 'text-primary',
                ],
                [
                    'judul' => 'Wawancara Santri & Wali',
                    'deskripsi' => 'Penggalian motivasi belajar mondok, kesiapan kemandirian di asrama, serta komitmen kesepakatan wali santri.',
                    'icon' => 'bi-people-fill',
                    'color' => 'text-danger',
                ],
            ]),
            'alur_pendaftaran' => json_encode([
                [
                    'step' => '1',
                    'judul' => 'Pengisian Formulir Online',
                    'deskripsi' => 'Isi data calon santri dan wali melalui formulir pendaftaran di website resmi SIMPONPES.',
                ],
                [
                    'step' => '2',
                    'judul' => 'Cetak Kartu Ujian',
                    'deskripsi' => 'Sistem langsung menerbitkan Nomor Registrasi dan Kartu Peserta Ujian Masuk resmi siap cetak PDF.',
                ],
                [
                    'step' => '3',
                    'judul' => 'Pelaksanaan Ujian Seleksi',
                    'deskripsi' => 'Mengikuti ujian seleksi Al-Qur\'an, akademik, dan wawancara santri & wali sesuai jadwal.',
                ],
                [
                    'step' => '4',
                    'judul' => 'Pengumuman Kelulusan',
                    'deskripsi' => 'Hasil kelulusan diumumkan melalui portal website dan notifikasi resmi WhatsApp panitia PPDB.',
                ],
                [
                    'step' => '5',
                    'judul' => 'Daftar Ulang & Orientasi',
                    'deskripsi' => 'Penyelesaian administrasi, fitting seragam, pembagian kamar asrama, dan ta\'aruf santri baru.',
                ],
            ]),
        ]);
    }

    /**
     * Array Persyaratan Santri
     */
    public function getPersyaratanListAttribute(): array
    {
        if (empty($this->persyaratan_santri)) {
            return [];
        }

        return array_values(array_filter(array_map('trim', explode("\n", $this->persyaratan_santri))));
    }

    /**
     * Array Berkas Wajib
     */
    public function getBerkasListAttribute(): array
    {
        if (empty($this->berkas_wajib)) {
            return [];
        }

        return array_values(array_filter(array_map('trim', explode("\n", $this->berkas_wajib))));
    }

    /**
     * Array Materi Ujian
     */
    public function getMateriUjianListAttribute(): array
    {
        if (empty($this->materi_ujian)) {
            return [];
        }

        $decoded = json_decode($this->materi_ujian, true);

        return is_array($decoded) ? $decoded : [];
    }

    /**
     * Array Alur Pendaftaran
     */
    public function getAlurListAttribute(): array
    {
        if (empty($this->alur_pendaftaran)) {
            return [];
        }

        $decoded = json_decode($this->alur_pendaftaran, true);

        return is_array($decoded) ? $decoded : [];
    }

    /**
     * Status Label & Badge
     */
    public function getStatusLabelAttribute(): string
    {
        return match ($this->status_ppdb) {
            'buka' => 'Pendaftaran Dibuka',
            'tutup' => 'Pendaftaran Ditutup',
            'segera' => 'Segera Dibuka',
            default => ucfirst($this->status_ppdb),
        };
    }

    public function getStatusBadgeClassAttribute(): string
    {
        return match ($this->status_ppdb) {
            'buka' => 'bg-success text-white',
            'tutup' => 'bg-danger text-white',
            'segera' => 'bg-warning text-dark',
            default => 'bg-secondary text-white',
        };
    }

    /**
     * URL Logo Pesantren (kustom atau bawaan)
     */
    public function getLogoUrlAttribute(): ?string
    {
        if ($this->logo && file_exists(public_path('images/'.$this->logo))) {
            return asset('images/'.$this->logo);
        }

        if (file_exists(public_path('images/logo.png'))) {
            return asset('images/logo.png');
        }

        return null;
    }

    /**
     * URL Foto Sambutan Pengasuh
     */
    public function getSambutanPengasuhFotoUrlAttribute(): ?string
    {
        if ($this->sambutan_pengasuh_foto && file_exists(public_path('images/'.$this->sambutan_pengasuh_foto))) {
            return asset('images/'.$this->sambutan_pengasuh_foto);
        }

        return null;
    }

    /**
     * URL Foto Sejarah / Gedung Pesantren
     */
    public function getSejarahFotoUrlAttribute(): ?string
    {
        if ($this->sejarah_foto && file_exists(public_path('images/'.$this->sejarah_foto))) {
            return asset('images/'.$this->sejarah_foto);
        }

        return null;
    }

    /**
     * URL Foto / Banner Visi Misi
     */
    public function getVisiMisiFotoUrlAttribute(): ?string
    {
        if ($this->visi_misi_foto && file_exists(public_path('images/'.$this->visi_misi_foto))) {
            return asset('images/'.$this->visi_misi_foto);
        }

        return null;
    }

    /**
     * Accessor Profil: Sambutan Pengasuh
     */
    public function getSambutanPengasuhNamaAttribute(): string
    {
        return $this->attributes['sambutan_pengasuh_nama'] ?? 'KH. Dr. Abdullah Syukri, M.Ag';
    }

    public function getSambutanPengasuhJabatanAttribute(): string
    {
        return $this->attributes['sambutan_pengasuh_jabatan'] ?? "Pengasuh & Mudir 'Aam";
    }

    public function getSambutanPengasuhQuoteAttribute(): string
    {
        return $this->attributes['sambutan_pengasuh_quote'] ?? "Membina Generasi yang Hafal Al-Qur'an, Berwawasan Luas, dan Berakhlak Mulia.";
    }

    public function getSambutanPengasuhTeksAttribute(): string
    {
        return $this->attributes['sambutan_pengasuh_teks'] ?? "Pondok Pesantren Modern Li Ulil Albab berikhtiar mendidik para santri dengan memadukan kedalaman ilmu-ilmu turats salafiyah, kemurnian hafalan Al-Qur'an 30 juz mutqin, serta penguasaan sains, teknologi informasi, dan bahasa internasional. Kami mendidik dengan hati, keteladanan, dan disiplin kasih sayang 24 jam di asrama.";
    }

    public function getSejarahSingkatAttribute(): string
    {
        return $this->attributes['sejarah_singkat'] ?? "Pondok Pesantren Modern Li Ulil Albab didirikan pada tahun 2012 atas inisiasi KH. Dr. Abdullah Syukri, M.Ag bersama para alim ulama dan tokoh masyarakat. Bermula dari halaqah tahfidz Al-Qur'an dengan belasan santri, kini pesantren telah berkembang menjadi kompleks pendidikan terpadu di atas lahan wakaf seluas 4,5 hektar dengan jenjang formal MTs Terpadu, MA Unggulan, dan Takhasus Tahfidzul Qur'an 30 Juz Bersanad.";
    }

    public function getFilosofiNamaAttribute(): string
    {
        return $this->attributes['filosofi_nama'] ?? "Nama Li Ulil Albab diambil dari terminologi Qur'ani yang menggambarkan insan paripurna: generasi yang senantiasa menyeimbangkan antara dzikrullah (hubungan ruhani yang kokoh dengan Sang Pencipta) dan fikr (analisis ilmiah, kecerdasan nalar, serta kesadaran sosial yang tajam).";
    }

    /**
     * Array Sarana & Prasarana
     */
    public function getSaranaListAttribute(): array
    {
        if (! empty($this->attributes['sarana_prasarana'])) {
            return array_values(array_filter(array_map('trim', explode("\n", $this->attributes['sarana_prasarana']))));
        }

        return [
            "Masjid Jami' 2 Lantai (Kapasitas 1.500 Jamaah)",
            'Asrama Representatif Putra & Putri Terpisah',
            'Ruang Kelas Multimedia Ber-AC',
            'Laboratorium IT & Sains Komputer Terpadu',
            'Maktabah Digital & Perpustakaan Kitab Salaf',
            'Klinik Poskestren 24 Jam & Dokter Jaga',
        ];
    }

    /**
     * Accessor Visi & Misi
     */
    public function getVisiPesantrenAttribute(): string
    {
        return $this->attributes['visi_pesantren'] ?? "Menjadi Pondok Pesantren Modern Unggulan Berstandar Nasional dan Internasional yang Melahirkan Generasi Ulil Albab: Berakhlak Qur'ani, Hafidz 30 Juz, Unggul dalam Ilmu Pengetahuan, Berkarakter Mandiri, dan Berwawasan Global.";
    }

    public function getMottoPesantrenAttribute(): string
    {
        return $this->attributes['motto_pesantren'] ?? 'Berilmu Amaliah, Beramal Ilmiah, & Berakhlakul Karimah';
    }

    public function getMisiListAttribute(): array
    {
        if (! empty($this->attributes['misi_pesantren'])) {
            $lines = array_values(array_filter(array_map('trim', explode("\n", $this->attributes['misi_pesantren']))));
            $items = [];
            foreach ($lines as $i => $line) {
                // Jika format judul: deskripsi atau biasa
                $parts = explode(':', $line, 2);
                if (count($parts) === 2) {
                    $items[] = [
                        'judul' => trim($parts[0]),
                        'deskripsi' => trim($parts[1]),
                    ];
                } else {
                    $items[] = [
                        'judul' => 'Misi '.($i + 1),
                        'deskripsi' => trim($line),
                    ];
                }
            }

            return $items;
        }

        return [
            [
                'judul' => 'Tarbiyah Qur\'aniyah Mutqin',
                'deskripsi' => 'Menyelenggarakan program Tahfidzul Qur\'an 30 Juz secara terstruktur dengan bimbingan sanad muttashil, tajwid tahsin standar, dan pengamalan adab-adab Al-Qur\'an.',
            ],
            [
                'judul' => 'Tafaqquh Fiddin & Turats',
                'deskripsi' => 'Mengintegrasikan kurikulum kajian kitab kuning ulama salaf dengan kurikulum sains modern kementerian agama secara seimbang dan harmonis.',
            ],
            [
                'judul' => 'Penguasaan Bahasa Internasional',
                'deskripsi' => 'Membudayakan penguasaan aktif bahasa Arab dan bahasa Inggris dalam interaksi harian, literasi keilmuan, dan komunikasi global.',
            ],
            [
                'judul' => 'Pembentukan Karakter Mandiri & Kepemimpinan',
                'deskripsi' => 'Menumbuhkan kedisiplinan, kemandirian asrama 24 jam, kejujuran, etos kerja, serta kepemimpinan santri melalui wadah organisasi santri (OPLU).',
            ],
            [
                'judul' => 'Pengabdian Masyarakat & Kewirausahaan',
                'deskripsi' => 'Mencetak santri yang memiliki kepekaan sosial tinggi, berjiwa entrepreneurship, dan siap mengabdi untuk kemaslahatan umat, bangsa, dan agama.',
            ],
        ];
    }

    public function getStandarKelulusanListAttribute(): array
    {
        $raw = ! empty($this->attributes['standar_kelulusan'])
            ? array_values(array_filter(array_map('trim', explode("\n", $this->attributes['standar_kelulusan']))))
            : [
                'Tahfidz: Hafal 10 - 30 Juz Al-Qur\'an bersanad muttashil dengan predikat mutqin.',
                'Turats: Mampu membaca dan memahami kitab kuning dasar (Safinah, Taqrib, Jurumiyyah).',
                'Bahasa: Aktif berkomunikasi dalam bahasa Arab dan Inggris dengan skor TOAFL/TOEFL kompetitif.',
                'Akademik: Lulus 100% dan siap menembus PTN unggulan, PTKIN (UIN), serta universitas Timur Tengah (Al-Azhar, Yaman).',
            ];

        $items = [];
        foreach ($raw as $line) {
            $parts = explode(':', $line, 2);
            if (count($parts) === 2) {
                $items[] = [
                    'kategori' => trim($parts[0]),
                    'deskripsi' => trim($parts[1]),
                ];
            } else {
                $items[] = [
                    'kategori' => 'Kompetensi',
                    'deskripsi' => trim($line),
                ];
            }
        }

        return $items;
    }

    /**
     * Accessor Struktur Organisasi
     */
    public function getStrukturOrganisasiListAttribute(): array
    {
        $struktur = null;
        if (! empty($this->attributes['struktur_organisasi'])) {
            $decoded = json_decode($this->attributes['struktur_organisasi'], true);
            if (is_array($decoded) && count($decoded) > 0) {
                $struktur = $decoded;
            }
        }

        if (! $struktur) {
            $struktur = [
                'puncak' => [
                    'nama' => 'KH. Dr. Abdullah Syukri, M.Ag',
                    'jabatan' => 'Pengasuh & Mudir \'Aam Pesantren',
                    'badge' => 'PIMPINAN PUNCAK',
                    'deskripsi' => 'Penanggung jawab umum seluruh kebijakan arah tarbiyah, akidah, kelembagaan, dan kurikulum Pondok Pesantren Modern Li Ulil Albab.',
                    'foto' => null,
                ],
                'bph' => [
                    [
                        'nama' => 'Dr. KH. Ahmad Rofi\'i, M.Pd.I',
                        'jabatan' => 'Wakil Mudir Bidang Tarbiyah',
                        'icon' => 'bi-mortarboard-fill',
                        'color' => 'primary',
                        'deskripsi' => 'Mengkoordinir pengembangan kurikulum terpadu salaf-modern, evaluasi belajar santri, dan supervisi dewan guru.',
                        'foto' => null,
                    ],
                    [
                        'nama' => 'Ustadz M. Faruq, S.Kom',
                        'jabatan' => 'Sekretaris Lembaga & Kepala IT',
                        'icon' => 'bi-laptop-fill',
                        'color' => 'info',
                        'deskripsi' => 'Mengelola tata usaha kelembagaan, perizinan, sistem informasi manajemen SIMPONPES, dan media center publik.',
                        'foto' => null,
                    ],
                    [
                        'nama' => 'Ustadzah Hj. Siti Aminah, S.E',
                        'jabatan' => 'Bendahara Umum Pesantren',
                        'icon' => 'bi-cash-coin',
                        'color' => 'warning',
                        'deskripsi' => 'Penanggung jawab tata kelola administrasi keuangan pesantren, dana operasional santri, dan akuntabilitas anggaran.',
                        'foto' => null,
                    ],
                ],
                'divisi' => [
                    [
                        'nama' => 'Ustadzah Nurul Hidayah, Lc',
                        'jabatan' => 'Direktur Tahfidzul Qur\'an',
                        'color' => 'success',
                        'icon' => 'bi-book-half',
                        'deskripsi' => 'Sanad Hafalan 30 Juz, pembimbingan halaqah tahfidz mutqin dan karantina tasmi\'.',
                        'foto' => null,
                    ],
                    [
                        'nama' => 'Ustadz Rahmat Hidayat, M.Pd',
                        'jabatan' => 'Kepala Madrasah & Akademik',
                        'color' => 'primary',
                        'icon' => 'bi-mortarboard',
                        'deskripsi' => 'Pengelola kurikulum formal MTs & MA Kemenag, ujian nasional, dan akreditasi madrasah.',
                        'foto' => null,
                    ],
                    [
                        'nama' => 'Ustadz Fauzan Azhim, S.Sos.I',
                        'jabatan' => 'Kepala Kesantrian Banin',
                        'color' => 'info',
                        'icon' => 'bi-shield-check',
                        'deskripsi' => 'Pembina disiplin asrama santri putra, kepemimpinan organisasi, dan kegiatan ekstrakurikuler.',
                        'foto' => null,
                    ],
                    [
                        'nama' => 'Ustadzah Maryam Sholihat, S.Ag',
                        'jabatan' => 'Kepala Kesantrian Banat',
                        'color' => 'danger',
                        'icon' => 'bi-heart-pulse-fill',
                        'deskripsi' => 'Pembina ketertiban asrama putri, kepribadian muslimah, dan pembinaan ruhiyah santriwati.',
                        'foto' => null,
                    ],
                ],
            ];
        }

        // Generate foto_url helper for view rendering
        if (isset($struktur['puncak'])) {
            $foto = $struktur['puncak']['foto'] ?? null;
            $struktur['puncak']['foto_url'] = ($foto && file_exists(public_path('images/'.$foto))) ? asset('images/'.$foto) : null;
        }

        if (isset($struktur['bph']) && is_array($struktur['bph'])) {
            foreach ($struktur['bph'] as &$bph) {
                $foto = $bph['foto'] ?? null;
                $bph['foto_url'] = ($foto && file_exists(public_path('images/'.$foto))) ? asset('images/'.$foto) : null;
            }
        }

        if (isset($struktur['divisi']) && is_array($struktur['divisi'])) {
            foreach ($struktur['divisi'] as &$div) {
                $foto = $div['foto'] ?? null;
                $div['foto_url'] = ($foto && file_exists(public_path('images/'.$foto))) ? asset('images/'.$foto) : null;
            }
        }

        return $struktur;
    }
}
