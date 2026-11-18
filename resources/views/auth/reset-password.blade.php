<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atur Kata Sandi Baru - SIMPONPES Li Ulil Albab</title>

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
                <i class="bi bi-key-fill fs-2"></i>
            </div>
            <h3 class="fw-bold text-dark mb-1">Atur Kata Sandi Baru</h3>
            <p class="text-muted small mb-0">
                Silakan buat kata sandi baru yang aman dan mudah diingat (minimal 6 karakter).
            </p>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger d-flex align-items-start gap-2 small shadow-sm mb-4" role="alert">
                <i class="bi bi-exclamation-triangle-fill fs-5 flex-shrink-0"></i>
                <div>{{ $errors->first() }}</div>
            </div>
        @endif

        <form action="{{ route('password.update') }}" method="POST">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">

            <div class="mb-3">
                <label for="email" class="form-label fw-semibold small text-dark">Alamat Email</label>
                <div class="input-group">
                    <span class="input-group-text bg-light border-end-0 text-muted"><i class="bi bi-envelope"></i></span>
                    <input type="email" name="email" id="email" value="{{ old('email', $email) }}" required
                        class="form-control border-start-0 @error('email') is-invalid @enderror" readonly>
                </div>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label fw-semibold small text-dark">Kata Sandi Baru</label>
                <div class="input-group">
                    <span class="input-group-text bg-light border-end-0 text-muted"><i class="bi bi-lock"></i></span>
                    <input type="password" name="password" id="password" required minlength="6"
                        class="form-control border-start-0 border-end-0 @error('password') is-invalid @enderror"
                        placeholder="Minimal 6 karakter">
                    <button class="btn btn-light border border-start-0 text-muted" type="button" onclick="togglePass('password', this)">
                        <i class="bi bi-eye"></i>
                    </button>
                </div>
            </div>

            <div class="mb-4">
                <label for="password_confirmation" class="form-label fw-semibold small text-dark">Konfirmasi Kata Sandi Baru</label>
                <div class="input-group">
                    <span class="input-group-text bg-light border-end-0 text-muted"><i class="bi bi-check2-circle"></i></span>
                    <input type="password" name="password_confirmation" id="password_confirmation" required minlength="6"
                        class="form-control border-start-0 border-end-0"
                        placeholder="Ulangi kata sandi baru">
                    <button class="btn btn-light border border-start-0 text-muted" type="button" onclick="togglePass('password_confirmation', this)">
                        <i class="bi bi-eye"></i>
                    </button>
                </div>
            </div>

            <button type="submit" class="btn btn-pesantren w-100 py-2.5 shadow-sm mb-3">
                <i class="bi bi-check-circle me-1"></i> Simpan Kata Sandi Baru
            </button>

            <div class="text-center">
                <a href="{{ route('login') }}" class="text-decoration-none small text-muted fw-semibold">
                    <i class="bi bi-arrow-left me-1"></i> Batal &amp; Kembali ke Halaman Masuk
                </a>
            </div>
        </form>
    </div>

    <script>
        function togglePass(inputId, btn) {
            const input = document.getElementById(inputId);
            const icon = btn.querySelector('i');
            if (input.type === 'password') {
                input.type = 'text';
                icon.className = 'bi bi-eye-slash';
            } else {
                input.type = 'password';
                icon.className = 'bi bi-eye';
            }
        }
    </script>
</body>

</html>
