@extends('layouts.app', ['title' => 'Manajemen Transaksi Pembayaran'])

@section('content')
<div class="container-fluid px-3 px-lg-4 py-3">

    <!-- Header Section with Role Indicator -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-3 pb-2 border-bottom">
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-1" style="font-size: 0.8rem;">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-decoration-none text-success">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Transaksi Pembayaran</li>
                </ol>
            </nav>
            <h1 class="h4 fw-bold text-dark mb-0 d-flex align-items-center gap-2">
                <i class="bi bi-cash-coin text-success"></i> Transaksi Pembayaran Santri
            </h1>
            <small class="text-muted" style="font-size: 0.78rem;">
                Pencatatan keuangan SPP, uang gedung, kitab, seragam, dan penerimaan santri Pondok Pesantren Li Ulil Albab.
            </small>
        </div>
        <div class="d-flex align-items-center gap-2">
            @if(Auth::user()->isAdmin())
                <a href="{{ route('pembayaran.create') }}" class="btn btn-sm btn-pesantren d-flex align-items-center gap-1 shadow-sm px-3 py-2 fw-semibold">
                    <i class="bi bi-plus-circle-fill"></i> Catat Pembayaran Baru
                </a>
            @endif
        </div>
    </div>

    <!-- Alert Notifications -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show d-flex align-items-center gap-2 py-2 px-3 small shadow-sm mb-3" role="alert">
            <i class="bi bi-check-circle-fill fs-5 text-success"></i>
            <div>{{ session('success') }}</div>
            <button type="button" class="btn-close btn-sm p-2" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center gap-2 py-2 px-3 small shadow-sm mb-3" role="alert">
            <i class="bi bi-exclamation-triangle-fill fs-5 text-danger"></i>
            <div>{{ session('error') }}</div>
            <button type="button" class="btn-close btn-sm p-2" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Statistic Summary Cards -->
    <div class="row g-2 mb-3">
        <div class="col-sm-6 col-lg-3">
            <div class="card border-0 shadow-sm border-start border-success border-4 h-100">
                <div class="card-body p-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <span class="text-muted small fw-semibold text-uppercase" style="font-size: 0.72rem;">Total Penerimaan Lunas</span>
                            <h5 class="fw-bold text-success mb-0 mt-1">Rp {{ number_format($totalPenerimaan, 0, ',', '.') }}</h5>
                        </div>
                        <span class="rounded-circle bg-success bg-opacity-10 text-success p-2 d-flex align-items-center justify-content-center" style="width: 42px; height: 42px;">
                            <i class="bi bi-wallet2 fs-5"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3">
            <div class="card border-0 shadow-sm border-start border-primary border-4 h-100">
                <div class="card-body p-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <span class="text-muted small fw-semibold text-uppercase" style="font-size: 0.72rem;">Pemasukan Bulan Ini</span>
                            <h5 class="fw-bold text-primary mb-0 mt-1">Rp {{ number_format($transaksiBulanIni, 0, ',', '.') }}</h5>
                        </div>
                        <span class="rounded-circle bg-primary bg-opacity-10 text-primary p-2 d-flex align-items-center justify-content-center" style="width: 42px; height: 42px;">
                            <i class="bi bi-calendar-check fs-5"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3">
            <div class="card border-0 shadow-sm border-start border-info border-4 h-100">
                <div class="card-body p-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <span class="text-muted small fw-semibold text-uppercase" style="font-size: 0.72rem;">Total Transaksi</span>
                            <h5 class="fw-bold text-dark mb-0 mt-1">{{ number_format($totalTransaksi) }} <small class="text-muted fs-6 fw-normal">Data</small></h5>
                        </div>
                        <span class="rounded-circle bg-info bg-opacity-10 text-info p-2 d-flex align-items-center justify-content-center" style="width: 42px; height: 42px;">
                            <i class="bi bi-receipt fs-5"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3">
            <div class="card border-0 shadow-sm border-start border-warning border-4 h-100">
                <div class="card-body p-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <span class="text-muted small fw-semibold text-uppercase" style="font-size: 0.72rem;">Menunggu / Pending</span>
                            <h5 class="fw-bold text-warning-emphasis mb-0 mt-1">{{ number_format($totalPending) }} <small class="text-muted fs-6 fw-normal">Transaksi</small></h5>
                        </div>
                        <span class="rounded-circle bg-warning bg-opacity-10 text-warning p-2 d-flex align-items-center justify-content-center" style="width: 42px; height: 42px;">
                            <i class="bi bi-clock-history fs-5"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter & Search Card -->
    <div class="card border-0 shadow-sm mb-3">
        <div class="card-body p-3">
            <form action="{{ route('pembayaran.index') }}" method="GET" class="row g-2 align-items-center">
                <div class="col-md-3">
                    <div class="input-group input-group-sm">
                        <span class="input-group-text bg-light border-end-0"><i class="bi bi-search text-muted"></i></span>
                        <input type="text" name="search" value="{{ request('search') }}" class="form-control border-start-0" placeholder="Kode TRX, Nama Santri, NIS...">
                    </div>
                </div>

                <div class="col-6 col-md-2">
                    <select name="kategori" class="form-select form-select-sm">
                        <option value="">Semua Kategori</option>
                        @foreach($kategoris as $kat)
                            <option value="{{ $kat }}" {{ request('kategori') == $kat ? 'selected' : '' }}>{{ $kat }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-6 col-md-2">
                    <select name="metode" class="form-select form-select-sm">
                        <option value="">Semua Metode</option>
                        <option value="Tunai" {{ request('metode') == 'Tunai' ? 'selected' : '' }}>Tunai / Cash</option>
                        <option value="Transfer Bank" {{ request('metode') == 'Transfer Bank' ? 'selected' : '' }}>Transfer Bank</option>
                        <option value="QRIS" {{ request('metode') == 'QRIS' ? 'selected' : '' }}>QRIS</option>
                    </select>
                </div>

                <div class="col-6 col-md-2">
                    <select name="status" class="form-select form-select-sm">
                        <option value="">Semua Status</option>
                        <option value="Lunas" {{ request('status') == 'Lunas' ? 'selected' : '' }}>Lunas</option>
                        <option value="Pending" {{ request('status') == 'Pending' ? 'selected' : '' }}>Pending</option>
                        <option value="Batal" {{ request('status') == 'Batal' ? 'selected' : '' }}>Batal</option>
                    </select>
                </div>

                <div class="col-6 col-md-3 d-flex gap-2">
                    <button type="submit" class="btn btn-sm btn-success w-100 fw-semibold">
                        <i class="bi bi-filter"></i> Saring Data
                    </button>
                    @if(request()->hasAny(['search', 'kategori', 'metode', 'status', 'santri_id', 'tanggal_mulai', 'tanggal_akhir']))
                        <a href="{{ route('pembayaran.index') }}" class="btn btn-sm btn-outline-secondary" title="Reset Filter">
                            <i class="bi bi-arrow-counterclockwise"></i>
                        </a>
                    @endif
                </div>
            </form>
        </div>
    </div>

    <!-- Payment Data Table Card -->
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white py-2 px-3 border-bottom d-flex align-items-center justify-content-between">
            <div class="fw-bold text-dark small d-flex align-items-center gap-2">
                <i class="bi bi-receipt-cutoff text-success"></i> Riwayat Transaksi Pembayaran ({{ $pembayarans->total() }} Data)
            </div>
            <small class="text-muted">Aksi: Detail Kwitansi, Cetak, Sunting, Hapus</small>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0 w-100" style="font-size: 0.83rem; min-width: 820px;">
                <thead class="table-light text-secondary" style="font-size: 0.78rem;">
                    <tr>
                        <th class="ps-3 py-2 text-center" style="width: 45px;">No</th>
                        <th class="py-2" style="width: 14%;">No. Transaksi</th>
                        <th class="py-2" style="width: 13%;">Tanggal</th>
                        <th class="py-2" style="width: 22%;">Santri</th>
                        <th class="py-2" style="width: 18%;">Kategori Pembayaran</th>
                        <th class="py-2" style="width: 13%;">Nominal</th>
                        <th class="py-2" style="width: 10%;">Metode &amp; Status</th>
                        <th class="py-2 text-center pe-3" style="width: 10%; white-space: nowrap;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pembayarans as $index => $p)
                        <tr>
                            <td class="ps-3 text-muted text-center">{{ $pembayarans->firstItem() + $index }}</td>
                            <td>
                                <a href="{{ route('pembayaran.show', $p->id) }}" class="fw-bold text-success text-decoration-none font-monospace">
                                    {{ $p->kode_transaksi }}
                                </a>
                                @if($p->bukti_bayar)
                                    <span class="badge bg-light text-info border ms-1" title="Terdapat Bukti Pembayaran">
                                        <i class="bi bi-paperclip"></i> Bukti
                                    </span>
                                @endif
                            </td>
                            <td>
                                <div class="fw-medium text-dark">{{ $p->tanggal_pembayaran->translatedFormat('d M Y') }}</div>
                                <small class="text-muted" style="font-size: 0.72rem;">{{ $p->created_at->format('H:i') }} WIB</small>
                            </td>
                            <td>
                                @if($p->santri)
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="rounded-circle bg-success bg-opacity-10 text-success fw-bold d-flex align-items-center justify-content-center" style="width: 30px; height: 30px; font-size: 0.75rem;">
                                            {{ strtoupper(substr($p->santri->nama_lengkap, 0, 1)) }}
                                        </div>
                                        <div>
                                            <a href="{{ route('santri.show', $p->santri_id) }}" class="fw-bold text-dark text-decoration-none d-block">
                                                {{ $p->santri->nama_lengkap }}
                                            </a>
                                            <small class="text-muted" style="font-size: 0.72rem;">
                                                NIS: {{ $p->santri->nis }} &bull; {{ $p->santri->kelas ?? 'Kelas -' }}
                                            </small>
                                        </div>
                                    </div>
                                @else
                                    <span class="text-muted fst-italic">Santri Terhapus</span>
                                @endif
                            </td>
                            <td>
                                <span class="fw-semibold text-dark">{{ $p->kategori_pembayaran }}</span>
                                @if($p->bulan_dibayar || $p->tahun_dibayar)
                                    <div class="text-muted" style="font-size: 0.72rem;">
                                        Periode: {{ $p->bulan_dibayar }} {{ $p->tahun_dibayar }}
                                    </div>
                                @endif
                            </td>
                            <td>
                                <span class="fw-bold text-success fs-6">{{ $p->rupiah }}</span>
                            </td>
                            <td>
                                <div class="d-flex flex-column gap-1">
                                    <span class="badge {{ $p->status_badge_class }} px-2 py-1" style="font-size: 0.7rem; width: fit-content;">
                                        {{ $p->status }}
                                    </span>
                                    <span class="badge bg-light text-secondary border px-2 py-0" style="font-size: 0.68rem; width: fit-content;">
                                        <i class="bi bi-credit-card me-1"></i>{{ $p->metode_pembayaran }}
                                    </span>
                                </div>
                            </td>
                            <td class="text-center pe-3">
                                <div class="btn-group btn-group-sm" role="group">
                                    <!-- Aksi Detail / Kwitansi -->
                                    <a href="{{ route('pembayaran.show', $p->id) }}" class="btn btn-outline-info p-1 px-2" title="Lihat Kwitansi Pembayaran">
                                        <i class="bi bi-file-earmark-text"></i>
                                    </a>

                                    <!-- Aksi Cetak Slip Cepat -->
                                    <a href="{{ route('pembayaran.cetak', $p->id) }}" target="_blank" class="btn btn-outline-secondary p-1 px-2" title="Cetak Kwitansi Langsung">
                                        <i class="bi bi-printer"></i>
                                    </a>

                                    @if(Auth::user()->isAdmin())
                                        <!-- Aksi Edit -->
                                        <a href="{{ route('pembayaran.edit', $p->id) }}" class="btn btn-outline-primary p-1 px-2" title="Sunting Data Pembayaran">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>

                                        <!-- Aksi Hapus -->
                                        <button type="button" class="btn btn-outline-danger p-1 px-2" data-bs-toggle="modal" data-bs-target="#modalHapusTrx{{ $p->id }}" title="Hapus Transaksi">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    @endif
                                </div>
                            </td>
                        </tr>

                        @if(Auth::user()->isAdmin())
                            <!-- MODAL KONFIRMASI HAPUS TRANSAKSI -->
                            <div class="modal fade" id="modalHapusTrx{{ $p->id }}" tabindex="-1" aria-labelledby="modalHapusTrxLabel{{ $p->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content border-0 shadow">
                                        <div class="modal-header bg-danger text-white py-2 px-3">
                                            <h6 class="modal-title fw-bold" id="modalHapusTrxLabel{{ $p->id }}">
                                                <i class="bi bi-exclamation-triangle-fill me-1"></i> Konfirmasi Penghapusan Transaksi
                                            </h6>
                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body p-3">
                                            <p class="mb-2 text-dark">Apakah Anda yakin ingin menghapus data transaksi pembayaran berikut?</p>
                                            <div class="p-3 bg-light rounded-3 small">
                                                <div><strong>Kode Transaksi:</strong> <span class="font-monospace text-danger">{{ $p->kode_transaksi }}</span></div>
                                                <div><strong>Nama Santri:</strong> {{ $p->santri?->nama_lengkap ?? '-' }}</div>
                                                <div><strong>Kategori:</strong> {{ $p->kategori_pembayaran }}</div>
                                                <div><strong>Nominal:</strong> <span class="text-success fw-bold">{{ $p->rupiah }}</span></div>
                                                <div><strong>Tanggal:</strong> {{ $p->tanggal_pembayaran->translatedFormat('d F Y') }}</div>
                                            </div>
                                            <small class="text-danger mt-2 d-block">
                                                <i class="bi bi-info-circle me-1"></i> Tindakan ini tidak dapat dibatalkan.
                                            </small>
                                        </div>
                                        <div class="modal-footer bg-light py-2 px-3">
                                            <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                                            <form action="{{ route('pembayaran.destroy', $p->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    <i class="bi bi-trash me-1"></i> Ya, Hapus Transaksi
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-5 text-muted">
                                <i class="bi bi-cash-stack display-6 d-block mb-2 text-muted"></i>
                                Belum ada data transaksi pembayaran yang tercatat atau cocok dengan pencarian Anda.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($pembayarans->hasPages())
            <div class="p-3 border-top d-flex justify-content-between align-items-center">
                <small class="text-muted">
                    Menampilkan data {{ $pembayarans->firstItem() }} s/d {{ $pembayarans->lastItem() }} dari {{ $pembayarans->total() }} entri
                </small>
                <div>
                    {{ $pembayarans->links() }}
                </div>
            </div>
        @endif
    </div>

</div>
@endsection
