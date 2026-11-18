<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ujian Masuk Akademik Calon Santri - {{ $ppdbSetting->nama_pesantren }}</title>

    <!-- Favicon / Logo di Browser Tab -->
    @php
        $faviconUrl = $ppdbSetting?->logo_url ?? (file_exists(public_path('storage/images/logo.png')) ? asset('storage/images/logo.png') : asset('images/logo.png'));
    @endphp
    <link rel="icon" type="image/png" href="{{ $faviconUrl }}">
    <link rel="shortcut icon" href="{{ $faviconUrl }}">
    <link rel="apple-touch-icon" href="{{ $faviconUrl }}">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Amiri:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: linear-gradient(135deg, #022c22 0%, #064e3b 60%, #065f46 100%);
            min-height: 100vh;
            color: #1e293b;
        }
        .exam-hero-card {
            background: #ffffff;
            border-radius: 24px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.35);
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        .btn-pesantren {
            background: linear-gradient(135deg, #065f46 0%, #047857 100%);
            color: #ffffff;
            font-weight: 600;
            border: none;
            transition: all 0.25s ease;
        }
        .btn-pesantren:hover {
            background: #022c22;
            color: #ffffff;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(6, 95, 70, 0.3);
        }
        .btn-gold {
            background: linear-gradient(135deg, #d97706 0%, #b45309 100%);
            color: #ffffff;
            font-weight: 700;
            border: none;
            transition: all 0.25s ease;
        }
        .btn-gold:hover {
            background: linear-gradient(135deg, #b45309 0%, #92400e 100%);
            color: #ffffff;
            transform: translateY(-2px);
            box-shadow: 0 10px 24px rgba(217, 119, 6, 0.45);
        }
        @media (max-width: 767.98px) {
            body {
                padding-top: 1rem !important;
                padding-bottom: 1.5rem !important;
            }
            .exam-hero-card {
                border-radius: 16px;
            }
            input, .form-control {
                font-size: 16px !important;
            }
        }
    </style>
</head>
<body class="py-4 py-md-5">

<div class="container py-2">
    <!-- Top Brand Header -->
    <div class="text-center text-white mb-4">
        <a href="{{ route('landing') }}" class="d-inline-flex align-items-center gap-2 text-decoration-none text-white mb-2">
            @if($ppdbSetting->logo_url)
                <img src="{{ $ppdbSetting->logo_url }}" alt="Logo" class="rounded-3 bg-white p-1" style="width: 44px; height: 44px; object-fit: contain;" onerror="this.onerror=null; this.src='{{ asset('images/logo.png') }}';">
            @else
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="rounded-3 bg-white p-1" style="width: 44px; height: 44px; object-fit: contain;">
            @endif
            <div class="text-start lh-1">
                <span class="fw-bold fs-5 tracking-tight d-block">{{ $ppdbSetting->nama_pesantren }}</span>
                <small class="text-warning fw-semibold" style="font-size: 0.72rem; letter-spacing: 0.05em;">PORTAL UJIAN SELEKSI MASUK AKADEMIK</small>
            </div>
        </a>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-9 col-xl-8">

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show shadow-sm mb-4" role="alert">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session('info'))
                <div class="alert alert-info alert-dismissible fade show shadow-sm mb-4" role="alert">
                    <i class="bi bi-info-circle-fill me-2"></i> {{ session('info') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="exam-hero-card">
                <!-- Header Banner -->
                <div class="p-4 p-md-5 text-white" style="background: linear-gradient(135deg, #064e3b 0%, #065f46 100%);">
                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 mb-2">
                        <span class="badge bg-warning text-dark px-3 py-2 fw-bold">
                            <i class="bi bi-laptop me-1"></i> Computer Based Test (CBT)
                        </span>
                        <span class="badge bg-white bg-opacity-20 text-white px-3 py-2">
                            Tahun Ajaran {{ $ppdbSetting->tahun_ajaran }}
                        </span>
                    </div>
                    <h2 class="fw-bold mb-2 text-white">Tes Akademik &amp; Potensi Dasar Santri</h2>
                    <p class="text-white-75 mb-0" style="font-size: 0.95rem;">
                        Syarat seleksi masuk wajib bagi seluruh calon santri baru yang telah melakukan registrasi pendaftaran PPDB.
                    </p>
                </div>

                <div class="p-4 p-md-5">

                    <!-- Petunjuk Pelaksanaan Ujian -->
                    <div class="p-3 p-md-4 rounded-4 bg-light border mb-4">
                        <h6 class="fw-bold text-dark mb-3 d-flex align-items-center gap-2">
                            <i class="bi bi-card-checklist text-success fs-5"></i> Ketentuan &amp; Informasi Ujian Masuk:
                        </h6>
                        <div class="row g-3 small text-muted">
                            <div class="col-sm-6">
                                <div class="d-flex align-items-start gap-2">
                                    <i class="bi bi-check2-circle text-success fs-6 mt-0.5"></i>
                                    <div><strong>Jumlah Soal:</strong> {{ $totalSoal }} Butir Pilihan Ganda (A, B, C, D)</div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="d-flex align-items-start gap-2">
                                    <i class="bi bi-clock-history text-warning fs-6 mt-0.5"></i>
                                    <div><strong>Alokasi Waktu:</strong> 90 Menit (Hitung Mundur)</div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="d-flex align-items-start gap-2">
                                    <i class="bi bi-mortarboard text-primary fs-6 mt-0.5"></i>
                                    <div><strong>Komposisi Materi:</strong> PAI, Tajwid, Bahasa Arab, B. Indonesia, Matematika &amp; B. Inggris</div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="d-flex align-items-start gap-2">
                                    <i class="bi bi-award text-danger fs-6 mt-0.5"></i>
                                    <div><strong>Passing Grade:</strong> Minimal skor 70.00 untuk kelulusan langsung</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Jika Calon Santri Sudah Pernah Ujian -->
                    @if($examResult)
                        <div class="alert alert-success p-4 rounded-4 shadow-sm mb-4 border-2">
                            <div class="d-flex align-items-center gap-3 mb-3">
                                <span class="p-2 bg-success text-white rounded-circle fs-4">
                                    <i class="bi bi-check-lg"></i>
                                </span>
                                <div>
                                    <h5 class="fw-bold text-dark mb-0">Ujian Telah Selesai Dikerjakan!</h5>
                                    <div class="small text-muted">Atas nama: <strong>{{ $examResult->nama_santri }}</strong> ({{ $examResult->no_pendaftaran }})</div>
                                </div>
                            </div>
                            <p class="small text-muted mb-3">
                                Anda sudah mengerjakan seluruh butir tes akademik ini. Nilai Anda telah diproses dan diverifikasi oleh Panitia PPDB.
                            </p>
                            <div class="d-flex flex-wrap gap-2">
                                <a href="{{ route('ppdb.exam.result', $examResult->no_pendaftaran) }}" class="btn btn-success fw-bold px-4">
                                    <i class="bi bi-trophy-fill me-1"></i> Buka Rincian Nilai &amp; Hasil Kelulusan
                                </a>
                                <a href="{{ route('ppdb.exam.cetak', $examResult->no_pendaftaran) }}" target="_blank" class="btn btn-outline-secondary px-3">
                                    <i class="bi bi-printer me-1"></i> Cetak Surat Hasil Ujian
                                </a>
                            </div>
                        </div>
                    @endif

                    <!-- Form Verifikasi Nomor Pendaftaran & Mulai Ujian -->
                    <form action="{{ route('ppdb.exam.start') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label class="form-label fw-bold text-dark" for="no_pendaftaran">
                                Masukkan Nomor Pendaftaran / Registrasi Calon Santri <span class="text-danger">*</span>
                            </label>
                            <div class="input-group input-group-lg">
                                <span class="input-group-text bg-white border-end-0 text-success">
                                    <i class="bi bi-qr-code-scan"></i>
                                </span>
                                <input type="text"
                                       name="no_pendaftaran"
                                       id="no_pendaftaran"
                                       class="form-control border-start-0 font-monospace fw-bold text-uppercase @error('no_pendaftaran') is-invalid @enderror"
                                       placeholder="Contoh: PPDB-2026-0001"
                                       value="{{ old('no_pendaftaran', $noPendaftaran) }}"
                                       required
                                       autofocus>
                            </div>
                            @error('no_pendaftaran')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                            <div class="form-text">
                                Nomor pendaftaran tercantum pada <strong>Kartu Peserta Ujian Masuk</strong> yang diterbitkan saat Anda menyelesaikan registrasi pendaftaran online.
                            </div>
                        </div>

                        <!-- Info Konfirmasi Santri Jika Ada -->
                        @if($registration && !$examResult)
                            <div class="card border-success border-opacity-50 bg-success bg-opacity-10 mb-4 p-3 rounded-3">
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <span class="badge bg-success">Data Pendaftar Terverifikasi ✓</span>
                                    <span class="small text-muted font-monospace">{{ $registration->no_pendaftaran }}</span>
                                </div>
                                <div class="row g-2 small">
                                    <div class="col-sm-6">
                                        <span class="text-muted">Nama Calon Santri:</span>
                                        <div class="fw-bold text-dark fs-6">{{ $registration->nama_lengkap }}</div>
                                    </div>
                                    <div class="col-sm-6">
                                        <span class="text-muted">Jenjang Pendidikan:</span>
                                        <div class="fw-semibold text-dark">{{ $registration->jenjang }}</div>
                                    </div>
                                    <div class="col-sm-6">
                                        <span class="text-muted">Jalur Pendaftaran:</span>
                                        <div class="fw-semibold text-dark">{{ $registration->jalur }}</div>
                                    </div>
                                    <div class="col-sm-6">
                                        <span class="text-muted">Asal Sekolah:</span>
                                        <div class="fw-semibold text-dark">{{ $registration->asal_sekolah }}</div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <!-- Pernyataan Integritas Ujian -->
                        <div class="form-check p-3 bg-light rounded-3 mb-4 border">
                            <input class="form-check-input ms-0 me-2" type="checkbox" id="integritas" required>
                            <label class="form-check-label small text-dark" for="integritas">
                                Saya menyatakan siap mengerjakan ujian tes akademik ini secara mandiri, jujur, tanpa bantuan pihak lain, sesuai batas waktu yang telah ditentukan demi meraih berkah ilmu.
                            </label>
                        </div>

                        <!-- Action Buttons -->
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-gold btn-lg py-3 shadow-sm">
                                <i class="bi bi-play-circle-fill me-2 fs-5"></i> Mulai Ujian Tes Akademik Sekarang
                            </button>
                            <a href="{{ route('landing') }}#formulir-ppdb" class="btn btn-link text-decoration-none text-muted small mt-1">
                                <i class="bi bi-arrow-left me-1"></i> Belum Memiliki Nomor Pendaftaran? Daftar PPDB Di Sini
                            </a>
                        </div>
                    </form>

                </div>
            </div>

            <div class="text-center text-white-50 small mt-4">
                &copy; {{ date('Y') }} Panitia PPDB {{ $ppdbSetting->nama_pesantren }}. Sistem Ujian Online Terintegrasi.
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
