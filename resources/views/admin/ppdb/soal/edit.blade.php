@extends('layouts.app', ['title' => 'Edit Butir Soal #' . $soal->nomor_urut])

@section('content')
<div class="container-fluid px-3 px-lg-4 py-3" style="max-width: 1000px;">

    <!-- Header & Breadcrumb -->
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 mb-3 pb-2 border-bottom">
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-1" style="font-size: 0.8rem;">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-decoration-none text-success">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.ppdb.soal.index') }}" class="text-decoration-none text-success">Bank Soal PPDB</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Soal #{{ $soal->nomor_urut }}</li>
                </ol>
            </nav>
            <h2 class="h4 fw-bold mb-1 text-dark d-flex align-items-center gap-2">
                <i class="bi bi-pencil-square text-success"></i> Edit Butir Soal Nomor {{ $soal->nomor_urut }}
            </h2>
            <p class="text-muted mb-0 small" style="font-size: 0.78rem;">
                Perbarui narasi pertanyaan, pilihan jawaban, kunci jawaban, atau kategori butir soal.
            </p>
        </div>
        <a href="{{ route('admin.ppdb.soal.index') }}" class="btn btn-sm btn-outline-secondary">
            <i class="bi bi-arrow-left me-1"></i> Kembali ke Bank Soal
        </a>
    </div>

    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show shadow-sm mb-4" role="alert">
            <div class="fw-bold mb-1"><i class="bi bi-exclamation-triangle-fill me-1"></i> Terdapat kesalahan input:</div>
            <ul class="mb-0 ps-3">
                @foreach($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white">
        <div class="card-body p-4 p-md-5">
            <form action="{{ route('admin.ppdb.soal.update', $soal) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row g-3 mb-4">
                    <div class="col-md-3">
                        <label class="form-label fw-bold text-dark">Nomor Urut Soal <span class="text-danger">*</span></label>
                        <input type="number" name="nomor_urut" min="1" class="form-control @error('nomor_urut') is-invalid @enderror" value="{{ old('nomor_urut', $soal->nomor_urut) }}" required>
                        <div class="form-text">Urutan tampil di CBT santri.</div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold text-dark">Kategori / Bidang Studi Materi <span class="text-danger">*</span></label>
                        <input type="text" name="kategori" list="kategoriPresets" class="form-control @error('kategori') is-invalid @enderror" value="{{ old('kategori', $soal->kategori) }}" required placeholder="Pilih atau ketik kategori...">
                        <datalist id="kategoriPresets">
                            @foreach($kategoriList as $k)
                                <option value="{{ $k }}"></option>
                            @endforeach
                        </datalist>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label fw-bold text-dark">Bobot Poin <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input type="number" name="bobot" min="1" max="100" class="form-control @error('bobot') is-invalid @enderror" value="{{ old('bobot', $soal->bobot) }}" required>
                            <span class="input-group-text">Poin</span>
                        </div>
                    </div>
                </div>

                <!-- Teks Pertanyaan -->
                <div class="mb-4">
                    <label class="form-label fw-bold text-dark">Teks Pertanyaan Soal <span class="text-danger">*</span></label>
                    <textarea name="pertanyaan" rows="4" class="form-control @error('pertanyaan') is-invalid @enderror" required>{{ old('pertanyaan', $soal->pertanyaan) }}</textarea>
                </div>

                <!-- 4 Pilihan Opsi -->
                <div class="p-3 p-md-4 rounded-4 bg-light border mb-4">
                    <h6 class="fw-bold text-dark mb-3"><i class="bi bi-list-check text-success me-2"></i>Pilihan Opsi Jawaban (A, B, C, D)</h6>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold text-dark">Pilihan A <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text fw-bold bg-white">A</span>
                                <input type="text" name="opsi_a" class="form-control @error('opsi_a') is-invalid @enderror" value="{{ old('opsi_a', $soal->opsi_a) }}" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold text-dark">Pilihan B <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text fw-bold bg-white">B</span>
                                <input type="text" name="opsi_b" class="form-control @error('opsi_b') is-invalid @enderror" value="{{ old('opsi_b', $soal->opsi_b) }}" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold text-dark">Pilihan C <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text fw-bold bg-white">C</span>
                                <input type="text" name="opsi_c" class="form-control @error('opsi_c') is-invalid @enderror" value="{{ old('opsi_c', $soal->opsi_c) }}" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold text-dark">Pilihan D <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text fw-bold bg-white">D</span>
                                <input type="text" name="opsi_d" class="form-control @error('opsi_d') is-invalid @enderror" value="{{ old('opsi_d', $soal->opsi_d) }}" required>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Kunci Jawaban & Penjelasan -->
                <div class="row g-3 mb-4">
                    <div class="col-md-4">
                        <label class="form-label fw-bold text-dark">Kunci Jawaban Benar <span class="text-danger">*</span></label>
                        <select name="kunci_jawaban" class="form-select @error('kunci_jawaban') is-invalid @enderror" required>
                            <option value="A" {{ old('kunci_jawaban', $soal->kunci_jawaban) === 'A' ? 'selected' : '' }}>Opsi A</option>
                            <option value="B" {{ old('kunci_jawaban', $soal->kunci_jawaban) === 'B' ? 'selected' : '' }}>Opsi B</option>
                            <option value="C" {{ old('kunci_jawaban', $soal->kunci_jawaban) === 'C' ? 'selected' : '' }}>Opsi C</option>
                            <option value="D" {{ old('kunci_jawaban', $soal->kunci_jawaban) === 'D' ? 'selected' : '' }}>Opsi D</option>
                        </select>
                        <div class="form-text">Jawaban ini digunakan sistem untuk auto-grading.</div>
                    </div>

                    <div class="col-md-8">
                        <label class="form-label fw-bold text-dark">Penjelasan / Pembahasan Soal (Opsional)</label>
                        <input type="text" name="penjelasan" class="form-control @error('penjelasan') is-invalid @enderror" value="{{ old('penjelasan', $soal->penjelasan) }}" placeholder="Catatan dalil, rumus, atau alasan mengapa opsi tersebut benar...">
                    </div>
                </div>

                <div class="form-check form-switch p-3 bg-light rounded-3 mb-4 border">
                    <input class="form-check-input ms-0 me-3" type="checkbox" role="switch" name="is_aktif" id="is_aktif" value="1" {{ old('is_aktif', $soal->is_aktif) ? 'checked' : '' }}>
                    <label class="form-check-label fw-semibold text-dark" for="is_aktif">
                        Aktifkan butir soal ini dalam sesi pengerjaan ujian CBT santri
                    </label>
                </div>

                <div class="d-flex justify-content-between align-items-center pt-3 border-top">
                    <a href="{{ route('admin.ppdb.soal.index') }}" class="btn btn-outline-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary fw-bold px-4 py-2">
                        <i class="bi bi-save me-1"></i> Perbarui Butir Soal
                    </button>
                </div>

            </form>
        </div>
    </div>

</div>
@endsection
