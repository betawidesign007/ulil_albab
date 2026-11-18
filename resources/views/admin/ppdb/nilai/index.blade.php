@extends('layouts.app', ['title' => 'Rekapitulasi Nilai & Kelulusan Ujian PPDB'])

@section('content')
<div class="container-fluid px-3 px-lg-4 py-3" style="max-width: 1400px;">

    <!-- Header & Breadcrumb -->
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 mb-3 pb-2 border-bottom">
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-1" style="font-size: 0.8rem;">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-decoration-none text-success">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.ppdb.index') }}" class="text-decoration-none text-success">Kelola Web &amp; PPDB</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Nilai &amp; Hasil Ujian Santri</li>
                </ol>
            </nav>
            <h2 class="h4 fw-bold mb-1 text-dark d-flex align-items-center gap-2">
                <i class="bi bi-award text-success"></i> Rekapitulasi Nilai &amp; Keputusan Kelulusan Ujian Masuk
            </h2>
            <p class="text-muted mb-0 small" style="font-size: 0.78rem;">
                Pantau perolehan skor akademik calon santri baru, evaluasi lembar jawaban, dan berikan catatan resmi pengumuman kelulusan.
            </p>
        </div>
        <div class="d-flex align-items-center gap-2">
            <a href="{{ route('admin.ppdb.soal.index') }}" class="btn btn-sm btn-outline-success shadow-sm py-2 px-3 fw-semibold">
                <i class="bi bi-journal-text me-1"></i> Buka Bank Soal (50 Soal)
            </a>
            <a href="{{ route('ppdb.exam.index') }}" target="_blank" class="btn btn-sm btn-outline-secondary shadow-sm py-2 px-3 fw-semibold">
                <i class="bi bi-box-arrow-up-right me-1"></i> Buka Portal Ujian Santri
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show d-flex align-items-center gap-2 shadow-sm mb-4" role="alert">
            <i class="bi bi-check-circle-fill fs-5"></i>
            <div>{{ session('success') }}</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Quick Stats Cards -->
    <div class="row g-3 mb-4">
        <div class="col-md-3 col-sm-6">
            <div class="card border-0 shadow-sm bg-white p-3 border-start border-4 border-primary h-100">
                <div class="text-muted small fw-semibold text-uppercase">Total Santri Ujian</div>
                <div class="d-flex align-items-center justify-content-between mt-2">
                    <h3 class="fw-bold mb-0 text-primary">{{ number_format($totalPeserta) }}</h3>
                    <i class="bi bi-people-fill fs-3 text-primary opacity-50"></i>
                </div>
                <small class="text-muted mt-2 d-block">Rata-rata Nilai: <strong>{{ $rataRataNilai }}</strong> / 100</small>
            </div>
        </div>

        <div class="col-md-3 col-sm-6">
            <div class="card border-0 shadow-sm bg-white p-3 border-start border-4 border-success h-100">
                <div class="text-muted small fw-semibold text-uppercase">Santri Lulus</div>
                <div class="d-flex align-items-center justify-content-between mt-2">
                    <h3 class="fw-bold mb-0 text-success">{{ number_format($totalLulus) }}</h3>
                    <i class="bi bi-check-circle-fill fs-3 text-success opacity-50"></i>
                </div>
                <small class="text-muted mt-2 d-block">Memenuhi ambang batas kelulusan (>= 70)</small>
            </div>
        </div>

        <div class="col-md-3 col-sm-6">
            <div class="card border-0 shadow-sm bg-white p-3 border-start border-4 border-warning h-100">
                <div class="text-muted small fw-semibold text-uppercase">Dipertimbangkan</div>
                <div class="d-flex align-items-center justify-content-between mt-2">
                    <h3 class="fw-bold mb-0 text-warning">{{ number_format($totalDipertimbangkan) }}</h3>
                    <i class="bi bi-hourglass-split fs-3 text-warning opacity-50"></i>
                </div>
                <small class="text-muted mt-2 d-block">Perlu wawancara tambahan / matrikulasi</small>
            </div>
        </div>

        <div class="col-md-3 col-sm-6">
            <div class="card border-0 shadow-sm bg-white p-3 border-start border-4 border-danger h-100">
                <div class="text-muted small fw-semibold text-uppercase">Tidak Lulus</div>
                <div class="d-flex align-items-center justify-content-between mt-2">
                    <h3 class="fw-bold mb-0 text-danger">{{ number_format($totalTidakLulus) }}</h3>
                    <i class="bi bi-x-circle-fill fs-3 text-danger opacity-50"></i>
                </div>
                <small class="text-muted mt-2 d-block">Belum mencapai standar passing grade</small>
            </div>
        </div>
    </div>

    <!-- Toolbar Pencarian & Filter -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body p-3">
            <form method="GET" action="{{ route('admin.ppdb.nilai.index') }}" class="row g-2 align-items-center">
                <div class="col-md-4">
                    <div class="input-group input-group-sm">
                        <span class="input-group-text bg-white"><i class="bi bi-search text-muted"></i></span>
                        <input type="text" name="search" class="form-control" placeholder="Cari nama santri atau no pendaftaran..." value="{{ request('search') }}">
                    </div>
                </div>

                <div class="col-md-3">
                    <select name="status" class="form-select form-select-sm">
                        <option value="">-- Semua Status Kelulusan --</option>
                        <option value="Lulus" {{ request('status') === 'Lulus' ? 'selected' : '' }}>Lulus</option>
                        <option value="Dipertimbangkan" {{ request('status') === 'Dipertimbangkan' ? 'selected' : '' }}>Dipertimbangkan</option>
                        <option value="Tidak Lulus" {{ request('status') === 'Tidak Lulus' ? 'selected' : '' }}>Tidak Lulus</option>
                    </select>
                </div>

                <div class="col-md-2">
                    <select name="sort" class="form-select form-select-sm">
                        <option value="terbaru" {{ request('sort') === 'terbaru' ? 'selected' : '' }}>Terbaru</option>
                        <option value="nilai_tertinggi" {{ request('sort') === 'nilai_tertinggi' ? 'selected' : '' }}>Nilai Tertinggi</option>
                        <option value="nilai_terendah" {{ request('sort') === 'nilai_terendah' ? 'selected' : '' }}>Nilai Terendah</option>
                        <option value="nama_asc" {{ request('sort') === 'nama_asc' ? 'selected' : '' }}>Nama A - Z</option>
                    </select>
                </div>

                <div class="col-md-3 d-flex gap-2">
                    <button type="submit" class="btn btn-sm btn-success px-3 fw-semibold">
                        <i class="bi bi-filter"></i> Terapkan
                    </button>
                    @if(request()->hasAny(['search', 'status', 'sort']))
                        <a href="{{ route('admin.ppdb.nilai.index') }}" class="btn btn-sm btn-outline-secondary">Reset</a>
                    @endif
                </div>
            </form>
        </div>
    </div>

    <!-- Tabel Rekapitulasi Nilai -->
    <div class="card border-0 shadow-sm rounded-3 overflow-hidden">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0" style="min-width: 860px;">
                <thead class="table-light text-muted small text-uppercase">
                    <tr>
                        <th style="width: 140px;">No. Pendaftaran</th>
                        <th>Nama Calon Santri</th>
                        <th style="width: 170px;">Pilihan Jenjang</th>
                        <th style="width: 140px;" class="text-center">Benar / Salah</th>
                        <th style="width: 100px;" class="text-center">Skor Nilai</th>
                        <th style="width: 140px;" class="text-center">Status Kelulusan</th>
                        <th style="width: 160px;">Waktu Ujian</th>
                        <th style="width: 130px;" class="text-center">Aksi &amp; Evaluasi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($results as $res)
                        <tr>
                            <td class="font-monospace fw-bold text-success">{{ $res->no_pendaftaran }}</td>
                            <td>
                                <div class="fw-bold text-dark">{{ $res->nama_santri }}</div>
                                @if($res->registration)
                                    <small class="text-muted d-block">
                                        Wali: {{ $res->registration->nama_wali }} ({{ $res->registration->no_wa }})
                                    </small>
                                @endif
                            </td>
                            <td>
                                <span class="badge bg-light text-dark border small">{{ $res->jenjang }}</span>
                            </td>
                            <td class="text-center small">
                                <span class="badge bg-success bg-opacity-10 text-success fw-bold">{{ $res->jawaban_benar }} B</span>
                                <span class="badge bg-danger bg-opacity-10 text-danger fw-bold ms-1">{{ $res->jawaban_salah }} S</span>
                                @if($res->jawaban_kosong > 0)
                                    <span class="badge bg-secondary bg-opacity-10 text-secondary fw-bold ms-1">{{ $res->jawaban_kosong }} K</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <span class="fw-bold fs-6 {{ $res->nilai >= 70 ? 'text-success' : ($res->nilai >= 55 ? 'text-warning' : 'text-danger') }}">
                                    {{ number_format($res->nilai, 0) }}
                                </span>
                                <small class="text-muted d-block" style="font-size: 0.7rem;">/ 100</small>
                            </td>
                            <td class="text-center">
                                <span class="badge {{ $res->status_badge_class }} px-3 py-1.5 rounded-pill fs-7">
                                    {{ $res->status_kelulusan }}
                                </span>
                            </td>
                            <td class="small text-muted">
                                {{ $res->waktu_selesai ? $res->waktu_selesai->translatedFormat('d M Y, H:i') : '-' }}
                                <div style="font-size: 0.72rem;">Durasi: {{ $res->durasi_menit }} Menit</div>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('admin.ppdb.nilai.show', $res) }}" class="btn btn-sm btn-primary fw-semibold px-2 py-1" title="Buka Detail Lembar Jawaban & Beri Catatan Evaluasi">
                                    <i class="bi bi-pencil-square me-1"></i> Evaluasi
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-5 text-muted">
                                <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                                Belum ada data ujian masuk santri yang sesuai kriteria pencarian.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($results->hasPages())
            <div class="card-footer bg-white p-3 border-top d-flex justify-content-end">
                {{ $results->links() }}
            </div>
        @endif
    </div>

</div>
@endsection
