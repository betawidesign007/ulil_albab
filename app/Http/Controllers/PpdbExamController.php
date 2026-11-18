<?php

namespace App\Http\Controllers;

use App\Models\PpdbExamResult;
use App\Models\PpdbRegistration;
use App\Models\PpdbSetting;
use App\Models\PpdbSoal;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PpdbExamController extends Controller
{
    /**
     * Tampilkan gerbang masuk / konfirmasi ujian masuk calon santri.
     */
    public function index(Request $request): View
    {
        $noPendaftaran = trim((string) $request->query('no_pendaftaran', ''));
        $registration = null;
        $examResult = null;

        if ($noPendaftaran !== '') {
            $registration = PpdbRegistration::where('no_pendaftaran', $noPendaftaran)->first();
            if ($registration) {
                $examResult = PpdbExamResult::where('ppdb_registration_id', $registration->id)->first();
            }
        }

        $totalSoal = PpdbSoal::aktif()->count();
        $ppdbSetting = PpdbSetting::first() ?? new PpdbSetting;

        return view('ppdb.exam.index', [
            'noPendaftaran' => $noPendaftaran,
            'registration' => $registration,
            'examResult' => $examResult,
            'totalSoal' => $totalSoal,
            'ppdbSetting' => $ppdbSetting,
        ]);
    }

    /**
     * Memulai sesi pengerjaan ujian CBT untuk calon santri.
     */
    public function start(Request $request): View|RedirectResponse
    {
        $validated = $request->validate([
            'no_pendaftaran' => ['required', 'string'],
        ], [
            'no_pendaftaran.required' => 'Nomor registrasi pendaftaran wajib diisi.',
        ]);

        $noPendaftaran = trim($validated['no_pendaftaran']);
        $registration = PpdbRegistration::where('no_pendaftaran', $noPendaftaran)->first();

        if (! $registration) {
            return redirect()->route('ppdb.exam.index')
                ->withInput()
                ->with('error', "Nomor registrasi '{$noPendaftaran}' tidak ditemukan dalam database PPDB. Silakan periksa kembali atau lakukan pendaftaran terlebih dahulu.");
        }

        // Cek apakah santri sudah pernah menyelesaikan ujian
        $existingResult = PpdbExamResult::where('ppdb_registration_id', $registration->id)->first();
        if ($existingResult) {
            return redirect()->route('ppdb.exam.result', $registration->no_pendaftaran)
                ->with('info', 'Anda telah menyelesaikan ujian masuk akademik ini sebelumnya. Berikut adalah rincian perolehan nilai dan evaluasi Anda.');
        }

        // Ambil semua soal aktif urut nomor
        $soals = PpdbSoal::aktif()->orderBy('nomor_urut')->get();

        if ($soals->isEmpty()) {
            return redirect()->route('ppdb.exam.index', ['no_pendaftaran' => $noPendaftaran])
                ->with('error', 'Bank soal ujian saat ini belum siap atau dinonaktifkan oleh administrator. Silakan hubungi panitia PPDB.');
        }

        // Catat waktu mulai di sesi santri jika belum ada
        $sessionKey = 'ppdb_exam_start_'.$registration->id;
        if (! session()->has($sessionKey)) {
            session([$sessionKey => now()->toIso8601String()]);
        }

        $startTime = Carbon::parse(session($sessionKey));
        $ppdbSetting = PpdbSetting::first() ?? new PpdbSetting;

        return view('ppdb.exam.start', [
            'registration' => $registration,
            'soals' => $soals,
            'startTime' => $startTime,
            'durasiMenit' => 90, // Standar 90 menit untuk 50 butir soal
            'ppdbSetting' => $ppdbSetting,
        ]);
    }

    /**
     * Proses pengumpulan lembar jawaban ujian, koreksi otomatis, dan penerbitan nilai.
     */
    public function submit(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'no_pendaftaran' => ['required', 'string'],
            'answers' => ['nullable', 'array'],
        ]);

        $noPendaftaran = trim($validated['no_pendaftaran']);
        $registration = PpdbRegistration::where('no_pendaftaran', $noPendaftaran)->firstOrFail();

        // Mencegah double submit jika sudah ada nilai
        $existingResult = PpdbExamResult::where('ppdb_registration_id', $registration->id)->first();
        if ($existingResult) {
            return redirect()->route('ppdb.exam.result', $registration->no_pendaftaran)
                ->with('info', 'Ujian Anda telah tercatat sebelumnya.');
        }

        $sessionKey = 'ppdb_exam_start_'.$registration->id;
        $waktuMulai = session()->has($sessionKey) ? Carbon::parse(session($sessionKey)) : now()->subMinutes(30);
        $waktuSelesai = now();
        $durasiMenit = max(1, (int) round($waktuMulai->diffInMinutes($waktuSelesai)));

        $submittedAnswers = $validated['answers'] ?? [];
        $soals = PpdbSoal::aktif()->orderBy('nomor_urut')->get();

        $totalSoal = $soals->count();
        $jawabanBenar = 0;
        $jawabanSalah = 0;
        $jawabanKosong = 0;
        $detailJawaban = [];

        foreach ($soals as $soal) {
            $userAns = isset($submittedAnswers[$soal->id]) ? strtoupper(trim((string) $submittedAnswers[$soal->id])) : null;
            $kunci = strtoupper(trim((string) $soal->kunci_jawaban));

            $isCorrect = false;
            if (empty($userAns)) {
                $jawabanKosong++;
                $statusPoin = 'kosong';
            } elseif ($userAns === $kunci) {
                $jawabanBenar++;
                $isCorrect = true;
                $statusPoin = 'benar';
            } else {
                $jawabanSalah++;
                $statusPoin = 'salah';
            }

            $detailJawaban[] = [
                'soal_id' => $soal->id,
                'nomor_urut' => $soal->nomor_urut,
                'kategori' => $soal->kategori,
                'jawaban_santri' => $userAns,
                'kunci_jawaban' => $kunci,
                'is_correct' => $isCorrect,
                'status' => $statusPoin,
            ];
        }

        // Hitung skor perolehan (skala 0 - 100)
        $nilai = $totalSoal > 0 ? round(($jawabanBenar / $totalSoal) * 100, 2) : 0.00;

        // Status kelulusan awal berdasarkan standar passing grade (bisa diperbarui admin kapan pun)
        $statusKelulusan = match (true) {
            $nilai >= 70.0 => 'Lulus',
            $nilai >= 55.0 => 'Dipertimbangkan',
            default => 'Tidak Lulus',
        };

        // Buat record hasil ujian
        $examResult = PpdbExamResult::create([
            'ppdb_registration_id' => $registration->id,
            'no_pendaftaran' => $registration->no_pendaftaran,
            'nama_santri' => $registration->nama_lengkap,
            'jenjang' => $registration->jenjang,
            'total_soal' => $totalSoal,
            'jawaban_benar' => $jawabanBenar,
            'jawaban_salah' => $jawabanSalah,
            'jawaban_kosong' => $jawabanKosong,
            'nilai' => $nilai,
            'status_kelulusan' => $statusKelulusan,
            'catatan_admin' => 'Hasil ujian otomatis tersimpan. Menunggu verifikasi lanjutan oleh Panitia Penguji PPDB.',
            'detail_jawaban' => $detailJawaban,
            'waktu_mulai' => $waktuMulai,
            'waktu_selesai' => $waktuSelesai,
            'durasi_menit' => $durasiMenit,
        ]);

        // Hapus session waktu mulai
        session()->forget($sessionKey);

        return redirect()->route('ppdb.exam.result', $registration->no_pendaftaran)
            ->with('success', 'Alhamdulillah! Ujian tes akademik telah berhasil dikirim dan dinilai oleh sistem.');
    }

    /**
     * Tampilkan hasil nilai ujian dan status kelulusan calon santri.
     */
    public function result(string $no_pendaftaran): View|RedirectResponse
    {
        $registration = PpdbRegistration::where('no_pendaftaran', $no_pendaftaran)->first();

        if (! $registration) {
            return redirect()->route('ppdb.exam.index')
                ->with('error', "Nomor registrasi '{$no_pendaftaran}' tidak ditemukan.");
        }

        $examResult = PpdbExamResult::where('ppdb_registration_id', $registration->id)->first();

        if (! $examResult) {
            return redirect()->route('ppdb.exam.index', ['no_pendaftaran' => $no_pendaftaran])
                ->with('info', 'Calon santri ini belum mengerjakan ujian seleksi masuk. Silakan mulai tes akademik sekarang.');
        }

        $ppdbSetting = PpdbSetting::first() ?? new PpdbSetting;

        // Rekap per kategori
        $detailJawaban = $examResult->detail_jawaban ?? [];
        $kategoriStats = [];

        foreach ($detailJawaban as $item) {
            $kat = $item['kategori'] ?? 'Lainnya';
            if (! isset($kategoriStats[$kat])) {
                $kategoriStats[$kat] = ['total' => 0, 'benar' => 0, 'salah' => 0, 'kosong' => 0];
            }
            $kategoriStats[$kat]['total']++;
            if (($item['status'] ?? '') === 'benar') {
                $kategoriStats[$kat]['benar']++;
            } elseif (($item['status'] ?? '') === 'salah') {
                $kategoriStats[$kat]['salah']++;
            } else {
                $kategoriStats[$kat]['kosong']++;
            }
        }

        return view('ppdb.exam.result', [
            'registration' => $registration,
            'examResult' => $examResult,
            'kategoriStats' => $kategoriStats,
            'ppdbSetting' => $ppdbSetting,
        ]);
    }

    /**
     * Cetak Surat Keterangan / Sertifikat Hasil Ujian Masuk Calon Santri.
     */
    public function cetak(string $no_pendaftaran): View|RedirectResponse
    {
        $registration = PpdbRegistration::where('no_pendaftaran', $no_pendaftaran)->firstOrFail();
        $examResult = PpdbExamResult::where('ppdb_registration_id', $registration->id)->firstOrFail();
        $ppdbSetting = PpdbSetting::first() ?? new PpdbSetting;

        return view('ppdb.exam.cetak', [
            'registration' => $registration,
            'examResult' => $examResult,
            'ppdbSetting' => $ppdbSetting,
        ]);
    }
}
