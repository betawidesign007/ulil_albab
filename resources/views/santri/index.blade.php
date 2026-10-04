@extends('layouts.app')

@section('content')
<div class="row gy-4">

    <!-- Header Section with Role Indicator -->
    <div class="col-12">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
            <div>
                <h1 class="h3 fw-bold text-dark mb-1">
                    <i class="bi bi-people-fill text-success me-2"></i> Data Santri Pondok Pesantren
                </h1>
                <p class="text-muted mb-0">
                    Pondok Pesantren Modern Li Ulil Albab &bull; Anda login sebagai 
                    <span class="badge {{ Auth::user()->role_badge_class }}">{{ Auth::user()->role_label }}</span>
                </p>
            </div>
            <div class="d-flex gap-2">
                @if(Auth::user()->isPemilik() || Auth::user()->isAdmin())
                    <a href="{{ route('laporan.santri') }}" class="btn btn-outline-secondary shadow-sm">
                        <i class="bi bi-printer me-1"></i> Cetak Laporan
                    </a>
                @endif

                @if(Auth::user()->isAdmin())
                    <a href="{{ route('santri.create') }}" class="btn btn-pesantren shadow-sm">
                        <i class="bi bi-person-plus-fill me-1"></i> + Tambah Santri
                    </a>
                @endif
            </div>
        </div>
    </div>

    <!-- Role Notice Banner for Non-Admin -->
    @if(!Auth::user()->isAdmin())
        <div class="col-12">
            <div class="alert alert-info border-0 shadow-sm d-flex align-items-center gap-2 mb-0">
                <i class="bi bi-info-circle-fill fs-5"></i>
                <div class="small">
                    <strong>Pemberitahuan Hak Akses:</strong> Sebagai <em>{{ Auth::user()->role_label }}</em>, Anda memiliki izin untuk melihat detail data santri. Wewenang penambahan, penyuntingan, dan penghapusan data santri dikhususkan bagi <strong>Administrator</strong>.
                </div>
            </div>
        </div>
    @endif

    <!-- Filter & Search Card -->
    <div class="col-12">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-3">
                <form action="{{ route('santri.index') }}" method="GET" class="row g-2 align-items-center">
                    <div class="col-md-4">
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0"><i class="bi bi-search text-muted"></i></span>
                            <input type="text" name="search" value="{{ request('search') }}" class="form-control border-start-0" placeholder="Cari Nama Lengkap / NIS...">
                        </div>
                    </div>
                    <div class="col-6 col-md-2">
                        <select name="kamar" class="form-select">
                            <option value="">Semua Kamar</option>
                            <option value="Al-Ghazali" {{ request('kamar') == 'Al-Ghazali' ? 'selected' : '' }}>Al-Ghazali</option>
                            <option value="Ali bin Abi Thalib" {{ request('kamar') == 'Ali bin Abi Thalib' ? 'selected' : '' }}>Ali bin Abi Thalib</option>
                            <option value="Fatimah" {{ request('kamar') == 'Fatimah' ? 'selected' : '' }}>Fatimah</option>
                            <option value="Aisyah" {{ request('kamar') == 'Aisyah' ? 'selected' : '' }}>Aisyah</option>
                        </select>
                    </div>
                    <div class="col-6 col-md-2">
                        <select name="kelas" class="form-select">
                            <option value="">Semua Kelas</option>
                            <option value="1 Tsanawiyah" {{ request('kelas') == '1 Tsanawiyah' ? 'selected' : '' }}>1 Tsanawiyah</option>
                            <option value="2 Tsanawiyah" {{ request('kelas') == '2 Tsanawiyah' ? 'selected' : '' }}>2 Tsanawiyah</option>
                            <option value="3 Tsanawiyah" {{ request('kelas') == '3 Tsanawiyah' ? 'selected' : '' }}>3 Tsanawiyah</option>
                            <option value="1 Aliyah" {{ request('kelas') == '1 Aliyah' ? 'selected' : '' }}>1 Aliyah</option>
                            <option value="2 Aliyah" {{ request('kelas') == '2 Aliyah' ? 'selected' : '' }}>2 Aliyah</option>
                            <option value="3 Aliyah" {{ request('kelas') == '3 Aliyah' ? 'selected' : '' }}>3 Aliyah</option>
                        </select>
                    </div>
                    <div class="col-6 col-md-2">
                        <select name="jenis_kelamin" class="form-select">
                            <option value="">Semua Gender</option>
                            <option value="Laki-laki" {{ request('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki (Banin)</option>
                            <option value="Perempuan" {{ request('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan (Banat)</option>
                        </select>
                    </div>
                    <div class="col-6 col-md-2 d-flex gap-2">
                        <button type="submit" class="btn btn-success w-100">
                            <i class="bi bi-filter"></i> Filter
                        </button>
                        @if(request()->hasAny(['search', 'kamar', 'kelas', 'jenis_kelamin']))
                            <a href="{{ route('santri.index') }}" class="btn btn-outline-secondary" title="Reset Filter">
                                <i class="bi bi-arrow-counterclockwise"></i>
                            </a>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Santri Data Table -->
    <div class="col-12">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light small">
                            <tr>
                                <th class="py-3 px-4">NIS</th>
                                <th class="py-3">Nama Santri</th>
                                <th class="py-3">Jenis Kelamin</th>
                                <th class="py-3">Asrama / Kamar</th>
                                <th class="py-3">Jenjang / Kelas</th>
                                <th class="py-3 text-center">Hak Akses &amp; Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($santris as $santri)
                                <tr>
                                    <td class="px-4 fw-bold text-success">{{ $santri->nis }}</td>
                                    <td>
                                        <div class="fw-semibold text-dark">{{ $santri->nama_lengkap }}</div>
                                        <small class="text-muted"><i class="bi bi-geo-alt me-1"></i>{{ $santri->tempat_lahir }}</small>
                                    </td>
                                    <td>
                                        <span class="badge {{ $santri->jenis_kelamin == 'Laki-laki' ? 'bg-primary-subtle text-primary border border-primary-subtle' : 'bg-danger-subtle text-danger border border-danger-subtle' }} rounded-pill px-2 py-1">
                                            {{ $santri->jenis_kelamin }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge bg-light text-dark border">
                                            <i class="bi bi-door-closed me-1"></i> {{ $santri->kamar ?? '-' }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge bg-light text-dark border">
                                            <i class="bi bi-bookmark me-1"></i> {{ $santri->kelas ?? '-' }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('santri.show', $santri->id) }}" class="btn btn-sm btn-outline-success">
                                            <i class="bi bi-eye"></i> Detail
                                        </a>

                                        @if(Auth::user()->isAdmin())
                                            <a href="{{ route('santri.edit', $santri->id) }}" class="btn btn-sm btn-outline-primary ms-1">
                                                <i class="bi bi-pencil"></i> Edit
                                            </a>
                                            <form action="{{ route('santri.destroy', $santri->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data santri ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger ms-1" title="Hapus Data">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-5 text-muted">
                                        <i class="bi bi-people display-6 d-block mb-2 text-muted"></i>
                                        Tidak ditemukan data santri yang sesuai kriteria pencarian.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($santris->hasPages())
                    <div class="p-3 border-top d-flex justify-content-end">
                        {{ $santris->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>

</div>
@endsection
