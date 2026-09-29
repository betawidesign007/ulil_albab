@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-9 col-lg-8">
        <div class="card shadow-sm border-0 overflow-hidden">
            <!-- Header Card Banner -->
            <div class="p-4 bg-pesantren text-white d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center gap-3">
                    <span class="rounded-circle bg-white text-success d-flex align-items-center justify-content-center shadow-sm" style="width: 52px; height: 52px;">
                        <i class="bi bi-person-fill fs-2"></i>
                    </span>
                    <div>
                        <h4 class="fw-bold mb-0 text-white">{{ $santri->nama_lengkap }}</h4>
                        <small class="text-white-50">NIS: <strong>{{ $santri->nis }}</strong> &bull; {{ $santri->kelas ?? 'Kelas Belum Ditentukan' }}</small>
                    </div>
                </div>
                <a href="{{ route('santri.index') }}" class="btn btn-outline-light btn-sm">
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
                    <div class="col-sm-6">
                        <div class="p-3 bg-light rounded-3">
                            <span class="text-muted small d-block">Tempat, Tanggal Lahir</span>
                            <span class="fw-semibold text-dark">
                                {{ $santri->tempat_lahir }}, 
                                {{ \Carbon\Carbon::parse($santri->tanggal_lahir)->translatedFormat('d F Y') }}
                            </span>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="p-3 bg-light rounded-3">
                            <span class="text-muted small d-block">Jenis Kelamin</span>
                            <span class="fw-semibold text-dark">{{ $santri->jenis_kelamin }}</span>
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
