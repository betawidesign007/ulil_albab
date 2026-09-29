<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SantriController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// 1. Landing Page Utama Pondok Pesantren
Route::get('/', function () {
    return view('landing');
})->name('landing');

// 1.b. Proses Pendaftaran Formulir PPDB Online
Route::post('/ppdb/daftar', function (\Illuminate\Http\Request $request) {
    $request->validate([
        'nama_lengkap' => 'required|string|max:255',
        'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
        'tempat_lahir' => 'required|string|max:100',
        'tanggal_lahir' => 'required|date',
        'jenjang' => 'required|string',
        'nama_wali' => 'required|string|max:255',
        'no_wa' => 'required|string|max:30',
        'alamat' => 'required|string',
    ]);

    $noPendaftaran = 'PPDB-' . date('Y') . '-' . str_pad(mt_rand(101, 9999), 4, '0', STR_PAD_LEFT);
    $jadwalUjian = ($request->jalur === 'Prestasi Tahfidz') ? 'Sabtu, 13 Juni 2027 (08.00 WIB)' : 'Minggu, 14 Juni 2027 (08.00 WIB)';
    $ruangUjian = ($request->model_ujian === 'Online / Jarak Jauh') ? 'Zoom Meeting Seleksi 01' : 'Gedung Rektorat Lt. 2 (Ruang Al-Fatih)';

    return back()->with('ppdb_success', [
        'no_pendaftaran' => $noPendaftaran,
        'nama_lengkap' => $request->nama_lengkap,
        'jenis_kelamin' => $request->jenis_kelamin,
        'jenjang' => $request->jenjang,
        'jalur' => $request->jalur ?? 'Reguler',
        'model_ujian' => $request->model_ujian ?? 'Tatap Muka di Pesantren',
        'nama_wali' => $request->nama_wali,
        'no_wa' => $request->no_wa,
        'jadwal_ujian' => $jadwalUjian,
        'ruang_ujian' => $ruangUjian,
        'tanggal_daftar' => now()->translatedFormat('d F Y'),
    ]);
})->name('ppdb.daftar');

// 2. Autentikasi Pengguna & Demo Quick-Login
Route::middleware('guest')->group(function () {
    // Tambahkan parameter opsional {role?} agar tombol 1-klik tidak error
    Route::get('/login/{role?}', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');


// 3. Area Manajemen Terproteksi (Login Diperlukan)
Route::middleware('auth')->group(function () {

    // Dashboard terpadu untuk Admin, Pengajar, dan Pemilik
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Hak Akses Bersama (Admin, Pengajar, Pemilik): Melihat Daftar & Detail Santri
    Route::get('/santri', [SantriController::class, 'index'])->name('santri.index');
    Route::get('/santri/{santri}', [SantriController::class, 'show'])->name('santri.show');

    // Hak Akses Khusus Administrator: CRUD Master Data Santri
    Route::middleware('role:admin')->group(function () {
        Route::get('/santri-tambah/baru', [SantriController::class, 'create'])->name('santri.create');
        Route::post('/santri', [SantriController::class, 'store'])->name('santri.store');
        Route::get('/santri/{santri}/edit', [SantriController::class, 'edit'])->name('santri.edit');
        Route::put('/santri/{santri}', [SantriController::class, 'update'])->name('santri.update');
        Route::delete('/santri/{santri}', [SantriController::class, 'destroy'])->name('santri.destroy');

        // Manajemen Pengguna (Admin, Pengajar, Pemilik)
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::post('/users', [UserController::class, 'store'])->name('users.store');
        Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    });

    // Hak Akses Pemilik & Admin: Laporan & Rekapitulasi Eksekutif
    Route::middleware('role:pemilik,admin')->group(function () {
        Route::get('/laporan/santri', [DashboardController::class, 'laporan'])->name('laporan.santri');
    });
});
