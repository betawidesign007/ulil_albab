<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Santri;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class PembayaranController extends Controller implements HasMiddleware
{
    /**
     * Daftarkan middleware pada controller ini.
     * Mengamankan index dan seluruh action pembayaran dari Pengajar.
     */
    public static function middleware(): array
    {
        return [
            // Seluruh fitur transaksi pembayaran (termasuk index) hanya untuk Admin dan Pemilik; Pengajar dilarang
            new Middleware('role:admin,pemilik'),
            // Tambah, ubah, dan hapus pembayaran dikhususkan hanya untuk Admin
            new Middleware('role:admin', except: ['index', 'show', 'cetak']),
        ];
    }

    /**
     * Daftar transaksi pembayaran (dapat diakses oleh Admin dan Pemilik; hak akses Pengajar ditiadakan).
     */
    public function index(Request $request)
    {
        if (Auth::user()?->isPengajar()) {
            abort(403, 'Akses Ditolak: Dewan Pengajar tidak memiliki hak akses pada transaksi pembayaran santri.');
        }

        $query = Pembayaran::with(['santri', 'petugas']);

        // Filter Pencarian (Kode Transaksi, Nama Santri, NIS, Catatan)
        if ($request->filled('search')) {
            $search = trim($request->input('search'));
            $query->where(function ($q) use ($search) {
                $q->where('kode_transaksi', 'like', "%{$search}%")
                    ->orWhere('catatan', 'like', "%{$search}%")
                    ->orWhereHas('santri', function ($sq) use ($search) {
                        $sq->where('nama_lengkap', 'like', "%{$search}%")
                            ->orWhere('nis', 'like', "%{$search}%");
                    });
            });
        }

        // Filter Kategori
        if ($request->filled('kategori')) {
            $query->where('kategori_pembayaran', $request->input('kategori'));
        }

        // Filter Metode Pembayaran
        if ($request->filled('metode')) {
            $query->where('metode_pembayaran', $request->input('metode'));
        }

        // Filter Status
        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        // Filter Santri spesifik
        if ($request->filled('santri_id')) {
            $query->where('santri_id', $request->input('santri_id'));
        }

        // Filter Rentang Tanggal
        if ($request->filled('tanggal_mulai')) {
            $query->whereDate('tanggal_pembayaran', '>=', $request->input('tanggal_mulai'));
        }
        if ($request->filled('tanggal_akhir')) {
            $query->whereDate('tanggal_pembayaran', '<=', $request->input('tanggal_akhir'));
        }

        // Ringkasan Statistik
        $totalPenerimaan = Pembayaran::where('status', 'Lunas')->sum('jumlah');
        $transaksiBulanIni = Pembayaran::where('status', 'Lunas')
            ->whereMonth('tanggal_pembayaran', date('m'))
            ->whereYear('tanggal_pembayaran', date('Y'))
            ->sum('jumlah');
        $totalTransaksi = Pembayaran::count();
        $totalPending = Pembayaran::where('status', 'Pending')->count();

        $pembayarans = $query->orderBy('tanggal_pembayaran', 'desc')
            ->orderBy('id', 'desc')
            ->paginate(10)
            ->withQueryString();

        $kategoris = [
            'Syahriah / SPP Bulanan',
            'Uang Gedung / Pangkal',
            'Pendaftaran Santri Baru',
            'Kitab & Modul Pelajaran',
            'Seragam & Perlengkapan',
            'Uang Makan / Konsumsi',
            'Kegiatan & Ujian Semester',
            'Infaq & Wakaf Sukarela',
            'Lain-lain',
        ];

        return view('pembayaran.index', compact(
            'pembayarans',
            'totalPenerimaan',
            'transaksiBulanIni',
            'totalTransaksi',
            'totalPending',
            'kategoris'
        ));
    }

    /**
     * Form Tambah Transaksi Pembayaran (Khusus Admin).
     */
    public function create(Request $request)
    {
        $this->authorizeAdmin();

        $santris = Santri::orderBy('nama_lengkap')->get(['id', 'nis', 'nama_lengkap', 'kelas', 'kamar']);
        $selectedSantriId = $request->query('santri_id');
        $kodeTransaksi = Pembayaran::generateKodeTransaksi();

        $kategoris = [
            'Syahriah / SPP Bulanan',
            'Uang Gedung / Pangkal',
            'Pendaftaran Santri Baru',
            'Kitab & Modul Pelajaran',
            'Seragam & Perlengkapan',
            'Uang Makan / Konsumsi',
            'Kegiatan & Ujian Semester',
            'Infaq & Wakaf Sukarela',
            'Lain-lain',
        ];

        $bulanList = [
            'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
            'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember',
        ];

        return view('pembayaran.create', compact('santris', 'selectedSantriId', 'kodeTransaksi', 'kategoris', 'bulanList'));
    }

    /**
     * Simpan Transaksi Pembayaran Baru (Khusus Admin).
     */
    public function store(Request $request)
    {
        $this->authorizeAdmin();

        $validated = $request->validate([
            'santri_id' => 'required|exists:santris,id',
            'kategori_pembayaran' => 'required|string|max:100',
            'bulan_dibayar' => 'nullable|string|max:50',
            'tahun_dibayar' => 'nullable|string|max:50',
            'jumlah' => 'required|numeric|min:0',
            'tanggal_pembayaran' => 'required|date',
            'metode_pembayaran' => 'required|in:Tunai,Transfer Bank,QRIS',
            'status' => 'required|in:Lunas,Pending,Batal',
            'bukti_bayar' => 'nullable|file|mimes:jpg,jpeg,png,webp,pdf|max:5120',
            'catatan' => 'nullable|string|max:1000',
        ]);

        $validated['kode_transaksi'] = Pembayaran::generateKodeTransaksi();
        $validated['user_id'] = Auth::id();

        // Upload bukti pembayaran jika ada
        if ($request->hasFile('bukti_bayar')) {
            $file = $request->file('bukti_bayar');
            $extension = strtolower($file->getClientOriginalExtension() ?: 'jpg');
            $filename = 'bukti_'.time().'_'.bin2hex(random_bytes(4)).'.'.$extension;
            $targetDir = public_path('images/pembayaran');

            if (! file_exists($targetDir)) {
                mkdir($targetDir, 0755, true);
            }

            $file->move($targetDir, $filename);
            $validated['bukti_bayar'] = 'images/pembayaran/'.$filename;
        }

        $pembayaran = Pembayaran::create($validated);

        return redirect()->route('pembayaran.show', $pembayaran->id)
            ->with('success', 'Transaksi pembayaran berhasil dicatat dengan kode: '.$pembayaran->kode_transaksi);
    }

    /**
     * Tampilkan Detail Transaksi / Kwitansi Pembayaran.
     */
    public function show(Pembayaran $pembayaran)
    {
        if (Auth::user()?->isPengajar()) {
            abort(403, 'Akses Ditolak: Dewan Pengajar tidak memiliki hak akses pada transaksi pembayaran santri.');
        }

        $pembayaran->load(['santri', 'petugas']);

        return view('pembayaran.show', compact('pembayaran'));
    }

    /**
     * Cetak Kwitansi Pembayaran Format Thermal / Kertas A4.
     */
    public function cetak(Pembayaran $pembayaran)
    {
        if (Auth::user()?->isPengajar()) {
            abort(403, 'Akses Ditolak: Dewan Pengajar tidak memiliki hak akses pada transaksi pembayaran santri.');
        }

        $pembayaran->load(['santri', 'petugas']);

        return view('pembayaran.cetak', compact('pembayaran'));
    }

    /**
     * Form Edit Transaksi Pembayaran (Khusus Admin).
     */
    public function edit(Pembayaran $pembayaran)
    {
        $this->authorizeAdmin();

        $santris = Santri::orderBy('nama_lengkap')->get(['id', 'nis', 'nama_lengkap', 'kelas', 'kamar']);

        $kategoris = [
            'Syahriah / SPP Bulanan',
            'Uang Gedung / Pangkal',
            'Pendaftaran Santri Baru',
            'Kitab & Modul Pelajaran',
            'Seragam & Perlengkapan',
            'Uang Makan / Konsumsi',
            'Kegiatan & Ujian Semester',
            'Infaq & Wakaf Sukarela',
            'Lain-lain',
        ];

        $bulanList = [
            'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
            'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember',
        ];

        return view('pembayaran.edit', compact('pembayaran', 'santris', 'kategoris', 'bulanList'));
    }

    /**
     * Update Transaksi Pembayaran (Khusus Admin).
     */
    public function update(Request $request, Pembayaran $pembayaran)
    {
        $this->authorizeAdmin();

        $validated = $request->validate([
            'santri_id' => 'required|exists:santris,id',
            'kategori_pembayaran' => 'required|string|max:100',
            'bulan_dibayar' => 'nullable|string|max:50',
            'tahun_dibayar' => 'nullable|string|max:50',
            'jumlah' => 'required|numeric|min:0',
            'tanggal_pembayaran' => 'required|date',
            'metode_pembayaran' => 'required|in:Tunai,Transfer Bank,QRIS',
            'status' => 'required|in:Lunas,Pending,Batal',
            'bukti_bayar' => 'nullable|file|mimes:jpg,jpeg,png,webp,pdf|max:5120',
            'catatan' => 'nullable|string|max:1000',
        ]);

        if ($request->hasFile('bukti_bayar')) {
            // Hapus file lama jika ada dan file fisik ada
            if ($pembayaran->bukti_bayar && file_exists(public_path($pembayaran->bukti_bayar))) {
                File::delete(public_path($pembayaran->bukti_bayar));
            }

            $file = $request->file('bukti_bayar');
            $extension = strtolower($file->getClientOriginalExtension() ?: 'jpg');
            $filename = 'bukti_'.time().'_'.bin2hex(random_bytes(4)).'.'.$extension;
            $targetDir = public_path('images/pembayaran');

            if (! file_exists($targetDir)) {
                mkdir($targetDir, 0755, true);
            }

            $file->move($targetDir, $filename);
            $validated['bukti_bayar'] = 'images/pembayaran/'.$filename;
        }

        $pembayaran->update($validated);

        return redirect()->route('pembayaran.show', $pembayaran->id)
            ->with('success', 'Transaksi pembayaran berhasil diperbarui!');
    }

    /**
     * Hapus Transaksi Pembayaran (Khusus Admin).
     */
    public function destroy(Pembayaran $pembayaran)
    {
        $this->authorizeAdmin();

        if ($pembayaran->bukti_bayar && file_exists(public_path($pembayaran->bukti_bayar))) {
            File::delete(public_path($pembayaran->bukti_bayar));
        }

        $kode = $pembayaran->kode_transaksi;
        $pembayaran->delete();

        return redirect()->route('pembayaran.index')
            ->with('success', "Transaksi pembayaran {$kode} berhasil dihapus.");
    }

    /**
     * Helper proteksi hanya Admin yang dapat menambah/mengubah data pembayaran
     */
    private function authorizeAdmin(): void
    {
        if (! Auth::check() || ! Auth::user()->isAdmin()) {
            abort(403, 'Akses Ditolak: Hanya Administrator yang berwenang mengelola transaksi pembayaran.');
        }
    }
}
