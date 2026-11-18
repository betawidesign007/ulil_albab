<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kwitansi_{{ $pembayaran->kode_transaksi }} - PP Li Ulil Albab</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', Arial, sans-serif;
            background-color: #f8fafc;
            color: #1e293b;
            padding: 20px;
        }
        .kwitansi-box {
            max-width: 800px;
            margin: 0 auto;
            background: #ffffff;
            border: 2px solid #065f46;
            border-radius: 8px;
            padding: 30px;
        }
        .kop-pesantren {
            border-bottom: 3px double #065f46;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }
        .font-monospace {
            font-family: monospace;
        }
        @media print {
            body {
                background: #ffffff;
                padding: 0;
            }
            .kwitansi-box {
                border: 2px solid #065f46;
                padding: 20px;
                box-shadow: none;
            }
            .no-print {
                display: none !important;
            }
        }
    </style>
</head>
<body>

    <div class="no-print text-center mb-3">
        <button onclick="window.print()" class="btn btn-success me-2">
            Cetak Kwitansi Sekarang
        </button>
        <button onclick="window.close()" class="btn btn-secondary">
            Tutup Jendela
        </button>
    </div>

    <div class="kwitansi-box">
        <!-- Kop Pesantren -->
        <div class="kop-pesantren d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center gap-3">
                <div>
                    <h3 class="fw-bold mb-0 text-success" style="color: #065f46 !important;">PONDOK PESANTREN MODERN LI ULIL ALBAB</h3>
                    <small class="text-muted d-block">Lembaga Pendidikan &amp; Pengkaderan Da'i Qur'ani &bull; Terakreditasi</small>
                    <small class="text-muted d-block" style="font-size: 0.75rem;">Jl. Pesantren No. 01, Telp/WA: (021) 1234-5678 &bull; Website: simponpes.id</small>
                </div>
            </div>
            <div class="text-end">
                <span class="badge bg-success fs-6 px-3 py-2">
                    {{ strtoupper($pembayaran->status) }}
                </span>
            </div>
        </div>

        <!-- Judul Dokumen -->
        <div class="text-center my-3">
            <h4 class="fw-bold text-decoration-underline mb-1">BUKTI PEMBAYARAN / KWITANSI RESMI</h4>
            <span class="font-monospace text-muted fw-bold">NO: {{ $pembayaran->kode_transaksi }}</span>
        </div>

        <!-- Meta Data Transaksi -->
        <div class="row g-2 mb-3 small">
            <div class="col-6">
                <table class="table table-sm table-borderless mb-0">
                    <tr>
                        <td class="text-muted" style="width: 140px;">Telah Diterima Dari</td>
                        <td>: <strong>{{ $pembayaran->santri?->nama_lengkap ?? '-' }}</strong></td>
                    </tr>
                    <tr>
                        <td class="text-muted">Nomor Induk Santri</td>
                        <td>: <strong>{{ $pembayaran->santri?->nis ?? '-' }}</strong></td>
                    </tr>
                    <tr>
                        <td class="text-muted">Jenjang / Asrama</td>
                        <td>: {{ $pembayaran->santri?->kelas ?? '-' }} / {{ $pembayaran->santri?->kamar ?? '-' }}</td>
                    </tr>
                    @if($pembayaran->santri?->nama_orang_tua)
                    <tr>
                        <td class="text-muted">Orang Tua / Wali</td>
                        <td>: {{ $pembayaran->santri->nama_orang_tua }}</td>
                    </tr>
                    @endif
                </table>
            </div>
            <div class="col-6">
                <table class="table table-sm table-borderless mb-0">
                    <tr>
                        <td class="text-muted" style="width: 140px;">Tanggal Bayar</td>
                        <td>: <strong>{{ $pembayaran->tanggal_pembayaran->translatedFormat('d F Y') }}</strong></td>
                    </tr>
                    <tr>
                        <td class="text-muted">Metode Bayar</td>
                        <td>: {{ $pembayaran->metode_pembayaran }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Petugas Penerima</td>
                        <td>: {{ $pembayaran->petugas?->name ?? 'Kasir Pesantren' }}</td>
                    </tr>
                </table>
            </div>
        </div>

        <!-- Tabel Pos Pembayaran -->
        <table class="table table-bordered my-3 align-middle">
            <thead class="table-light small">
                <tr>
                    <th style="width: 50px;" class="text-center">No</th>
                    <th>Pos Penerimaan / Uraian Pembayaran</th>
                    <th class="text-center" style="width: 180px;">Periode</th>
                    <th class="text-end" style="width: 200px;">Jumlah</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="text-center">1</td>
                    <td>
                        <strong>{{ $pembayaran->kategori_pembayaran }}</strong>
                        @if($pembayaran->catatan)
                            <div class="small text-muted">{{ $pembayaran->catatan }}</div>
                        @endif
                    </td>
                    <td class="text-center">
                        {{ $pembayaran->bulan_dibayar ? $pembayaran->bulan_dibayar . ' ' . $pembayaran->tahun_dibayar : '-' }}
                    </td>
                    <td class="text-end fw-bold fs-6">
                        {{ $pembayaran->rupiah }}
                    </td>
                </tr>
            </tbody>
            <tfoot>
                <tr class="table-light">
                    <th colspan="3" class="text-end py-2">TOTAL DITERIMA:</th>
                    <th class="text-end py-2 fs-5 text-success" style="color: #065f46 !important;">{{ $pembayaran->rupiah }}</th>
                </tr>
            </tfoot>
        </table>

        <!-- Tanda Tangan -->
        <div class="row pt-4 text-center small mt-4">
            <div class="col-6">
                <p class="mb-5">Penyetor / Wali Santri,</p>
                <p class="fw-bold mb-0">( .................................................... )</p>
            </div>
            <div class="col-6">
                <p class="mb-5">Pengelola Keuangan Pesantren,</p>
                <p class="fw-bold mb-0"><u>{{ $pembayaran->petugas?->name ?? 'Bendahara' }}</u></p>
                <small class="text-muted">{{ date('d F Y') }}</small>
            </div>
        </div>

        <!-- Catatan Kaki -->
        <div class="mt-4 pt-3 border-top text-center text-muted" style="font-size: 0.72rem;">
            * Simpanlah bukti pembayaran ini sebagai tanda bukti pelunasan yang sah dari Pondok Pesantren Li Ulil Albab.
        </div>
    </div>

    <script>
        // Otomatis muncul print dialog jika diinginkan user
        // window.print();
    </script>
</body>
</html>
