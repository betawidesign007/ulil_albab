<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Matriks Jadwal Pelajaran & Acuan Kerja - Pondok Pesantren Li Ulil Albab</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            color: #000;
            background: #fff;
            font-size: 11pt;
        }
        .kop-surat {
            border-bottom: 3px double #000;
            padding-bottom: 12px;
            margin-bottom: 20px;
        }
        .table-print {
            border-collapse: collapse;
            width: 100%;
        }
        .table-print th, .table-print td {
            border: 1px solid #000 !important;
            padding: 6px 8px;
            font-size: 9.5pt;
        }
        .table-print th {
            background-color: #f2f2f2 !important;
            text-align: center;
        }
        @media print {
            .no-print {
                display: none !important;
            }
            body {
                padding: 0;
                margin: 0;
            }
            @page {
                size: A4 landscape;
                margin: 1.2cm;
            }
        }
    </style>
</head>
<body class="p-4">

    <!-- Tombol Cetak Browser -->
    <div class="no-print mb-4 d-flex justify-content-between align-items-center bg-light p-3 rounded border">
        <div>
            <h6 class="fw-bold mb-0 text-dark">Pratinjau Cetak / Ekspor PDF</h6>
            <small class="text-muted">Gunakan opsi cetak atau simpan sebagai PDF melalui browser.</small>
        </div>
        <div class="d-flex gap-2">
            <button onclick="window.print()" class="btn btn-success fw-bold">
                <i class="bi bi-printer-fill me-1"></i> Cetak Dokumen Ini
            </button>
            <button onclick="window.close()" class="btn btn-secondary">
                Tutup
            </button>
        </div>
    </div>

    <!-- Kop Surat Pesantren -->
    <div class="kop-surat d-flex align-items-center justify-content-center gap-3">
        @php
            $cetakLogo = $appSetting?->logo_url ?? (file_exists(public_path('images/logo.png')) ? asset('images/logo.png') : null);
        @endphp
        @if($cetakLogo)
            <img src="{{ $cetakLogo }}" alt="Logo Pesantren" style="width: 70px; height: 70px; object-fit: contain;">
        @endif
        <div class="text-center">
            <h3 class="fw-bold mb-0 text-uppercase tracking-wider">{{ $appSetting?->nama_pesantren ?? 'YAYASAN PONDOK PESANTREN LI ULIL ALBAB' }}</h3>
            <h4 class="fw-bold mb-1">MADRASAH TSANAWIYAH &amp; ALIYAH TERPADU</h4>
            <p class="mb-0" style="font-size: 10pt;">
                {{ $appSetting?->alamat ?? 'Jl. Pesantren Modern No. 99, Li Ulil Albab Center' }} | Telp: {{ $appSetting?->telepon ?? '(+62) 877-9910-7735' }} | Email: {{ $appSetting?->email ?? 'ppdb@ulilalbab.ac.id' }}
            </p>
        </div>
    </div>

    <!-- Judul Dokumen -->
    <div class="text-center mb-3">
        <h5 class="fw-bold text-uppercase text-decoration-underline mb-1">
            MATRIKS JADWAL PELAJARAN &amp; KONSEP ACUAN KERJA ASATIDZ
        </h5>
        <div style="font-size: 10pt;">
            Tahun Ajaran 2026/2027 - Semester Ganjil
        </div>
    </div>

    <!-- Tabel Matriks Jadwal -->
    <table class="table-print mb-4">
        <thead>
            <tr>
                <th style="width: 4%;">No</th>
                <th style="width: 10%;">Hari &amp; Jam</th>
                <th style="width: 12%;">Kelas &amp; Ruang</th>
                <th style="width: 18%;">Mata Pelajaran &amp; Kitab</th>
                <th style="width: 18%;">Dewan Asatidz</th>
                <th style="width: 26%;">Target Acuan Kerja Santri</th>
                <th style="width: 12%;">Status Pelaksanaan</th>
            </tr>
        </thead>
        <tbody>
            @forelse($jadwals as $index => $j)
                <tr>
                    <td class="text-center align-middle">{{ $index + 1 }}</td>
                    <td class="align-middle">
                        <strong>{{ $j->hari }}</strong><br>
                        <small>{{ $j->jam_rentang }}</small>
                    </td>
                    <td class="align-middle">
                        <strong>{{ $j->kelas }}</strong><br>
                        <small class="text-muted">{{ $j->ruangan }}</small>
                    </td>
                    <td class="align-middle">
                        <strong>{{ $j->mata_pelajaran }}</strong>
                        @if($j->kitab_referensi)
                            <br><small><em>Kitab: {{ $j->kitab_referensi }}</em></small>
                        @endif
                    </td>
                    <td class="align-middle">
                        <strong>{{ $j->pengajar?->name ?? 'Belum Ditentukan' }}</strong><br>
                        <small class="text-muted">{{ $j->pengajar?->jabatan ?? 'Pengajar' }}</small>
                    </td>
                    <td class="align-middle">
                        <small>{{ $j->target_capaian ?? '-' }}</small>
                    </td>
                    <td class="align-middle text-center">
                        <small><strong>{{ $j->status_label }}</strong></small><br>
                        <small class="text-muted">({{ $j->verifikasi_label }})</small>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center py-4">Tidak ada data jadwal yang terdaftar.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Tanda Tangan & Pengesahan -->
    <div class="row mt-4" style="font-size: 10.5pt;">
        <div class="col-6 text-center">
            <p class="mb-1">Mengetahui,</p>
            <p class="fw-bold mb-5">Kepala Bagian Akademik / Kurikulum</p>
            <p class="fw-bold text-decoration-underline mb-0">Ustadz M. Faruq, S.Kom</p>
            <small>NIY. 201809001</small>
        </div>
        <div class="col-6 text-center">
            <p class="mb-1">Disahkan di Li Ulil Albab, {{ now()->translatedFormat('d F Y') }}</p>
            <p class="fw-bold mb-5">Pengasuh &amp; Mudir Pondok Pesantren</p>
            <p class="fw-bold text-decoration-underline mb-0">{{ $pemilik?->name ?? 'KH. Dr. Abdullah Syukri, M.Ag' }}</p>
            <small>Pimpinan Pondok Pesantren</small>
        </div>
    </div>

</body>
</html>
