<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Kata Sandi - SIMPONPES Li Ulil Albab</title>

    @php
        $faviconUrl = $appSetting?->logo_url ?? (file_exists(public_path('storage/images/logo.png')) || file_exists(base_path('../public_html/storage/images/logo.png')) ? asset('storage/images/logo.png') : asset('images/logo.png'));
    @endphp
    <link rel="icon" type="image/png" sizes="32x32" href="{{ $faviconUrl }}?v={{ time() }}">
    <link rel="shortcut icon" href="{{ $faviconUrl }}?v={{ time() }}">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: linear-gradient(135deg, #022c22 0%, #065f46 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1.5rem;
        }

        .auth-card {
            background: #ffffff;
            border-radius: 20px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            max-width: 520px;
            width: 100%;
            overflow: hidden;
        }

        .btn-pesantren {
            background-color: #065f46;
            color: #ffffff;
            font-weight: 600;
            border: none;
            padding: 0.75rem 1.25rem;
            border-radius: 10px;
            transition: all 0.2s ease;
            min-height: 44px;
        }

        .btn-pesantren:hover {
            background-color: #044332;
            color: #ffffff;
        }
    </style>
</head>

<body>
    <div class="auth-card p-4 p-md-5">
        <div class="text-center mb-4">
            <div class="d-inline-flex align-items-center justify-content-center p-3 rounded-circle bg-success bg-opacity-10 text-success mb-3 shadow-sm">
                <i class="bi bi-shield-lock-fill fs-2"></i>
            </div>
            <h3 class="fw-bold text-dark mb-1">Lupa Kata Sandi?</h3>
            <p class="text-muted small mb-0">
                Masukkan alamat email yang terdaftar (misal: akun <code>@gmail.com</code>). Kami akan mengirimkan tautan untuk menyetel ulang kata sandi Anda.
            </p>
        </div>

        @if (session('status'))
            <div class="alert alert-success d-flex align-items-start gap-2 small shadow-sm mb-4" role="alert">
                <i class="bi bi-check-circle-fill fs-5 flex-shrink-0"></i>
                <div>{{ session('status') }}</div>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger d-flex align-items-start gap-2 small shadow-sm mb-4" role="alert">
                <i class="bi bi-exclamation-triangle-fill fs-5 flex-shrink-0"></i>
                <div>{{ $errors->first() }}</div>
            </div>
        @endif

        <form action="{{ route('password.email') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="email" class="form-label fw-semibold small text-dark">Alamat Email Terdaftar</label>
                <div class="input-group">
                    <span class="input-group-text bg-light border-end-0 text-muted"><i class="bi bi-envelope"></i></span>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus
                        class="form-control border-start-0 @error('email') is-invalid @enderror"
                        placeholder="contoh: admin@gmail.com">
                </div>
            </div>

            <button type="submit" class="btn btn-pesantren w-100 py-2.5 shadow-sm mb-3">
                <i class="bi bi-send-fill me-1"></i> Kirim Tautan Reset Kata Sandi
            </button>

            <div class="text-center">
                <a href="{{ route('login') }}" class="text-decoration-none small text-muted fw-semibold">
                    <i class="bi bi-arrow-left me-1"></i> Kembali ke Halaman Masuk
                </a>
            </div>
        </form>
    </div>
</body>

</html>
