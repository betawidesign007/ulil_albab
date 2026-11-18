@extends('errors.layout')

@section('title', '404 Halaman Tidak Ditemukan')

@section('badge_class', 'bg-secondary text-white')
@section('badge_text')
    <i class="bi bi-question-circle"></i> HTTP 404 Not Found
@endsection

@section('icon')
    <div class="icon-circle bg-secondary bg-opacity-10 text-secondary mx-auto">
        <i class="bi bi-compass"></i>
    </div>
@endsection

@section('heading', 'Halaman Tidak Ditemukan')

@section('description')
    Halaman atau berkas data yang Anda tuju tidak ditemukan di sistem SIMPONPES. Tautan mungkin telah dipindahkan, dihapus, atau URL yang dimasukkan salah.
@endsection

@section('extra_content')
    <div class="alert alert-light border text-start py-3 px-4 rounded-3 mb-4 text-muted small">
        <div class="d-flex align-items-start gap-2">
            <i class="bi bi-lightbulb-fill text-warning fs-5 flex-shrink-0"></i>
            <div>
                <strong>Saran untuk Anda:</strong>
                <ul class="mb-0 ps-3 mt-1">
                    <li>Periksa kembali penulisan alamat URL pada peramban web Anda.</li>
                    <li>Gunakan tombol navigasi di bawah untuk kembali ke area yang aman.</li>
                    <li>Jika Anda sedang mencari santri atau modul spesifik, silakan buka menu utama di Dashboard.</li>
                </ul>
            </div>
        </div>
    </div>
@endsection

@section('actions')
    @auth
        <a href="{{ route('dashboard') }}" class="btn-pesantren">
            <i class="bi bi-speedometer2"></i> Kembali ke Dashboard
        </a>
    @else
        <a href="{{ route('landing') }}" class="btn-pesantren">
            <i class="bi bi-house-door"></i> Ke Beranda Utama
        </a>
    @endauth

    <button type="button" onclick="window.history.length > 1 ? window.history.back() : window.location.href='{{ route('landing') }}'" class="btn-secondary-action">
        <i class="bi bi-arrow-left"></i> Halaman Sebelumnya
    </button>
@endsection
