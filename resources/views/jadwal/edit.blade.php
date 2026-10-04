@extends('layouts.app', ['title' => 'Edit Jadwal & Acuan Kerja'])

@section('content')
<div class="container-fluid px-3 px-lg-4 py-3" style="max-width: 1400px;">

    <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 mb-3 pb-2 border-bottom">
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-1" style="font-size: 0.8rem;">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-decoration-none text-success">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('jadwal.index') }}" class="text-decoration-none text-success">Jadwal &amp; Acuan Kerja</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Jadwal</li>
                </ol>
            </nav>
            <h2 class="h4 fw-bold mb-1 text-dark d-flex align-items-center gap-2">
                <i class="bi bi-pencil-square text-success"></i> Edit Jadwal &amp; Konsep Acuan Kerja
            </h2>
            <p class="text-muted mb-0 small" style="font-size: 0.78rem;">
                Perbarui detail waktu mengajar, alokasi kelas, ustadz pengampu, atau penyesuaian target silabus kitab.
            </p>
        </div>
        <div>
            <a href="{{ route('jadwal.index') }}" class="btn btn-sm btn-outline-secondary px-3 py-2 fw-semibold">
                <i class="bi bi-arrow-left me-1"></i> Kembali ke Daftar Jadwal
            </a>
        </div>
    </div>

    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show shadow-sm mb-4" role="alert">
            <div class="fw-bold mb-1"><i class="bi bi-exclamation-triangle-fill me-1"></i> Terdapat kesalahan pengisian:</div>
            <ul class="mb-0 ps-3">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <form action="{{ route('jadwal.update', $jadwal->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row g-4">
            <!-- Kolom 1: Alokasi Waktu & Pengajar -->
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header bg-white py-3 border-bottom">
                        <h5 class="fw-bold mb-0 text-dark d-flex align-items-center gap-2">
                            <span class="badge bg-success bg-opacity-10 text-success p-2 rounded-circle">
                                <i class="bi bi-clock-fill fs-6"></i>
                            </span>
                            1. Alokasi Waktu, Kelas &amp; Dewan Asatidz
                        </h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold small text-dark">Hari <span class="text-danger">*</span></label>
                                <select name="hari" class="form-select @error('hari') is-invalid @enderror" required>
                                    @foreach(['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Ahad'] as $h)
                                        <option value="{{ $h }}" {{ old('hari', $jadwal->hari) === $h ? 'selected' : '' }}>{{ $h }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold small text-dark">Kelas / Kelompok <span class="text-danger">*</span></label>
                                <input type="text" name="kelas" class="form-control @error('kelas') is-invalid @enderror" value="{{ old('kelas', $jadwal->kelas) }}" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold small text-dark">Jam Mulai <span class="text-danger">*</span></label>
                                <input type="text" name="jam_mulai" class="form-control @error('jam_mulai') is-invalid @enderror" value="{{ old('jam_mulai', $jadwal->jam_mulai) }}" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold small text-dark">Jam Selesai <span class="text-danger">*</span></label>
                                <input type="text" name="jam_selesai" class="form-control @error('jam_selesai') is-invalid @enderror" value="{{ old('jam_selesai', $jadwal->jam_selesai) }}" required>
                            </div>

                            <div class="col-12">
                                <label class="form-label fw-bold small text-dark">Dewan Asatidz / Pengajar <span class="text-danger">*</span></label>
                                <select name="user_id" class="form-select @error('user_id') is-invalid @enderror" required>
                                    @foreach($pengajars as $p)
                                        <option value="{{ $p->id }}" {{ old('user_id', $jadwal->user_id) == $p->id ? 'selected' : '' }}>
                                            {{ $p->name }} ({{ $p->jabatan ?? 'Pengajar' }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold small text-dark">Ruangan / Tempat <span class="text-danger">*</span></label>
                                <input type="text" name="ruangan" class="form-control @error('ruangan') is-invalid @enderror" value="{{ old('ruangan', $jadwal->ruangan) }}" required>
                            </div>

                            <div class="col-md-3">
                                <label class="form-label fw-bold small text-dark">Tahun Ajaran <span class="text-danger">*</span></label>
                                <input type="text" name="tahun_ajaran" class="form-control @error('tahun_ajaran') is-invalid @enderror" value="{{ old('tahun_ajaran', $jadwal->tahun_ajaran) }}" required>
                            </div>

                            <div class="col-md-3">
                                <label class="form-label fw-bold small text-dark">Semester <span class="text-danger">*</span></label>
                                <select name="semester" class="form-select @error('semester') is-invalid @enderror" required>
                                    <option value="Ganjil" {{ old('semester', $jadwal->semester) === 'Ganjil' ? 'selected' : '' }}>Ganjil</option>
                                    <option value="Genap" {{ old('semester', $jadwal->semester) === 'Genap' ? 'selected' : '' }}>Genap</option>
                                </select>
                            </div>

                            <div class="col-12">
                                <label class="form-label fw-bold small text-dark">Status Pelaksanaan Terkini <span class="text-danger">*</span></label>
                                <select name="status_pelaksanaan" class="form-select @error('status_pelaksanaan') is-invalid @enderror" required>
                                    <option value="aktif" {{ old('status_pelaksanaan', $jadwal->status_pelaksanaan) === 'aktif' ? 'selected' : '' }}>
                                        🔵 Berjalan Sesuai Jadwal
                                    </option>
                                    <option value="tuntas" {{ old('status_pelaksanaan', $jadwal->status_pelaksanaan) === 'tuntas' ? 'selected' : '' }}>
                                        🟢 Materi Selesai / Tuntas
                                    </option>
                                    <option value="diganti" {{ old('status_pelaksanaan', $jadwal->status_pelaksanaan) === 'diganti' ? 'selected' : '' }}>
                                        🟡 Jadwal Pengganti (Inval)
                                    </option>
                                    <option value="kendala" {{ old('status_pelaksanaan', $jadwal->status_pelaksanaan) === 'kendala' ? 'selected' : '' }}>
                                        🔴 Terkendala / Perlu Penyesuaian
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Kolom 2: Konsep Acuan Kerja & Kurikulum -->
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header bg-white py-3 border-bottom">
                        <h5 class="fw-bold mb-0 text-dark d-flex align-items-center gap-2">
                            <span class="badge bg-primary bg-opacity-10 text-primary p-2 rounded-circle">
                                <i class="bi bi-bookmark-star-fill fs-6"></i>
                            </span>
                            2. Konsep Acuan Kerja, Kitab &amp; Target Capaian
                        </h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label fw-bold small text-dark">Nama Mata Pelajaran <span class="text-danger">*</span></label>
                                <input type="text" name="mata_pelajaran" class="form-control @error('mata_pelajaran') is-invalid @enderror" value="{{ old('mata_pelajaran', $jadwal->mata_pelajaran) }}" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold small text-dark">Kitab Rujukan / Buku Pegangan</label>
                                <input type="text" name="kitab_referensi" class="form-control @error('kitab_referensi') is-invalid @enderror" value="{{ old('kitab_referensi', $jadwal->kitab_referensi) }}">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold small text-dark">Metode Pembelajaran</label>
                                <input type="text" name="metode_pembelajaran" class="form-control @error('metode_pembelajaran') is-invalid @enderror" value="{{ old('metode_pembelajaran', $jadwal->metode_pembelajaran) }}">
                            </div>

                            <div class="col-12">
                                <label class="form-label fw-bold small text-dark">Target Capaian Pembelajaran (Acuan Kerja)</label>
                                <textarea name="target_capaian" rows="3" class="form-control @error('target_capaian') is-invalid @enderror">{{ old('target_capaian', $jadwal->target_capaian) }}</textarea>
                            </div>

                            <div class="col-12">
                                <label class="form-label fw-bold small text-dark">Silabus Ringkas / Rencana Bahasan</label>
                                <textarea name="silabus_ringkas" rows="3" class="form-control @error('silabus_ringkas') is-invalid @enderror">{{ old('silabus_ringkas', $jadwal->silabus_ringkas) }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Submit Button Bar -->
            <div class="col-12">
                <div class="card border-0 shadow-sm p-3 bg-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <a href="{{ route('jadwal.index') }}" class="btn btn-outline-secondary">Batal</a>
                        <button type="submit" class="btn btn-pesantren px-4 fw-bold shadow-sm">
                            <i class="bi bi-save-fill me-1"></i> Perbarui Jadwal &amp; Acuan Kerja
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>

</div>
@endsection
