<?php

use App\Http\Controllers\Admin\KegiatanController;
use App\Http\Controllers\Admin\PpdbExamAdminController;
use App\Http\Controllers\Admin\PpdbSettingController;
use App\Http\Controllers\Admin\VideoController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JadwalPelajaranController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\PpdbExamController;
use App\Http\Controllers\ProfileController;
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
Route::redirect('/dokumentasi', '/#kegiatan');
Route::redirect('/kegiatan', '/#kegiatan');
Route::redirect('/video', '/#video');
Route::redirect('/galeri', '/#video');
Route::redirect('/ppdb', '/#formulir-ppdb');
Route::redirect('/daftar', '/#formulir-ppdb');
Route::redirect('/formulir', '/#formulir-ppdb');
Route::redirect('/alur-ujian', '/#alur-ujian');

// 1B. Ujian Masuk Akademik Calon Santri (CBT Online Mandiri)
Route::get('/ujian-masuk', [PpdbExamController::class, 'index'])->name('ppdb.exam.index');
Route::post('/ujian-masuk/start', [PpdbExamController::class, 'start'])->name('ppdb.exam.start');
Route::post('/ujian-masuk/submit', [PpdbExamController::class, 'submit'])->name('ppdb.exam.submit');
Route::get('/ujian-masuk/hasil/{no_pendaftaran}', [PpdbExamController::class, 'result'])->name('ppdb.exam.result');
Route::get('/ujian-masuk/cetak/{no_pendaftaran}', [PpdbExamController::class, 'cetak'])->name('ppdb.exam.cetak');

// 2. Autentikasi Pengguna SIMPONPES (Terproteksi dari Akses Publik Langsung)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');

    // Alur Autentikasi Lupa Kata Sandi & Reset Password
    Route::get('/forgot-password', [PasswordResetController::class, 'showForgotForm'])->name('password.request');
    Route::post('/forgot-password', [PasswordResetController::class, 'sendResetLink'])->name('password.email');
    Route::get('/reset-password/{token}', [PasswordResetController::class, 'showResetForm'])->name('password.reset');
    Route::post('/reset-password', [PasswordResetController::class, 'resetPassword'])->name('password.update');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// 3. Area Manajemen Terproteksi (Login Diperlukan)
Route::middleware('auth')->group(function () {

    // Pengaturan Akun & Profil Pengguna Mandiri (Ganti Email & Password)
    Route::get('/profil-saya', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profil-saya', [ProfileController::class, 'update'])->name('profile.update');

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

    // Hak Akses Pembayaran Santri (Khusus Admin & Pemilik - Hak Akses Pengajar Dihapus)
    Route::middleware('role:admin,pemilik')->group(function () {
        Route::get('/pembayaran', [PembayaranController::class, 'index'])->name('pembayaran.index');
        Route::get('/pembayaran/{pembayaran}', [PembayaranController::class, 'show'])->name('pembayaran.show');
        Route::get('/pembayaran/{pembayaran}/cetak', [PembayaranController::class, 'cetak'])->name('pembayaran.cetak');
    });

    // Hak Akses Khusus Administrator: CRUD Master Data Santri, Pengguna, Jadwal, PPDB, Galeri Foto & Video
    Route::middleware('role:admin')->group(function () {
        Route::get('/santri-tambah/baru', [SantriController::class, 'create'])->name('santri.create');
        Route::post('/santri', [SantriController::class, 'store'])->name('santri.store');
        Route::get('/santri/{santri}/edit', [SantriController::class, 'edit'])->name('santri.edit');
        Route::put('/santri/{santri}', [SantriController::class, 'update'])->name('santri.update');
        Route::delete('/santri/{santri}', [SantriController::class, 'destroy'])->name('santri.destroy');

        // CRUD Transaksi Pembayaran
        Route::get('/pembayaran-tambah/baru', [PembayaranController::class, 'create'])->name('pembayaran.create');
        Route::post('/pembayaran', [PembayaranController::class, 'store'])->name('pembayaran.store');
        Route::get('/pembayaran/{pembayaran}/edit', [PembayaranController::class, 'edit'])->name('pembayaran.edit');
        Route::put('/pembayaran/{pembayaran}', [PembayaranController::class, 'update'])->name('pembayaran.update');
        Route::delete('/pembayaran/{pembayaran}', [PembayaranController::class, 'destroy'])->name('pembayaran.destroy');

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

        // Manajemen Bank Soal Ujian Masuk PPDB (CRUD 50+ Soal & Toggle Status)
        Route::get('/admin/ppdb/soal', [PpdbExamAdminController::class, 'soalIndex'])->name('admin.ppdb.soal.index');
        Route::get('/admin/ppdb/soal/create', [PpdbExamAdminController::class, 'soalCreate'])->name('admin.ppdb.soal.create');
        Route::post('/admin/ppdb/soal', [PpdbExamAdminController::class, 'soalStore'])->name('admin.ppdb.soal.store');
        Route::get('/admin/ppdb/soal/{soal}/edit', [PpdbExamAdminController::class, 'soalEdit'])->name('admin.ppdb.soal.edit');
        Route::put('/admin/ppdb/soal/{soal}', [PpdbExamAdminController::class, 'soalUpdate'])->name('admin.ppdb.soal.update');
        Route::delete('/admin/ppdb/soal/{soal}', [PpdbExamAdminController::class, 'soalDestroy'])->name('admin.ppdb.soal.destroy');
        Route::patch('/admin/ppdb/soal/{soal}/toggle', [PpdbExamAdminController::class, 'soalToggleAktif'])->name('admin.ppdb.soal.toggle');

        // Manajemen Nilai & Evaluasi Keputusan Kelulusan Ujian Masuk Santri
        Route::get('/admin/ppdb/nilai', [PpdbExamAdminController::class, 'nilaiIndex'])->name('admin.ppdb.nilai.index');
        Route::get('/admin/ppdb/nilai/{result}', [PpdbExamAdminController::class, 'nilaiShow'])->name('admin.ppdb.nilai.show');
        Route::put('/admin/ppdb/nilai/{result}', [PpdbExamAdminController::class, 'nilaiUpdate'])->name('admin.ppdb.nilai.update');

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
