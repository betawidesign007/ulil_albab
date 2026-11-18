@extends('layouts.app', ['title' => 'Detail Ujian & Evaluasi - ' . $result->nama_santri])

@section('content')
<div class="container-fluid px-3 px-lg-4 py-3" style="max-width: 1300px;">

    <!-- Header & Breadcrumb -->
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 mb-3 pb-2 border-bottom">
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-1" style="font-size: 0.8rem;">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-decoration-none text-success">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.ppdb.nilai.index') }}" class="text-decoration-none text-success">Nilai Ujian Masuk</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $result->nama_santri }}</li>
                </ol>
            </nav>
            <h2 class="h4 fw-bold mb-1 text-dark d-flex align-items-center gap-2">
                <i class="bi bi-file-earmark-person-fill text-success"></i> Evaluasi Ujian Seleksi: {{ $result->nama_santri }}
            </h2>
            <p class="text-muted mb-0 small" style="font-size: 0.78rem;">
                Tinjau rincian lembar jawaban per butir soal dan berikan keputusan kelulusan serta catatan evaluasi resmi dari Panitia PPDB.
            </p>
        </div>
        <div class="d-flex align-items-center gap-2">
            <a href="{{ route('ppdb.exam.cetak', $result->no_pendaftaran) }}" target="_blank" class="btn btn-sm btn-outline-secondary shadow-sm py-2 px-3 fw-semibold">
                <i class="bi bi-printer me-1"></i> Cetak SKHU Santri
            </a>
            <a href="{{ route('admin.ppdb.nilai.index') }}" class="btn btn-sm btn-outline-secondary shadow-sm py-2 px-3">
                <i class="bi bi-arrow-left me-1"></i> Kembali ke Daftar Nilai
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

    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show shadow-sm mb-4" role="alert">
            <div class="fw-bold mb-1"><i class="bi bi-exclamation-triangle-fill me-1"></i> Terdapat kesalahan formulir:</div>
            <ul class="mb-0 ps-3">
                @foreach($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row g-4 mb-4">
        <!-- Kolom Kiri: Ringkasan Santri & Form Evaluasi Admin -->
        <div class="col-lg-5">
            <!-- Profil Singkat Santri Card -->
            <div class="card border-0 shadow-sm rounded-4 p-4 mb-4 bg-white">
                <div class="d-flex align-items-center justify-content-between mb-3 pb-2 border-bottom">
                    <span class="badge bg-success bg-opacity-10 text-success fw-bold font-monospace px-3 py-1.5">
                        {{ $result->no_pendaftaran }}
                    </span>
                    <span class="badge {{ $result->status_badge_class }} px-3 py-1.5 rounded-pill">
                        {{ $result->status_kelulusan }}
                    </span>
                </div>

                <h5 class="fw-bold text-dark mb-1">{{ $result->nama_santri }}</h5>
                <div class="text-muted small mb-3">Jenjang: <strong>{{ $result->jenjang }}</strong></div>

                <div class="p-3 bg-light rounded-3 mb-3 small">
                    <div class="d-flex justify-content-between mb-1">
                        <span class="text-muted">Total Soal:</span>
                        <strong>{{ $result->total_soal }} Butir</strong>
                    </div>
                    <div class="d-flex justify-content-between mb-1">
                        <span class="text-muted">Jawaban Benar:</span>
                        <strong class="text-success">{{ $result->jawaban_benar }}</strong>
                    </div>
                    <div class="d-flex justify-content-between mb-1">
                        <span class="text-muted">Jawaban Salah:</span>
                        <strong class="text-danger">{{ $result->jawaban_salah }}</strong>
                    </div>
                    <div class="d-flex justify-content-between mb-1">
                        <span class="text-muted">Tidak Dijawab:</span>
                        <strong class="text-secondary">{{ $result->jawaban_kosong }}</strong>
                    </div>
                    <div class="d-flex justify-content-between pt-2 border-top">
                        <span class="text-muted">Skor Nilai:</span>
                        <strong class="fs-5 fw-bold text-success">{{ number_format($result->nilai, 0) }} / 100</strong>
                    </div>
                </div>

                @if($result->registration)
                    <div class="small text-muted">
                        <div><i class="bi bi-person me-1"></i> Wali: <strong>{{ $result->registration->nama_wali }}</strong></div>
                        <div><i class="bi bi-whatsapp me-1 text-success"></i> WhatsApp: <strong>{{ $result->registration->no_wa }}</strong></div>
                        <div><i class="bi bi-award me-1"></i> Jalur: <strong>{{ $result->registration->jalur }}</strong></div>
                        <div><i class="bi bi-calendar3 me-1"></i> Selesai Ujian: <strong>{{ $result->waktu_selesai ? $result->waktu_selesai->translatedFormat('d M Y, H:i') : '-' }}</strong> ({{ $result->durasi_menit }} Menit)</div>
                    </div>
                @endif
            </div>

            <!-- Form Penetapan Status Kelulusan & Catatan Evaluasi Admin -->
            <div class="card border-0 shadow-sm rounded-4 p-4 bg-white" style="border-top: 4px solid #059669 !important;">
                <h5 class="fw-bold text-dark mb-2 d-flex align-items-center gap-2">
                    <i class="bi bi-chat-square-quote-fill text-success"></i> Input Evaluasi &amp; Catatan Admin
                </h5>
                <p class="text-muted small mb-3">
                    Informasi dan catatan yang Anda simpan di sini akan <strong>langsung tampil</strong> pada portal pengumuman nilai calon santri dan dokumen cetak SKHU resmi.
                </p>

                <form action="{{ route('admin.ppdb.nilai.update', $result) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label fw-bold text-dark">Keputusan Status Kelulusan <span class="text-danger">*</span></label>
                        <select name="status_kelulusan" class="form-select @error('status_kelulusan') is-invalid @enderror" required>
                            <option value="Lulus" {{ old('status_kelulusan', $result->status_kelulusan) === 'Lulus' ? 'selected' : '' }}>
                                🟢 Lulus (Memenuhi Syarat & Diterima)
                            </option>
                            <option value="Dipertimbangkan" {{ old('status_kelulusan', $result->status_kelulusan) === 'Dipertimbangkan' ? 'selected' : '' }}>
                                🟡 Dipertimbangkan (Perlu Wawancara Khusus / Matrikulasi)
                            </option>
                            <option value="Tidak Lulus" {{ old('status_kelulusan', $result->status_kelulusan) === 'Tidak Lulus' ? 'selected' : '' }}>
                                🔴 Tidak Lulus (Belum Memenuhi Passing Grade)
                            </option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold text-dark">Skor Nilai Akhir (0 - 100) <span class="text-danger">*</span></label>
                        <input type="number" step="0.01" min="0" max="100" name="nilai" class="form-control @error('nilai') is-invalid @enderror" value="{{ old('nilai', $result->nilai) }}" required>
                        <div class="form-text">Dapat disesuaikan jika ada poin tambahan dari tes wawancara / tahfidz.</div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold text-dark">Catatan &amp; Pesan Evaluasi Dewan Penguji</label>
                        <textarea name="catatan_admin" rows="5" class="form-control @error('catatan_admin') is-invalid @enderror" placeholder="Tuliskan catatan apresiasi, rekomendasi penempatan kelas, jadwal daftar ulang, atau syarat berkas lanjutan...">{{ old('catatan_admin', $result->catatan_admin) }}</textarea>
                        <div class="form-text">Pesan ini akan terbaca oleh calon santri dan orang tua.</div>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-success fw-bold py-2.5">
                            <i class="bi bi-check2-circle me-1"></i> Simpan &amp; Perbarui Evaluasi Santri
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Kolom Kanan: Rincian Lembar Jawaban Santri (50 Butir Soal) -->
        <div class="col-lg-7">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white">
                <div class="card-header bg-white p-3 p-md-4 border-bottom d-flex align-items-center justify-content-between">
                    <div>
                        <h5 class="fw-bold mb-0 text-dark">
                            <i class="bi bi-card-checklist text-success me-2"></i>Lembar Jawaban Ujian Masuk
                        </h5>
                        <small class="text-muted">Tinjau seluruh respon jawaban yang dipilih oleh calon santri</small>
                    </div>
                    <span class="badge bg-light text-dark border px-3 py-2">
                        Total {{ count($result->detail_jawaban ?? []) }} Soal
                    </span>
                </div>

                <div class="card-body p-3 p-md-4 overflow-y-auto" style="max-height: 850px;">
                    @forelse($result->detail_jawaban ?? [] as $item)
                        @php
                            $soalRef = $soals->get($item['soal_id'] ?? null);
                            $status = $item['status'] ?? 'kosong';
                        @endphp
                        <div class="p-3 rounded-3 border mb-3 {{ $status === 'benar' ? 'bg-success bg-opacity-10 border-success border-opacity-25' : ($status === 'salah' ? 'bg-danger bg-opacity-10 border-danger border-opacity-25' : 'bg-light') }}">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <div class="d-flex align-items-center gap-2">
                                    <span class="badge bg-dark fw-bold">No. {{ $item['nomor_urut'] ?? $loop->iteration }}</span>
                                    <span class="badge bg-secondary bg-opacity-25 text-dark small">{{ $item['kategori'] ?? '-' }}</span>
                                </div>
                                <div>
                                    @if($status === 'benar')
                                        <span class="badge bg-success"><i class="bi bi-check-lg me-1"></i> Benar</span>
                                    @elseif($status === 'salah')
                                        <span class="badge bg-danger"><i class="bi bi-x-lg me-1"></i> Salah</span>
                                    @else
                                        <span class="badge bg-secondary"><i class="bi bi-dash me-1"></i> Tidak Dijawab</span>
                                    @endif
                                </div>
                            </div>

                            @if($soalRef)
                                <div class="fw-semibold text-dark mb-2" style="font-size: 0.92rem;">
                                    {{ $soalRef->pertanyaan }}
                                </div>
                            @endif

                            <div class="d-flex flex-wrap gap-3 small pt-2 border-top border-secondary border-opacity-15">
                                <div>
                                    <span class="text-muted">Jawaban Santri:</span>
                                    <strong class="font-monospace {{ $status === 'benar' ? 'text-success' : ($status === 'salah' ? 'text-danger' : 'text-secondary') }}">
                                        {{ $item['jawaban_santri'] ?? '(Kosong)' }}
                                    </strong>
                                </div>
                                <div>
                                    <span class="text-muted">Kunci Jawaban:</span>
                                    <strong class="font-monospace text-success">{{ $item['kunci_jawaban'] ?? '-' }}</strong>
                                </div>
                                @if($soalRef && $soalRef->penjelasan)
                                    <div class="w-100 text-muted fst-italic">
                                        <i class="bi bi-info-circle me-1"></i> {{ $soalRef->penjelasan }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-5 text-muted">
                            <i class="bi bi-file-earmark-x fs-1 d-block mb-2"></i>
                            Rincian detail lembar jawaban tidak tersedia.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
