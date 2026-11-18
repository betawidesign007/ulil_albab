@extends('errors.layout')

@section('title', '403 Akses Ditolak')

@section('badge_class', 'bg-danger text-white')
@section('badge_text')
    <i class="bi bi-shield-x"></i> HTTP 403 Forbidden
@endsection

@section('icon')
    <div class="icon-circle bg-danger bg-opacity-10 text-danger mx-auto">
        <i class="bi bi-shield-lock-fill"></i>
    </div>
@endsection

@section('heading', 'Akses Ditolak / Tidak Memiliki Wewenang')

@section('description')
    Halaman atau modul yang ingin Anda buka memiliki pembatasan keamanan dan hanya dapat diakses oleh peran tertentu dalam sistem SIMPONPES.
@endsection

@section('extra_content')
    @php
        $errorMessage = $exception->getMessage() ?: null;
    @endphp

    @if ($errorMessage)
        <div class="alert alert-danger bg-danger bg-opacity-10 border-danger border-opacity-25 text-start py-3 px-4 rounded-3 mb-4">
            <div class="d-flex align-items-start gap-2">
                <i class="bi bi-exclamation-octagon-fill text-danger fs-5 mt-1 flex-shrink-0"></i>
                <div>
                    <strong class="text-danger d-block mb-1">Keterangan Penolakan Sistem:</strong>
                    <span class="text-dark">{{ $errorMessage }}</span>
                </div>
            </div>
        </div>
    @else
        <div class="alert alert-warning bg-warning bg-opacity-10 border-warning border-opacity-25 text-start py-3 px-4 rounded-3 mb-4">
            <div class="d-flex align-items-start gap-2">
                <i class="bi bi-exclamation-triangle-fill text-warning fs-5 mt-1 flex-shrink-0"></i>
                <div class="text-dark small">
                    <strong>Pemberitahuan Hak Akses:</strong>
                    Akun yang Anda gunakan saat ini tidak terdaftar memiliki izin pada modul ini. Pastikan Anda masuk menggunakan akun yang sesuai (misal: Administrator).
                </div>
            </div>
        </div>
    @endif
@endsection

@section('actions')
    @auth
        <a href="{{ route('dashboard') }}" class="btn-pesantren">
            <i class="bi bi-speedometer2"></i> Kembali ke Dashboard
        </a>
    @else
        <a href="{{ route('landing') }}" class="btn-secondary-action">
            <i class="bi bi-house-door"></i> Ke Halaman Utama
        </a>
    @endauth

    <button type="button" onclick="window.history.length > 1 ? window.history.back() : window.location.href='{{ route('landing') }}'" class="btn-secondary-action">
        <i class="bi bi-arrow-left"></i> Halaman Sebelumnya
    </button>
@endsection
