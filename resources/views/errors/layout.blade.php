<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Terjadi Kesalahan') - Pondok Pesantren Li Ulil Albab</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Amiri:ital,wght@0,400;0,700;1,400&display=swap"
        rel="stylesheet">

    <!-- Bootstrap 5 CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        :root {
            --primary-emerald: #065f46;
            --primary-dark: #044332;
            --primary-light: #10b981;
            --accent-gold: #d97706;
            --accent-gold-light: #f59e0b;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: linear-gradient(135deg, #022c22 0%, #065f46 60%, #044332 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1.5rem;
            color: #1e293b;
        }

        .error-card {
            background: #ffffff;
            border-radius: 24px;
            box-shadow: 0 25px 60px -15px rgba(0, 0, 0, 0.4);
            max-width: 760px;
            width: 100%;
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .error-header {
            background: linear-gradient(145deg, #044332 0%, #065f46 100%);
            color: #ffffff;
            padding: 1.5rem 2rem;
            border-bottom: 3px solid var(--accent-gold);
        }

        .error-code-badge {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 0.85rem;
            font-weight: 700;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            padding: 0.35rem 0.85rem;
            border-radius: 50rem;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .icon-circle {
            width: 88px;
            height: 88px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1rem;
            font-size: 2.75rem;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
        }

        .btn-pesantren {
            background-color: var(--primary-emerald);
            color: #ffffff;
            font-weight: 600;
            border: none;
            padding: 0.65rem 1.4rem;
            border-radius: 12px;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            text-decoration: none;
        }

        .btn-pesantren:hover {
            background-color: var(--primary-dark);
            color: #ffffff;
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(6, 95, 70, 0.25);
        }

        .btn-secondary-action {
            background-color: #f1f5f9;
            color: #334155;
            font-weight: 600;
            border: 1px solid #cbd5e1;
            padding: 0.65rem 1.4rem;
            border-radius: 12px;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            text-decoration: none;
        }

        .btn-secondary-action:hover {
            background-color: #e2e8f0;
            color: #0f172a;
            border-color: #94a3b8;
        }

        .btn-danger-outline {
            background-color: #fef2f2;
            color: #dc2626;
            border: 1px solid #fecaca;
            font-weight: 600;
            padding: 0.65rem 1.4rem;
            border-radius: 12px;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            text-decoration: none;
        }

        .btn-danger-outline:hover {
            background-color: #fee2e2;
            color: #b91c1c;
            border-color: #f87171;
            transform: translateY(-2px);
        }

        .account-box {
            background: #f8fafc;
            border: 1px dashed #cbd5e1;
            border-radius: 16px;
            padding: 1.25rem;
        }

        /* Mobile Responsiveness for iPhone/Ponsel */
        @media (max-width: 575.98px) {
            body {
                padding: 0.75rem;
            }
            .error-card {
                border-radius: 16px;
            }
            .error-header {
                padding: 1rem 1.25rem;
            }
            .btn-pesantren, .btn-secondary-action, .btn-danger-outline {
                width: 100%;
            }
            .account-box {
                padding: 1rem;
            }
        }
    </style>
</head>

<body>

    <div class="error-card">
        <!-- Error Top Pesantren Bar -->
        <div class="error-header d-flex align-items-center justify-content-between flex-wrap gap-2">
            <div class="d-flex align-items-center gap-2">
                @php
                    $navLogo = $appSetting?->logo_url ?? (file_exists(public_path('images/logo.png')) ? asset('images/logo.png') : null);
                @endphp
                @if($navLogo)
                    <img src="{{ $navLogo }}" alt="Logo SIMPONPES" class="rounded-circle shadow-sm bg-white p-1" style="width: 38px; height: 38px; object-fit: contain;">
                @else
                    <span class="d-inline-flex align-items-center justify-content-center bg-white text-success rounded-circle shadow-sm" style="width: 38px; height: 38px;">
                        <i class="bi bi-book-half fs-5 text-success"></i>
                    </span>
                @endif
                <div>
                    <h6 class="fw-bold mb-0 text-white">SIMPONPES</h6>
                    <small class="text-warning" style="font-size: 0.75rem;">{{ $appSetting?->nama_pesantren ?? 'PP. Li Ulil Albab' }}</small>
                </div>
            </div>

            <div class="d-flex align-items-center gap-2">
                <span class="error-code-badge @yield('badge_class', 'bg-warning text-dark')">
                    @yield('badge_text', 'Pemberitahuan Sistem')
                </span>
            </div>
        </div>

        <!-- Main Body -->
        <div class="p-4 p-md-5 text-center">
            <!-- Icon -->
            <div class="text-center">
                @yield('icon')
            </div>

            <!-- Title & Subtitle -->
            <h2 class="fw-bold text-dark mb-2">@yield('heading')</h2>
            <div class="text-muted mb-4 lead fs-6">
                @yield('description')
            </div>

            <!-- Optional Custom Alert / Detail -->
            @yield('extra_content')

            <!-- Section: Pengecekan Akun & Solusi Salah Masuk Akun -->
            @auth
                <div class="account-box text-start mb-4">
                    <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-2">
                        <span class="small fw-bold text-muted text-uppercase tracking-wider">
                            <i class="bi bi-person-badge me-1"></i> Informasi Akun Yang Sedang Aktif
                        </span>
                        <span class="badge {{ auth()->user()->role_badge_class ?? 'bg-secondary' }} px-2 py-1">
                            {{ auth()->user()->role_label ?? auth()->user()->role_value ?? (auth()->user()->role instanceof \BackedEnum ? auth()->user()->role->value : auth()->user()->role) }}
                        </span>
                    </div>

                    <div class="d-flex align-items-center gap-3 py-1">
                        <div class="rounded-circle bg-success bg-opacity-10 text-success d-flex align-items-center justify-content-center fw-bold" style="width: 44px; height: 44px; font-size: 1.1rem;">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </div>
                        <div class="flex-grow-1 overflow-hidden">
                            <div class="fw-bold text-dark text-truncate">{{ auth()->user()->name }}</div>
                            <div class="small text-muted text-truncate">{{ auth()->user()->email }}</div>
                        </div>
                    </div>

                    <hr class="my-2 border-secondary opacity-25">

                    <div class="d-flex align-items-start gap-2 small text-muted mt-2">
                        <i class="bi bi-info-circle-fill text-warning flex-shrink-0 mt-1"></i>
                        <div>
                            <strong>Salah masuk akun?</strong> Jika Anda memiliki akun lain dengan hak akses yang berbeda (misalnya akun Administrator atau Asatidz), Anda dapat keluar dan masuk kembali menggunakan akun yang sesuai.
                        </div>
                    </div>
                </div>
            @endauth

            <!-- Action Buttons -->
            <div class="d-flex flex-wrap justify-content-center gap-2 mt-4">
                @yield('actions')

                @auth
                    <form method="POST" action="{{ route('logout') }}" class="d-inline">
                        @csrf
                        <button type="submit" class="btn-danger-outline" title="Keluar dan masuk dengan akun lain">
                            <i class="bi bi-box-arrow-left"></i> Ganti Akun / Keluar
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="btn-pesantren">
                        <i class="bi bi-box-arrow-in-right"></i> Masuk / Login
                    </a>
                @endauth
            </div>
        </div>

        <!-- Footer Note -->
        <div class="bg-light px-4 py-3 border-top d-flex justify-content-between align-items-center flex-wrap gap-2 text-muted small">
            <div>
                &copy; {{ date('Y') }} Pondok Pesantren Li Ulil Albab &bull; Sistem Informasi Akademik & Kepegawaian
            </div>
            <div>
                <a href="{{ route('landing') }}" class="text-decoration-none text-muted">
                    <i class="bi bi-globe me-1"></i> Website Utama
                </a>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
