@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-12 col-xl-11">

        <!-- Controls (Hidden on print) -->
        <div class="d-flex justify-content-between align-items-center mb-4 d-print-none">
            <div>
                <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary btn-sm">
                    &larr; Kembali ke Dashboard
                </a>
            </div>
            <div class="d-flex gap-2">
                <button onclick="window.print()" class="btn btn-pesantren btn-sm d-flex align-items-center gap-1 shadow-sm">
                    <i class="bi bi-printer-fill"></i> Cetak Dokumen Resmi
                </button>
            </div>
        </div>

        <!-- Official Report Paper Document -->
        <div class="card border-0 shadow-sm p-4 p-md-5 bg-white">

            <!-- Official Letterhead (Kop Surat Pesantren) -->
            <div class="text-center border-bottom pb-4 mb-4 position-relative">
                <div class="d-flex align-items-center justify-content-center gap-3 mb-2">
                    <span class="d-inline-flex align-items-center justify-content-center bg-success text-white rounded-circle shadow-sm" style="width: 55px; height: 55px;">
                        <i class="bi bi-book-half fs-2"></i>
                    </span>
                    <div>
                        <h6 class="text-uppercase tracking-wider text-muted mb-0 small">Yayasan Pendidikan Islam</h6>
                        <h2 class="fw-bold mb-0 text-success">PONDOK PESANTREN MODERN LI ULIL ALBAB</h2>
                        <small class="text-muted">SK Kemenag RI No: 452/PP.00.7/2018 &bull; Terakreditasi A (Unggul)</small>
                    </div>
                </div>
                <p class="text-muted small mb-0">
                    Alamat: Kompleks Pesantren Li Ulil Albab Center, Jl. Raya Pesantren No. 99 | Telp: (031) 8765-4321 | Web: www.ulilalbab.ac.id
                </p>
                <div class="border-top border-dark border-2 mt-3 pt-1"></div>
            </div>

            <!-- Report Title -->
            <div class="text-center mb-4">
                <h4 class="fw-bold text-dark text-uppercase mb-1">Laporan Rekapitulasi Data Induk Santri</h4>
                <p class="text-muted small mb-0">Tahun Ajaran 2026/2027 &bull; Dicetak pada: {{ \Carbon\Carbon::now()->translatedFormat('d F Y, H:i') }} WIB</p>
            </div>

            <!-- Summary Chips -->
            <div class="row g-3 mb-4">
                <div class="col-md-4">
                    <div class="p-3 bg-light rounded-3 text-center border">
                        <small class="text-muted d-block">Total Seluruh Santri</small>
                        <strong class="fs-4 text-success">{{ $totalSantri }}</strong> Santri
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-3 bg-light rounded-3 text-center border">
                        <small class="text-muted d-block">Santri Putra (Banin)</small>
                        <strong class="fs-4 text-primary">{{ $totalPutra }}</strong> Santri
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-3 bg-light rounded-3 text-center border">
                        <small class="text-muted d-block">Santri Putri (Banat)</small>
                        <strong class="fs-4 text-danger">{{ $totalPutri }}</strong> Santri
                    </div>
                </div>
            </div>

            <!-- Santri Data Table -->
            <div class="table-responsive mb-4">
                <table class="table table-bordered table-striped align-middle small mb-0">
                    <thead class="table-success text-center">
                        <tr>
                            <th style="width: 40px;">No</th>
                            <th>NIS</th>
                            <th>Nama Lengkap</th>
                            <th>Jenis Kelamin</th>
                            <th>Tempat, Tanggal Lahir</th>
                            <th>Asrama / Kamar</th>
                            <th>Kelas</th>
                            <th>Alamat Domisili</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($santris as $index => $santri)
                            <tr>
                                <td class="text-center">{{ $index + 1 }}</td>
                                <td class="fw-bold text-center">{{ $santri->nis }}</td>
                                <td class="fw-semibold">{{ $santri->nama_lengkap }}</td>
                                <td class="text-center">{{ $santri->jenis_kelamin }}</td>
                                <td>
                                    {{ $santri->tempat_lahir }},
                                    {{ \Carbon\Carbon::parse($santri->tanggal_lahir)->translatedFormat('d M Y') }}
                                </td>
                                <td>{{ $santri->kamar ?? '-' }}</td>
                                <td>{{ $santri->kelas ?? '-' }}</td>
                                <td>{{ $santri->alamat ?? '-' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-3 text-muted">Belum ada data santri yang tercatat.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Signatures Section -->
            <div class="row mt-5 pt-4 text-center">
                <div class="col-6">
                    <p class="small text-muted mb-5">
                        Mengetahui,<br>
                        <strong>Kepala Bagian Tata Usaha (Admin)</strong>
                    </p>
                    <p class="fw-bold mb-0 text-decoration-underline">Ustadz M. Faruq, S.Kom</p>
                    <small class="text-muted">NIP. 19850412 201201 1 002</small>
                </div>
                <div class="col-6">
                    <p class="small text-muted mb-5">
                        Disetujui oleh,<br>
                        <strong>Pimpinan &amp; Pengasuh Pondok (Mudir)</strong>
                    </p>
                    <p class="fw-bold mb-0 text-decoration-underline">KH. Dr. Abdullah Syukri, M.Ag</p>
                    <small class="text-muted">NIP. 19740815 200003 1 001</small>
                </div>
            </div>

        </div>
    </div>
</div>

<style>
@media print {
    header, footer, .d-print-none, .navbar, .alert {
        display: none !important;
    }
    body {
        background-color: #ffffff !important;
        color: #000000 !important;
        font-size: 11pt;
    }
    .card {
        box-shadow: none !important;
        border: none !important;
        padding: 0 !important;
    }
    .table {
        border-color: #000000 !important;
    }
}
</style>
@endsection
