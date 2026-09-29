<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Simponpes' }} - Pondok Pesantren Ulil Albab</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Amiri:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">

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
            background-color: #f8fafc;
            color: #1e293b;
        }

        .navbar-brand-arabic {
            font-family: 'Amiri', serif;
            font-size: 1.4rem;
            color: #fef08a !important;
        }

        .bg-pesantren {
            background: linear-gradient(135deg, #065f46 0%, #044332 100%);
        }

        .nav-link {
            font-weight: 500;
            transition: all 0.2s ease;
        }

        .nav-link:hover, .nav-link.active {
            color: #fef08a !important;
        }

        .role-badge {
            font-size: 0.75rem;
            padding: 0.35rem 0.65rem;
            border-radius: 9999px;
            font-weight: 600;
            letter-spacing: 0.025em;
        }

        .card {
            border-radius: 12px;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .btn-pesantren {
            background-color: #065f46;
            color: #ffffff;
            border: none;
            font-weight: 600;
        }

        .btn-pesantren:hover {
            background-color: #044332;
            color: #ffffff;
        }

        .btn-gold {
            background-color: #d97706;
            color: #ffffff;
            font-weight: 600;
            border: none;
        }

        .btn-gold:hover {
            background-color: #b45309;
            color: #ffffff;
        }
    </style>
</head>

<body class="d-flex flex-column min-vh-100">

    <!-- Top Notification Bar -->
    <header class="bg-pesantren text-white shadow-sm sticky-top">
        <nav class="navbar navbar-expand-lg navbar-dark py-2">
            <div class="container">
                <!-- Brand -->
                <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('dashboard') }}">
                    <span class="d-inline-flex align-items-center justify-content-center bg-white text-success rounded-circle shadow-sm" style="width: 38px; height: 38px;">
                        <i class="bi bi-book-half fs-5 text-success"></i>
                    </span>
                    <div>
                        <div class="fw-bold fs-6 lh-1">SIMPONPES</div>
                        <small class="text-white-50" style="font-size: 0.75rem;">PP. Ulil Albab</small>
                    </div>
                </a>

                <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navSimponpes" aria-controls="navSimponpes" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navSimponpes">
                    <!-- Nav Items -->
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-3">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('dashboard') ? 'active fw-bold' : '' }}" href="{{ route('dashboard') }}">
                                <i class="bi bi-speedometer2 me-1"></i> Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('santri.*') ? 'active fw-bold' : '' }}" href="{{ route('santri.index') }}">
                                <i class="bi bi-people-fill me-1"></i> Data Santri
                            </a>
                        </li>

                        @auth
                            {{-- Menu Khusus Admin --}}
                            @if(Auth::user()->isAdmin())
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('santri.create') ? 'active fw-bold' : '' }}" href="{{ route('santri.create') }}">
                                        <i class="bi bi-person-plus-fill me-1"></i> Tambah Santri
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('users.*') ? 'active fw-bold' : '' }}" href="{{ route('users.index') }}">
                                        <i class="bi bi-shield-lock-fill me-1"></i> Pengguna & Hak Akses
                                    </a>
                                </li>
                            @endif

                            {{-- Menu Pemilik & Admin: Laporan --}}
                            @if(Auth::user()->isPemilik() || Auth::user()->isAdmin())
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('laporan.*') ? 'active fw-bold' : '' }}" href="{{ route('laporan.santri') }}">
                                        <i class="bi bi-file-earmark-bar-graph me-1"></i> Laporan Eksekutif
                                    </a>
                                </li>
                            @endif
                        @endauth
                    </ul>

                    <!-- Right Controls / Profile -->
                    <div class="d-flex align-items-center gap-2">
                        <!-- Tautan ke Landing Page Publik -->
                        <a href="{{ route('landing') }}" class="btn btn-sm btn-outline-light d-flex align-items-center gap-1 rounded-pill px-3" title="Kunjungi Website Pondok">
                            <i class="bi bi-globe2"></i> <span class="d-none d-md-inline">Lihat Website</span>
                        </a>

                        @auth
                            <!-- User Dropdown & Role Badge -->
                            <div class="dropdown">
                                <button class="btn btn-dark bg-dark bg-opacity-25 border-0 text-white rounded-pill d-flex align-items-center gap-2 py-1 px-3 dropdown-toggle shadow-none" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <span class="rounded-circle bg-white text-dark d-flex align-items-center justify-content-center" style="width: 28px; height: 28px;">
                                        <i class="bi bi-person-circle fs-6"></i>
                                    </span>
                                    <span class="fw-medium text-truncate d-none d-sm-inline" style="max-width: 140px;">
                                        {{ Auth::user()->name }}
                                    </span>
                                    <span class="badge {{ Auth::user()->role_badge_class }} role-badge">
                                        {{ ucfirst(Auth::user()->role) }}
                                    </span>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-2 p-2">
                                    <li class="px-3 py-2 border-bottom">
                                        <div class="fw-bold text-dark">{{ Auth::user()->name }}</div>
                                        <div class="text-muted small">{{ Auth::user()->email }}</div>
                                        <div class="mt-1">
                                            <span class="badge {{ Auth::user()->role_badge_class }}">
                                                {{ Auth::user()->role_label }}
                                            </span>
                                        </div>
                                    </li>
                                    <li>
                                        <a class="dropdown-item py-2 mt-1 rounded" href="{{ route('dashboard') }}">
                                            <i class="bi bi-grid-fill text-muted me-2"></i> Dashboard Saya
                                        </a>
                                    </li>
                                    @if(Auth::user()->isAdmin())
                                        <li>
                                            <a class="dropdown-item py-2 rounded" href="{{ route('users.index') }}">
                                                <i class="bi bi-gear-fill text-muted me-2"></i> Manajemen Hak Akses
                                            </a>
                                        </li>
                                    @endif
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <form action="{{ route('logout') }}" method="POST">
                                            @csrf
                                            <button type="submit" class="dropdown-item py-2 text-danger rounded">
                                                <i class="bi bi-box-arrow-right me-2"></i> Keluar (Logout)
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-sm btn-light fw-semibold rounded-pill px-3">
                                <i class="bi bi-box-arrow-in-right me-1"></i> Masuk
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <!-- Main Content Container -->
    <main class="flex-grow-1 py-4">
        <div class="container">
            <!-- Flash Message Alerts -->
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm d-flex align-items-center gap-2 mb-4" role="alert">
                    <i class="bi bi-check-circle-fill fs-5"></i>
                    <div>{{ session('success') }}</div>
                    <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (session('warning'))
                <div class="alert alert-warning alert-dismissible fade show border-0 shadow-sm d-flex align-items-center gap-2 mb-4" role="alert">
                    <i class="bi bi-exclamation-triangle-fill fs-5"></i>
                    <div>{{ session('warning') }}</div>
                    <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm d-flex align-items-center gap-2 mb-4" role="alert">
                    <i class="bi bi-x-circle-fill fs-5"></i>
                    <div>{{ session('error') }}</div>
                    <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @yield('content')
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-white border-top py-3 mt-auto">
        <div class="container d-flex flex-column flex-sm-row justify-content-between align-items-center gap-2 small text-muted">
            <div>
                &copy; {{ date('Y') }} <strong>SIMPONPES</strong> - Pondok Pesantren Ulil Albab.
            </div>
            <div class="d-flex align-items-center gap-3">
                <span class="badge bg-light text-secondary border">Hak Akses Multiuser: Admin &bull; Pengajar &bull; Pemilik</span>
                <a href="{{ route('landing') }}" class="text-decoration-none text-muted">Website Utama</a>
            </div>
        </div>
    </footer>

    <!-- Bootstrap 5 JS Bundle CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>

</html>
