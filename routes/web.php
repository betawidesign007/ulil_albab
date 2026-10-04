<?php

use App\Http\Controllers\Admin\KegiatanController;
use App\Http\Controllers\Admin\PpdbSettingController;
use App\Http\Controllers\Admin\VideoController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JadwalPelajaranController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\SantriController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// 1. Landing Page Utama Pondok Pesantren & Pendaftaran PPDB Online
Route::get('/', [LandingController::class, 'index'])->name('landing');
Route::post('/ppdb/daftar', [LandingController::class, 'daftarPpdb'])->name('ppdb.daftar');
Route::redirect('/profil', '/#profil');
Route::redirect('/visi-misi', '/#visi-misi');
Route::redirect('/struktur', '/#struktur');

// 2. Autentikasi Pengguna SIMPONPES (Terproteksi dari Akses Publik Langsung)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
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

    // Hak Akses Bersama (Admin, Pengajar, Pemilik): Jadwal Mata Pelajaran & Acuan Kerja
    Route::get('/jadwal', [JadwalPelajaranController::class, 'index'])->name('jadwal.index');
    Route::get('/jadwal/cetak', [JadwalPelajaranController::class, 'cetak'])->name('jadwal.cetak');
    Route::get('/jadwal/{jadwal}', [JadwalPelajaranController::class, 'show'])->name('jadwal.show');
    Route::post('/jadwal/{jadwal}/acuan', [JadwalPelajaranController::class, 'updateAcuanKerja'])->name('jadwal.acuan');
    Route::post('/jadwal/{jadwal}/jurnal', [JadwalPelajaranController::class, 'updateJurnal'])->name('jadwal.jurnal');
    Route::post('/jadwal/{jadwal}/supervisi', [JadwalPelajaranController::class, 'supervisi'])->name('jadwal.supervisi');

    // Hak Akses Khusus Administrator: CRUD Master Data Santri, Pengguna, Jadwal, PPDB, Galeri Foto & Video
    Route::middleware('role:admin')->group(function () {
        Route::get('/santri-tambah/baru', [SantriController::class, 'create'])->name('santri.create');
        Route::post('/santri', [SantriController::class, 'store'])->name('santri.store');
        Route::get('/santri/{santri}/edit', [SantriController::class, 'edit'])->name('santri.edit');
        Route::put('/santri/{santri}', [SantriController::class, 'update'])->name('santri.update');
        Route::delete('/santri/{santri}', [SantriController::class, 'destroy'])->name('santri.destroy');

        // Manajemen Pengguna (Admin, Pengajar, Pemilik)
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::post('/users', [UserController::class, 'store'])->name('users.store');
        Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
        Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

        // Manajemen Galeri Konten Kegiatan
        Route::resource('kegiatan', KegiatanController::class);

        // Manajemen Galeri Video & 4 Video Slideshow Teratas
        Route::resource('video', VideoController::class);

        // Manajemen Pengaturan Informasi PPDB & Website Landing Page
        Route::get('/admin/ppdb-setting', [PpdbSettingController::class, 'index'])->name('admin.ppdb.index');
        Route::put('/admin/ppdb-setting', [PpdbSettingController::class, 'update'])->name('admin.ppdb.update');

        // Manajemen CRUD Jadwal Pelajaran (Khusus Administrator)
        Route::get('/jadwal-tambah/baru', [JadwalPelajaranController::class, 'create'])->name('jadwal.create');
        Route::post('/jadwal', [JadwalPelajaranController::class, 'store'])->name('jadwal.store');
        Route::get('/jadwal/{jadwal}/edit', [JadwalPelajaranController::class, 'edit'])->name('jadwal.edit');
        Route::put('/jadwal/{jadwal}', [JadwalPelajaranController::class, 'update'])->name('jadwal.update');
        Route::delete('/jadwal/{jadwal}', [JadwalPelajaranController::class, 'destroy'])->name('jadwal.destroy');
    });

    // Hak Akses Pemilik & Admin: Laporan & Rekapitulasi Eksekutif
    Route::middleware('role:pemilik,admin')->group(function () {
        Route::get('/laporan/santri', [DashboardController::class, 'laporan'])->name('laporan.santri');
    });
});
