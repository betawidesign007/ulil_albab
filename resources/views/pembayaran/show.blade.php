@extends('layouts.app', ['title' => 'Detail Kwitansi Pembayaran'])

@section('content')
<div class="container py-3">
    <div class="row justify-content-center">
        <div class="col-md-9 col-lg-8">

            <!-- Tombol Navigasi Atas -->
            <div class="d-flex justify-content-between align-items-center mb-3">
                <a href="{{ route('pembayaran.index') }}" class="btn btn-outline-secondary btn-sm">
                    &larr; Ke Daftar Pembayaran
                </a>
                <div class="d-flex gap-2">
                    <a href="{{ route('pembayaran.cetak', $pembayaran->id) }}" target="_blank" class="btn btn-outline-success btn-sm shadow-sm">
                        <i class="bi bi-printer me-1"></i> Cetak Kwitansi
                    </a>
                    @if(Auth::user()->isAdmin())
                        <a href="{{ route('pembayaran.edit', $pembayaran->id) }}" class="btn btn-primary btn-sm shadow-sm">
                            <i class="bi bi-pencil-square me-1"></i> Sunting
                        </a>
                    @endif
                </div>
            </div>

            <!-- Card Kwitansi Pembayaran -->
            <div class="card shadow border-0 overflow-hidden" id="kwitansiPrintArea">
                <!-- Header Card Banner Pesantren -->
                <div class="p-4 bg-pesantren text-white">
                    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-3">
                        <div class="d-flex align-items-center gap-3">
                            <span class="rounded-circle bg-white text-success d-flex align-items-center justify-content-center shadow-sm" style="width: 52px; height: 52px;">
                                <i class="bi bi-cash-stack fs-2"></i>
                            </span>
                            <div>
                                <h4 class="fw-bold mb-0 text-white">KWITANSI PEMBAYARAN</h4>
                                <small class="text-white-50">Pondok Pesantren Modern Li Ulil Albab</small>
                            </div>
                        </div>
                        <div class="text-sm-end">
                            <span class="badge {{ $pembayaran->status_badge_class }} fs-6 px-3 py-2">
                                {{ strtoupper($pembayaran->status) }}
                            </span>
                        </div>
                    </div>
                </div>

                <div class="card-body p-4 p-md-5">
                    <!-- Info Meta Transaksi -->
                    <div class="row g-3 pb-3 mb-4 border-bottom">
                        <div class="col-6 col-sm-3">
                            <span class="text-muted small d-block">Nomor Transaksi</span>
                            <strong class="font-monospace text-dark fs-6">{{ $pembayaran->kode_transaksi }}</strong>
                        </div>
                        <div class="col-6 col-sm-3">
                            <span class="text-muted small d-block">Tanggal Transaksi</span>
                            <strong class="text-dark">{{ $pembayaran->tanggal_pembayaran->translatedFormat('d F Y') }}</strong>
                        </div>
                        <div class="col-6 col-sm-3">
                            <span class="text-muted small d-block">Metode Pembayaran</span>
                            <span class="badge bg-light text-dark border">{{ $pembayaran->metode_pembayaran }}</span>
                        </div>
                        <div class="col-6 col-sm-3">
                            <span class="text-muted small d-block">Petugas Kasir</span>
                            <strong class="text-dark">{{ $pembayaran->petugas?->name ?? 'Administrator' }}</strong>
                        </div>
                    </div>

                    <!-- Identitas Santri -->
                    <div class="bg-light p-3 rounded-3 mb-4 border">
                        <h6 class="fw-bold text-dark mb-2 border-bottom pb-2">
                            <i class="bi bi-person-badge text-success me-1"></i> Data Santri
                        </h6>
                        @if($pembayaran->santri)
                            <div class="row g-2 small">
                                <div class="col-sm-6">
                                    <span class="text-muted">Nomor Induk Santri (NIS):</span>
                                    <strong class="text-dark d-block fs-6">{{ $pembayaran->santri->nis }}</strong>
                                </div>
                                <div class="col-sm-6">
                                    <span class="text-muted">Nama Lengkap Santri:</span>
                                    <strong class="text-dark d-block fs-6">{{ $pembayaran->santri->nama_lengkap }}</strong>
                                </div>
                                <div class="col-sm-6">
                                    <span class="text-muted">Jenjang / Kelas:</span>
                                    <span class="text-dark d-block">{{ $pembayaran->santri->kelas ?? '-' }}</span>
                                </div>
                                <div class="col-sm-6">
                                    <span class="text-muted">Asrama / Kamar:</span>
                                    <span class="text-dark d-block">{{ $pembayaran->santri->kamar ?? '-' }}</span>
                                </div>
                                @if($pembayaran->santri->nama_orang_tua)
                                    <div class="col-sm-6">
                                        <span class="text-muted">Nama Orang Tua / Wali:</span>
                                        <span class="text-dark d-block">{{ $pembayaran->santri->nama_orang_tua }}</span>
                                    </div>
                                @endif
                                @if($pembayaran->santri->no_hp)
                                    <div class="col-sm-6">
                                        <span class="text-muted">No. WhatsApp / HP:</span>
                                        <span class="text-dark d-block">{{ $pembayaran->santri->no_hp }}</span>
                                    </div>
                                @endif
                            </div>
                        @else
                            <div class="text-danger small fst-italic">Data santri telah dihapus dari sistem.</div>
                        @endif
                    </div>

                    <!-- Tabel Rincian Pembayaran -->
                    <div class="table-responsive mb-4">
                        <table class="table table-bordered align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="py-2 px-3">Deskripsi / Pos Penerimaan</th>
                                    <th class="py-2 text-center" style="width: 25%;">Periode</th>
                                    <th class="py-2 text-end px-3" style="width: 30%;">Nominal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="py-3 px-3">
                                        <strong class="text-dark d-block">{{ $pembayaran->kategori_pembayaran }}</strong>
                                        @if($pembayaran->catatan)
                                            <small class="text-muted d-block mt-1">
                                                <i class="bi bi-info-circle me-1"></i> Catatan: {{ $pembayaran->catatan }}
                                            </small>
                                        @endif
                                    </td>
                                    <td class="py-3 text-center">
                                        @if($pembayaran->bulan_dibayar || $pembayaran->tahun_dibayar)
                                            <span class="badge bg-light text-dark border">
                                                {{ $pembayaran->bulan_dibayar }} {{ $pembayaran->tahun_dibayar }}
                                            </span>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td class="py-3 text-end px-3">
                                        <span class="fw-bold text-dark fs-6">{{ $pembayaran->rupiah }}</span>
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot class="table-light">
                                <tr>
                                    <th colspan="2" class="text-end py-3 px-3 fs-6">TOTAL PEMBAYARAN:</th>
                                    <th class="text-end py-3 px-3 fs-5 text-success">{{ $pembayaran->rupiah }}</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    <!-- Lampiran Bukti Pembayaran jika ada -->
                    @if($pembayaran->bukti_bayar)
                        <div class="mb-4 p-3 bg-light rounded-3 border">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <h6 class="fw-bold mb-0 text-dark">
                                    <i class="bi bi-paperclip me-1 text-primary"></i> Lampiran Bukti Transaksi
                                </h6>
                                <a href="{{ asset($pembayaran->bukti_bayar) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-box-arrow-up-right me-1"></i> Buka File Asli
                                </a>
                            </div>
                            @php
                                $ext = pathinfo($pembayaran->bukti_bayar, PATHINFO_EXTENSION);
                            @endphp
                            @if(in_array(strtolower($ext), ['jpg', 'jpeg', 'png', 'webp']))
                                <div class="text-center p-2 bg-white rounded border">
                                    <img src="{{ asset($pembayaran->bukti_bayar) }}" alt="Bukti Pembayaran" class="img-fluid rounded shadow-sm" style="max-height: 380px; object-fit: contain;">
                                </div>
                            @else
                                <div class="p-3 bg-white rounded border d-flex align-items-center gap-2">
                                    <i class="bi bi-file-earmark-pdf text-danger fs-3"></i>
                                    <div>
                                        <div class="fw-bold">Dokumen Lampiran ({{ strtoupper($ext) }})</div>
                                        <small class="text-muted">Klik tombol di atas untuk melihat dokumen secara penuh.</small>
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endif

                    <!-- Area Tanda Tangan & Footer Kwitansi -->
                    <div class="row pt-4 mt-2 border-top text-center text-muted small">
                        <div class="col-6">
                            <p class="mb-5">Penyetor / Orang Tua Santri,</p>
                            <p class="fw-bold text-dark mb-0">( ............................................ )</p>
                        </div>
                        <div class="col-6">
                            <p class="mb-5">Petugas Administrasi Pesantren,</p>
                            <p class="fw-bold text-dark mb-0">{{ $pembayaran->petugas?->name ?? 'Petugas Bag. Keuangan' }}</p>
                            <small class="text-muted">{{ date('d M Y') }}</small>
                        </div>
                    </div>

                </div>

                <!-- Footer Card -->
                <div class="card-footer bg-light py-3 px-4 d-flex justify-content-between align-items-center">
                    <small class="text-muted" style="font-size: 0.75rem;">
                        <i class="bi bi-shield-check text-success me-1"></i> SIMPONPES - Sistem Informasi Manajemen Pondok Pesantren Li Ulil Albab
                    </small>
                    <a href="{{ route('pembayaran.cetak', $pembayaran->id) }}" target="_blank" class="btn btn-sm btn-success px-3 shadow-sm">
                        <i class="bi bi-printer-fill me-1"></i> Cetak Kwitansi Resmi
                    </a>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
