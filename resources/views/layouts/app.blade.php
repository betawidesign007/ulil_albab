<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Simponpes' }} - Pondok Pesantren Li Ulil Albab</title>

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
            font-size: 0.84rem;
            padding: 0.35rem 0.6rem !important;
            white-space: nowrap;
            transition: all 0.2s ease;
        }

        .nav-link:hover,
        .nav-link.active {
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

        html {
            scroll-behavior: smooth;
            scroll-padding-top: 65px;
        }

        body {
            overflow-x: clip;
            max-width: 100%;
            width: 100%;
        }

        header.sticky-top {
            position: sticky !important;
            top: 0 !important;
            z-index: 1030 !important;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.12) !important;
        }

        @media (max-width: 991.98px) {
            header.sticky-top .navbar-collapse {
                max-height: 85vh;
                overflow-y: auto;
                padding-bottom: 1rem;
            }
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
        <nav class="navbar navbar-expand-lg navbar-dark py-1">
            <div class="container-fluid px-3 px-xl-4">
                <!-- Brand -->
                <a class="navbar-brand d-flex align-items-center gap-2 me-2" href="{{ route('dashboard') }}">
                    @php
                        $navLogo = $appSetting?->logo_url ?? (file_exists(public_path('images/logo.png')) ? asset('images/logo.png') : null);
                    @endphp
                    @if ($navLogo)
                        <img src="{{ $navLogo }}" alt="Logo SIMPONPES"
                            class="rounded-circle shadow-sm bg-white p-1"
                            style="width: 32px; height: 32px; object-fit: contain;">
                    @else
                        <span
                            class="d-inline-flex align-items-center justify-content-center bg-white text-success rounded-circle shadow-sm"
                            style="width: 32px; height: 32px;">
                            <i class="bi bi-book-half fs-6 text-success"></i>
                        </span>
                    @endif
                    <div class="lh-1">
                        <div class="fw-bold fs-6">SIMPONPES</div>
                        <small class="text-white-50" style="font-size: 0.68rem;">{{ $appSetting?->nama_pesantren ?? 'PP. Li Ulil Albab' }}</small>
                    </div>
                </a>

                <button class="navbar-toggler border-0 shadow-none px-2 py-1" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navSimponpes" aria-controls="navSimponpes" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon" style="width: 1.15rem; height: 1.15rem;"></span>
                </button>

                <div class="collapse navbar-collapse" id="navSimponpes">
                    <!-- Nav Items (Kompak, Proporsional & Terorganisir) -->
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-2">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('dashboard') ? 'active fw-bold' : '' }}"
                                href="{{ route('dashboard') }}">
                                <i class="bi bi-speedometer2 me-1"></i> Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('santri.*') ? 'active fw-bold' : '' }}"
                                href="{{ route('santri.index') }}">
                                <i class="bi bi-people-fill me-1"></i> Santri
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('jadwal.*') ? 'active fw-bold' : '' }}"
                                href="{{ route('jadwal.index') }}">
                                <i class="bi bi-journal-bookmark-fill me-1"></i> Jadwal &amp; Acuan
                            </a>
                        </li>

                        @auth
                            {{-- Menu Khusus Admin (Dikelompokkan agar proporsional di layar) --}}
                            @if (Auth::user()->isAdmin())
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle {{ request()->routeIs('admin.ppdb.*', 'kegiatan.*', 'video.*', 'jadwal.create') ? 'active fw-bold' : '' }}"
                                        href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="bi bi-globe me-1"></i> Kelola Web &amp; PPDB
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-dark shadow border-0 mt-1 py-1"
                                        style="font-size: 0.82rem; background-color: #044332;">
                                        <li><a class="dropdown-item py-2" href="{{ route('admin.ppdb.index') }}"><i
                                                    class="bi bi-sliders2 me-2 text-warning"></i> Pengaturan Web &amp; Logo</a></li>
                                        <li><a class="dropdown-item py-2" href="{{ route('santri.create') }}"><i
                                                    class="bi bi-person-plus-fill me-2 text-info"></i> Tambah Santri
                                                Baru</a></li>
                                        <li><a class="dropdown-item py-2" href="{{ route('jadwal.create') }}"><i
                                                    class="bi bi-calendar-plus me-2 text-warning"></i> Tambah Jadwal &amp;
                                                Acuan</a></li>
                                        <li>
                                            <hr class="dropdown-divider border-secondary opacity-25 my-1">
                                        </li>
                                        <li><a class="dropdown-item py-2" href="{{ route('kegiatan.index') }}"><i
                                                    class="bi bi-images me-2 text-success"></i> Galeri Dokumentasi Foto</a>
                                        </li>
                                        <li><a class="dropdown-item py-2" href="{{ route('video.index') }}"><i
                                                    class="bi bi-play-btn-fill me-2 text-danger"></i> Galeri Video
                                                Kegiatan</a></li>
                                    </ul>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('users.*') ? 'active fw-bold' : '' }}"
                                        href="{{ route('users.index') }}">
                                        <i class="bi bi-shield-lock-fill me-1"></i> Pengguna
                                    </a>
                                </li>
                            @endif

                            {{-- Menu Pemilik & Admin: Laporan --}}
                            @if (Auth::user()->isPemilik() || Auth::user()->isAdmin())
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('laporan.*') ? 'active fw-bold' : '' }}"
                                        href="{{ route('laporan.santri') }}">
                                        <i class="bi bi-file-earmark-bar-graph me-1"></i> Laporan
                                    </a>
                                </li>
                            @endif
                        @endauth
                    </ul>

                    <!-- Right Controls / Profile (Selalu Pas di Dalam Layar) -->
                    <div class="d-flex align-items-center gap-2 flex-shrink-0">
                        <!-- Tautan ke Landing Page Publik -->
                        <a href="{{ route('landing') }}"
                            class="btn btn-sm btn-outline-light d-flex align-items-center gap-1 rounded-pill px-2 py-1"
                            title="Kunjungi Website Pondok" style="font-size: 0.78rem;">
                            <i class="bi bi-globe2"></i> <span class="d-none d-xl-inline">Website Utama</span>
                        </a>

                        @auth
                            <!-- User Dropdown & Role Badge -->
                            <div class="dropdown">
                                <button
                                    class="btn btn-dark bg-dark bg-opacity-25 border-0 text-white rounded-pill d-flex align-items-center gap-1 py-1 px-2 dropdown-toggle shadow-none"
                                    type="button" data-bs-toggle="dropdown" aria-expanded="false"
                                    style="font-size: 0.78rem;">
                                    <span
                                        class="rounded-circle bg-white text-dark d-flex align-items-center justify-content-center"
                                        style="width: 24px; height: 24px;">
                                        <i class="bi bi-person-circle fs-6"></i>
                                    </span>
                                    <span class="fw-medium text-truncate d-none d-md-inline" style="max-width: 130px;">
                                        {{ Auth::user()->name }}
                                    </span>
                                    <span class="badge {{ Auth::user()->role_badge_class }} py-0 px-2"
                                        style="font-size: 0.68rem;">
                                        {{ ucfirst(Auth::user()->role) }}
                                    </span>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-2 p-2"
                                    style="font-size: 0.82rem;">
                                    <li class="px-3 py-2 border-bottom">
                                        <div class="fw-bold text-dark">{{ Auth::user()->name }}</div>
                                        <div class="text-muted small" style="font-size: 0.75rem;">
                                            {{ Auth::user()->email }}</div>
                                        <div class="mt-1">
                                            <span class="badge {{ Auth::user()->role_badge_class }}"
                                                style="font-size: 0.68rem;">
                                                {{ Auth::user()->role_label }}
                                            </span>
                                        </div>
                                    </li>
                                    <li>
                                        <a class="dropdown-item py-2 mt-1 rounded" href="{{ route('dashboard') }}">
                                            <i class="bi bi-grid-fill text-muted me-2"></i> Dashboard Saya
                                        </a>
                                    </li>
                                    @if (Auth::user()->isAdmin())
                                        <li>
                                            <a class="dropdown-item py-2 rounded" href="{{ route('users.index') }}">
                                                <i class="bi bi-gear-fill text-muted me-2"></i> Manajemen Hak Akses
                                            </a>
                                        </li>
                                    @endif
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
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
                <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm d-flex align-items-center gap-2 mb-4"
                    role="alert">
                    <i class="bi bi-check-circle-fill fs-5"></i>
                    <div>{{ session('success') }}</div>
                    <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"
                        aria-label="Close"></button>
                </div>
            @endif

            @if (session('warning'))
                <div class="alert alert-warning alert-dismissible fade show border-0 shadow-sm d-flex align-items-center gap-2 mb-4"
                    role="alert">
                    <i class="bi bi-exclamation-triangle-fill fs-5"></i>
                    <div>{{ session('warning') }}</div>
                    <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"
                        aria-label="Close"></button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm d-flex align-items-center gap-2 mb-4"
                    role="alert">
                    <i class="bi bi-x-circle-fill fs-5"></i>
                    <div>{{ session('error') }}</div>
                    <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"
                        aria-label="Close"></button>
                </div>
            @endif

            @yield('content')
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-white border-top py-3 mt-auto">
        <div
            class="container d-flex flex-column flex-sm-row justify-content-between align-items-center gap-2 small text-muted">
            <div>
                &copy; {{ date('Y') }} <strong>SIMPONPES</strong> - Pondok Pesantren Li Ulil Albab.
            </div>
            <div class="d-flex align-items-center gap-3">
                <span class="badge bg-light text-secondary border">Hak Akses Multiuser: Admin &bull; Pengajar &bull;
                    Pemilik</span>
                <a href="{{ route('landing') }}" class="text-decoration-none text-muted">Website Utama</a>
            </div>
        </div>
    </footer>

    <!-- Bootstrap 5 JS Bundle CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>

</html>
