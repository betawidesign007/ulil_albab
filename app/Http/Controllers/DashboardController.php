<?php

namespace App\Http\Controllers;

use App\Models\Santri;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Tampilkan dashboard sesuai role yang sedang login
     */
    public function index()
    {
        $user = Auth::user();

        // Metrik umum
        $totalSantri = Santri::count();
        $totalPutra = Santri::where('jenis_kelamin', 'Laki-laki')->count();
        $totalPutri = Santri::where('jenis_kelamin', 'Perempuan')->count();
        $totalUsers = User::count();

        // Data santri terbaru
        $recentSantris = Santri::latest()->take(5)->get();

        // Statistik per Asrama/Kamar
        $kamarStats = Santri::select('kamar')
            ->selectRaw('count(*) as total')
            ->whereNotNull('kamar')
            ->groupBy('kamar')
            ->get();

        // Statistik per Kelas
        $kelasStats = Santri::select('kelas')
            ->selectRaw('count(*) as total')
            ->whereNotNull('kelas')
            ->groupBy('kelas')
            ->get();

        return view('dashboard.index', compact(
            'user',
            'totalSantri',
            'totalPutra',
            'totalPutri',
            'totalUsers',
            'recentSantris',
            'kamarStats',
            'kelasStats'
        ));
    }

    /**
     * Laporan eksekutif santri untuk Pemilik Pondok dan Admin
     */
    public function laporan()
    {
        $santris = Santri::orderBy('kelas')->orderBy('nama_lengkap')->get();
        $totalSantri = $santris->count();
        $totalPutra = $santris->where('jenis_kelamin', 'Laki-laki')->count();
        $totalPutri = $santris->where('jenis_kelamin', 'Perempuan')->count();

        return view('dashboard.laporan', compact(
            'santris',
            'totalSantri',
            'totalPutra',
            'totalPutri'
        ));
    }
}
