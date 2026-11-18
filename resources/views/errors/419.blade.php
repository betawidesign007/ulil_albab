@extends('errors.layout')

@section('title', '419 Sesi Kedaluwarsa')

@section('badge_class', 'bg-warning text-dark')
@section('badge_text')
    <i class="bi bi-clock-history"></i> HTTP 419 Page Expired
@endsection

@section('icon')
    <div class="icon-circle bg-warning bg-opacity-10 text-warning mx-auto">
        <i class="bi bi-hourglass-split"></i>
    </div>
@endsection

@section('heading', 'Sesi Halaman Kedaluwarsa')

@section('description')
    Masa aktif keamanan formulir (CSRF Token) telah berakhir karena halaman didiamkan terlalu lama atau sesi akun Anda telah diperbarui.
@endsection

@section('extra_content')
    <div class="alert alert-warning bg-warning bg-opacity-10 border-warning border-opacity-25 text-start py-3 px-4 rounded-3 mb-4">
        <div class="d-flex align-items-start gap-2">
            <i class="bi bi-shield-lock text-warning fs-5 flex-shrink-0 mt-1"></i>
            <div class="small text-dark">
                <strong>Mengapa hal ini terjadi?</strong>
                <p class="mb-1 mt-1">
                    Sistem SIMPONPES mengamankan setiap pengiriman data dari serangan pemalsuan permintaan antar-situs. Jika Anda mendiamkan halaman formulir login atau beralih akun, token keamanan otomatis kedaluwarsa.
                </p>
                <div class="mt-2 text-muted">
                    <strong>Solusi:</strong> Silakan klik tombol <em>Muat Ulang Halaman</em> di bawah ini untuk memperbarui token, lalu kirim ulang data Anda.
                </div>
            </div>
        </div>
    </div>
@endsection

@section('actions')
    <button type="button" onclick="window.location.reload();" class="btn-pesantren">
        <i class="bi bi-arrow-clockwise"></i> Muat Ulang Halaman
    </button>

    <a href="{{ route('login') }}" class="btn-secondary-action">
        <i class="bi bi-box-arrow-in-right"></i> Ke Halaman Login
    </a>
@endsection
