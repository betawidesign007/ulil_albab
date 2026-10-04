@extends('layouts.app', ['title' => 'Jadwal Pelajaran & Konsep Acuan Kerja'])

@section('content')
<div class="container-fluid px-3 px-lg-4 py-3">

    <!-- Header Section -->
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 mb-3 pb-2 border-bottom">
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-1" style="font-size: 0.8rem;">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-decoration-none text-success">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Jadwal &amp; Acuan Kerja</li>
                </ol>
            </nav>
            <h2 class="h4 fw-bold mb-0 text-dark d-flex align-items-center gap-2">
                <i class="bi bi-journal-bookmark-fill text-success"></i> Jadwal Pelajaran &amp; Konsep Acuan Kerja
            </h2>
            <small class="text-muted" style="font-size: 0.78rem;">
                Portal terpadu kurikulum pesantren, target capaian silabus kitab, evaluasi mengajar asatidz, dan supervisi pimpinan.
            </small>
        </div>

        <div class="d-flex flex-wrap align-items-center gap-2">
            <a href="{{ route('jadwal.cetak', request()->query()) }}" target="_blank" class="btn btn-sm btn-outline-secondary d-flex align-items-center gap-1 shadow-sm px-3 py-2 fw-semibold">
                <i class="bi bi-printer-fill"></i> Cetak / Ekspor PDF
            </a>

            @if(Auth::user()->isAdmin())
                <button type="button" class="btn btn-sm btn-pesantren d-flex align-items-center gap-1 shadow-sm px-3 py-2 fw-semibold" data-bs-toggle="modal" data-bs-target="#modalTambahJadwalCepat">
                    <i class="bi bi-plus-circle-fill"></i> Tambah Cepat
                </button>
                <a href="{{ route('jadwal.create') }}" class="btn btn-sm btn-gold d-flex align-items-center gap-1 shadow-sm px-3 py-2 fw-semibold text-white">
                    <i class="bi bi-file-earmark-plus-fill"></i> + Form Lengkap
                </a>
            @endif
        </div>
    </div>

    <!-- Alert Success / Error -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show d-flex align-items-center gap-2 py-2 px-3 small shadow-sm mb-3" role="alert">
            <i class="bi bi-check-circle-fill fs-5"></i>
            <div>{{ session('success') }}</div>
            <button type="button" class="btn-close btn-sm p-2" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Compact Role Context Banner -->
    <div class="card border-0 shadow-sm mb-3" style="background: linear-gradient(135deg, #065f46 0%, #044332 100%); color: #ffffff;">
        <div class="card-body p-2 px-3 d-flex flex-wrap align-items-center justify-content-between gap-2">
            <div class="d-flex align-items-center gap-2">
                <div class="rounded-circle bg-white bg-opacity-20 d-flex align-items-center justify-content-center" style="width: 34px; height: 34px;">
                    <i class="bi bi-shield-shaded fs-5 text-warning"></i>
                </div>
                <div>
                    <span class="fw-bold text-white small">
                        Peran Anda: <span class="badge bg-warning text-dark px-2 py-1">{{ Auth::user()->role_label }}</span>
                    </span>
                    <span class="text-white-50 ms-2 small d-none d-md-inline" style="font-size: 0.78rem;">
                        @if(Auth::user()->isAdmin())
                            Hak penuh menambah, mengedit, menghapus jadwal &amp; mengatur alokasi pengajar.
                        @elseif(Auth::user()->isPengajar())
                            Melihat jadwal mengajar Anda, mengisi realisasi jurnal, serta mengontrol target capaian santri.
                        @elseif(Auth::user()->isPemilik())
                            Supervisi capaian kurikulum seluruh dewan asatidz &amp; memberikan catatan evaluasi resmi.
                        @endif
                    </span>
                </div>
            </div>
            <div>
                <span class="badge bg-white bg-opacity-15 text-warning border border-warning border-opacity-25 px-2 py-1 fw-bold" style="font-size: 0.75rem;">
                    <i class="bi bi-calendar-event me-1"></i> TA 2026/2027 (Ganjil)
                </span>
            </div>
        </div>
    </div>

    <!-- Compact Statistik Acuan Kerja & Ketercapaian -->
    <div class="row g-2 mb-3">
        <div class="col-md-3 col-6">
            <div class="card border-0 shadow-sm bg-white p-2 px-3 h-100 border-start border-4 border-success">
                <div class="text-muted small fw-bold text-uppercase" style="font-size: 0.7rem;">Total Sesi Pelajaran</div>
                <div class="d-flex align-items-center justify-content-between mt-1">
                    <h4 class="fw-bold mb-0 text-dark">{{ $totalJadwal }} <small class="fs-6 text-muted fw-normal">Sesi</small></h4>
                    <i class="bi bi-calendar-check fs-4 text-success opacity-50"></i>
                </div>
                <small class="text-muted" style="font-size: 0.72rem;">Jadwal aktif terdata</small>
            </div>
        </div>
        <div class="col-md-3 col-6">
            <div class="card border-0 shadow-sm bg-white p-2 px-3 h-100 border-start border-4 border-primary">
                <div class="text-muted small fw-bold text-uppercase" style="font-size: 0.7rem;">Dewan Asatidz Aktif</div>
                <div class="d-flex align-items-center justify-content-between mt-1">
                    <h4 class="fw-bold mb-0 text-primary">{{ $totalPengajar }} <small class="fs-6 text-muted fw-normal">Guru</small></h4>
                    <i class="bi bi-person-workspace fs-4 text-primary opacity-50"></i>
                </div>
                <small class="text-muted" style="font-size: 0.72rem;">Pengampu mapel &amp; kitab</small>
            </div>
        </div>
        <div class="col-md-3 col-6">
            <div class="card border-0 shadow-sm bg-white p-2 px-3 h-100 border-start border-4 border-info">
                <div class="text-muted small fw-bold text-uppercase" style="font-size: 0.7rem;">Disetujui Mudir</div>
                <div class="d-flex align-items-center justify-content-between mt-1">
                    <h4 class="fw-bold mb-0 text-info">{{ $verifikasiDisetujuiCount }} <small class="fs-6 text-muted fw-normal">Mapel</small></h4>
                    <i class="bi bi-patch-check-fill fs-4 text-info opacity-50"></i>
                </div>
                <small class="text-muted" style="font-size: 0.72rem;">Acuan kerja tervalidasi</small>
            </div>
        </div>
        <div class="col-md-3 col-6">
            <div class="card border-0 shadow-sm bg-white p-2 px-3 h-100 border-start border-4 border-warning">
                <div class="text-muted small fw-bold text-uppercase" style="font-size: 0.7rem;">Menunggu / Revisi</div>
                <div class="d-flex align-items-center justify-content-between mt-1">
                    <h4 class="fw-bold mb-0 text-warning-emphasis">{{ $verifikasiMenungguCount + $verifikasiRevisiCount }} <small class="fs-6 text-muted fw-normal">Sesi</small></h4>
                    <i class="bi bi-hourglass-split fs-4 text-warning opacity-50"></i>
                </div>
                <small class="text-muted" style="font-size: 0.72rem;">{{ $verifikasiRevisiCount }} perlu penyesuaian</small>
            </div>
        </div>
    </div>

    <!-- Khusus Role Pengajar: Seksi "Jadwal Mengajar Saya & Update Jurnal Cepat" -->
    @if(Auth::user()->isPengajar() && $myJadwals)
        <div class="card border-0 shadow-sm mb-3 bg-light border border-success border-opacity-25">
            <div class="card-header bg-white py-2 px-3 border-bottom d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center gap-2">
                    <span class="badge bg-success p-1 rounded-circle"><i class="bi bi-star-fill text-white" style="font-size: 0.7rem;"></i></span>
                    <strong class="text-dark small">Jadwal Mengajar &amp; Acuan Kerja Saya ({{ Auth::user()->name }})</strong>
                </div>
                <span class="badge bg-success-subtle text-success border border-success px-2 py-1" style="font-size: 0.75rem;">
                    {{ $myJadwals->count() }} Jadwal Diampu
                </span>
            </div>
            <div class="card-body p-2 px-3">
                <div class="row g-2">
                    @forelse($myJadwals as $mj)
                        <div class="col-lg-6">
                            <div class="card border-0 shadow-sm h-100 bg-white p-2 px-3">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <div>
                                        <span class="badge bg-dark me-1" style="font-size: 0.7rem;">{{ $mj->hari }}</span>
                                        <span class="badge bg-secondary" style="font-size: 0.7rem;">{{ $mj->jam_rentang }}</span>
                                        <span class="badge bg-primary ms-1" style="font-size: 0.7rem;">{{ $mj->kelas }}</span>
                                    </div>
                                    <span class="badge {{ $mj->status_badge }}" style="font-size: 0.7rem;">{{ $mj->status_label }}</span>
                                </div>

                                <div class="fw-bold text-dark small">{{ $mj->mata_pelajaran }}</div>
                                <div class="text-muted mb-2" style="font-size: 0.75rem;">
                                    <i class="bi bi-book text-success me-1"></i> Kitab: <strong>{{ $mj->kitab_referensi ?? '-' }}</strong> |
                                    <i class="bi bi-geo-alt text-danger me-1"></i> {{ $mj->ruangan }}
                                </div>

                                <div class="p-2 rounded bg-light mb-1" style="font-size: 0.75rem;">
                                    <strong>Target Capaian:</strong> {{ Str::limit($mj->target_capaian ?? 'Belum ada target diisi', 90, '...') }}
                                </div>

                                @if($mj->jurnal_terakhir)
                                    <div class="p-2 rounded bg-success-subtle text-success-emphasis mb-1" style="font-size: 0.75rem;">
                                        <div class="fw-bold d-flex justify-content-between">
                                            <span><i class="bi bi-journal-text me-1"></i> Jurnal Terakhir:</span>
                                            <span class="text-muted" style="font-size: 0.7rem;">{{ $mj->jurnal_updated_at?->diffForHumans() }}</span>
                                        </div>
                                        <div class="mt-1">{{ Str::limit($mj->jurnal_terakhir, 90, '...') }}</div>
                                    </div>
                                @endif

                                @if($mj->catatan_supervisi)
                                    <div class="p-2 rounded bg-warning-subtle text-warning-emphasis mb-1" style="font-size: 0.75rem;">
                                        <strong><i class="bi bi-chat-quote-fill me-1"></i> Catatan Mudir:</strong> {{ Str::limit($mj->catatan_supervisi, 80, '...') }}
                                    </div>
                                @endif

                                <div class="d-flex justify-content-between align-items-center mt-2 pt-2 border-top">
                                    <span class="badge {{ $mj->verifikasi_badge }}" style="font-size: 0.7rem;">{{ $mj->verifikasi_label }}</span>
                                    <button type="button" class="btn btn-sm btn-outline-success py-1 px-2 fw-semibold" style="font-size: 0.75rem;" data-bs-toggle="modal" data-bs-target="#modalJurnal{{ $mj->id }}">
                                        <i class="bi bi-pencil-square me-1"></i> Input Jurnal &amp; Capaian
                                    </button>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center py-3 text-muted small">
                            Belum ada jadwal mengajar yang dialokasikan untuk akun Anda.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    @endif

    <!-- Compact Filter Bar -->
    <div class="card border-0 shadow-sm mb-3">
        <div class="card-body p-2 px-3">
            <form method="GET" action="{{ route('jadwal.index') }}" class="row g-2 align-items-center">
                <div class="col-md-2 col-6">
                    <label class="form-label text-muted mb-0 fw-bold" style="font-size: 0.72rem;">HARI</label>
                    <select name="hari" class="form-select form-select-sm" onchange="this.form.submit()" style="font-size: 0.8rem;">
                        <option value="">Semua Hari</option>
                        @foreach(['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Ahad'] as $h)
                            <option value="{{ $h }}" {{ request('hari') === $h ? 'selected' : '' }}>{{ $h }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-2 col-6">
                    <label class="form-label text-muted mb-0 fw-bold" style="font-size: 0.72rem;">KELAS</label>
                    <select name="kelas" class="form-select form-select-sm" onchange="this.form.submit()" style="font-size: 0.8rem;">
                        <option value="">Semua Kelas</option>
                        @foreach($kelasList as $k)
                            <option value="{{ $k }}" {{ request('kelas') === $k ? 'selected' : '' }}>{{ $k }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3 col-12">
                    <label class="form-label text-muted mb-0 fw-bold" style="font-size: 0.72rem;">DEWAN ASATIDZ</label>
                    <select name="pengajar_id" class="form-select form-select-sm" onchange="this.form.submit()" style="font-size: 0.8rem;">
                        <option value="">Semua Asatidz</option>
                        @foreach($pengajars as $p)
                            <option value="{{ $p->id }}" {{ request('pengajar_id') == $p->id ? 'selected' : '' }}>{{ $p->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-2 col-6">
                    <label class="form-label text-muted mb-0 fw-bold" style="font-size: 0.72rem;">STATUS PELAKSANAAN</label>
                    <select name="status" class="form-select form-select-sm" onchange="this.form.submit()" style="font-size: 0.8rem;">
                        <option value="">Semua Status</option>
                        <option value="aktif" {{ request('status') === 'aktif' ? 'selected' : '' }}>Sesuai Jadwal</option>
                        <option value="tuntas" {{ request('status') === 'tuntas' ? 'selected' : '' }}>Materi Tuntas</option>
                        <option value="diganti" {{ request('status') === 'diganti' ? 'selected' : '' }}>Jadwal Pengganti</option>
                        <option value="kendala" {{ request('status') === 'kendala' ? 'selected' : '' }}>Terkendala</option>
                    </select>
                </div>

                <div class="col-md-2 col-6">
                    <label class="form-label text-muted mb-0 fw-bold" style="font-size: 0.72rem;">VERIFIKASI MUDIR</label>
                    <select name="verifikasi" class="form-select form-select-sm" onchange="this.form.submit()" style="font-size: 0.8rem;">
                        <option value="">Semua Verifikasi</option>
                        <option value="disetujui_mudir" {{ request('verifikasi') === 'disetujui_mudir' ? 'selected' : '' }}>Disetujui Mudir</option>
                        <option value="menunggu_verifikasi" {{ request('verifikasi') === 'menunggu_verifikasi' ? 'selected' : '' }}>Menunggu Review</option>
                        <option value="perlu_revisi" {{ request('verifikasi') === 'perlu_revisi' ? 'selected' : '' }}>Perlu Revisi</option>
                    </select>
                </div>

                <div class="col-md-1 col-12 d-flex align-items-end">
                    <a href="{{ route('jadwal.index') }}" class="btn btn-sm btn-outline-secondary w-100 py-1" title="Reset Filter" style="font-size: 0.8rem;">
                        <i class="bi bi-arrow-counterclockwise"></i> Reset
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Tabel Matriks Jadwal & Acuan Kerja (Luas, Presisi & Efisien) -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-header bg-white py-2 px-3 border-bottom d-flex align-items-center justify-content-between">
            <h6 class="fw-bold mb-0 text-dark d-flex align-items-center gap-2">
                <i class="bi bi-table text-success"></i> Matriks Jadwal Mata Pelajaran &amp; Dokumen Acuan Kerja
            </h6>
            <span class="badge bg-light text-dark border px-2 py-1" style="font-size: 0.75rem;">
                Menampilkan {{ $jadwals->count() }} Jadwal Pelajaran
            </span>
        </div>
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0 w-100" style="font-size: 0.82rem;">
                <thead class="table-light text-secondary" style="font-size: 0.76rem;">
                    <tr>
                        <th class="ps-2 py-2 text-center" style="width: 10%;">Hari &amp; Jam</th>
                        <th class="py-2" style="width: 20%;">Mata Pelajaran &amp; Kitab</th>
                        <th class="py-2 text-center" style="width: 10%;">Kelas &amp; Ruang</th>
                        <th class="py-2" style="width: 15%;">Dewan Asatidz</th>
                        <th class="py-2" style="width: 20%;">Target Acuan &amp; Jurnal</th>
                        <th class="py-2 text-center" style="width: 11%;">Status &amp; Supervisi</th>
                        <th class="py-2 text-center pe-2" style="width: 14%; white-space: nowrap;">Kontrol &amp; Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($jadwals as $j)
                        <tr>
                            <!-- Hari & Jam -->
                            <td class="ps-3">
                                <span class="badge bg-dark text-white fw-bold d-block text-center py-1 mb-1" style="font-size: 0.72rem;">{{ $j->hari }}</span>
                                <small class="text-muted fw-semibold d-block text-center" style="font-size: 0.75rem;"><i class="bi bi-clock me-1"></i>{{ $j->jam_rentang }}</small>
                            </td>

                            <!-- Mata Pelajaran & Kitab -->
                            <td>
                                <div class="fw-bold text-dark">{{ $j->mata_pelajaran }}</div>
                                @if($j->kitab_referensi)
                                    <small class="text-success d-block" style="font-size: 0.75rem;">
                                        <i class="bi bi-book-half me-1"></i> Kitab: <strong>{{ $j->kitab_referensi }}</strong>
                                    </small>
                                @endif
                                @if($j->metode_pembelajaran)
                                    <small class="text-muted d-block" style="font-size: 0.72rem;">
                                        <i class="bi bi-gear-fill me-1"></i> Metode: {{ $j->metode_pembelajaran }}
                                    </small>
                                @endif
                            </td>

                            <!-- Kelas & Ruangan -->
                            <td>
                                <span class="badge bg-primary-subtle text-primary border border-primary-subtle fw-semibold d-block text-center py-1 mb-1" style="font-size: 0.73rem;">
                                    {{ $j->kelas }}
                                </span>
                                <small class="text-muted d-block text-center" style="font-size: 0.72rem;">
                                    <i class="bi bi-geo-alt-fill text-danger me-1"></i>{{ $j->ruangan }}
                                </small>
                            </td>

                            <!-- Pengajar -->
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <span class="rounded-circle bg-light border d-flex align-items-center justify-content-center text-success fw-bold flex-shrink-0" style="width: 28px; height: 28px; font-size: 0.75rem;">
                                        <i class="bi bi-person-fill"></i>
                                    </span>
                                    <div>
                                        <div class="fw-bold text-dark" style="font-size: 0.82rem;">
                                            {{ $j->pengajar?->name ?? 'Belum Ditentukan' }}
                                        </div>
                                        <small class="text-muted" style="font-size: 0.72rem;">
                                            {{ $j->pengajar?->jabatan ?? 'Dewan Asatidz' }}
                                        </small>
                                    </div>
                                </div>
                            </td>

                            <!-- Target Acuan Kerja & Jurnal -->
                            <td>
                                @if($j->target_capaian)
                                    <div class="mb-1" style="font-size: 0.78rem;">
                                        <span class="badge bg-secondary bg-opacity-10 text-secondary me-1 py-0 px-1" style="font-size: 0.68rem;">Target</span>
                                        {{ Str::limit($j->target_capaian, 75, '...') }}
                                        @if(Auth::user()->isAdmin() || (Auth::user()->isPengajar() && $j->user_id === Auth::id()))
                                            <button type="button" class="btn btn-link btn-sm p-0 ms-1 text-decoration-none text-primary" style="font-size: 0.7rem;" data-bs-toggle="modal" data-bs-target="#modalTargetAcuan{{ $j->id }}" title="Edit Target Acuan">
                                                <i class="bi bi-pencil-square"></i>
                                            </button>
                                        @endif
                                    </div>
                                @else
                                    <div class="mb-1">
                                        <button type="button" class="btn btn-sm btn-outline-primary py-0 px-2" style="font-size: 0.72rem;" data-bs-toggle="modal" data-bs-target="#modalTargetAcuan{{ $j->id }}">
                                            <i class="bi bi-plus-circle me-1"></i> + Lengkapi Acuan Kerja
                                        </button>
                                    </div>
                                @endif

                                @if($j->jurnal_terakhir)
                                    <div class="p-1 px-2 rounded bg-success-subtle text-success-emphasis border border-success-subtle" style="font-size: 0.74rem;">
                                        <span class="fw-bold"><i class="bi bi-check-all"></i> Jurnal:</span> {{ Str::limit($j->jurnal_terakhir, 65, '...') }}
                                        <span class="text-muted d-block mt-0" style="font-size: 0.68rem;">Update: {{ $j->jurnal_updated_at?->translatedFormat('d M, H:i') }}</span>
                                    </div>
                                @else
                                    <div class="d-flex align-items-center gap-1">
                                        <span class="text-muted fst-italic" style="font-size: 0.73rem;">
                                            <i class="bi bi-hourglass"></i> Belum ada jurnal.
                                        </span>
                                        @if(Auth::user()->isAdmin() || (Auth::user()->isPengajar() && $j->user_id === Auth::id()))
                                            <button type="button" class="btn btn-sm btn-outline-success py-0 px-1" style="font-size: 0.68rem;" data-bs-toggle="modal" data-bs-target="#modalJurnal{{ $j->id }}">
                                                + Isi Jurnal
                                            </button>
                                        @endif
                                    </div>
                                @endif
                            </td>

                            <!-- Status Pelaksanaan & Verifikasi -->
                            <td class="text-center">
                                <span class="badge {{ $j->status_badge }} d-block py-1 mb-1 text-center" style="font-size: 0.7rem;">
                                    {{ $j->status_label }}
                                </span>
                                <span class="badge {{ $j->verifikasi_badge }} d-block py-1 text-center" style="font-size: 0.68rem;">
                                    {{ $j->verifikasi_label }}
                                </span>
                                @if($j->catatan_supervisi)
                                    <small class="text-warning-emphasis d-block mt-1" style="font-size: 0.68rem;" title="{{ $j->catatan_supervisi }}">
                                        <i class="bi bi-chat-left-dots-fill"></i> Ada catatan supervisi
                                    </small>
                                @endif
                            </td>

                            <!-- Kontrol & Aksi (Presisi, Bersih & Tidak Tertutup) -->
                            <td class="text-center pe-3" style="white-space: nowrap;">
                                <div class="btn-group btn-group-sm" role="group">
                                    <!-- Tombol Detail / Acuan Lengkap -->
                                    <a href="{{ route('jadwal.show', $j->id) }}" class="btn btn-outline-info p-1 px-2" title="Detail Acuan Kerja & Silabus">
                                        <i class="bi bi-eye"></i>
                                    </a>

                                    <!-- Kontrol Pengajar & Admin: Kelola Target Acuan Kerja -->
                                    @if(Auth::user()->isAdmin() || (Auth::user()->isPengajar() && $j->user_id === Auth::id()))
                                        <button type="button" class="btn btn-outline-primary p-1 px-2" data-bs-toggle="modal" data-bs-target="#modalTargetAcuan{{ $j->id }}" title="Target Acuan Kerja">
                                            <i class="bi bi-file-earmark-text"></i>
                                        </button>
                                        <button type="button" class="btn btn-outline-success p-1 px-2" data-bs-toggle="modal" data-bs-target="#modalJurnal{{ $j->id }}" title="Input / Edit Jurnal Acuan">
                                            <i class="bi bi-journal-plus"></i>
                                        </button>
                                    @endif

                                    <!-- Kontrol Pemilik: Supervisi & Verifikasi -->
                                    @if(Auth::user()->isPemilik() || Auth::user()->isAdmin())
                                        <button type="button" class="btn btn-outline-warning p-1 px-2" data-bs-toggle="modal" data-bs-target="#modalSupervisi{{ $j->id }}" title="Supervisi &amp; Evaluasi Pimpinan">
                                            <i class="bi bi-award"></i>
                                        </button>
                                    @endif

                                    <!-- Kontrol Administrator: Edit & Hapus Master Jadwal -->
                                    @if(Auth::user()->isAdmin())
                                        <a href="{{ route('jadwal.edit', $j->id) }}" class="btn btn-outline-secondary p-1 px-2" title="Edit Jadwal">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('jadwal.destroy', $j->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus jadwal ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger p-1 px-2" title="Hapus Jadwal">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>

                        <!-- MODAL KELOLA TARGET ACUAN KERJA (Untuk Pengajar & Admin) -->
                        @if(Auth::user()->isAdmin() || (Auth::user()->isPengajar() && $j->user_id === Auth::id()))
                        <div class="modal fade text-start" id="modalTargetAcuan{{ $j->id }}" tabindex="-1" aria-labelledby="modalTargetAcuanLabel{{ $j->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                <div class="modal-content border-0 shadow">
                                    <form action="{{ route('jadwal.acuan', $j->id) }}" method="POST">
                                        @csrf
                                        <div class="modal-header bg-primary text-white py-2 px-3">
                                            <h6 class="modal-title fw-bold" id="modalTargetAcuanLabel{{ $j->id }}">
                                                <i class="bi bi-file-earmark-text me-1"></i> Target Acuan Kerja: {{ $j->mata_pelajaran }} ({{ $j->kelas }})
                                            </h6>
                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body p-3">
                                            <div class="mb-3 p-2 bg-light rounded small" style="font-size: 0.78rem;">
                                                <div class="row">
                                                    <div class="col-sm-6"><strong>Pengajar:</strong> {{ $j->pengajar?->name ?? 'Belum Ditentukan' }}</div>
                                                    <div class="col-sm-6"><strong>Jadwal:</strong> {{ $j->hari }}, {{ $j->jam_rentang }} ({{ $j->ruangan }})</div>
                                                </div>
                                            </div>

                                            <div class="row g-2 mb-2">
                                                <div class="col-md-6">
                                                    <label class="form-label fw-bold small text-dark mb-1">Kitab Rujukan / Modul Pegangan</label>
                                                    <input type="text" name="kitab_referensi" class="form-control form-control-sm" value="{{ $j->kitab_referensi }}" placeholder="Contoh: Matan Al-Jurumiyyah">
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label fw-bold small text-dark mb-1">Metode Pembelajaran</label>
                                                    <input type="text" name="metode_pembelajaran" class="form-control form-control-sm" value="{{ $j->metode_pembelajaran }}" placeholder="Contoh: Sorogan, Bandongan, Talaqqi">
                                                </div>
                                            </div>

                                            <div class="mb-2">
                                                <label class="form-label fw-bold small text-dark mb-1">Target Capaian Pembelajaran (Acuan Kerja) <span class="text-danger">*</span></label>
                                                <textarea name="target_capaian" rows="3" class="form-control form-control-sm" placeholder="Tuliskan target kompetensi, hafalan, atau penguasaan materi yang wajib dicapai santri..." required>{{ $j->target_capaian }}</textarea>
                                                <div class="text-muted mt-1" style="font-size: 0.7rem;">Target ini akan menjadi acuan supervisi Mudir dan laporan evaluasi santri.</div>
                                            </div>

                                            <div class="mb-2">
                                                <label class="form-label fw-bold small text-dark mb-1">Silabus Ringkas / Rencana Bahasan</label>
                                                <textarea name="silabus_ringkas" rows="3" class="form-control form-control-sm" placeholder="Rencana bahasan bab atau pekanan selama satu semester...">{{ $j->silabus_ringkas }}</textarea>
                                            </div>
                                        </div>
                                        <div class="modal-footer bg-light py-2 px-3">
                                            <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-primary btn-sm fw-bold">
                                                <i class="bi bi-save2 me-1"></i> Simpan Target Acuan Kerja
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endif

                        <!-- MODAL INPUT JURNAL (Untuk Pengajar & Admin) -->
                        <div class="modal fade text-start" id="modalJurnal{{ $j->id }}" tabindex="-1" aria-labelledby="modalJurnalLabel{{ $j->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content border-0 shadow">
                                    <form action="{{ route('jadwal.jurnal', $j->id) }}" method="POST">
                                        @csrf
                                        <div class="modal-header bg-success text-white py-2 px-3">
                                            <h6 class="modal-title fw-bold" id="modalJurnalLabel{{ $j->id }}">
                                                <i class="bi bi-journal-text me-1"></i> Update Jurnal Acuan: {{ $j->mata_pelajaran }}
                                            </h6>
                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body p-3">
                                            <div class="mb-2 p-2 bg-light rounded small" style="font-size: 0.78rem;">
                                                <div><strong>Kelas:</strong> {{ $j->kelas }} | <strong>Hari:</strong> {{ $j->hari }} ({{ $j->jam_rentang }})</div>
                                                <div><strong>Target Capaian:</strong> {{ $j->target_capaian ?? '-' }}</div>
                                            </div>

                                            <div class="mb-2">
                                                <label class="form-label fw-bold small text-dark mb-1">Status Pelaksanaan Terkini <span class="text-danger">*</span></label>
                                                <select name="status_pelaksanaan" class="form-select form-select-sm" required>
                                                    <option value="aktif" {{ $j->status_pelaksanaan === 'aktif' ? 'selected' : '' }}>
                                                        🔵 Berjalan Sesuai Jadwal
                                                    </option>
                                                    <option value="tuntas" {{ $j->status_pelaksanaan === 'tuntas' ? 'selected' : '' }}>
                                                        🟢 Target Materi Selesai / Tuntas
                                                    </option>
                                                    <option value="diganti" {{ $j->status_pelaksanaan === 'diganti' ? 'selected' : '' }}>
                                                        🟡 Jadwal Pengganti (Inval / Penyesuaian)
                                                    </option>
                                                    <option value="kendala" {{ $j->status_pelaksanaan === 'kendala' ? 'selected' : '' }}>
                                                        🔴 Terkendala / Perlu Penguatan Santri
                                                    </option>
                                                </select>
                                            </div>

                                            <div class="mb-2">
                                                <label class="form-label fw-bold small text-dark mb-1">Laporan Jurnal / Realisasi Materi Terkini <span class="text-danger">*</span></label>
                                                <textarea name="jurnal_terakhir" rows="4" class="form-control form-control-sm" placeholder="Tuliskan materi yang telah dipelajari, bab/halaman kitab yang dikaji, atau catatan pertemuan hari ini..." required>{{ $j->jurnal_terakhir }}</textarea>
                                                <div class="text-muted mt-1" style="font-size: 0.7rem;">Laporan ini akan langsung terpantau oleh Mudir / Pemilik Pondok.</div>
                                            </div>
                                        </div>
                                        <div class="modal-footer bg-light py-2 px-3">
                                            <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Tutup</button>
                                            <button type="submit" class="btn btn-success btn-sm fw-bold">
                                                <i class="bi bi-save2 me-1"></i> Simpan Jurnal Acuan
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- MODAL SUPERVISI & EVALUASI MUDIR (Untuk Pemilik & Admin) -->
                        <div class="modal fade text-start" id="modalSupervisi{{ $j->id }}" tabindex="-1" aria-labelledby="modalSupervisiLabel{{ $j->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content border-0 shadow">
                                    <form action="{{ route('jadwal.supervisi', $j->id) }}" method="POST">
                                        @csrf
                                        <div class="modal-header bg-warning text-dark py-2 px-3">
                                            <h6 class="modal-title fw-bold" id="modalSupervisiLabel{{ $j->id }}">
                                                <i class="bi bi-shield-check me-1"></i> Supervisi Mudir: {{ $j->mata_pelajaran }}
                                            </h6>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body p-3">
                                            <div class="mb-2 p-2 bg-light rounded small" style="font-size: 0.78rem;">
                                                <div><strong>Ustadz Pengampu:</strong> {{ $j->pengajar?->name }}</div>
                                                <div><strong>Kelas:</strong> {{ $j->kelas }} | <strong>Kitab:</strong> {{ $j->kitab_referensi ?? '-' }}</div>
                                                @if($j->jurnal_terakhir)
                                                    <div class="mt-1 text-success">
                                                        <strong>Jurnal Terakhir:</strong> {{ $j->jurnal_terakhir }}
                                                    </div>
                                                @endif
                                            </div>

                                            <div class="mb-2">
                                                <label class="form-label fw-bold small text-dark mb-1">Status Verifikasi Acuan Kerja <span class="text-danger">*</span></label>
                                                <select name="status_verifikasi" class="form-select form-select-sm" required>
                                                    <option value="disetujui_mudir" {{ $j->status_verifikasi === 'disetujui_mudir' ? 'selected' : '' }}>
                                                        ✅ Disetujui Mudir / Sesuai Target Kurikulum
                                                    </option>
                                                    <option value="menunggu_verifikasi" {{ $j->status_verifikasi === 'menunggu_verifikasi' ? 'selected' : '' }}>
                                                        ⏳ Menunggu Evaluasi Tambahan
                                                    </option>
                                                    <option value="perlu_revisi" {{ $j->status_verifikasi === 'perlu_revisi' ? 'selected' : '' }}>
                                                        ⚠️ Perlu Evaluasi &amp; Revisi Acuan Kerja
                                                    </option>
                                                </select>
                                            </div>

                                            <div class="mb-2">
                                                <label class="form-label fw-bold small text-dark mb-1">Catatan Supervisi &amp; Arahan Pimpinan <span class="text-danger">*</span></label>
                                                <textarea name="catatan_supervisi" rows="4" class="form-control form-control-sm" placeholder="Tuliskan evaluasi, arahan metode pengajaran, atau rekomendasi perbaikan untuk dewan asatidz..." required>{{ $j->catatan_supervisi }}</textarea>
                                                <div class="text-muted mt-1" style="font-size: 0.7rem;">Catatan ini akan tampil di dashboard guru pengampu sebagai acuan perbaikan.</div>
                                            </div>
                                        </div>
                                        <div class="modal-footer bg-light py-2 px-3">
                                            <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Tutup</button>
                                            <button type="submit" class="btn btn-warning btn-sm fw-bold">
                                                <i class="bi bi-check2-circle me-1"></i> Simpan Catatan Supervisi
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-4 text-muted">
                                <i class="bi bi-inbox fs-2 d-block mb-1 text-muted opacity-50"></i>
                                Tidak ada data jadwal mata pelajaran yang cocok dengan filter pencarian.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

<!-- MODAL TAMBAH JADWAL & ACUAN KERJA CEPAT (Untuk Admin) -->
@if(Auth::user()->isAdmin())
<div class="modal fade text-start" id="modalTambahJadwalCepat" tabindex="-1" aria-labelledby="modalTambahJadwalCepatLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow">
            <form action="{{ route('jadwal.store') }}" method="POST">
                @csrf
                <div class="modal-header bg-pesantren text-white py-2 px-3">
                    <h6 class="modal-title fw-bold" id="modalTambahJadwalCepatLabel">
                        <i class="bi bi-plus-circle-fill me-1"></i> Tambah Jadwal Pelajaran &amp; Konsep Acuan Kerja
                    </h6>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-3">
                    <div class="row g-2">
                        <!-- Sesi 1: Waktu & Guru -->
                        <div class="col-md-4">
                            <label class="form-label fw-bold small text-dark mb-1">Hari <span class="text-danger">*</span></label>
                            <select name="hari" class="form-select form-select-sm" required>
                                <option value="">Pilih Hari...</option>
                                @foreach(['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Ahad'] as $h)
                                    <option value="{{ $h }}">{{ $h }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold small text-dark mb-1">Jam Mulai <span class="text-danger">*</span></label>
                            <input type="text" name="jam_mulai" class="form-control form-control-sm" value="07:30" placeholder="07:30" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold small text-dark mb-1">Jam Selesai <span class="text-danger">*</span></label>
                            <input type="text" name="jam_selesai" class="form-control form-control-sm" value="09:00" placeholder="09:00" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold small text-dark mb-1">Mata Pelajaran <span class="text-danger">*</span></label>
                            <input type="text" name="mata_pelajaran" class="form-control form-control-sm" placeholder="Contoh: Nahwu Dasar / Fikih" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold small text-dark mb-1">Dewan Asatidz / Pengajar <span class="text-danger">*</span></label>
                            <select name="user_id" class="form-select form-select-sm" required>
                                <option value="">Pilih Ustadz / Guru...</option>
                                @foreach($pengajars as $p)
                                    <option value="{{ $p->id }}">{{ $p->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-bold small text-dark mb-1">Kelas <span class="text-danger">*</span></label>
                            <input type="text" name="kelas" class="form-control form-control-sm" placeholder="VII-A MTs" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold small text-dark mb-1">Ruangan <span class="text-danger">*</span></label>
                            <input type="text" name="ruangan" class="form-control form-control-sm" value="Ruang Kelas" required>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label fw-bold small text-dark mb-1">Tahun Ajaran <span class="text-danger">*</span></label>
                            <input type="text" name="tahun_ajaran" class="form-control form-control-sm" value="2026/2027" required>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label fw-bold small text-dark mb-1">Semester <span class="text-danger">*</span></label>
                            <select name="semester" class="form-select form-select-sm" required>
                                <option value="Ganjil">Ganjil</option>
                                <option value="Genap">Genap</option>
                            </select>
                        </div>

                        <!-- Sesi 2: Acuan Kerja -->
                        <div class="col-md-6 pt-2 border-top">
                            <label class="form-label fw-bold small text-dark mb-1">Kitab Rujukan / Buku Pegangan</label>
                            <input type="text" name="kitab_referensi" class="form-control form-control-sm" placeholder="Contoh: Matan Al-Jurumiyyah">
                        </div>
                        <div class="col-md-6 pt-2 border-top">
                            <label class="form-label fw-bold small text-dark mb-1">Metode Pembelajaran</label>
                            <input type="text" name="metode_pembelajaran" class="form-control form-control-sm" placeholder="Contoh: Sorogan, Bandongan">
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-bold small text-dark mb-1">Target Capaian Pembelajaran (Acuan Kerja)</label>
                            <textarea name="target_capaian" rows="2" class="form-control form-control-sm" placeholder="Target kompetensi atau hafalan/pemahaman santri yang wajib dicapai..."></textarea>
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-bold small text-dark mb-1">Silabus Ringkas / Rencana Bahasan</label>
                            <textarea name="silabus_ringkas" rows="2" class="form-control form-control-sm" placeholder="Pokok bahasan pekanan..."></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light py-2 px-3">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success btn-sm fw-bold">
                        <i class="bi bi-check-circle me-1"></i> Simpan Jadwal &amp; Acuan Kerja
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif
@endsection
