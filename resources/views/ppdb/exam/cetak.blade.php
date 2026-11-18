<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Hasil Ujian Masuk - {{ $registration->nama_lengkap }} ({{ $registration->no_pendaftaran }})</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            color: #000;
            background: #fff;
            padding: 20px;
        }
        .kop-surat {
            border-bottom: 3px double #000;
            padding-bottom: 12px;
            margin-bottom: 20px;
        }
        .table-data td {
            padding: 4px 8px;
            font-size: 13pt;
        }
        @media print {
            .no-print {
                display: none !important;
            }
            body {
                padding: 0;
            }
        }
    </style>
</head>
<body>

    <!-- Tombol Navigasi Cetak (Disembunyikan saat print) -->
    <div class="no-print mb-4 p-3 bg-light border rounded-3 d-flex justify-content-between align-items-center">
        <div>
            <strong>Pratinjau Cetak Surat Keterangan Hasil Ujian Seleksi Masuk (SKHU)</strong>
            <div class="small text-muted">Gunakan tombol di samping untuk mencetak langsung atau simpan sebagai dokumen PDF.</div>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('ppdb.exam.result', $registration->no_pendaftaran) }}" class="btn btn-secondary btn-sm">
                &larr; Kembali ke Hasil
            </a>
            <button type="button" class="btn btn-success btn-sm fw-bold" onclick="window.print()">
                <i class="bi bi-printer-fill me-1"></i> Cetak / Simpan PDF
            </button>
        </div>
    </div>

    <div class="container" style="max-width: 800px;">
        <!-- Kop Surat Resmi -->
        <div class="kop-surat d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center gap-3">
                @if($ppdbSetting->logo_url)
                    <img src="{{ $ppdbSetting->logo_url }}" alt="Logo" style="width: 75px; height: 75px; object-fit: contain;">
                @else
                    <div style="width: 75px; height: 75px; border: 2px solid #000; display:flex; align-items:center; justify-content:center; font-size:24pt; font-weight:bold;">
                        LA
                    </div>
                @endif
                <div>
                    <h5 class="fw-bold mb-0 text-uppercase" style="letter-spacing: 0.05em;">PANITIA PENERIMAAN SANTRI BARU (PPDB)</h5>
                    <h4 class="fw-bold mb-0 text-uppercase" style="letter-spacing: 0.05em;">{{ $ppdbSetting->nama_pesantren }}</h4>
                    <div style="font-size: 10pt;">{{ $ppdbSetting->alamat }} | Telepon: {{ $ppdbSetting->telepon }} | Email: {{ $ppdbSetting->email }}</div>
                </div>
            </div>
        </div>

        <!-- Judul Surat -->
        <div class="text-center my-4">
            <h5 class="fw-bold mb-1 text-decoration-underline text-uppercase">SURAT KETERANGAN HASIL UJIAN SELEKSI MASUK</h5>
            <div style="font-size: 11pt;">Nomor: {{ $examResult->id }}/PPDB/{{ date('Y') }}/{{ str_replace('PPDB-', '', $registration->no_pendaftaran) }}</div>
        </div>

        <p style="font-size: 12pt; text-align: justify; line-height: 1.6;">
            Panitia Penerimaan Peserta Didik Baru (PPDB) Pondok Pesantren Li Ulil Albab Tahun Ajaran <strong>{{ $ppdbSetting->tahun_ajaran }}</strong> menerangkan bahwa calon santri dengan data identitas di bawah ini:
        </p>

        <!-- Tabel Data Santri -->
        <table class="table-data mb-4 w-100">
            <tr>
                <td style="width: 32%;">Nomor Pendaftaran / Registrasi</td>
                <td style="width: 3%;">:</td>
                <td class="fw-bold">{{ $registration->no_pendaftaran }}</td>
            </tr>
            <tr>
                <td>Nama Lengkap Calon Santri</td>
                <td>:</td>
                <td class="fw-bold">{{ $registration->nama_lengkap }}</td>
            </tr>
            <tr>
                <td>Jenis Kelamin</td>
                <td>:</td>
                <td>{{ $registration->jenis_kelamin }}</td>
            </tr>
            <tr>
                <td>Tempat, Tanggal Lahir</td>
                <td>:</td>
                <td>{{ $registration->tempat_lahir }}, {{ $registration->tanggal_lahir ? $registration->tanggal_lahir->translatedFormat('d F Y') : '-' }}</td>
            </tr>
            <tr>
                <td>Asal Sekolah / Madrasah</td>
                <td>:</td>
                <td>{{ $registration->asal_sekolah }}</td>
            </tr>
            <tr>
                <td>Pilihan Jenjang Pendidikan</td>
                <td>:</td>
                <td class="fw-bold">{{ $registration->jenjang }}</td>
            </tr>
            <tr>
                <td>Nama Orang Tua / Wali</td>
                <td>:</td>
                <td>{{ $registration->nama_wali }} ({{ $registration->no_wa }})</td>
            </tr>
            <tr>
                <td>Jalur Pendaftaran</td>
                <td>:</td>
                <td>{{ $registration->jalur }}</td>
            </tr>
        </table>

        <p style="font-size: 12pt; text-align: justify; line-height: 1.6;">
            Telah mengikuti rangkaian <strong>Tes Akademik Ujian Masuk (CBT 50 Butir Soal)</strong> dengan perolehan hasil sebagai berikut:
        </p>

        <!-- Tabel Perolehan Nilai -->
        <table class="table table-bordered text-center align-middle mb-4" style="border: 2px solid #000; font-size: 12pt;">
            <thead class="table-light" style="border-bottom: 2px solid #000;">
                <tr>
                    <th style="width: 25%;">Total Soal</th>
                    <th style="width: 25%;">Jawaban Benar</th>
                    <th style="width: 25%;">Nilai Skor Akhir</th>
                    <th style="width: 25%;">Status Hasil Ujian</th>
                </tr>
            </thead>
            <tbody>
                <tr style="height: 55px;">
                    <td>{{ $examResult->total_soal }} Butir</td>
                    <td class="fw-bold">{{ $examResult->jawaban_benar }} Butir</td>
                    <td class="fw-bold fs-4">{{ number_format($examResult->nilai, 0) }} / 100</td>
                    <td class="fw-bold fs-5 text-uppercase">{{ $examResult->status_kelulusan }}</td>
                </tr>
            </tbody>
        </table>

        <!-- Catatan Resmi / Rekomendasi Dewan Penguji -->
        <div class="p-3 border rounded mb-4" style="border: 1.5px solid #333 !important; font-size: 11pt; background-color: #fafafa;">
            <strong>Catatan &amp; Keputusan Dewan Penguji PPDB:</strong><br>
            <span style="font-style: italic;">
                "{{ $examResult->catatan_admin ?? 'Peserta dinyatakan memenuhi persyaratan standar seleksi akademik dan berhak melanjutkan ke tahapan verifikasi berkas administrasi serta daftar ulang.' }}"
            </span>
        </div>

        <p style="font-size: 12pt; text-align: justify; line-height: 1.6;">
            Demikian surat keterangan hasil ujian masuk ini dibuat dengan sebenar-benarnya untuk dipergunakan sebagai dokumen kelengkapan registrasi daftar ulang santri baru Pondok Pesantren Li Ulil Albab.
        </p>

        <!-- Tanda Tangan & Cap -->
        <div class="row mt-5 pt-3" style="font-size: 12pt;">
            <div class="col-6 text-center">
                <br>
                Orang Tua / Wali Santri,
                <br><br><br><br>
                ( <strong>{{ $registration->nama_wali }}</strong> )
            </div>
            <div class="col-6 text-center">
                Ditetapkan di Surabaya, {{ date('d F Y') }}<br>
                Ketua Panitia Seleksi PPDB,
                <br><br><br><br>
                ( <strong>{{ $examResult->penilai ? $examResult->penilai->name : 'Ustadz M. Faruq, S.Kom' }}</strong> )
            </div>
        </div>

    </div>

</body>
</html>
