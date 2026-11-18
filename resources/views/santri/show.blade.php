@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-9 col-lg-8">
        <div class="card shadow-sm border-0 overflow-hidden">
            <!-- Header Card Banner -->
            <div class="p-3 p-sm-4 bg-pesantren text-white d-flex flex-column flex-sm-row align-items-sm-center justify-content-between gap-3">
                <div class="d-flex align-items-center gap-3">
                    <span class="rounded-circle bg-white text-success d-flex align-items-center justify-content-center shadow-sm flex-shrink-0" style="width: 48px; height: 48px;">
                        <i class="bi bi-person-fill fs-2"></i>
                    </span>
                    <div class="overflow-hidden">
                        <h4 class="fw-bold mb-0 text-white text-truncate">{{ $santri->nama_lengkap }}</h4>
                        <small class="text-white-50">NIS: <strong>{{ $santri->nis }}</strong> &bull; {{ $santri->kelas ?? 'Kelas Belum Ditentukan' }}</small>
                    </div>
                </div>
                <a href="{{ route('santri.index') }}" class="btn btn-outline-light btn-sm align-self-start align-self-sm-center flex-shrink-0">
                    &larr; Kembali
                </a>
            </div>

            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
                    <h5 class="fw-bold text-dark mb-0">Biodata Lengkap Santri</h5>
                    <span class="badge {{ $santri->jenis_kelamin == 'Laki-laki' ? 'bg-primary-subtle text-primary border border-primary-subtle' : 'bg-danger-subtle text-danger border border-danger-subtle' }} px-3 py-2">
                        Santri {{ $santri->jenis_kelamin }}
                    </span>
                </div>

                <div class="row g-3 mb-4">
                    <div class="col-sm-6">
                        <div class="p-3 bg-light rounded-3">
                            <span class="text-muted small d-block">Nomor Induk Santri (NIS)</span>
                            <span class="fw-bold text-dark fs-6">{{ $santri->nis }}</span>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="p-3 bg-light rounded-3">
                            <span class="text-muted small d-block">Nama Lengkap</span>
                            <span class="fw-bold text-dark fs-6">{{ $santri->nama_lengkap }}</span>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="p-3 bg-light rounded-3">
                            <span class="text-muted small d-block">Tempat, Tanggal Lahir</span>
                            <span class="fw-semibold text-dark">
                                {{ $santri->tempat_lahir }}, 
                                {{ \Carbon\Carbon::parse($santri->tanggal_lahir)->translatedFormat('d F Y') }}
                            </span>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="p-3 bg-light rounded-3">
                            <span class="text-muted small d-block">Usia</span>
                            <span class="fw-bold text-dark fs-6">{{ $santri->usia ? $santri->usia . ' Tahun' : '-' }}</span>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="p-3 bg-light rounded-3">
                            <span class="text-muted small d-block">Jenis Kelamin</span>
                            <span class="fw-semibold text-dark">{{ $santri->jenis_kelamin }}</span>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="p-3 bg-light rounded-3">
                            <span class="text-muted small d-block">Nama Orang Tua / Wali</span>
                            <span class="fw-bold text-dark">{{ $santri->nama_orang_tua ?? '-' }}</span>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="p-3 bg-light rounded-3">
                            <span class="text-muted small d-block">Nomor Telepon / WhatsApp</span>
                            @if($santri->no_hp)
                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $santri->no_hp) }}" target="_blank" class="text-decoration-none text-success fw-bold">
                                    <i class="bi bi-whatsapp me-1"></i> {{ $santri->no_hp }}
                                </a>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="p-3 bg-light rounded-3">
                            <span class="text-muted small d-block">Kamar / Asrama</span>
                            <span class="fw-bold text-success fs-6">
                                <i class="bi bi-door-closed me-1"></i> {{ $santri->kamar ?? 'Belum ditentukan' }}
                            </span>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="p-3 bg-light rounded-3">
                            <span class="text-muted small d-block">Jenjang / Kelas</span>
                            <span class="fw-bold text-primary fs-6">
                                <i class="bi bi-mortarboard me-1"></i> {{ $santri->kelas ?? 'Belum ditentukan' }}
                            </span>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="p-3 bg-light rounded-3">
                            <span class="text-muted small d-block">Alamat Asal / Domisili</span>
                            <span class="fw-medium text-dark">{{ $santri->alamat ?? '-' }}</span>
                        </div>
                    </div>
                </div>

                @if(!Auth::user()->isPengajar())
                <!-- Bagian Riwayat Pembayaran Santri -->
                <div class="mt-4 pt-3 border-top">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="fw-bold text-dark mb-0 d-flex align-items-center gap-2">
                            <i class="bi bi-cash-coin text-success"></i> Riwayat Pembayaran Santri
                        </h5>
                        @if(Auth::user()->isAdmin())
                            <a href="{{ route('pembayaran.create', ['santri_id' => $santri->id]) }}" class="btn btn-sm btn-pesantren">
                                <i class="bi bi-plus-circle me-1"></i> + Catat Pembayaran
                            </a>
                        @endif
                    </div>

                    @if($santri->pembayarans->count() > 0)
                        <div class="table-responsive border rounded-3 mb-3">
                            <table class="table table-hover align-middle mb-0" style="font-size: 0.83rem;">
                                <thead class="table-light">
                                    <tr>
                                        <th class="py-2 px-3">Kode TRX</th>
                                        <th class="py-2">Tanggal</th>
                                        <th class="py-2">Kategori</th>
                                        <th class="py-2">Nominal</th>
                                        <th class="py-2">Status</th>
                                        <th class="py-2 text-center pe-3">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($santri->pembayarans as $trx)
                                        <tr>
                                            <td class="px-3 font-monospace fw-bold text-success">{{ $trx->kode_transaksi }}</td>
                                            <td>{{ $trx->tanggal_pembayaran->translatedFormat('d M Y') }}</td>
                                            <td>{{ $trx->kategori_pembayaran }}</td>
                                            <td class="fw-bold">{{ $trx->rupiah }}</td>
                                            <td>
                                                <span class="badge {{ $trx->status_badge_class }} py-1 px-2" style="font-size: 0.7rem;">
                                                    {{ $trx->status }}
                                                </span>
                                            </td>
                                            <td class="text-center pe-3">
                                                <a href="{{ route('pembayaran.show', $trx->id) }}" class="btn btn-sm btn-outline-info py-0 px-2" title="Lihat Kwitansi">
                                                    <i class="bi bi-receipt"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="p-3 text-center bg-light rounded-3 text-muted small mb-3">
                            <i class="bi bi-wallet2 d-block fs-4 text-muted mb-1"></i>
                            Belum ada riwayat transaksi pembayaran untuk santri ini.
                        </div>
                    @endif
                </div>
                @endif

                <!-- Action Button Area with Role Protection -->
                <div class="d-flex justify-content-between align-items-center pt-3 border-top">
                    <a href="{{ route('santri.index') }}" class="btn btn-secondary btn-sm">
                        &larr; Ke Daftar Santri
                    </a>

                    <div class="d-flex gap-2">
                        @if(Auth::user()->isAdmin())
                            <a href="{{ route('santri.edit', $santri->id) }}" class="btn btn-primary btn-sm px-3">
                                <i class="bi bi-pencil-square me-1"></i> Edit Data Santri
                            </a>
                        @else
                            <span class="badge bg-light text-muted border p-2 small">
                                <i class="bi bi-lock-fill me-1"></i> Mode Baca ({{ Auth::user()->role_label }})
                            </span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
