@extends('layouts.app', ['title' => 'Detail Acuan Kerja - ' . $jadwal->mata_pelajaran])

@section('content')
<div class="container py-4">

    <!-- Header & Navigation -->
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4 pb-2 border-bottom">
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-1">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-decoration-none text-success">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('jadwal.index') }}" class="text-decoration-none text-success">Jadwal &amp; Acuan Kerja</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Detail Acuan</li>
                </ol>
            </nav>
            <h2 class="fw-bold mb-1 text-dark d-flex align-items-center gap-2">
                <i class="bi bi-file-earmark-ruled-fill text-success"></i> Dokumen Konsep Acuan Kerja Guru
            </h2>
            <p class="text-muted mb-0 small">
                Rincian silabus, kompetensi target capaian santri, log jurnal harian, dan evaluasi pimpinan.
            </p>
        </div>

        <div class="d-flex align-items-center gap-2">
            <a href="{{ route('jadwal.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left me-1"></i> Kembali ke Daftar
            </a>
            @if(Auth::user()->isAdmin())
                <a href="{{ route('jadwal.edit', $jadwal->id) }}" class="btn btn-warning text-dark fw-bold">
                    <i class="bi bi-pencil-square me-1"></i> Edit Jadwal
                </a>
                <form action="{{ route('jadwal.destroy', $jadwal->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus jadwal ini?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger fw-semibold">
                        <i class="bi bi-trash me-1"></i> Hapus Jadwal
                    </button>
                </form>
            @endif
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show d-flex align-items-center gap-2 shadow-sm mb-4" role="alert">
            <i class="bi bi-check-circle-fill fs-5"></i>
            <div>{{ session('success') }}</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Kartu Ringkasan Mapel & Pengampu -->
    <div class="card border-0 shadow-sm mb-4 bg-white">
        <div class="card-body p-4">
            <div class="row align-items-center g-3">
                <div class="col-lg-8">
                    <div class="d-flex align-items-center gap-2 mb-2">
                        <span class="badge bg-dark px-3 py-1 fs-6">{{ $jadwal->hari }}</span>
                        <span class="badge bg-primary px-3 py-1 fs-6">{{ $jadwal->jam_rentang }}</span>
                        <span class="badge bg-success px-3 py-1 fs-6">{{ $jadwal->kelas }}</span>
                        <span class="badge {{ $jadwal->status_badge }} px-3 py-1">{{ $jadwal->status_label }}</span>
                    </div>
                    <h3 class="fw-bold text-dark mb-1">{{ $jadwal->mata_pelajaran }}</h3>
                    <div class="text-muted">
                        <i class="bi bi-book-half text-success me-1"></i> Kitab: <strong>{{ $jadwal->kitab_referensi ?? 'Tidak ada kitab spesifik' }}</strong> |
                        <i class="bi bi-geo-alt-fill text-danger me-1"></i> Lokasi: <strong>{{ $jadwal->ruangan }}</strong> |
                        <i class="bi bi-calendar3 text-primary me-1"></i> Tahun: <strong>{{ $jadwal->tahun_ajaran }} ({{ $jadwal->semester }})</strong>
                    </div>
                </div>

                <div class="col-lg-4 text-lg-end">
                    <div class="p-3 bg-light rounded-3 text-start text-lg-end">
                        <small class="text-muted text-uppercase fw-semibold d-block">Dewan Asatidz Pengampu</small>
                        <h5 class="fw-bold text-dark mb-0">{{ $jadwal->pengajar?->name ?? 'Belum Ditentukan' }}</h5>
                        <small class="text-success">{{ $jadwal->pengajar?->jabatan ?? 'Dewan Pengajar' }}</small>
                        <div class="text-muted small mt-1"><i class="bi bi-telephone me-1"></i>{{ $jadwal->pengajar?->no_hp ?? '-' }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <!-- Kolom Kiri: Target Capaian & Silabus Acuan Kerja -->
        <div class="col-lg-7">
            <!-- Target Capaian -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white py-3 border-bottom">
                    <h5 class="fw-bold mb-0 text-dark d-flex align-items-center gap-2">
                        <i class="bi bi-bullseye text-danger"></i> Target Capaian Kompetensi Santri (Acuan Utama)
                    </h5>
                </div>
                <div class="card-body p-4">
                    @if($jadwal->target_capaian)
                        <div class="lead fs-6 text-dark lh-base">
                            {{ $jadwal->target_capaian }}
                        </div>
                    @else
                        <div class="text-muted fst-italic">Belum ada deskripsi target capaian yang diisi.</div>
                    @endif
                </div>
            </div>

            <!-- Silabus & Rencana Bahasan -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white py-3 border-bottom">
                    <h5 class="fw-bold mb-0 text-dark d-flex align-items-center gap-2">
                        <i class="bi bi-list-check text-primary"></i> Silabus Ringkas &amp; Rencana Pokok Bahasan
                    </h5>
                </div>
                <div class="card-body p-4">
                    @if($jadwal->silabus_ringkas)
                        <div class="text-secondary lh-lg" style="white-space: pre-line;">
                            {{ $jadwal->silabus_ringkas }}
                        </div>
                    @else
                        <div class="text-muted fst-italic">Silabus pembelajaran belum dicantumkan.</div>
                    @endif

                    @if($jadwal->metode_pembelajaran)
                        <div class="mt-4 pt-3 border-top">
                            <h6 class="fw-bold text-dark mb-1"><i class="bi bi-gear-wide-connected me-1 text-success"></i> Metode Pembelajaran:</h6>
                            <p class="text-muted mb-0">{{ $jadwal->metode_pembelajaran }}</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Jurnal Pengajar & Log Realisasi Materi -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white py-3 border-bottom d-flex align-items-center justify-content-between">
                    <h5 class="fw-bold mb-0 text-dark d-flex align-items-center gap-2">
                        <i class="bi bi-journal-text text-success"></i> Jurnal Realisasi Materi &amp; Evaluasi Harian
                    </h5>
                    @if(Auth::user()->isAdmin() || (Auth::user()->isPengajar() && $jadwal->user_id === Auth::id()))
                        <button type="button" class="btn btn-sm btn-outline-success" data-bs-toggle="collapse" data-bs-target="#collapseEditJurnal">
                            <i class="bi bi-pencil-fill me-1"></i> Update Jurnal
                        </button>
                    @endif
                </div>
                <div class="card-body p-4">
                    @if(Auth::user()->isAdmin() || (Auth::user()->isPengajar() && $jadwal->user_id === Auth::id()))
                        <div class="collapse mb-3" id="collapseEditJurnal">
                            <form action="{{ route('jadwal.jurnal', $jadwal->id) }}" method="POST" class="p-3 bg-light rounded-3 border">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label fw-bold small">Status Pelaksanaan</label>
                                    <select name="status_pelaksanaan" class="form-select form-select-sm" required>
                                        <option value="aktif" {{ $jadwal->status_pelaksanaan === 'aktif' ? 'selected' : '' }}>🔵 Berjalan Sesuai Jadwal</option>
                                        <option value="tuntas" {{ $jadwal->status_pelaksanaan === 'tuntas' ? 'selected' : '' }}>🟢 Materi Selesai / Tuntas</option>
                                        <option value="diganti" {{ $jadwal->status_pelaksanaan === 'diganti' ? 'selected' : '' }}>🟡 Jadwal Pengganti (Inval)</option>
                                        <option value="kendala" {{ $jadwal->status_pelaksanaan === 'kendala' ? 'selected' : '' }}>🔴 Terkendala / Perlu Penyesuaian</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-bold small">Catatan Jurnal / Materi Pertemuan Hari Ini</label>
                                    <textarea name="jurnal_terakhir" rows="3" class="form-control form-control-sm" required placeholder="Tuliskan bab yang dibahas, kemajuan santri, atau PR/tugas...">{{ $jadwal->jurnal_terakhir }}</textarea>
                                </div>
                                <button type="submit" class="btn btn-sm btn-success fw-bold">Simpan Jurnal</button>
                            </form>
                        </div>
                    @endif

                    @if($jadwal->jurnal_terakhir)
                        <div class="p-3 bg-success-subtle text-success-emphasis rounded-3 border border-success-subtle">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <span class="fw-bold"><i class="bi bi-clock-history me-1"></i> Laporan Terakhir Pengajar:</span>
                                <small class="text-muted">{{ $jadwal->jurnal_updated_at?->translatedFormat('l, d F Y - H:i') }} WIB</small>
                            </div>
                            <p class="mb-0 text-dark">{{ $jadwal->jurnal_terakhir }}</p>
                        </div>
                    @else
                        <div class="text-muted fst-italic">Pengajar belum menginputkan jurnal pertemuan untuk jadwal ini.</div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Kolom Kanan: Supervisi Mudir & Verifikasi Pimpinan -->
        <div class="col-lg-5">
            <!-- Box Verifikasi Pimpinan -->
            <div class="card border-0 shadow-sm mb-4 border-top border-4 border-warning">
                <div class="card-header bg-white py-3 border-bottom d-flex align-items-center justify-content-between">
                    <h5 class="fw-bold mb-0 text-dark d-flex align-items-center gap-2">
                        <i class="bi bi-award-fill text-warning"></i> Supervisi Mudir / Pimpinan
                    </h5>
                    <span class="badge {{ $jadwal->verifikasi_badge }}">{{ $jadwal->verifikasi_label }}</span>
                </div>
                <div class="card-body p-4">
                    @if($jadwal->catatan_supervisi)
                        <div class="p-3 bg-light rounded-3 mb-3 border-start border-4 border-warning">
                            <small class="text-muted d-block mb-1">
                                <i class="bi bi-person-badge-fill text-warning me-1"></i>
                                Oleh: <strong>{{ $jadwal->supervisor?->name ?? 'Pimpinan Pondok' }}</strong>
                                ({{ $jadwal->supervisi_at?->diffForHumans() }})
                            </small>
                            <p class="mb-0 fst-italic text-dark font-normal">"{{ $jadwal->catatan_supervisi }}"</p>
                        </div>
                    @else
                        <div class="p-3 bg-light rounded-3 mb-3 text-muted text-center small">
                            <i class="bi bi-chat-square-dots fs-3 d-block mb-1 opacity-50"></i>
                            Belum ada catatan evaluasi dari pimpinan pondok.
                        </div>
                    @endif

                    <!-- Form Supervisi untuk Pemilik / Mudir -->
                    @if(Auth::user()->isPemilik() || Auth::user()->isAdmin())
                        <div class="mt-3 pt-3 border-top">
                            <h6 class="fw-bold text-dark mb-2">
                                <i class="bi bi-pen-fill text-warning me-1"></i> Beri Arahan &amp; Verifikasi
                            </h6>
                            <form action="{{ route('jadwal.supervisi', $jadwal->id) }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label small fw-bold text-muted">Status Persetujuan Mudir</label>
                                    <select name="status_verifikasi" class="form-select form-select-sm" required>
                                        <option value="disetujui_mudir" {{ $jadwal->status_verifikasi === 'disetujui_mudir' ? 'selected' : '' }}>
                                            ✅ Disetujui Mudir / Sesuai Target Kurikulum
                                        </option>
                                        <option value="menunggu_verifikasi" {{ $jadwal->status_verifikasi === 'menunggu_verifikasi' ? 'selected' : '' }}>
                                            ⏳ Menunggu Evaluasi Lanjutan
                                        </option>
                                        <option value="perlu_revisi" {{ $jadwal->status_verifikasi === 'perlu_revisi' ? 'selected' : '' }}>
                                            ⚠️ Perlu Revisi / Penyesuaian Acuan Kerja
                                        </option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label small fw-bold text-muted">Catatan Supervisi &amp; Rekomendasi Pimpinan</label>
                                    <textarea name="catatan_supervisi" rows="3" class="form-control form-control-sm" placeholder="Tuliskan arahan supervisi untuk pengajar..." required>{{ $jadwal->catatan_supervisi }}</textarea>
                                </div>
                                <button type="submit" class="btn btn-warning btn-sm fw-bold w-100 shadow-sm">
                                    <i class="bi bi-send-check-fill me-1"></i> Kirim Evaluasi Acuan Kerja
                                </button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Box Panduan Acuan Kerja -->
            <div class="card border-0 shadow-sm bg-pesantren text-white">
                <div class="card-body p-4">
                    <h6 class="fw-bold text-warning mb-2"><i class="bi bi-info-circle-fill me-1"></i> Petunjuk Acuan Kerja Pesantren</h6>
                    <p class="small text-white-50 mb-3">
                        Konsep acuan kerja ini berfungsi sebagai standarisasi pembelajaran di Pondok Pesantren Li Ulil Albab.
                    </p>
                    <ul class="list-unstyled small text-white-75 mb-0">
                        <li class="mb-2"><i class="bi bi-check2 text-warning me-1"></i> <strong>Pengajar:</strong> Mengisi realisasi materi setiap selesai pertemuan.</li>
                        <li class="mb-2"><i class="bi bi-check2 text-warning me-1"></i> <strong>Admin:</strong> Memastikan tidak ada bentrok waktu &amp; ruangan.</li>
                        <li><i class="bi bi-check2 text-warning me-1"></i> <strong>Pemilik/Mudir:</strong> Melakukan supervisi berkala terhadap ketercapaian silabus kitab.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
