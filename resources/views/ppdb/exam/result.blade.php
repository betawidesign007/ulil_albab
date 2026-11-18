<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Ujian Masuk Akademik - {{ $registration->nama_lengkap }}</title>

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
        .result-card {
            background: #ffffff;
            border-radius: 24px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.35);
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        .score-circle {
            width: 140px;
            height: 140px;
            border-radius: 50%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
            border: 6px solid #ffffff;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
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
        }
    </style>
</head>
<body class="py-4 py-md-5">

<div class="container py-2">
    <!-- Top Header -->
    <div class="text-center text-white mb-4">
        <a href="{{ route('landing') }}" class="d-inline-flex align-items-center gap-2 text-decoration-none text-white mb-2">
            @if($ppdbSetting->logo_url)
                <img src="{{ $ppdbSetting->logo_url }}" alt="Logo" class="rounded-3 bg-white p-1" style="width: 44px; height: 44px; object-fit: contain;" onerror="this.onerror=null; this.src='{{ asset('images/logo.png') }}';">
            @else
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="rounded-3 bg-white p-1" style="width: 44px; height: 44px; object-fit: contain;">
            @endif
            <div class="text-start lh-1">
                <span class="fw-bold fs-5 tracking-tight d-block">{{ $ppdbSetting->nama_pesantren }}</span>
                <small class="text-warning fw-semibold" style="font-size: 0.72rem; letter-spacing: 0.05em;">PENGUMUMAN RESMI UJIAN SELEKSI MASUK</small>
            </div>
        </a>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-10 col-xl-9">

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show shadow-sm mb-4 d-flex align-items-center gap-2" role="alert">
                    <i class="bi bi-check-circle-fill fs-5"></i>
                    <div>{{ session('success') }}</div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session('info'))
                <div class="alert alert-info alert-dismissible fade show shadow-sm mb-4" role="alert">
                    <i class="bi bi-info-circle-fill me-2"></i> {{ session('info') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="result-card">
                <!-- Banner Header -->
                <div class="p-4 p-md-5 text-white text-center position-relative" style="background: linear-gradient(135deg, #064e3b 0%, #065f46 100%);">
                    <span class="badge bg-warning text-dark fw-bold px-3 py-2 mb-3">
                        <i class="bi bi-award-fill me-1"></i> SURAT KETERANGAN HASIL UJIAN (SKHU) PPDB
                    </span>
                    <h2 class="fw-bold text-white mb-1">{{ $registration->nama_lengkap }}</h2>
                    <div class="text-white-75 font-monospace mb-4">No. Pendaftaran: {{ $registration->no_pendaftaran }} &bull; Jenjang: {{ $registration->jenjang }}</div>

                    <!-- Score Circle -->
                    @php
                        $circleBg = match($examResult->status_kelulusan) {
                            'Lulus' => 'linear-gradient(135deg, #059669 0%, #047857 100%)',
                            'Dipertimbangkan' => 'linear-gradient(135deg, #d97706 0%, #b45309 100%)',
                            default => 'linear-gradient(135deg, #dc2626 0%, #b91c1c 100%)',
                        };
                    @endphp
                    <div class="score-circle text-white mb-3" style="background: {{ $circleBg }};">
                        <span class="small fw-semibold opacity-75" style="font-size: 0.75rem;">NILAI AKHIR</span>
                        <div class="display-5 fw-extrabold lh-1 my-1" style="font-weight: 800;">{{ number_format($examResult->nilai, 0) }}</div>
                        <span class="small opacity-75" style="font-size: 0.72rem;">DARI 100</span>
                    </div>

                    <div>
                        <span class="badge {{ $examResult->status_badge_class }} fs-6 px-4 py-2 rounded-pill shadow-sm">
                            <i class="bi bi-check-circle-fill me-1"></i> STATUS: {{ strtoupper($examResult->status_kelulusan) }}
                        </span>
                    </div>
                </div>

                <div class="p-4 p-md-5">

                    <!-- Kotak Informasi Catatan & Feedback Resmi Dari Administrator / Dewan Penguji -->
                    <div class="p-4 rounded-4 border mb-4 shadow-sm" style="background-color: #f8fafc; border-left: 6px solid #059669 !important;">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <h6 class="fw-bold text-dark mb-0 d-flex align-items-center gap-2">
                                <i class="bi bi-chat-left-quote-fill text-success fs-5"></i>
                                Informasi &amp; Evaluasi Resmi Dewan Penguji PPDB:
                            </h6>
                            @if($examResult->penilai)
                                <span class="badge bg-secondary bg-opacity-10 text-secondary small">
                                    Diverifikasi oleh: {{ $examResult->penilai->name }}
                                </span>
                            @endif
                        </div>
                        <p class="text-dark mb-0 lh-base" style="font-size: 0.95rem; white-space: pre-line;">
                            {{ $examResult->catatan_admin ?? 'Hasil ujian masuk ini telah tercatat secara resmi pada sistem penerimaan santri baru PP. Li Ulil Albab. Silakan unduh dan cetak surat hasil ujian di bawah ini.' }}
                        </p>
                    </div>

                    <!-- Statistik Rincian Pengerjaan -->
                    <div class="row g-3 text-center mb-4">
                        <div class="col-4">
                            <div class="p-3 bg-light rounded-3 border">
                                <span class="text-success small fw-bold text-uppercase d-block mb-1">
                                    <i class="bi bi-check-circle-fill me-1"></i> Jawaban Benar
                                </span>
                                <h3 class="fw-bold mb-0 text-success">{{ $examResult->jawaban_benar }}</h3>
                                <small class="text-muted">Butir Soal</small>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="p-3 bg-light rounded-3 border">
                                <span class="text-danger small fw-bold text-uppercase d-block mb-1">
                                    <i class="bi bi-x-circle-fill me-1"></i> Jawaban Salah
                                </span>
                                <h3 class="fw-bold mb-0 text-danger">{{ $examResult->jawaban_salah }}</h3>
                                <small class="text-muted">Butir Soal</small>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="p-3 bg-light rounded-3 border">
                                <span class="text-secondary small fw-bold text-uppercase d-block mb-1">
                                    <i class="bi bi-dash-circle-fill me-1"></i> Tidak Dijawab
                                </span>
                                <h3 class="fw-bold mb-0 text-secondary">{{ $examResult->jawaban_kosong }}</h3>
                                <small class="text-muted">Butir Soal</small>
                            </div>
                        </div>
                    </div>

                    <!-- Breakdown Kompetensi Per Kategori Materi -->
                    <div class="mb-4">
                        <h6 class="fw-bold text-dark mb-3"><i class="bi bi-bar-chart-line-fill text-success me-2"></i>Rincian Penguasaan Materi:</h6>
                        <div class="table-responsive">
                            <table class="table table-bordered table-sm align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>Kategori Materi</th>
                                        <th class="text-center" style="width: 15%;">Jumlah Soal</th>
                                        <th class="text-center" style="width: 15%;">Benar</th>
                                        <th class="text-center" style="width: 25%;">Persentase</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($kategoriStats as $katNama => $stat)
                                        @php
                                            $pct = $stat['total'] > 0 ? round(($stat['benar'] / $stat['total']) * 100) : 0;
                                            $barColor = $pct >= 70 ? 'bg-success' : ($pct >= 50 ? 'bg-warning' : 'bg-danger');
                                        @endphp
                                        <tr>
                                            <td class="fw-semibold text-dark">{{ $katNama }}</td>
                                            <td class="text-center">{{ $stat['total'] }}</td>
                                            <td class="text-center fw-bold text-success">{{ $stat['benar'] }}</td>
                                            <td>
                                                <div class="d-flex align-items-center gap-2">
                                                    <div class="progress flex-grow-1" style="height: 8px;">
                                                        <div class="progress-bar {{ $barColor }}" style="width: {{ $pct }}%;"></div>
                                                    </div>
                                                    <span class="small fw-bold" style="width: 40px;">{{ $pct }}%</span>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Detail Data Pendaftar -->
                    <div class="p-3 bg-light rounded-3 border mb-4 small">
                        <div class="row g-2">
                            <div class="col-sm-6">
                                <span class="text-muted">Nama Calon Santri:</span>
                                <div class="fw-bold text-dark">{{ $registration->nama_lengkap }}</div>
                            </div>
                            <div class="col-sm-6">
                                <span class="text-muted">Nama Orang Tua / Wali:</span>
                                <div class="fw-semibold text-dark">{{ $registration->nama_wali }} ({{ $registration->no_wa }})</div>
                            </div>
                            <div class="col-sm-6">
                                <span class="text-muted">Waktu Selesai Pengerjaan:</span>
                                <div class="fw-semibold text-dark">{{ $examResult->waktu_selesai ? $examResult->waktu_selesai->translatedFormat('d F Y, H:i') . ' WIB' : '-' }} (Durasi: {{ $examResult->durasi_menit }} menit)</div>
                            </div>
                            <div class="col-sm-6">
                                <span class="text-muted">Jalur Masuk:</span>
                                <div class="fw-semibold text-dark">{{ $registration->jalur }}</div>
                            </div>
                        </div>
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="d-flex flex-wrap gap-2 justify-content-between align-items-center pt-2">
                        <a href="{{ route('landing') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-house-door me-1"></i> Kembali ke Beranda
                        </a>
                        <div class="d-flex gap-2">
                            <a href="{{ route('ppdb.exam.cetak', $registration->no_pendaftaran) }}" target="_blank" class="btn btn-pesantren fw-bold px-3">
                                <i class="bi bi-printer-fill me-1"></i> Cetak Bukti Hasil Nilai Ujian (PDF)
                            </a>
                            @php
                                $cleanPhone = preg_replace('/[^0-9]/', '', $ppdbSetting->telepon);
                                if (str_starts_with($cleanPhone, '0')) {
                                    $cleanPhone = '62' . substr($cleanPhone, 1);
                                }
                                $waText = urlencode("Assalamu'alaikum Panitia PPDB Li Ulil Albab. Saya telah menyelesaikan ujian akademik santri an. {$registration->nama_lengkap} (No. {$registration->no_pendaftaran}) dengan skor {$examResult->nilai}. Mohon info tahapan selanjutnya.");
                            @endphp
                            <a href="https://wa.me/{{ $cleanPhone }}?text={{ $waText }}" target="_blank" class="btn btn-warning fw-bold text-dark px-3">
                                <i class="bi bi-whatsapp me-1"></i> Hubungi Panitia
                            </a>
                        </div>
                    </div>

                </div>
            </div>

            <div class="text-center text-white-50 small mt-4">
                &copy; {{ date('Y') }} Panitia PPDB {{ $ppdbSetting->nama_pesantren }}. Surat Keterangan Sah Diterbitkan Sistem.
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
