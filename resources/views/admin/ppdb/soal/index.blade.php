@extends('layouts.app', ['title' => 'Bank Soal Ujian Masuk PPDB'])

@section('content')
<div class="container-fluid px-3 px-lg-4 py-3" style="max-width: 1400px;">

    <!-- Header & Breadcrumb -->
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 mb-3 pb-2 border-bottom">
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-1" style="font-size: 0.8rem;">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-decoration-none text-success">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.ppdb.index') }}" class="text-decoration-none text-success">Kelola Web &amp; PPDB</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Bank Soal Ujian Masuk</li>
                </ol>
            </nav>
            <h2 class="h4 fw-bold mb-1 text-dark d-flex align-items-center gap-2">
                <i class="bi bi-journal-text text-success"></i> Bank Soal Tes Akademik Ujian Masuk PPDB
            </h2>
            <p class="text-muted mb-0 small" style="font-size: 0.78rem;">
                Kelola butir soal pilihan ganda, kunci jawaban, dan materi seleksi masuk calon santri baru secara berkelanjutan.
            </p>
        </div>
        <div class="d-flex align-items-center gap-2">
            <a href="{{ route('ppdb.exam.index') }}" target="_blank" class="btn btn-sm btn-outline-secondary shadow-sm py-2 px-3 fw-semibold">
                <i class="bi bi-box-arrow-up-right me-1"></i> Preview Portal CBT Santri
            </a>
            <a href="{{ route('admin.ppdb.soal.create') }}" class="btn btn-sm btn-success shadow-sm py-2 px-3 fw-semibold">
                <i class="bi bi-plus-circle me-1"></i> Tambah Soal Baru
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

    <!-- Quick Stats Summary -->
    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm bg-white p-3 border-start border-4 border-success">
                <div class="text-muted small fw-semibold text-uppercase">Total Soal Aktif CBT</div>
                <div class="d-flex align-items-center justify-content-between mt-2">
                    <h3 class="fw-bold mb-0 text-success">{{ $totalAktif }} Butir</h3>
                    <i class="bi bi-check2-circle fs-3 text-success opacity-50"></i>
                </div>
                <small class="text-muted mt-2 d-block">Digunakan langsung saat santri mengerjakan ujian</small>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm bg-white p-3 border-start border-4 border-primary">
                <div class="text-muted small fw-semibold text-uppercase">Total Bank Soal Tersimpan</div>
                <div class="d-flex align-items-center justify-content-between mt-2">
                    <h3 class="fw-bold mb-0 text-primary">{{ $totalSemua }} Butir</h3>
                    <i class="bi bi-database-fill fs-3 text-primary opacity-50"></i>
                </div>
                <small class="text-muted mt-2 d-block">Termasuk butir soal cadangan / dinonaktifkan</small>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm bg-white p-3 border-start border-4 border-warning">
                <div class="text-muted small fw-semibold text-uppercase">Menu Nilai &amp; Evaluasi</div>
                <div class="d-flex align-items-center justify-content-between mt-2">
                    <a href="{{ route('admin.ppdb.nilai.index') }}" class="btn btn-warning btn-sm fw-bold">
                        <i class="bi bi-mortarboard-fill me-1"></i> Buka Rekap Nilai Ujian &rarr;
                    </a>
                    <i class="bi bi-award-fill fs-3 text-warning opacity-50"></i>
                </div>
                <small class="text-muted mt-2 d-block">Lihat skor pengerjaan &amp; input catatan penguji</small>
            </div>
        </div>
    </div>

    <!-- Filter & Search Toolbar -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body p-3">
            <form method="GET" action="{{ route('admin.ppdb.soal.index') }}" class="row g-2 align-items-center">
                <div class="col-md-4">
                    <div class="input-group input-group-sm">
                        <span class="input-group-text bg-white"><i class="bi bi-search text-muted"></i></span>
                        <input type="text" name="search" class="form-control" placeholder="Cari pertanyaan atau nomor urut..." value="{{ request('search') }}">
                    </div>
                </div>

                <div class="col-md-3">
                    <select name="kategori" class="form-select form-select-sm">
                        <option value="">-- Semua Kategori Materi --</option>
                        @foreach($kategoriList as $kat)
                            <option value="{{ $kat }}" {{ request('kategori') === $kat ? 'selected' : '' }}>{{ $kat }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-2">
                    <select name="status" class="form-select form-select-sm">
                        <option value="">-- Status Soal --</option>
                        <option value="aktif" {{ request('status') === 'aktif' ? 'selected' : '' }}>Hanya Aktif</option>
                        <option value="nonaktif" {{ request('status') === 'nonaktif' ? 'selected' : '' }}>Nonaktif / Cadangan</option>
                    </select>
                </div>

                <div class="col-md-3 d-flex gap-2">
                    <button type="submit" class="btn btn-sm btn-success px-3 fw-semibold">
                        <i class="bi bi-filter"></i> Filter
                    </button>
                    @if(request()->hasAny(['search', 'kategori', 'status']))
                        <a href="{{ route('admin.ppdb.soal.index') }}" class="btn btn-sm btn-outline-secondary">Reset</a>
                    @endif
                </div>
            </form>
        </div>
    </div>

    <!-- Tabel Bank Soal -->
    <div class="card border-0 shadow-sm rounded-3 overflow-hidden">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0" style="min-width: 780px;">
                <thead class="table-light text-muted small text-uppercase">
                    <tr>
                        <th style="width: 70px;" class="text-center">No.</th>
                        <th style="width: 200px;">Kategori Materi</th>
                        <th>Pertanyaan &amp; Opsi Jawaban</th>
                        <th style="width: 100px;" class="text-center">Kunci</th>
                        <th style="width: 90px;" class="text-center">Bobot</th>
                        <th style="width: 110px;" class="text-center">Status CBT</th>
                        <th style="width: 140px;" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($soals as $soal)
                        <tr>
                            <td class="text-center fw-bold text-dark fs-6">{{ $soal->nomor_urut }}</td>
                            <td>
                                <span class="badge bg-light text-dark border fw-semibold text-wrap lh-base text-start">
                                    {{ $soal->kategori }}
                                </span>
                            </td>
                            <td>
                                <div class="fw-semibold text-dark mb-2" style="font-size: 0.93rem;">
                                    {{ Str::limit($soal->pertanyaan, 160) }}
                                </div>
                                <div class="small text-muted d-flex flex-wrap gap-3">
                                    <span class="{{ $soal->kunci_jawaban === 'A' ? 'fw-bold text-success' : '' }}"><strong>A:</strong> {{ Str::limit($soal->opsi_a, 40) }}</span>
                                    <span class="{{ $soal->kunci_jawaban === 'B' ? 'fw-bold text-success' : '' }}"><strong>B:</strong> {{ Str::limit($soal->opsi_b, 40) }}</span>
                                    <span class="{{ $soal->kunci_jawaban === 'C' ? 'fw-bold text-success' : '' }}"><strong>C:</strong> {{ Str::limit($soal->opsi_c, 40) }}</span>
                                    <span class="{{ $soal->kunci_jawaban === 'D' ? 'fw-bold text-success' : '' }}"><strong>D:</strong> {{ Str::limit($soal->opsi_d, 40) }}</span>
                                </div>
                            </td>
                            <td class="text-center">
                                <span class="badge bg-success fs-6 px-3 py-1 font-monospace">{{ $soal->kunci_jawaban }}</span>
                            </td>
                            <td class="text-center text-muted fw-semibold">{{ $soal->bobot }} pt</td>
                            <td class="text-center">
                                <form action="{{ route('admin.ppdb.soal.toggle', $soal) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-sm {{ $soal->is_aktif ? 'btn-outline-success' : 'btn-outline-secondary' }} py-1 px-2" style="font-size: 0.75rem;" title="Klik untuk mengubah status aktif/nonaktif">
                                        @if($soal->is_aktif)
                                            <i class="bi bi-check-circle-fill me-1"></i> Aktif
                                        @else
                                            <i class="bi bi-dash-circle me-1"></i> Nonaktif
                                        @endif
                                    </button>
                                </form>
                            </td>
                            <td class="text-center">
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('admin.ppdb.soal.edit', $soal) }}" class="btn btn-outline-primary" title="Edit Butir Soal">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <button type="button" class="btn btn-outline-danger" title="Hapus Soal" onclick="konfirmasiHapusSoal('{{ $soal->id }}', '{{ $soal->nomor_urut }}')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                                <form id="formHapusSoal_{{ $soal->id }}" action="{{ route('admin.ppdb.soal.destroy', $soal) }}" method="POST" class="d-none">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-5 text-muted">
                                <i class="bi bi-journal-x fs-1 d-block mb-2"></i>
                                Tidak ada butir soal yang sesuai kriteria pencarian.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($soals->hasPages())
            <div class="card-footer bg-white p-3 border-top d-flex justify-content-end">
                {{ $soals->links() }}
            </div>
        @endif
    </div>

</div>

<script>
    function konfirmasiHapusSoal(id, nomor) {
        if (confirm(`Apakah Anda yakin ingin menghapus butir soal nomor ${nomor} dari bank soal?`)) {
            document.getElementById(`formHapusSoal_${id}`).submit();
        }
    }
</script>
@endsection
