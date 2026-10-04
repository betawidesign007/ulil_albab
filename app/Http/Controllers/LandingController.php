<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use App\Models\PpdbRegistration;
use App\Models\PpdbSetting;
use App\Models\Santri;
use App\Models\User;
use App\Models\Video;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    /**
     * Tampilkan Halaman Utama (Landing Page) Pesantren
     */
    public function index()
    {
        // 1. Pengaturan Dinamis PPDB & Landing Page dari Halaman Admin
        $ppdbSetting = PpdbSetting::getActive();

        // 2. Metrik Dinamis
        // Santri aktif: jumlah riil santri yang diinput di SIMPONPES
        $santriCount = Santri::count();
        $totalSantri = $santriCount;

        // Dewan Asatidz: jumlah riil akun pengajar di SIMPONPES
        $pengajarCount = User::where('role', 'pengajar')->count();
        $totalAsatidz = $pengajarCount;

        // Total Pendaftar PPDB Online dari tabel ppdb_registrations
        $totalPendaftarPpdb = PpdbRegistration::count();

        // Kuota PPDB Dinamis dari pengaturan admin
        $kuotaAwal = $ppdbSetting->kuota_penerimaan;
        $sisaKuotaPpdb = max(0, $kuotaAwal - $totalPendaftarPpdb);

        // 3. Data Slide Show Paling Atas (Maksimal 4 Video Terpilih oleh Admin)
        $heroVideos = Video::where('is_hero_slider', true)
            ->orderBy('urutan')
            ->orderBy('id', 'desc')
            ->take(4)
            ->get();

        // Fallback jika belum ada 4 video yang ditandai is_hero_slider, ambil 4 video teratas
        if ($heroVideos->count() < 4) {
            $heroVideos = Video::orderBy('urutan')
                ->orderBy('id', 'desc')
                ->take(4)
                ->get();
        }

        // 4. Video Utama (Featured Video)
        $featuredVideo = Video::where('is_featured', true)->first()
            ?? Video::orderBy('urutan')->first();

        // 5. Seluruh Video untuk Video Galeri
        $galeriVideos = Video::orderBy('urutan')->orderBy('id', 'desc')->get();

        // 6. Dokumentasi Foto Kegiatan (Galeri Konten)
        $kegiatans = Kegiatan::orderBy('tanggal', 'desc')->get();

        return view('landing', compact(
            'ppdbSetting',
            'totalSantri',
            'santriCount',
            'totalAsatidz',
            'totalPendaftarPpdb',
            'sisaKuotaPpdb',
            'kuotaAwal',
            'heroVideos',
            'featuredVideo',
            'galeriVideos',
            'kegiatans'
        ));
    }

    /**
     * Proses Formulir Pendaftaran PPDB Online
     */
    public function daftarPpdb(Request $request)
    {
        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'tempat_lahir' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'nisn' => 'nullable|string|max:30',
            'asal_sekolah' => 'required|string|max:255',
            'jenjang' => 'required|string|max:100',
            'nama_wali' => 'required|string|max:255',
            'no_wa' => 'required|string|max:30',
            'pekerjaan_wali' => 'nullable|string|max:100',
            'pendidikan_wali' => 'nullable|string|max:100',
            'alamat' => 'required|string',
            'jalur' => 'nullable|string|max:100',
            'model_ujian' => 'nullable|string|max:100',
            'catatan_prestasi' => 'nullable|string|max:255',
        ]);

        $ppdbSetting = PpdbSetting::getActive();

        if ($ppdbSetting->status_ppdb === 'tutup') {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Pendaftaran PPDB saat ini sedang ditutup.',
                ], 422);
            }

            return back()->with('error', 'Pendaftaran PPDB saat ini sedang ditutup.');
        }

        // Generate Nomor Pendaftaran Unik
        $randomCode = str_pad(mt_rand(101, 9999), 4, '0', STR_PAD_LEFT);
        $noPendaftaran = 'PPDB-'.date('Y').'-'.$randomCode;

        $jalur = $validated['jalur'] ?? 'Reguler';
        $modelUjian = $validated['model_ujian'] ?? 'Tatap Muka di Pesantren';

        // Tentukan jadwal & ruang ujian sesuai konfigurasi Admin di PpdbSetting
        $jadwalUjian = $ppdbSetting->tanggal_ujian_seleksi.' ('.$ppdbSetting->jam_ujian.')';

        $ruangUjian = ($modelUjian === 'Online / Jarak Jauh')
            ? 'Ruang Virtual Zoom Seleksi PPDB'
            : $ppdbSetting->lokasi_ujian;

        // Simpan pendaftaran ke database secara persisten!
        $registration = PpdbRegistration::create([
            'no_pendaftaran' => $noPendaftaran,
            'nama_lengkap' => $validated['nama_lengkap'],
            'jenis_kelamin' => $validated['jenis_kelamin'],
            'tempat_lahir' => $validated['tempat_lahir'],
            'tanggal_lahir' => $validated['tanggal_lahir'],
            'nisn' => $validated['nisn'] ?? null,
            'asal_sekolah' => $validated['asal_sekolah'],
            'jenjang' => $validated['jenjang'],
            'nama_wali' => $validated['nama_wali'],
            'no_wa' => $validated['no_wa'],
            'pekerjaan_wali' => $validated['pekerjaan_wali'] ?? null,
            'pendidikan_wali' => $validated['pendidikan_wali'] ?? null,
            'alamat' => $validated['alamat'],
            'jalur' => $jalur,
            'model_ujian' => $modelUjian,
            'catatan_prestasi' => $validated['catatan_prestasi'] ?? null,
            'jadwal_ujian' => $jadwalUjian,
            'ruang_ujian' => $ruangUjian,
            'status' => 'Menunggu Ujian',
        ]);

        $successData = [
            'no_pendaftaran' => $registration->no_pendaftaran,
            'nama_lengkap' => $registration->nama_lengkap,
            'jenis_kelamin' => $registration->jenis_kelamin,
            'jenjang' => $registration->jenjang,
            'jalur' => $registration->jalur,
            'model_ujian' => $registration->model_ujian,
            'nama_wali' => $registration->nama_wali,
            'no_wa' => $registration->no_wa,
            'jadwal_ujian' => $registration->jadwal_ujian,
            'ruang_ujian' => $registration->ruang_ujian,
            'tanggal_daftar' => now()->translatedFormat('d F Y'),
        ];

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'data' => $successData,
                'message' => 'Pendaftaran PPDB berhasil disimpan.',
            ]);
        }

        return back()->with('ppdb_success', $successData);
    }
}
