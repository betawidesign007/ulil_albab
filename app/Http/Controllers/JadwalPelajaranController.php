<?php

namespace App\Http\Controllers;

use App\Models\JadwalPelajaran;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JadwalPelajaranController extends Controller
{
    /**
     * Tampilkan Matriks Jadwal Pelajaran & Monitoring Acuan Kerja
     * Dapat diakses dan dikontrol oleh Admin, Pengajar, dan Pemilik
     */
    public function index(Request $request)
    {
        $user = Auth::user();

        $query = JadwalPelajaran::with(['pengajar', 'supervisor'])
            ->when($request->filled('hari'), fn ($q) => $q->where('hari', $request->hari))
            ->when($request->filled('kelas'), fn ($q) => $q->where('kelas', $request->kelas))
            ->when($request->filled('pengajar_id'), fn ($q) => $q->where('user_id', $request->pengajar_id))
            ->when($request->filled('status'), fn ($q) => $q->where('status_pelaksanaan', $request->status))
            ->when($request->filled('verifikasi'), fn ($q) => $q->where('status_verifikasi', $request->verifikasi));

        $hariOrderSql = "CASE hari WHEN 'Senin' THEN 1 WHEN 'Selasa' THEN 2 WHEN 'Rabu' THEN 3 WHEN 'Kamis' THEN 4 WHEN 'Jumat' THEN 5 WHEN 'Sabtu' THEN 6 WHEN 'Ahad' THEN 7 ELSE 8 END";

        // Sorting urutan hari & jam
        $jadwals = $query->orderByRaw($hariOrderSql)
            ->orderBy('jam_mulai')
            ->get();

        // Data khusus pengajar yang sedang login
        $myJadwals = null;
        if ($user->isPengajar()) {
            $myJadwals = JadwalPelajaran::with(['pengajar', 'supervisor'])
                ->where('user_id', $user->id)
                ->orderByRaw($hariOrderSql)
                ->orderBy('jam_mulai')
                ->get();
        }

        // Statistik Acuan Kerja untuk Mudir/Pemilik & Admin
        $totalJadwal = JadwalPelajaran::count();
        $totalPengajar = User::where('role', 'pengajar')->count();
        $statusAktifCount = JadwalPelajaran::where('status_pelaksanaan', 'aktif')->count();
        $statusTuntasCount = JadwalPelajaran::where('status_pelaksanaan', 'tuntas')->count();
        $verifikasiDisetujuiCount = JadwalPelajaran::where('status_verifikasi', 'disetujui_mudir')->count();
        $verifikasiMenungguCount = JadwalPelajaran::where('status_verifikasi', 'menunggu_verifikasi')->count();
        $verifikasiRevisiCount = JadwalPelajaran::where('status_verifikasi', 'perlu_revisi')->count();

        // Daftar Pengajar & Kelas untuk filter
        $pengajars = User::whereIn('role', ['pengajar', 'admin'])->orderBy('name')->get();
        $kelasList = JadwalPelajaran::select('kelas')->distinct()->pluck('kelas');

        return view('jadwal.index', compact(
            'jadwals',
            'myJadwals',
            'pengajars',
            'kelasList',
            'totalJadwal',
            'totalPengajar',
            'statusAktifCount',
            'statusTuntasCount',
            'verifikasiDisetujuiCount',
            'verifikasiMenungguCount',
            'verifikasiRevisiCount'
        ));
    }

    /**
     * Form Tambah Jadwal Baru (Khusus Administrator)
     */
    public function create()
    {
        if (! Auth::user()->isAdmin()) {
            abort(403, 'Hanya Administrator yang berwenang menambah alokasi jadwal pelajaran.');
        }

        $pengajars = User::whereIn('role', ['pengajar', 'admin'])->orderBy('name')->get();

        return view('jadwal.create', compact('pengajars'));
    }

    /**
     * Simpan Jadwal Baru (Khusus Administrator)
     */
    public function store(Request $request)
    {
        if (! Auth::user()->isAdmin()) {
            abort(403, 'Hanya Administrator yang berwenang menambah jadwal pelajaran.');
        }

        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'hari' => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Ahad',
            'jam_mulai' => 'required|string|max:10',
            'jam_selesai' => 'required|string|max:10',
            'mata_pelajaran' => 'required|string|max:255',
            'kelas' => 'required|string|max:100',
            'ruangan' => 'required|string|max:100',
            'tahun_ajaran' => 'required|string|max:50',
            'semester' => 'required|in:Ganjil,Genap',
            'kitab_referensi' => 'nullable|string|max:255',
            'target_capaian' => 'nullable|string',
            'metode_pembelajaran' => 'nullable|string|max:255',
            'silabus_ringkas' => 'nullable|string',
        ]);

        $validated['status_pelaksanaan'] = 'aktif';
        $validated['status_verifikasi'] = 'menunggu_verifikasi';

        JadwalPelajaran::create($validated);

        return redirect()->route('jadwal.index')->with('success', 'Jadwal mata pelajaran dan konsep acuan kerja baru berhasil ditambahkan.');
    }

    /**
     * Tampilkan Detail Acuan Kerja Jadwal Pelajaran
     */
    public function show(JadwalPelajaran $jadwal)
    {
        $jadwal->load(['pengajar', 'supervisor']);

        return view('jadwal.show', compact('jadwal'));
    }

    /**
     * Form Edit Jadwal Pelajaran (Khusus Administrator)
     */
    public function edit(JadwalPelajaran $jadwal)
    {
        if (! Auth::user()->isAdmin()) {
            abort(403, 'Hanya Administrator yang berwenang mengubah jadwal pelajaran.');
        }

        $pengajars = User::whereIn('role', ['pengajar', 'admin'])->orderBy('name')->get();

        return view('jadwal.edit', compact('jadwal', 'pengajars'));
    }

    /**
     * Update Jadwal Pelajaran (Khusus Administrator)
     */
    public function update(Request $request, JadwalPelajaran $jadwal)
    {
        if (! Auth::user()->isAdmin()) {
            abort(403, 'Hanya Administrator yang berwenang mengubah jadwal pelajaran.');
        }

        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'hari' => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Ahad',
            'jam_mulai' => 'required|string|max:10',
            'jam_selesai' => 'required|string|max:10',
            'mata_pelajaran' => 'required|string|max:255',
            'kelas' => 'required|string|max:100',
            'ruangan' => 'required|string|max:100',
            'tahun_ajaran' => 'required|string|max:50',
            'semester' => 'required|in:Ganjil,Genap',
            'kitab_referensi' => 'nullable|string|max:255',
            'target_capaian' => 'nullable|string',
            'metode_pembelajaran' => 'nullable|string|max:255',
            'silabus_ringkas' => 'nullable|string',
            'status_pelaksanaan' => 'required|in:aktif,tuntas,diganti,kendala',
        ]);

        $jadwal->update($validated);

        return redirect()->route('jadwal.index')->with('success', 'Jadwal mata pelajaran dan acuan kerja berhasil diperbarui.');
    }

    /**
     * Hapus Jadwal Pelajaran (Khusus Administrator)
     */
    public function destroy(JadwalPelajaran $jadwal)
    {
        if (! Auth::user()->isAdmin()) {
            abort(403, 'Hanya Administrator yang berwenang menghapus jadwal.');
        }

        $jadwal->delete();

        return redirect()->route('jadwal.index')->with('success', 'Jadwal mata pelajaran berhasil dihapus.');
    }

    /**
     * Kontrol Pengajar: Update Jurnal Capaian & Status Pelaksanaan Acuan Kerja
     * Pengajar dapat mengupdate jurnal kelasnya sendiri, Admin juga memiliki akses.
     */
    public function updateJurnal(Request $request, JadwalPelajaran $jadwal)
    {
        $user = Auth::user();

        // Validasi hak akses: Pengajar pemilik jadwal atau Admin
        if (! $user->isAdmin() && $jadwal->user_id !== $user->id) {
            abort(403, 'Anda hanya dapat memperbarui jurnal untuk jadwal mengajar Anda sendiri.');
        }

        $validated = $request->validate([
            'jurnal_terakhir' => 'required|string|max:2000',
            'status_pelaksanaan' => 'required|in:aktif,tuntas,diganti,kendala',
        ]);

        $jadwal->update([
            'jurnal_terakhir' => $validated['jurnal_terakhir'],
            'status_pelaksanaan' => $validated['status_pelaksanaan'],
            'jurnal_updated_at' => now(),
            'status_verifikasi' => 'menunggu_verifikasi', // Agar dievaluasi ulang oleh Mudir
        ]);

        return redirect()->back()->with('success', 'Jurnal capaian materi dan status acuan kerja berhasil diperbarui.');
    }

    /**
     * Kontrol Pemilik (Mudir / Yayasan): Supervisi, Evaluasi, dan Verifikasi Acuan Kerja
     * Pemilik dan Admin dapat memberikan evaluasi arahan & verifikasi acuan kerja.
     */
    public function supervisi(Request $request, JadwalPelajaran $jadwal)
    {
        $user = Auth::user();

        if (! $user->isPemilik() && ! $user->isAdmin()) {
            abort(403, 'Hanya Pimpinan/Pemilik Pondok dan Administrator yang memiliki wewenang supervisi.');
        }

        $validated = $request->validate([
            'catatan_supervisi' => 'required|string|max:2000',
            'status_verifikasi' => 'required|in:disetujui_mudir,menunggu_verifikasi,perlu_revisi',
        ]);

        $jadwal->update([
            'catatan_supervisi' => $validated['catatan_supervisi'],
            'status_verifikasi' => $validated['status_verifikasi'],
            'supervisi_by' => $user->id,
            'supervisi_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Catatan supervisi dan evaluasi acuan kerja berhasil dikirimkan ke pengajar.');
    }

    /**
     * Kontrol Pengajar & Admin: Tambah / Perbarui Dokumen Acuan Kerja (Target, Kitab, Metode, Silabus)
     */
    public function updateAcuanKerja(Request $request, JadwalPelajaran $jadwal)
    {
        $user = Auth::user();

        if (! $user->isAdmin() && $jadwal->user_id !== $user->id) {
            abort(403, 'Anda hanya dapat memperbarui dokumen acuan kerja untuk jadwal mengajar Anda sendiri.');
        }

        $validated = $request->validate([
            'kitab_referensi' => 'nullable|string|max:255',
            'metode_pembelajaran' => 'nullable|string|max:255',
            'target_capaian' => 'required|string|max:2000',
            'silabus_ringkas' => 'nullable|string|max:2000',
        ]);

        $jadwal->update([
            'kitab_referensi' => $validated['kitab_referensi'],
            'metode_pembelajaran' => $validated['metode_pembelajaran'],
            'target_capaian' => $validated['target_capaian'],
            'silabus_ringkas' => $validated['silabus_ringkas'],
            'status_verifikasi' => 'menunggu_verifikasi',
        ]);

        return redirect()->back()->with('success', 'Dokumen target acuan kerja berhasil disimpan dan siap disupervisi.');
    }

    /**
     * Cetak Lembar Matriks Jadwal & Acuan Kerja Pondok Pesantren
     */
    public function cetak(Request $request)
    {
        $hariOrderSql = "CASE hari WHEN 'Senin' THEN 1 WHEN 'Selasa' THEN 2 WHEN 'Rabu' THEN 3 WHEN 'Kamis' THEN 4 WHEN 'Jumat' THEN 5 WHEN 'Sabtu' THEN 6 WHEN 'Ahad' THEN 7 ELSE 8 END";

        $jadwals = JadwalPelajaran::with(['pengajar', 'supervisor'])
            ->when($request->filled('hari'), fn ($q) => $q->where('hari', $request->hari))
            ->when($request->filled('kelas'), fn ($q) => $q->where('kelas', $request->kelas))
            ->when($request->filled('pengajar_id'), fn ($q) => $q->where('user_id', $request->pengajar_id))
            ->orderByRaw($hariOrderSql)
            ->orderBy('jam_mulai')
            ->get();

        $pemilik = User::where('role', 'pemilik')->first();

        return view('jadwal.cetak', compact('jadwals', 'pemilik'));
    }
}
