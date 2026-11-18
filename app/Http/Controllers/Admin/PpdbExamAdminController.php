<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PpdbExamResult;
use App\Models\PpdbSoal;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class PpdbExamAdminController extends Controller
{
    // ==========================================
    // 1. MANAJEMEN BANK SOAL UJIAN MASUK PPDB
    // ==========================================

    /**
     * Tampilkan daftar bank soal ujian masuk PPDB.
     */
    public function soalIndex(Request $request): View
    {
        $query = PpdbSoal::query();

        // Filter kategori
        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        // Filter status
        if ($request->filled('status')) {
            $isAktif = $request->status === 'aktif';
            $query->where('is_aktif', $isAktif);
        }

        // Pencarian teks pertanyaan atau nomor
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('pertanyaan', 'like', "%{$search}%")
                    ->orWhere('nomor_urut', $search);
            });
        }

        $soals = $query->orderBy('nomor_urut')->paginate(20)->withQueryString();

        $kategoriList = PpdbSoal::distinct()->pluck('kategori')->filter();
        $totalAktif = PpdbSoal::aktif()->count();
        $totalSemua = PpdbSoal::count();

        return view('admin.ppdb.soal.index', [
            'soals' => $soals,
            'kategoriList' => $kategoriList,
            'totalAktif' => $totalAktif,
            'totalSemua' => $totalSemua,
        ]);
    }

    /**
     * Tampilkan formulir pembuatan butir soal baru.
     */
    public function soalCreate(): View
    {
        $maxNomor = (int) PpdbSoal::max('nomor_urut') + 1;
        $kategoriList = [
            'Pendidikan Agama Islam & Fiqih Dasar',
            'Tajwid, Tahfidz & Bahasa Arab',
            'Bahasa Indonesia & Literasi Membaca',
            'Matematika Dasar & Logika Nalar',
            'Bahasa Inggris & Wawasan Kebangsaan',
        ];

        return view('admin.ppdb.soal.create', [
            'nextNomor' => $maxNomor,
            'kategoriList' => $kategoriList,
        ]);
    }

    /**
     * Simpan butir soal baru ke database.
     */
    public function soalStore(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nomor_urut' => ['required', 'integer', 'min:1'],
            'kategori' => ['required', 'string', 'max:100'],
            'pertanyaan' => ['required', 'string'],
            'opsi_a' => ['required', 'string'],
            'opsi_b' => ['required', 'string'],
            'opsi_c' => ['required', 'string'],
            'opsi_d' => ['required', 'string'],
            'kunci_jawaban' => ['required', 'in:A,B,C,D,a,b,c,d'],
            'bobot' => ['required', 'integer', 'min:1', 'max:100'],
            'penjelasan' => ['nullable', 'string'],
            'is_aktif' => ['nullable', 'boolean'],
        ]);

        $validated['kunci_jawaban'] = strtoupper($validated['kunci_jawaban']);
        $validated['is_aktif'] = $request->has('is_aktif');

        PpdbSoal::create($validated);

        return redirect()->route('admin.ppdb.soal.index')
            ->with('success', "Soal nomor urut {$validated['nomor_urut']} berhasil ditambahkan ke bank soal.");
    }

    /**
     * Tampilkan formulir edit butir soal.
     */
    public function soalEdit(PpdbSoal $soal): View
    {
        $kategoriList = [
            'Pendidikan Agama Islam & Fiqih Dasar',
            'Tajwid, Tahfidz & Bahasa Arab',
            'Bahasa Indonesia & Literasi Membaca',
            'Matematika Dasar & Logika Nalar',
            'Bahasa Inggris & Wawasan Kebangsaan',
        ];

        return view('admin.ppdb.soal.edit', [
            'soal' => $soal,
            'kategoriList' => $kategoriList,
        ]);
    }

    /**
     * Perbarui butir soal yang sudah ada.
     */
    public function soalUpdate(Request $request, PpdbSoal $soal): RedirectResponse
    {
        $validated = $request->validate([
            'nomor_urut' => ['required', 'integer', 'min:1'],
            'kategori' => ['required', 'string', 'max:100'],
            'pertanyaan' => ['required', 'string'],
            'opsi_a' => ['required', 'string'],
            'opsi_b' => ['required', 'string'],
            'opsi_c' => ['required', 'string'],
            'opsi_d' => ['required', 'string'],
            'kunci_jawaban' => ['required', 'in:A,B,C,D,a,b,c,d'],
            'bobot' => ['required', 'integer', 'min:1', 'max:100'],
            'penjelasan' => ['nullable', 'string'],
            'is_aktif' => ['nullable', 'boolean'],
        ]);

        $validated['kunci_jawaban'] = strtoupper($validated['kunci_jawaban']);
        $validated['is_aktif'] = $request->has('is_aktif');

        $soal->update($validated);

        return redirect()->route('admin.ppdb.soal.index')
            ->with('success', "Soal nomor {$soal->nomor_urut} berhasil diperbarui.");
    }

    /**
     * Hapus butir soal dari bank soal.
     */
    public function soalDestroy(PpdbSoal $soal): RedirectResponse
    {
        $nomor = $soal->nomor_urut;
        $soal->delete();

        return redirect()->route('admin.ppdb.soal.index')
            ->with('success', "Soal nomor {$nomor} berhasil dihapus dari bank soal.");
    }

    /**
     * Toggle status aktif/nonaktif soal secara cepat.
     */
    public function soalToggleAktif(PpdbSoal $soal): RedirectResponse
    {
        $soal->is_aktif = ! $soal->is_aktif;
        $soal->save();

        $status = $soal->is_aktif ? 'diaktifkan' : 'dinonaktifkan';

        return back()->with('success', "Soal nomor {$soal->nomor_urut} berhasil {$status}.");
    }

    // ============================================================
    // 2. MANAJEMEN NILAI UJIAN, EVALUASI & KEPUTUSAN KELULUSAN
    // ============================================================

    /**
     * Tampilkan rekapitulasi nilai ujian seluruh calon santri.
     */
    public function nilaiIndex(Request $request): View
    {
        $query = PpdbExamResult::with('registration', 'penilai');

        // Filter status kelulusan
        if ($request->filled('status')) {
            $query->where('status_kelulusan', $request->status);
        }

        // Filter jenjang
        if ($request->filled('jenjang')) {
            $query->where('jenjang', $request->jenjang);
        }

        // Pencarian nama atau nomor pendaftaran
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama_santri', 'like', "%{$search}%")
                    ->orWhere('no_pendaftaran', 'like', "%{$search}%");
            });
        }

        // Sort
        $sort = $request->get('sort', 'terbaru');
        match ($sort) {
            'nilai_tertinggi' => $query->orderByDesc('nilai'),
            'nilai_terendah' => $query->orderBy('nilai'),
            'nama_asc' => $query->orderBy('nama_santri'),
            default => $query->latest('id'),
        };

        $results = $query->paginate(20)->withQueryString();

        // Statistik ringkas
        $totalPeserta = PpdbExamResult::count();
        $totalLulus = PpdbExamResult::where('status_kelulusan', 'Lulus')->count();
        $totalDipertimbangkan = PpdbExamResult::where('status_kelulusan', 'Dipertimbangkan')->count();
        $totalTidakLulus = PpdbExamResult::where('status_kelulusan', 'Tidak Lulus')->count();
        $rataRataNilai = $totalPeserta > 0 ? round(PpdbExamResult::avg('nilai'), 1) : 0;

        return view('admin.ppdb.nilai.index', [
            'results' => $results,
            'totalPeserta' => $totalPeserta,
            'totalLulus' => $totalLulus,
            'totalDipertimbangkan' => $totalDipertimbangkan,
            'totalTidakLulus' => $totalTidakLulus,
            'rataRataNilai' => $rataRataNilai,
        ]);
    }

    /**
     * Tampilkan detail lembar pengerjaan ujian dan form evaluasi admin.
     */
    public function nilaiShow(PpdbExamResult $result): View
    {
        $result->load('registration', 'penilai');

        // Ambil data referensi soal untuk penjelasan
        $soalIds = collect($result->detail_jawaban ?? [])->pluck('soal_id')->filter();
        $soals = PpdbSoal::whereIn('id', $soalIds)->get()->keyBy('id');

        return view('admin.ppdb.nilai.show', [
            'result' => $result,
            'soals' => $soals,
        ]);
    }

    /**
     * Perbarui nilai, status kelulusan, dan catatan evaluasi resmi dari admin.
     */
    public function nilaiUpdate(Request $request, PpdbExamResult $result): RedirectResponse
    {
        $validated = $request->validate([
            'status_kelulusan' => ['required', 'in:Lulus,Dipertimbangkan,Tidak Lulus'],
            'nilai' => ['required', 'numeric', 'min:0', 'max:100'],
            'catatan_admin' => ['nullable', 'string', 'max:2000'],
        ]);

        $validated['dinilai_oleh'] = Auth::id();

        $result->update($validated);

        return redirect()->route('admin.ppdb.nilai.show', $result)
            ->with('success', "Informasi nilai dan evaluasi untuk santri {$result->nama_santri} ({$result->no_pendaftaran}) berhasil diperbarui.");
    }
}
