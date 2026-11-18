@extends('layouts.app', ['title' => 'Pengaturan Akun & Profil'])

@section('content')
<div class="container-fluid px-3 px-lg-4 py-3">

    <!-- Header & Breadcrumb -->
    <div class="mb-4 pb-2 border-bottom">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-1" style="font-size: 0.8rem;">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-decoration-none text-success">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Pengaturan Profil &amp; Akun</li>
            </ol>
        </nav>
        <h2 class="h4 fw-bold text-dark mb-0 d-flex align-items-center gap-2">
            <i class="bi bi-person-gear text-success"></i> Pengaturan Profil &amp; Keamanan Akun
        </h2>
        <small class="text-muted" style="font-size: 0.78rem;">
            Perbarui data diri, ubah email bawaan menjadi akun Google (@gmail.com), dan perbarui kata sandi akun Anda.
        </small>
    </div>

    <!-- Alert Messages -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show d-flex align-items-center gap-2 py-2 px-3 small shadow-sm mb-4" role="alert">
            <i class="bi bi-check-circle-fill fs-5"></i>
            <div>{{ session('success') }}</div>
            <button type="button" class="btn-close btn-sm p-2" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show py-2 px-3 small shadow-sm mb-4" role="alert">
            <div class="fw-bold mb-1"><i class="bi bi-exclamation-circle-fill me-1"></i> Terjadi kesalahan validasi:</div>
            <ul class="mb-0 ps-3">
                @foreach($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close btn-sm p-2" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row g-4">
        <!-- Kolom Info Akun -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 text-center p-4">
                <div class="d-inline-flex align-items-center justify-content-center p-3 rounded-circle bg-success bg-opacity-10 text-success mx-auto mb-3" style="width: 80px; height: 80px;">
                    <i class="bi bi-person-fill fs-1"></i>
                </div>
                <h5 class="fw-bold text-dark mb-1">{{ $user->name }}</h5>
                <p class="text-muted small mb-2">{{ $user->email }}</p>
                <div>
                    <span class="badge {{ $user->role_badge_class }} px-3 py-1.5 fs-6">
                        {{ $user->role_label }}
                    </span>
                </div>

                <div class="mt-4 pt-3 border-top text-start small text-muted">
                    <div class="d-flex justify-content-between mb-2">
                        <span>Status Akun:</span>
                        <strong class="text-success"><i class="bi bi-check2-circle"></i> Aktif Terverifikasi</strong>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span>No. Telepon/WA:</span>
                        <strong class="text-dark">{{ $user->no_hp ?? '-' }}</strong>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span>Terdaftar Sejak:</span>
                        <strong class="text-dark">{{ $user->created_at?->translatedFormat('d M Y') ?? '-' }}</strong>
                    </div>
                </div>
            </div>
        </div>

        <!-- Kolom Form Edit Akun -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-header bg-white py-3 px-4 border-bottom">
                    <h5 class="card-title fw-bold text-dark mb-0">
                        <i class="bi bi-pencil-square me-2 text-success"></i> Ubah Data Profil &amp; Kata Sandi
                    </h5>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('profile.update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <h6 class="fw-bold text-success mb-3">1. Informasi Akun &amp; Email</h6>
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label for="name" class="form-label small fw-bold text-dark">Nama Lengkap <span class="text-danger">*</span></label>
                                <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required
                                    class="form-control @error('name') is-invalid @enderror">
                            </div>

                            <div class="col-md-6">
                                <label for="email" class="form-label small fw-bold text-dark">Alamat Email (Dapat menggunakan @gmail.com) <span class="text-danger">*</span></label>
                                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required
                                    class="form-control @error('email') is-invalid @enderror" placeholder="namaanda@gmail.com">
                                <small class="text-muted" style="font-size: 0.72rem;">Email ini digunakan untuk masuk sistem dan menerima tautan reset kata sandi.</small>
                            </div>

                            <div class="col-md-6">
                                <label for="no_hp" class="form-label small fw-bold text-dark">Nomor Handphone / WhatsApp</label>
                                <input type="text" name="no_hp" id="no_hp" value="{{ old('no_hp', $user->no_hp) }}"
                                    class="form-control @error('no_hp') is-invalid @enderror" placeholder="08xxxxxxxxxx">
                            </div>
                        </div>

                        <hr class="my-4">

                        <h6 class="fw-bold text-danger mb-2">2. Ganti Kata Sandi (Opsional)</h6>
                        <p class="text-muted small mb-3">Kosongkan kolom di bawah ini jika Anda tidak ingin mengganti kata sandi saat ini.</p>

                        <div class="row g-3 mb-4">
                            <div class="col-12">
                                <label for="current_password" class="form-label small fw-bold text-dark">Kata Sandi Saat Ini</label>
                                <input type="password" name="current_password" id="current_password"
                                    class="form-control @error('current_password') is-invalid @enderror"
                                    placeholder="Wajib diisi jika ingin mengganti kata sandi baru">
                            </div>

                            <div class="col-md-6">
                                <label for="password" class="form-label small fw-bold text-dark">Kata Sandi Baru</label>
                                <input type="password" name="password" id="password" minlength="6"
                                    class="form-control @error('password') is-invalid @enderror"
                                    placeholder="Minimal 6 karakter">
                            </div>

                            <div class="col-md-6">
                                <label for="password_confirmation" class="form-label small fw-bold text-dark">Konfirmasi Kata Sandi Baru</label>
                                <input type="password" name="password_confirmation" id="password_confirmation" minlength="6"
                                    class="form-control" placeholder="Ulangi kata sandi baru">
                            </div>
                        </div>

                        <div class="d-flex justify-content-end gap-2 pt-3 border-top">
                            <a href="{{ route('dashboard') }}" class="btn btn-secondary px-3">Batal</a>
                            <button type="submit" class="btn btn-pesantren px-4 shadow-sm">
                                <i class="bi bi-save me-1"></i> Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
