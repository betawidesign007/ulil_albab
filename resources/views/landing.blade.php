<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Li Ulil Albab</title>
    <meta name="description"
        content="Portal resmi informasi kegiatan santri, dokumentasi foto, galeri video, serta alur persyaratan dan formulir pendaftaran PPDB online Pondok Pesantren Li Ulil Albab.">

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
            --primary-dark: #022c22;
            --primary-light: #059669;
            --primary-accent: #10b981;
            --accent-gold: #d97706;
            --accent-gold-light: #f59e0b;
            --bg-subtle: #f8fafc;
        }

        html {
            scroll-behavior: smooth;
            scroll-padding-top: 80px;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: #1e293b;
            overflow-x: clip;
            max-width: 100%;
            width: 100%;
            background-color: #ffffff;
        }

        .font-arabic {
            font-family: 'Amiri', serif;
        }

        /* Topbar & Navbar */
        .topbar-info {
            background-color: #022c22;
            color: #e2e8f0;
            font-size: 0.75rem;
        }

        .main-navbar {
            position: sticky !important;
            top: 0 !important;
            z-index: 1030 !important;
            background: rgba(255, 255, 255, 0.98) !important;
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
            border-bottom: 1px solid rgba(226, 232, 240, 0.8);
            box-shadow: 0 4px 20px -2px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
        }

        @media (max-width: 991.98px) {
            .main-navbar .navbar-collapse {
                max-height: 85vh;
                overflow-y: auto;
                padding-bottom: 1rem;
            }
        }

        .nav-link {
            font-weight: 500;
            color: #334155 !important;
            padding: 0.35rem 0.6rem !important;
            font-size: 0.82rem;
            transition: color 0.2s ease;
        }

        .nav-link:hover,
        .nav-link.active {
            color: #065f46 !important;
        }

        /* Hero Section */
        .hero-section {
            background: linear-gradient(135deg, #022c22 0%, #064e3b 50%, #065f46 100%);
            position: relative;
            color: #ffffff;
            padding-top: 4.5rem;
            padding-bottom: 6rem;
            overflow: hidden;
        }

        .hero-pattern {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: radial-gradient(rgba(255, 255, 255, 0.1) 1.2px, transparent 1.2px);
            background-size: 26px 26px;
            pointer-events: none;
        }

        .hero-badge {
            background: rgba(255, 255, 255, 0.14);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            color: #fef08a;
            font-size: 0.85rem;
            font-weight: 600;
            padding: 0.45rem 1.15rem;
            border-radius: 9999px;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        /* Buttons */
        .btn-pesantren {
            background: linear-gradient(135deg, #065f46 0%, #047857 100%);
            color: #ffffff;
            font-weight: 600;
            border: none;
            padding: 0.5rem 1.25rem;
            border-radius: 10px;
            transition: all 0.25s ease;
        }

        .btn-pesantren:hover {
            background: #022c22;
            color: #ffffff;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(6, 95, 70, 0.3);
        }

        .btn-gold {
            background: linear-gradient(135deg, #d97706 0%, #b45309 100%);
            color: #ffffff;
            font-weight: 600;
            border: none;
            padding: 0.45rem 1.15rem;
            border-radius: 28px;
            box-shadow: 0 4px 12px rgba(217, 119, 6, 0.3);
            transition: all 0.25s ease;
            white-space: nowrap;
        }

        .btn-gold:hover {
            background: linear-gradient(135deg, #b45309 0%, #92400e 100%);
            color: #ffffff;
            transform: translateY(-2px);
            box-shadow: 0 10px 24px rgba(217, 119, 6, 0.45);
        }

        /* Section Styling */
        .section-tag {
            color: #059669;
            background: #ecfdf5;
            padding: 0.4rem 1rem;
            border-radius: 9999px;
            font-weight: 700;
            font-size: 0.82rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            display: inline-block;
            margin-bottom: 0.75rem;
        }

        .section-title {
            font-size: 2.25rem;
            font-weight: 800;
            color: #0f172a;
            line-height: 1.25;
        }

        /* Activity Documentation Cards */
        .activity-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            overflow: hidden;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .activity-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 20px 25px -5px rgba(6, 95, 70, 0.12), 0 8px 10px -6px rgba(6, 95, 70, 0.08);
            border-color: #a7f3d0;
        }

        .activity-img-wrapper {
            position: relative;
            height: 220px;
            overflow: hidden;
            background-color: #1e293b;
        }

        .activity-img-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .activity-card:hover .activity-img-wrapper img {
            transform: scale(1.06);
        }

        .activity-category-badge {
            position: absolute;
            top: 14px;
            left: 14px;
            background: rgba(2, 44, 34, 0.85);
            backdrop-filter: blur(8px);
            color: #fef08a;
            font-size: 0.75rem;
            font-weight: 700;
            padding: 0.35rem 0.85rem;
            border-radius: 9999px;
            border: 1px solid rgba(254, 240, 138, 0.3);
        }

        .activity-date-badge {
            position: absolute;
            bottom: 12px;
            right: 14px;
            background: rgba(0, 0, 0, 0.7);
            color: #ffffff;
            font-size: 0.75rem;
            padding: 0.25rem 0.7rem;
            border-radius: 6px;
        }

        /* Video Showcase */
        .video-box-main {
            border-radius: 20px;
            overflow: hidden;
            background: #000000;
            box-shadow: 0 25px 35px -5px rgba(0, 0, 0, 0.35);
            position: relative;
        }

        .video-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            overflow: hidden;
            transition: all 0.3s ease;
            height: 100%;
            display: flex;
            flex-direction: column;
            cursor: pointer;
        }

        .video-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 16px 24px rgba(0, 0, 0, 0.08);
            border-color: #cbd5e1;
        }

        .video-thumb-container {
            position: relative;
            height: 180px;
            background: #0f172a;
            overflow: hidden;
        }

        .video-thumb-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.4s ease;
        }

        .video-card:hover .video-thumb-container img {
            transform: scale(1.05);
        }

        .play-button-overlay {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 52px;
            height: 52px;
            background: rgba(220, 38, 38, 0.9);
            color: #ffffff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 0 20px rgba(220, 38, 38, 0.6);
            transition: all 0.3s ease;
        }

        .video-card:hover .play-button-overlay {
            transform: translate(-50%, -50%) scale(1.15);
            background: #dc2626;
        }

        /* PPDB Steps & Alur */
        .ppdb-step-box {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            padding: 1.75rem;
            position: relative;
            transition: all 0.3s ease;
            height: 100%;
        }

        .ppdb-step-box:hover {
            border-color: #10b981;
            box-shadow: 0 12px 24px rgba(16, 185, 129, 0.1);
            transform: translateY(-4px);
        }

        .step-number {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            background: linear-gradient(135deg, #065f46 0%, #047857 100%);
            color: #ffffff;
            font-weight: 800;
            font-size: 1.25rem;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.25rem;
            box-shadow: 0 4px 10px rgba(6, 95, 70, 0.25);
        }

        .exam-subject-card {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            padding: 1.25rem;
            transition: all 0.2s ease;
        }

        .exam-subject-card:hover {
            background: #ffffff;
            border-color: #cbd5e1;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        /* Registration Form Card */
        .form-ppdb-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 20px;
            box-shadow: 0 20px 30px -10px rgba(0, 0, 0, 0.08);
            overflow: hidden;
        }

        .form-section-divider {
            font-size: 0.95rem;
            font-weight: 700;
            color: #065f46;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 1.25rem;
            margin-top: 1rem;
        }

        .form-section-divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: #e2e8f0;
        }

        .form-label {
            font-weight: 600;
            font-size: 0.88rem;
            color: #334155;
            margin-bottom: 0.35rem;
        }

        .form-control,
        .form-select {
            border-radius: 10px;
            padding: 0.7rem 0.95rem;
            border: 1.5px solid #cbd5e1;
            font-size: 0.92rem;
            transition: all 0.2s ease;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #059669;
            box-shadow: 0 0 0 4px rgba(5, 150, 105, 0.15);
        }

        /* Kartu Peserta Ujian Modal Styling */
        .kartu-ujian {
            background: #ffffff;
            border: 2px dashed #065f46;
            border-radius: 16px;
            padding: 2rem;
            position: relative;
        }

        .kartu-header {
            border-bottom: 2px solid #065f46;
            padding-bottom: 1rem;
            margin-bottom: 1.5rem;
        }

        /* Filter Tab Buttons */
        .filter-btn {
            border: 1px solid #cbd5e1;
            background: #ffffff;
            color: #475569;
            font-weight: 600;
            font-size: 0.88rem;
            padding: 0.5rem 1.2rem;
            border-radius: 9999px;
            transition: all 0.2s ease;
        }

        .filter-btn:hover,
        .filter-btn.active {
            background: #065f46;
            color: #ffffff;
            border-color: #065f46;
            box-shadow: 0 4px 10px rgba(6, 95, 70, 0.2);
        }

        @media print {
            body * {
                visibility: hidden;
            }

            #kartuUjianArea,
            #kartuUjianArea * {
                visibility: visible;
            }

            #kartuUjianArea {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
            }

            .no-print {
                display: none !important;
            }
        }

        /* 4 Video Hero Slideshow Styling */
        .hero-slideshow-section {
            background: linear-gradient(180deg, #022c22 0%, #064e3b 50%, #065f46 100%);
            border-bottom: 2px solid rgba(217, 119, 6, 0.3);
            position: relative;
        }

        .hero-video-card {
            background: rgba(2, 44, 34, 0.85);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(254, 240, 138, 0.25);
            border-radius: 20px;
            overflow: hidden;
            transition: all 0.3s ease;
            box-shadow: 0 20px 35px rgba(0, 0, 0, 0.35);
        }

        .hero-video-card:hover {
            border-color: #f59e0b;
            box-shadow: 0 25px 45px rgba(0, 0, 0, 0.45);
        }

        .hero-video-thumb {
            position: relative;
            height: 380px;
            background: #000000;
            cursor: pointer;
            overflow: hidden;
        }

        @media (max-width: 768px) {
            .hero-video-thumb {
                height: 240px;
            }
        }

        .hero-video-thumb img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .hero-video-card:hover .hero-video-thumb img {
            transform: scale(1.05);
        }

        .hero-play-btn {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 76px;
            height: 76px;
            background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);
            color: #ffffff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 0 30px rgba(220, 38, 38, 0.85);
            transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            z-index: 2;
        }

        .hero-video-thumb:hover .hero-play-btn {
            transform: translate(-50%, -50%) scale(1.18);
            background: #ef4444;
            box-shadow: 0 0 40px rgba(239, 68, 68, 1);
        }

        .hero-carousel-indicators [data-bs-target] {
            width: 36px;
            height: 6px;
            border-radius: 4px;
            background-color: rgba(255, 255, 255, 0.35);
            border: none;
            margin: 0 6px;
            transition: all 0.3s ease;
        }

        .hero-carousel-indicators .active {
            background-color: #f59e0b;
            width: 54px;
        }

        /* Profil, Visi Misi, Struktur Section Styling */
        .profil-tab-nav {
            background: #f1f5f9;
            padding: 6px;
            border-radius: 9999px;
            display: inline-flex;
            gap: 4px;
            box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.04);
            border: 1px solid #e2e8f0;
        }

        .profil-tab-btn {
            border: none;
            background: transparent;
            color: #475569;
            font-weight: 700;
            font-size: 0.88rem;
            padding: 0.6rem 1.35rem;
            border-radius: 9999px;
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            white-space: nowrap;
            text-decoration: none;
        }

        .profil-tab-btn:hover {
            color: #065f46;
            background: rgba(255, 255, 255, 0.7);
        }

        .profil-tab-btn.active {
            background: linear-gradient(135deg, #065f46 0%, #047857 100%);
            color: #ffffff !important;
            box-shadow: 0 4px 14px rgba(6, 95, 70, 0.28);
        }

        .profil-hero-card {
            background: linear-gradient(145deg, #022c22 0%, #064e3b 60%, #065f46 100%);
            border-radius: 20px;
            color: #ffffff;
            position: relative;
            overflow: hidden;
            border: 1px solid rgba(254, 240, 138, 0.25);
            box-shadow: 0 15px 30px rgba(2, 44, 34, 0.15);
        }

        .profil-hero-pattern {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: radial-gradient(rgba(255, 255, 255, 0.08) 1.2px, transparent 1.2px);
            background-size: 20px 20px;
            pointer-events: none;
        }

        .pilar-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            padding: 1.5rem;
            transition: all 0.3s ease;
            height: 100%;
        }

        .pilar-card:hover {
            transform: translateY(-5px);
            border-color: #10b981;
            box-shadow: 0 16px 25px -5px rgba(6, 95, 70, 0.1);
        }

        .pilar-icon-box {
            width: 52px;
            height: 52px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }

        .vision-banner {
            background: linear-gradient(135deg, #022c22 0%, #064e3b 100%);
            border-left: 6px solid #f59e0b;
            border-radius: 16px;
            color: #ffffff;
            padding: 2.25rem;
            position: relative;
            box-shadow: 0 12px 28px rgba(2, 44, 34, 0.15);
        }

        .mission-step-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            padding: 1.5rem;
            height: 100%;
            transition: all 0.3s ease;
            position: relative;
        }

        .mission-step-card:hover {
            border-color: #d97706;
            box-shadow: 0 12px 24px rgba(217, 119, 6, 0.12);
            transform: translateY(-4px);
        }

        .mission-badge-num {
            width: 42px;
            height: 42px;
            border-radius: 12px;
            background: linear-gradient(135deg, #d97706 0%, #b45309 100%);
            color: #ffffff;
            font-weight: 800;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            box-shadow: 0 4px 10px rgba(217, 119, 6, 0.25);
            flex-shrink: 0;
        }

        .panca-jiwa-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            padding: 1.25rem;
            text-align: center;
            transition: all 0.25s ease;
            height: 100%;
        }

        .panca-jiwa-card:hover {
            background: #ecfdf5;
            border-color: #059669;
            transform: translateY(-3px);
            box-shadow: 0 8px 16px rgba(5, 150, 105, 0.08);
        }

        /* Struktur Organisasi Tree / Hierarchy */
        .org-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            padding: 1.5rem;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            height: 100%;
            display: flex;
            flex-direction: column;
            position: relative;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.03);
        }

        .org-card:hover {
            transform: translateY(-6px);
            border-color: #059669;
            box-shadow: 0 20px 25px -5px rgba(6, 95, 70, 0.12), 0 8px 10px -6px rgba(6, 95, 70, 0.08);
        }

        .org-card.leader-card {
            border: 2px solid #f59e0b;
            background: linear-gradient(180deg, #ffffff 0%, #fefce8 100%);
            box-shadow: 0 10px 25px rgba(217, 119, 6, 0.12);
        }

        .org-avatar-wrapper {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: linear-gradient(135deg, #065f46 0%, #047857 100%);
            color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            margin: 0 auto 1rem auto;
            border: 4px solid #f8fafc;
            box-shadow: 0 4px 14px rgba(6, 95, 70, 0.25);
            position: relative;
        }

        .org-card.leader-card .org-avatar-wrapper {
            width: 96px;
            height: 96px;
            background: linear-gradient(135deg, #d97706 0%, #b45309 100%);
            border-color: #fef08a;
            box-shadow: 0 6px 18px rgba(217, 119, 6, 0.35);
        }

        .org-tree-line {
            width: 2px;
            height: 24px;
            background: #cbd5e1;
            margin: 0 auto;
        }

        .org-avatar-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
        }
    </style>
</head>

<body>

    <!-- Topbar Info (Kompak, Proporsional & Selalu Pas) -->
    <div class="topbar-info py-1 border-bottom border-success border-opacity-25">
        <div class="container-fluid px-3 px-lg-4 d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center gap-2 text-nowrap">
                <span class="font-arabic text-warning" style="font-size: 0.95rem;">بِسْمِ اللَّهِ الرَّحْمَٰنِ
                    الرَّحِيمِ</span>
                <span class="text-white-50 opacity-50 d-none d-md-inline">|</span>
                <span class="text-white-50 d-none d-xxl-inline" style="font-size: 0.76rem;"><i
                        class="bi bi-geo-alt-fill text-warning me-1"></i> {{ $ppdbSetting->alamat }}</span>
                <span class="text-white-50 d-none d-sm-inline" style="font-size: 0.76rem;"><i
                        class="bi bi-telephone-fill text-warning me-1"></i> {{ $ppdbSetting->telepon }}</span>
            </div>
            <div class="d-flex align-items-center gap-2 text-nowrap">
                <span
                    class="badge {{ $ppdbSetting->status_badge_class }} px-2 py-1 fw-semibold d-none d-md-inline-block"
                    style="font-size: 0.72rem;">
                    <i class="bi bi-bell-fill me-1"></i> PPDB {{ $ppdbSetting->tahun_ajaran }} ({{ $sisaKuotaPpdb }}
                    Sisa Kuota)
                </span>

                @guest
                    <!-- Akses Login Pengguna (Admin, Pengajar, Pendidik) -->
                    <a href="{{ route('login') }}"
                        class="btn btn-outline-light btn-sm py-0 px-2 fw-medium d-inline-flex align-items-center gap-1 text-decoration-none"
                        style="font-size: 0.72rem; border-color: rgba(255,255,255,0.3);">
                        <i class="bi bi-shield-lock-fill text-warning"></i> Login Pengguna
                    </a>
                @else
                    <!-- Akun Pengguna Sedang Login -->
                    <div class="d-inline-flex align-items-center gap-2">
                        <span class="text-white-50 d-none d-md-inline" style="font-size: 0.75rem;">
                            <i class="bi bi-person-circle text-warning"></i> {{ Auth::user()->name }}
                            <span class="badge bg-success bg-opacity-75 ms-1 py-0 px-1"
                                style="font-size: 0.68rem;">{{ Auth::user()->role_label }}</span>
                        </span>
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-link text-white-50 p-0 text-decoration-none"
                                style="font-size: 0.72rem;">
                                <i class="bi bi-box-arrow-right"></i> Keluar
                            </button>
                        </form>
                    </div>
                @endguest
            </div>
        </div>
    </div>

    <!-- Announcement Headline Banner (Kompak & Elegan) -->
    @if ($ppdbSetting->pengumuman_banner)
        <div class="py-1 px-3 text-center text-white shadow-sm"
            style="background: linear-gradient(90deg, #92400e 0%, #d97706 50%, #92400e 100%); font-size: 0.8rem;">
            <div
                class="container-fluid px-3 px-lg-4 d-flex align-items-center justify-content-center gap-2 text-nowrap overflow-hidden">
                <span class="badge bg-white text-dark fw-bold text-uppercase py-0 px-2"
                    style="font-size: 0.68rem; letter-spacing: 0.05em;">PENGUMUMAN</span>
                <span class="text-truncate fw-normal"
                    style="max-width: 700px;">{{ $ppdbSetting->pengumuman_banner }}</span>
                <a href="#alur-ujian" class="text-warning text-decoration-underline fw-bold ms-1"
                    style="font-size: 0.78rem;">Lihat Detail &raquo;</a>
            </div>
        </div>
    @endif

    <!-- Main Navigation Bar -->
    <nav class="navbar navbar-expand-lg main-navbar sticky-top py-2">
        <div class="container-fluid px-3 px-lg-4">
            <!-- Brand -->
            <a class="navbar-brand d-flex align-items-center gap-2 me-2 text-nowrap" href="{{ route('landing') }}">
                @if ($ppdbSetting->logo_url)
                    <img src="{{ $ppdbSetting->logo_url }}" alt="Logo Pesantren"
                        class="rounded-3 shadow-sm flex-shrink-0 bg-white p-1"
                        style="width: 46px; height: 46px; object-fit: contain;">
                @else
                    <span
                        class="d-inline-flex align-items-center justify-content-center bg-success text-white rounded-3 shadow-sm flex-shrink-0"
                        style="width: 34px; height: 34px;">
                        <i class="bi bi-book-half fs-5"></i>
                    </span>
                @endif
                <div class="lh-1">
                    <span class="fw-bold text-dark tracking-tight d-block text-uppercase"
                        style="font-size: 0.92rem; letter-spacing: -0.01em;">{{ $ppdbSetting->nama_pesantren }}</span>
                    <small class="text-muted fw-semibold" style="font-size: 0.65rem; letter-spacing: 0.05em;">PORTAL
                        KEGIATAN &amp; PPDB</small>
                </div>
            </a>

            <!-- Mobile Toggler -->
            <button class="navbar-toggler border-0 shadow-none px-2 py-1" type="button" data-bs-toggle="collapse"
                data-bs-target="#landingNav" aria-controls="landingNav" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon" style="width: 1.2rem; height: 1.2rem;"></span>
            </button>

            <!-- Nav Links & Actions -->
            <div class="collapse navbar-collapse" id="landingNav">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link py-1 px-2 text-nowrap" href="#beranda">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link py-1 px-2 text-nowrap" href="#profil"><i
                                class="bi bi-bank text-success me-1"></i> Profil Lembaga</a></li>
                    <li class="nav-item"><a class="nav-link py-1 px-2 text-nowrap" href="#video-slideshow"><i
                                class="bi bi-play-circle-fill text-danger me-1"></i> Video Pilihan</a></li>
                    <li class="nav-item"><a class="nav-link py-1 px-2 text-nowrap" href="#kegiatan">Dokumentasi</a></li>
                    <li class="nav-item"><a class="nav-link py-1 px-2 text-nowrap" href="#video">Galeri</a></li>
                    <li class="nav-item"><a class="nav-link py-1 px-2 text-nowrap" href="#alur-ujian">Alur Ujian</a>
                    </li>
                    <li class="nav-item"><a class="nav-link py-1 px-2 text-nowrap" href="#formulir-ppdb">Formulir
                            PPDB</a></li>
                    <li class="nav-item"><a class="nav-link py-1 px-2 text-nowrap" href="#kontak">Kontak</a></li>
                </ul>

                <!-- Action Button: Tombol Login Pengguna & Pendaftaran PPDB -->
                <div class="d-flex align-items-center gap-2 text-nowrap flex-shrink-0 mt-2 mt-lg-0">
                    @guest
                        <a href="{{ route('login') }}"
                            class="btn btn-outline-success btn-sm py-1 px-3 fw-semibold d-inline-flex align-items-center gap-1 shadow-sm"
                            style="font-size: 0.78rem;" title="Akses Login Pengguna: Admin, Pengajar, Pendidik">
                            <i class="bi bi-shield-lock-fill"></i> Login Pengguna
                        </a>
                    @else
                        <a href="{{ route('login') }}"
                            class="btn btn-outline-success btn-sm py-1 px-3 fw-semibold d-inline-flex align-items-center gap-1 shadow-sm"
                            style="font-size: 0.78rem;" title="Akses Pengguna (Admin, Pengajar, Pendidik)">
                            <i class="bi bi-person-badge-fill"></i> Login Pengguna
                        </a>
                    @endguest
                    <a href="#formulir-ppdb"
                        class="btn btn-gold btn-sm py-1 px-3 d-inline-flex align-items-center gap-1 shadow-sm fw-semibold"
                        style="font-size: 0.78rem; border-radius: 9999px;">
                        <i class="bi bi-pencil-square"></i> Daftar PPDB
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- ============================================================== -->
    <!-- SLIDE SHOW PALING ATAS: 4 VIDEO TERATAS (DIKELOLA DARI ADMIN)  -->
    <!-- ============================================================== -->
    <section id="video-slideshow" class="hero-slideshow-section py-4 py-lg-5 text-white">
        <div class="container">
            <div
                class="d-flex flex-wrap align-items-center justify-content-between mb-3 pb-2 border-bottom border-white border-opacity-10">
                <div class="d-flex align-items-center gap-2">
                    <span class="badge bg-danger px-3 py-2 fw-bold text-uppercase fs-6 shadow-sm">
                        <i class="bi bi-broadcast me-1"></i> TAYANGAN PILIHAN
                    </span>
                    <h3 class="fw-bold mb-0 text-white fs-4">Slide Show 4 Video Unggulan Santri</h3>
                </div>
                <div class="text-white-50 small mt-2 mt-sm-0">
                    <i class="bi bi-info-circle text-warning me-1"></i> Video dikelola langsung dari halaman Admin
                </div>
            </div>

            <!-- Carousel Slide Show 4 Video -->
            <div id="carouselTopVideos" class="carousel slide" data-bs-ride="carousel" data-bs-interval="6000">
                <!-- Indicators -->
                <div class="carousel-indicators hero-carousel-indicators mb-0" style="bottom: -2.5rem;">
                    @foreach ($heroVideos->take(4) as $idx => $vid)
                        <button type="button" data-bs-target="#carouselTopVideos"
                            data-bs-slide-to="{{ $idx }}" class="{{ $idx === 0 ? 'active' : '' }}"
                            aria-label="Video {{ $idx + 1 }}"></button>
                    @endforeach
                </div>

                <!-- Carousel Items -->
                <div class="carousel-inner rounded-4 pb-2">
                    @forelse($heroVideos->take(4) as $index => $heroVideo)
                        <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                            <div class="hero-video-card">
                                <div class="row g-0 align-items-center">
                                    <!-- Video Thumbnail & Play Button Column -->
                                    <div class="col-lg-7">
                                        <div class="hero-video-thumb position-relative"
                                            onclick="putarVideoModal('{{ $heroVideo->is_local_video ? $heroVideo->video_url : $heroVideo->youtube_id }}', '{{ addslashes($heroVideo->judul) }}', {{ $heroVideo->is_local_video ? 'true' : 'false' }})"
                                            title="Klik untuk memutar video">
                                            <img src="{{ $heroVideo->thumbnail_url }}" alt="{{ $heroVideo->judul }}"
                                                loading="lazy">

                                            <!-- Glowing Play Button -->
                                            <div class="hero-play-btn">
                                                <i class="bi bi-play-fill fs-1 text-white ms-1"></i>
                                            </div>

                                            <!-- Badges on Video -->
                                            <div class="position-absolute top-0 start-0 m-3 d-flex flex-wrap gap-2">
                                                <span class="badge bg-danger fs-6 px-3 py-2 shadow-sm">
                                                    <i class="bi bi-play-btn-fill me-1"></i> Video Teratas
                                                    #{{ $index + 1 }}
                                                </span>
                                                <span class="badge bg-dark bg-opacity-75 fs-6 px-3 py-2">
                                                    {{ $heroVideo->kategori }}
                                                </span>
                                            </div>

                                            <div class="position-absolute bottom-0 end-0 m-3">
                                                <span class="badge bg-dark bg-opacity-90 px-3 py-2 fs-6">
                                                    <i class="bi bi-clock-fill text-warning me-1"></i>
                                                    {{ $heroVideo->durasi }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Video Info Details Column -->
                                    <div class="col-lg-5 p-4 p-md-5 d-flex flex-column justify-content-between h-100">
                                        <div>
                                            <div class="d-flex align-items-center gap-2 mb-3">
                                                <span class="badge bg-warning text-dark fw-bold">SLIDE
                                                    {{ $index + 1 }} DARI
                                                    {{ $heroVideos->take(4)->count() }}</span>
                                                <span class="text-white-50 small">&bull; Kualitas Full HD</span>
                                            </div>

                                            <h3 class="fw-bold text-white mb-3 lh-sm" style="font-size: 1.65rem;">
                                                {{ $heroVideo->judul }}
                                            </h3>

                                            <p class="text-white-75 mb-4"
                                                style="font-size: 0.95rem; line-height: 1.6;">
                                                {{ $heroVideo->deskripsi ?? 'Dokumentasi visual kegiatan santri Pondok Pesantren Modern Li Ulil Albab. Menyajikan kehidupan berasrama, kajian kitab, dan pembinaan tahfidz Al-Qur\'an.' }}
                                            </p>
                                        </div>

                                        <div
                                            class="d-flex flex-wrap gap-2 pt-3 border-top border-white border-opacity-15">
                                            <button type="button"
                                                class="btn btn-danger btn-lg px-4 fw-bold d-inline-flex align-items-center gap-2 shadow"
                                                onclick="putarVideoModal('{{ $heroVideo->is_local_video ? $heroVideo->video_url : $heroVideo->youtube_id }}', '{{ addslashes($heroVideo->judul) }}', {{ $heroVideo->is_local_video ? 'true' : 'false' }})">
                                                <i class="bi bi-play-circle-fill fs-5"></i> Putar Video Sekarang
                                            </button>
                                            <a href="#formulir-ppdb" class="btn btn-outline-light btn-lg px-4">
                                                Daftar PPDB &rarr;
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="carousel-item active">
                            <div class="p-5 text-center bg-dark rounded-4">
                                <i class="bi bi-play-btn text-warning fs-1 mb-3"></i>
                                <h4 class="text-white">Slideshow Video Sedang Disiapkan</h4>
                                <p class="text-white-50">Admin dapat menandai 4 video unggulan untuk ditampilkan di
                                    sini.</p>
                            </div>
                        </div>
                    @endforelse
                </div>

                <!-- Carousel Controls -->
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselTopVideos"
                    data-bs-slide="prev" style="width: 5%; opacity: 0.8;">
                    <span class="carousel-control-prev-icon p-3 bg-dark bg-opacity-75 rounded-circle"
                        aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselTopVideos"
                    data-bs-slide="next" style="width: 5%; opacity: 0.8;">
                    <span class="carousel-control-next-icon p-3 bg-dark bg-opacity-75 rounded-circle"
                        aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </section>

    <!-- Success PPDB Notification (if returned from backend) -->
    @if (session('ppdb_success'))
        <div class="bg-success text-white py-3 text-center position-relative shadow-sm">
            <div class="container d-flex flex-wrap align-items-center justify-content-between gap-3">
                <div class="d-flex align-items-center gap-2 text-start">
                    <i class="bi bi-check-circle-fill fs-3 text-warning"></i>
                    <div>
                        <strong>Pendaftaran PPDB Berhasil!</strong> Nomor Registrasi: <span
                            class="badge bg-warning text-dark fs-6">{{ session('ppdb_success')['no_pendaftaran'] }}</span>
                        <div class="small">Atas nama <strong>{{ session('ppdb_success')['nama_lengkap'] }}</strong>
                            ({{ session('ppdb_success')['jenjang'] }}) telah terdata untuk Ujian Masuk.</div>
                    </div>
                </div>
                <button type="button" class="btn btn-light btn-sm fw-bold px-3"
                    onclick="bukaKartuUjianDariSession()">
                    <i class="bi bi-printer me-1"></i> Lihat &amp; Cetak Kartu Ujian Masuk
                </button>
            </div>
        </div>
    @endif

    <!-- Hero Section -->
    <header id="beranda" class="hero-section">
        <div class="hero-pattern"></div>
        <div class="container position-relative py-lg-4">
            <div class="row align-items-center gy-5">
                <div class="col-lg-7">
                    <!-- Badge -->
                    <div class="mb-3">
                        <span class="hero-badge">
                            <i class="bi bi-star-fill text-warning"></i>
                            Penerimaan Santri Baru (PPDB) Tahun Ajaran 2026/2027 Dibuka
                        </span>
                    </div>

                    <!-- Main Headline -->
                    <h1 class="display-4 fw-extrabold mb-3 text-white lh-sm" style="font-weight: 800;">
                        Portal Informasi Kegiatan Santri &amp; <span style="color: #fef08a;">PPDB Online</span>
                    </h1>

                    <!-- Arabic Quote -->
                    <div class="font-arabic fs-4 text-warning mb-3">
                        « (Al-Mujadilah:11) يَرْفَعِ اللَّهُ الَّذِينَ آمَنُوا مِنكُمْ وَالَّذِينَ أُوتُوا الْعِلْمَ
                        دَرَجَاتٍ ... »
                    </div>

                    <p class="lead text-white-50 mb-4 pe-lg-3">
                        Selamat datang di portal informasi resmi Pondok Pesantren Modern Li Ulil Albab. Saksikan
                        dokumentasi aktivitas keseharian santri, tonton liputan video program unggulan, dan daftarkan
                        putra-putri Anda melalui seleksi ujian masuk terpadu.
                    </p>

                    <!-- CTA Buttons -->
                    <div class="d-flex flex-wrap align-items-center gap-3 mb-4">
                        <a href="#formulir-ppdb" class="btn btn-gold btn-lg d-flex align-items-center gap-2">
                            <i class="bi bi-file-earmark-text-fill"></i> Isi Formulir PPDB Online
                        </a>
                        <a href="#alur-ujian" class="btn btn-outline-light btn-lg d-flex align-items-center gap-2">
                            <i class="bi bi-info-circle-fill"></i> Alur &amp; Syarat Ujian
                        </a>
                        <a href="#kegiatan"
                            class="btn btn-link text-white text-decoration-none fw-semibold d-flex align-items-center gap-1">
                            <i class="bi bi-camera-fill text-warning"></i> Dokumentasi Kegiatan &rarr;
                        </a>
                    </div>

                    <!-- Highlight Badges -->
                    <div class="d-flex flex-wrap align-items-center gap-4 pt-2 text-white-50 small">
                        <div><i class="bi bi-check-circle-fill text-success me-1"></i> Terakreditasi A (Unggul)</div>
                        <div><i class="bi bi-check-circle-fill text-success me-1"></i> Tahfidz 30 Juz Bersanad</div>
                        <div><i class="bi bi-check-circle-fill text-success me-1"></i> Ujian Masuk Online &amp; Offline
                        </div>
                    </div>
                </div>

                <!-- Hero Quick Announcement & Fast Access Card -->
                <div class="col-lg-5">
                    <div class="bg-white rounded-4 p-4 p-md-4 text-dark shadow-lg border-0 position-relative">
                        <div class="d-flex align-items-center justify-content-between mb-3 pb-2 border-bottom">
                            <div>
                                <span class="badge bg-success bg-opacity-10 text-success fw-bold">INFO SELEKSI
                                    MASUK</span>
                                <h5 class="fw-bold mb-0 text-dark">Jadwal PPDB 2026/2027</h5>
                            </div>
                            <span class="p-2 rounded-circle bg-success text-white">
                                <i class="bi bi-calendar-check fs-4"></i>
                            </span>
                        </div>

                        <div
                            class="alert alert-warning border-0 d-flex align-items-center gap-3 py-2 px-3 rounded-3 mb-3">
                            <i class="bi bi-clock-history fs-3 text-warning"></i>
                            <div class="small">
                                <strong>Gelombang I Sedang Berlangsung!</strong><br>
                                Batas Akhir Pendaftaran: <strong>30 Mei 2027</strong>
                            </div>
                        </div>

                        <ul class="list-group list-group-flush mb-4 small">
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0 py-2">
                                <span><i class="bi bi-calendar-event text-success me-2"></i>Pelaksanaan Ujian
                                    Masuk:</span>
                                <strong class="text-dark">13 - 14 Juni 2027</strong>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0 py-2">
                                <span><i class="bi bi-journal-check text-primary me-2"></i>Materi Ujian Seleksi:</span>
                                <span class="badge bg-primary text-white">Al-Qur'an &amp; Wawancara</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0 py-2">
                                <span><i class="bi bi-megaphone text-danger me-2"></i>Pengumuman Kelulusan:</span>
                                <strong class="text-success">20 Juni 2027</strong>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0 py-2">
                                <span><i class="bi bi-door-open text-warning me-2"></i>Kedatangan Masuk Asrama:</span>
                                <strong class="text-dark">10 Juli 2027</strong>
                            </li>
                        </ul>

                        <div class="d-grid gap-2">
                            <a href="#formulir-ppdb" class="btn btn-pesantren">
                                <i class="bi bi-pencil-square me-1"></i> Daftar Sekarang &amp; Dapatkan Nomor Ujian
                            </a>
                            <a href="#video" class="btn btn-outline-dark btn-sm">
                                <i class="bi bi-play-circle-fill text-danger me-1"></i> Tonton Video Profil Santri
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Quick Stats Dinamis -->
    <section class="py-4 bg-light border-bottom">
        <div class="container">
            <div class="row g-3 text-center">
                <div class="col-6 col-md-3">
                    <div class="p-3 bg-white rounded-3 shadow-sm border">
                        <div class="fs-2 fw-bold text-success" id="statTotalSantri">
                            {{ number_format($totalSantri) }}+</div>
                        <div class="small fw-semibold text-secondary">Santri Aktif Mukim</div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="p-3 bg-white rounded-3 shadow-sm border">
                        <div class="fs-2 fw-bold text-warning" id="statTotalAsatidz">{{ $totalAsatidz }}+</div>
                        <div class="small fw-semibold text-secondary">Dewan Asatidz &amp; Mursyid</div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="p-3 bg-white rounded-3 shadow-sm border">
                        <div class="fs-2 fw-bold text-primary" id="statPendaftarPpdb">{{ $totalPendaftarPpdb }}</div>
                        <div class="small fw-semibold text-secondary">Santri Baru Terdaftar (PPDB)</div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="p-3 bg-white rounded-3 shadow-sm border">
                        <div class="fs-2 fw-bold text-danger" id="statSisaKuota">{{ $sisaKuotaPpdb }}</div>
                        <div class="small fw-semibold text-secondary">Sisa Kuota PPDB {{ $ppdbSetting->tahun_ajaran }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ============================================================== -->
    <!-- SECTION PROFIL, VISI MISI & STRUKTUR KEPENGURUSAN PESANTREN    -->
    <!-- (Terintegrasi Dalam Satu Halaman / Unified Comprehensive Portal) -->
    <!-- ============================================================== -->
    <section id="profil" class="py-5" style="background-color: #f8fafc;">
        <div class="container py-lg-4">
            <!-- Header Section -->
            <div class="text-center max-w-xl mx-auto mb-4">
                <span class="section-tag"><i class="bi bi-bank me-1"></i> Profil Lembaga</span>
                <h2 class="section-title mb-2">Profil, Visi Misi &amp; Struktur Organisasi</h2>
                <p class="text-muted">Mengenal lebih dekat arah perjuangan tarbiyah, filosofi nama, nilai luhur, dan jajaran dewan asatidz pembina Pondok Pesantren Modern Li Ulil Albab dalam satu halaman terpadu.</p>
            </div>

            <!-- Tab Pills Selector (Bootstrap 5 Tab Navigation) -->
            <div class="d-flex justify-content-center mb-5">
                <div class="profil-tab-nav" role="tablist">
                    <button class="profil-tab-btn active" id="tab-profil-btn" data-bs-toggle="pill" data-bs-target="#tab-profil" type="button" role="tab" aria-controls="tab-profil" aria-selected="true">
                        <i class="bi bi-building"></i> Profil &amp; Sejarah
                    </button>
                    <button class="profil-tab-btn" id="tab-visimisi-btn" data-bs-toggle="pill" data-bs-target="#tab-visimisi" type="button" role="tab" aria-controls="tab-visimisi" aria-selected="false">
                        <i class="bi bi-compass"></i> Visi, Misi &amp; Nilai
                    </button>
                    <button class="profil-tab-btn" id="tab-struktur-btn" data-bs-toggle="pill" data-bs-target="#tab-struktur" type="button" role="tab" aria-controls="tab-struktur" aria-selected="false">
                        <i class="bi bi-diagram-3-fill"></i> Struktur Kepengurusan
                    </button>
                </div>
            </div>

            <!-- Tab Content Area -->
            <div class="tab-content" id="profilTabContent">

                <!-- ========================================== -->
                <!-- TAB 1: PROFIL & SEJARAH PESANTREN         -->
                <!-- ========================================== -->
                <div class="tab-pane fade show active" id="tab-profil" role="tabpanel" aria-labelledby="tab-profil-btn" tabindex="0">
                    <!-- Sambutan Pengasuh Card -->
                    <div class="profil-hero-card p-4 p-lg-5 mb-5">
                        <div class="profil-hero-pattern"></div>
                        <div class="row align-items-center gy-4 position-relative">
                            <div class="col-lg-4 text-center">
                                <div class="p-3 bg-white bg-opacity-10 rounded-4 border border-white border-opacity-20 d-inline-block shadow">
                                    <div class="rounded-circle bg-warning text-dark mx-auto d-flex align-items-center justify-content-center shadow-lg mb-3 overflow-hidden position-relative" style="width: 120px; height: 120px; font-size: 3rem; border: 4px solid rgba(255,255,255,0.6);">
                                        @if($ppdbSetting->sambutan_pengasuh_foto_url)
                                            <img src="{{ $ppdbSetting->sambutan_pengasuh_foto_url }}" alt="{{ $ppdbSetting->sambutan_pengasuh_nama }}" style="width: 100%; height: 100%; object-fit: cover;">
                                        @else
                                            <i class="bi bi-person-badge-fill"></i>
                                        @endif
                                    </div>
                                    <h5 class="fw-bold text-white mb-1">{{ $ppdbSetting->sambutan_pengasuh_nama }}</h5>
                                    <span class="badge bg-warning text-dark fw-bold px-3 py-1 mb-2">{{ $ppdbSetting->sambutan_pengasuh_jabatan }}</span>
                                    <div class="small text-white-50">Pengasuh Utama Lembaga Pesantren</div>
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <span class="badge bg-success-subtle text-success-emphasis border border-success-subtle px-3 py-1 fw-bold text-uppercase mb-3" style="font-size: 0.78rem;">
                                    <i class="bi bi-quote me-1"></i> Kalimat Sambutan Pengasuh
                                </span>
                                <h3 class="fw-bold text-white mb-3" style="font-size: 1.85rem; line-height: 1.35;">
                                    "{{ $ppdbSetting->sambutan_pengasuh_quote }}"
                                </h3>
                                <p class="text-white-75 mb-3" style="line-height: 1.7; font-size: 0.98rem; white-space: pre-line;">
                                    {{ $ppdbSetting->sambutan_pengasuh_teks }}
                                </p>
                                <div class="d-flex flex-wrap align-items-center gap-3 pt-2 text-white-50 small">
                                    <div><i class="bi bi-check2-circle text-warning me-1"></i> Berdiri Sejak Tahun 2012</div>
                                    <div><i class="bi bi-check2-circle text-warning me-1"></i> Pesantren Terakreditasi Unggul (A)</div>
                                    <div><i class="bi bi-check2-circle text-warning me-1"></i> Terdaftar di Kemenag RI</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Filosofi Nama & Sejarah Pendirian -->
                    <div class="row g-4 mb-5">
                        <div class="col-lg-6">
                            <div class="p-4 p-md-5 rounded-4 bg-white border h-100 shadow-sm">
                                <div class="d-flex align-items-center gap-3 mb-3">
                                    <span class="p-2 bg-success text-white rounded-3 shadow-sm">
                                        <i class="bi bi-book-half fs-4"></i>
                                    </span>
                                    <div>
                                        <h5 class="fw-bold mb-0 text-dark">Filosofi Nama "Li Ulil Albab"</h5>
                                        <small class="text-muted">Landasan Spiritual &amp; Makna Filosofis</small>
                                    </div>
                                </div>
                                <div class="p-3 bg-light rounded-3 border-start border-4 border-success mb-3">
                                    <div class="font-arabic fs-4 text-success text-end mb-2" dir="rtl">
                                        إِنَّ فِي خَلْقِ السَّمَاوَاتِ وَالْأَرْضِ وَاخْتِلَافِ اللَّيْلِ وَالنَّهَارِ لَآيَاتٍ لِّأُولِي الْأَلْبَابِ
                                    </div>
                                    <small class="text-muted d-block fst-italic">
                                        "Sesungguhnya dalam penciptaan langit dan bumi, dan silih bergantinya malam dan siang terdapat tanda-tanda bagi Ulil Albab (orang-orang yang berakal)." (QS. Ali 'Imran: 190)
                                    </small>
                                </div>
                                <div class="text-muted small mb-0" style="line-height: 1.7; white-space: pre-line;">
                                    {!! nl2br(e($ppdbSetting->filosofi_nama)) !!}
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="p-4 p-md-5 rounded-4 bg-white border h-100 shadow-sm">
                                <div class="d-flex align-items-center gap-3 mb-3">
                                    <span class="p-2 bg-warning text-dark rounded-3 shadow-sm">
                                        <i class="bi bi-hourglass-split fs-4"></i>
                                    </span>
                                    <div>
                                        <h5 class="fw-bold mb-0 text-dark">Sejarah Singkat Pendirian</h5>
                                        <small class="text-muted">Perjalanan Dedikasi &amp; Perkembangan</small>
                                    </div>
                                </div>
                                @if($ppdbSetting->sejarah_foto_url)
                                    <div class="mb-3 rounded-3 overflow-hidden shadow-sm" style="max-height: 200px;">
                                        <img src="{{ $ppdbSetting->sejarah_foto_url }}" alt="Gedung &amp; Sejarah Pesantren" style="width: 100%; height: 100%; object-fit: cover;">
                                    </div>
                                @endif
                                <div class="text-muted small mb-3" style="line-height: 1.7; white-space: pre-line;">
                                    {!! nl2br(e($ppdbSetting->sejarah_singkat)) !!}
                                </div>
                                <div class="d-flex align-items-center gap-2 pt-2 border-top">
                                    <span class="badge bg-success bg-opacity-10 text-success fw-bold">NSPP: 510035780099</span>
                                    <span class="badge bg-primary bg-opacity-10 text-primary fw-bold">SK Kemenag RI</span>
                                    <span class="badge bg-warning bg-opacity-10 text-warning-emphasis fw-bold">Akreditasi A</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 4 Pilar Keunggulan Pendidikan -->
                    <div class="mb-5">
                        <div class="text-center mb-4">
                            <h4 class="fw-bold text-dark mb-1">4 Pilar Keunggulan Kurikulum Pesantren</h4>
                            <p class="text-muted small">Ciri khas pendidikan terpadu yang membedakan santri Li Ulil Albab</p>
                        </div>
                        <div class="row g-4">
                            <div class="col-md-6 col-lg-3">
                                <div class="pilar-card">
                                    <div class="pilar-icon-box bg-success bg-opacity-10 text-success">
                                        <i class="bi bi-book-half"></i>
                                    </div>
                                    <h6 class="fw-bold text-dark mb-2">1. Tahfidz 30 Juz Bersanad</h6>
                                    <p class="text-muted small mb-0">Bimbingan talaqqi, metode mutqin, muraja'ah harian terpantau, dan ujian tasmi' bil-ghaib di hadapan masyayikh berijazah sanad.</p>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-3">
                                <div class="pilar-card">
                                    <div class="pilar-icon-box bg-warning bg-opacity-10 text-warning">
                                        <i class="bi bi-journal-bookmark-fill"></i>
                                    </div>
                                    <h6 class="fw-bold text-dark mb-2">2. Turats &amp; Kitab Salaf</h6>
                                    <p class="text-muted small mb-0">Kajian sistematis kitab kuning madzhab Syafi'i (Safinah, Taqrib, Jurumiyyah, Arbain Nawawi) untuk memperkokoh akidah dan fiqih harian.</p>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-3">
                                <div class="pilar-card">
                                    <div class="pilar-icon-box bg-primary bg-opacity-10 text-primary">
                                        <i class="bi bi-translate"></i>
                                    </div>
                                    <h6 class="fw-bold text-dark mb-2">3. Bilingual Arab &amp; Inggris</h6>
                                    <p class="text-muted small mb-0">Penerapan lingkungan bahasa aktif 24 jam dengan muhadatsah pagi, public speaking, debat ilmiah, dan pembiasaan percakapan harian.</p>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-3">
                                <div class="pilar-card">
                                    <div class="pilar-icon-box bg-danger bg-opacity-10 text-danger">
                                        <i class="bi bi-laptop"></i>
                                    </div>
                                    <h6 class="fw-bold text-dark mb-2">4. Sains &amp; IT Terpadu</h6>
                                    <p class="text-muted small mb-0">Integrasi kurikulum Kemenag dengan riset sains, laboratorium komputer, sistem informasi digital SIMPONPES, dan jiwa kemandirian santri.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Fasilitas Pendukung -->
                    <div class="p-4 p-md-5 rounded-4 bg-white border shadow-sm">
                        <div class="row align-items-center g-4">
                            <div class="col-lg-4">
                                <span class="badge bg-success mb-2">INFRASTRUKTUR LENGKAP</span>
                                <h4 class="fw-bold text-dark mb-2">Sarana &amp; Fasilitas Pembelajaran Asrama</h4>
                                <p class="text-muted small mb-0">Pesantren menyediakan lingkungan belajar yang aman, kondusif, nyaman, dan higienis bagi seluruh santri mukim.</p>
                            </div>
                            <div class="col-lg-8">
                                <div class="row g-3">
                                    @foreach($ppdbSetting->sarana_list as $sarana)
                                    <div class="col-sm-6">
                                        <div class="d-flex align-items-center gap-2 p-2 rounded-3 bg-light">
                                            <i class="bi bi-check-circle-fill text-success"></i>
                                            <span class="small fw-semibold text-dark">{{ $sarana }}</span>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ========================================== -->
                <!-- TAB 2: VISI, MISI & TUJUAN LEMBAGA        -->
                <!-- ========================================== -->
                <div class="tab-pane fade" id="tab-visimisi" role="tabpanel" aria-labelledby="tab-visimisi-btn" tabindex="0">
                    <!-- Banner Visi Akbar -->
                    <div class="vision-banner mb-5 position-relative overflow-hidden" @if($ppdbSetting->visi_misi_foto_url) style="background: linear-gradient(135deg, rgba(15, 23, 42, 0.92) 0%, rgba(6, 95, 70, 0.88) 100%), url('{{ $ppdbSetting->visi_misi_foto_url }}') center/cover no-repeat;" @endif>
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <span class="badge bg-warning text-dark fw-bold px-3 py-1">VISI PESANTREN 2026 - 2035</span>
                            <span class="text-white-50 small">&bull; Arah Strategis Pendidikan</span>
                        </div>
                        <h3 class="fw-bold text-white mb-3" style="font-size: 1.85rem; line-height: 1.35;">
                            "{{ $ppdbSetting->visi_pesantren }}"
                        </h3>
                        <div class="d-flex flex-wrap gap-4 pt-2 text-white-75 small border-top border-white border-opacity-15">
                            <div><i class="bi bi-star-fill text-warning me-1"></i> Berakhlak Mulia</div>
                            <div><i class="bi bi-star-fill text-warning me-1"></i> Hafalan Mutqin Bersanad</div>
                            <div><i class="bi bi-star-fill text-warning me-1"></i> Menguasai Bahasa Asing</div>
                            <div><i class="bi bi-star-fill text-warning me-1"></i> Tanggap Teknologi</div>
                        </div>
                    </div>

                    <!-- 5 Misi Pesantren -->
                    <div class="mb-5">
                        <div class="text-center mb-4">
                            <h4 class="fw-bold text-dark mb-1">Misi Strategis Pesantren</h4>
                            <p class="text-muted small">Langkah nyata mewujudkan generasi Ulil Albab yang siap memimpin peradaban</p>
                        </div>
                        <div class="row g-4">
                            @foreach($ppdbSetting->misi_list as $index => $misi)
                            <div class="{{ count($ppdbSetting->misi_list) <= 3 ? 'col-md-4' : ($index >= 3 ? 'col-md-6 col-lg-6' : 'col-md-6 col-lg-4') }}">
                                <div class="mission-step-card h-100">
                                    <div class="d-flex align-items-center gap-3 mb-3">
                                        <div class="mission-badge-num">{{ $index + 1 }}</div>
                                        <h6 class="fw-bold text-dark mb-0">{{ $misi['judul'] }}</h6>
                                    </div>
                                    <p class="text-muted small mb-0" style="line-height: 1.65;">
                                        {{ $misi['deskripsi'] }}
                                    </p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Panca Jiwa Pesantren (5 Nilai Luhur) -->
                    <div class="p-4 p-md-5 rounded-4 bg-white border shadow-sm mb-5">
                        <div class="text-center mb-4">
                            <span class="badge bg-success-subtle text-success px-3 py-1 fw-bold text-uppercase mb-2">KARAKTER SANTRI</span>
                            <h4 class="fw-bold text-dark mb-1">Panca Jiwa Pondok Pesantren</h4>
                            <p class="text-muted small">Lima nilai dasar yang senantiasa dihidupkan dalam jiwa seluruh santri dan asatidz</p>
                        </div>
                        <div class="row g-3">
                            <div class="col-md">
                                <div class="panca-jiwa-card">
                                    <div class="fs-2 text-success mb-2"><i class="bi bi-heart-fill"></i></div>
                                    <h6 class="fw-bold text-dark mb-1">Keikhlasan</h6>
                                    <p class="text-muted small mb-0">Semata-mata berbuat mencari ridho Allah SWT (lillahi ta'ala).</p>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="panca-jiwa-card">
                                    <div class="fs-2 text-warning mb-2"><i class="bi bi-flower1"></i></div>
                                    <h6 class="fw-bold text-dark mb-1">Kesederhanaan</h6>
                                    <p class="text-muted small mb-0">Bersahaja dalam sikap, kaya dalam cita-cita dan budi luhur.</p>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="panca-jiwa-card">
                                    <div class="fs-2 text-primary mb-2"><i class="bi bi-shield-shaded"></i></div>
                                    <h6 class="fw-bold text-dark mb-1">Kemandirian</h6>
                                    <p class="text-muted small mb-0">Mampu mengatur diri, tidak manja, dan bertanggung jawab penuh.</p>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="panca-jiwa-card">
                                    <div class="fs-2 text-danger mb-2"><i class="bi bi-people-fill"></i></div>
                                    <h6 class="fw-bold text-dark mb-1">Ukhuwah</h6>
                                    <p class="text-muted small mb-0">Menjaga persaudaraan sejati sesama santri dan umat Islam.</p>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="panca-jiwa-card">
                                    <div class="fs-2 text-info mb-2"><i class="bi bi-lightbulb-fill"></i></div>
                                    <h6 class="fw-bold text-dark mb-1">Bebas Berfikir</h6>
                                    <p class="text-muted small mb-0">Berwawasan luas, objektif dalam ilmu, santun dalam perbedaan.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Motto Pesantren & Target Lulusan -->
                    <div class="row g-4 align-items-center">
                        <div class="col-lg-6">
                            <div class="p-4 rounded-4 text-white text-center h-100 d-flex flex-column justify-content-center shadow-sm" style="background: linear-gradient(135deg, #065f46 0%, #047857 100%);">
                                <div class="font-arabic fs-3 text-warning mb-2">« اَلْعِلْمُ بِلَا عَمَلٍ كَالشَّجَرِ بِلَا ثَمَرٍ »</div>
                                <h5 class="fw-bold text-warning mb-2">Motto Pendidikan Santri</h5>
                                <div class="display-6 fw-bold mb-3" style="font-size: 1.65rem;">
                                    "{{ $ppdbSetting->motto_pesantren }}"
                                </div>
                                <p class="text-white-75 small mb-0">
                                    Santri Li Ulil Albab dituntut memadukan penguasaan teori ilmu dengan pengamalan ibadah yang istiqomah serta keteladanan budi pekerti luhur di masyarakat.
                                </p>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="p-4 rounded-4 bg-white border shadow-sm h-100">
                                <h5 class="fw-bold text-dark mb-3"><i class="bi bi-mortarboard-fill text-success me-2"></i>Standar Kompetensi Lulusan (SKL)</h5>
                                <ul class="list-group list-group-flush small">
                                    @foreach($ppdbSetting->standar_kelulusan_list as $skl)
                                    <li class="list-group-item px-0 d-flex gap-2">
                                        <i class="bi bi-check-circle-fill text-success mt-1"></i>
                                        <div><strong>{{ $skl['kategori'] }}:</strong> {{ $skl['deskripsi'] }}</div>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ========================================== -->
                <!-- TAB 3: STRUKTUR KEPENGURUSAN & ASATIDZ    -->
                <!-- ========================================== -->
                <div class="tab-pane fade" id="tab-struktur" role="tabpanel" aria-labelledby="tab-struktur-btn" tabindex="0">
                    <div class="text-center max-w-xl mx-auto mb-4">
                        <span class="badge bg-success-subtle text-success px-3 py-1 fw-bold text-uppercase mb-2">BAGAN ORGANISASI</span>
                        <h4 class="fw-bold text-dark mb-1">Struktur Kepengurusan Pondok Pesantren</h4>
                        <p class="text-muted small">Susunan pimpinan yayasan, dewan pengasuh, dan kepala divisi operasional Pondok Pesantren Modern Li Ulil Albab</p>
                    </div>

                    <!-- Level 1: Pengasuh / Puncak Hirarki -->
                    @php
                        $struktur = $ppdbSetting->struktur_organisasi_list;
                        $puncak = $struktur['puncak'] ?? ['nama' => 'KH. Dr. Abdullah Syukri, M.Ag', 'jabatan' => 'Pengasuh & Mudir \'Aam Pesantren', 'deskripsi' => 'Penanggung jawab umum seluruh kebijakan arah tarbiyah, akidah, kelembagaan, dan kurikulum.'];
                        $bphList = $struktur['bph'] ?? [];
                        $divisiList = $struktur['divisi'] ?? [];
                    @endphp
                    <div class="row justify-content-center mb-2">
                        <div class="col-md-8 col-lg-5">
                            <div class="org-card leader-card text-center p-4">
                                <span class="badge bg-warning text-dark fw-bold position-absolute top-0 end-0 m-3 px-3 py-1 shadow-sm">
                                    <i class="bi bi-award-fill me-1"></i> PIMPINAN PUNCAK
                                </span>
                                <div class="org-avatar-wrapper overflow-hidden">
                                    @if(!empty($puncak['foto_url']))
                                        <img src="{{ $puncak['foto_url'] }}" alt="{{ $puncak['nama'] }}">
                                    @else
                                        <i class="bi bi-person-fill"></i>
                                    @endif
                                </div>
                                <h5 class="fw-bold text-dark mb-1">{{ $puncak['nama'] }}</h5>
                                <div class="badge bg-success px-3 py-1 mb-2">{{ $puncak['jabatan'] }}</div>
                                <p class="text-muted small mb-0">
                                    {{ $puncak['deskripsi'] }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Tree Connector Line -->
                    <div class="org-tree-line mb-3"></div>

                    <!-- Level 2: Badan Pengurus Harian (BPH) -->
                    <div class="row g-4 justify-content-center mb-2">
                        @php
                            $bphGradients = [
                                'linear-gradient(135deg, #059669 0%, #047857 100%)',
                                'linear-gradient(135deg, #0284c7 0%, #0369a1 100%)',
                                'linear-gradient(135deg, #d97706 0%, #b45309 100%)',
                            ];
                            $bphBadges = [
                                'bg-primary bg-opacity-10 text-primary',
                                'bg-info bg-opacity-10 text-info',
                                'bg-warning bg-opacity-10 text-warning-emphasis',
                            ];
                            $bphIcons = [
                                'bi-mortarboard-fill',
                                'bi-laptop-fill',
                                'bi-cash-coin',
                            ];
                        @endphp
                        @foreach($bphList as $idx => $bph)
                        <div class="col-md-6 col-lg-4">
                            <div class="org-card text-center h-100">
                                <div class="org-avatar-wrapper overflow-hidden" style="background: {{ $bphGradients[$idx % count($bphGradients)] }};">
                                    @if(!empty($bph['foto_url']))
                                        <img src="{{ $bph['foto_url'] }}" alt="{{ $bph['nama'] }}">
                                    @else
                                        <i class="bi {{ $bphIcons[$idx % count($bphIcons)] }}"></i>
                                    @endif
                                </div>
                                <h6 class="fw-bold text-dark mb-1">{{ $bph['nama'] }}</h6>
                                <div class="badge {{ $bphBadges[$idx % count($bphBadges)] }} fw-bold px-2 py-1 mb-2">{{ $bph['jabatan'] }}</div>
                                <p class="text-muted small mb-0">
                                    {{ $bph['deskripsi'] }}
                                </p>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <!-- Tree Connector Line -->
                    <div class="org-tree-line mb-3"></div>

                    <!-- Level 3: Kepala Bidang Teknis & Pengasuhan Asrama -->
                    <div class="row g-4 justify-content-center mb-5">
                        @php
                            $divGradients = [
                                'linear-gradient(135deg, #10b981 0%, #059669 100%)',
                                'linear-gradient(135deg, #6366f1 0%, #4f46e5 100%)',
                                'linear-gradient(135deg, #0ea5e9 0%, #0284c7 100%)',
                                'linear-gradient(135deg, #ec4899 0%, #db2777 100%)',
                            ];
                            $divBadges = [
                                'bg-success bg-opacity-10 text-success',
                                'bg-primary bg-opacity-10 text-primary',
                                'bg-info bg-opacity-10 text-info',
                                'bg-danger bg-opacity-10 text-danger',
                            ];
                            $divIcons = [
                                'bi-book-half',
                                'bi-mortarboard',
                                'bi-shield-check',
                                'bi-heart-pulse-fill',
                            ];
                        @endphp
                        @foreach($divisiList as $idx => $div)
                        <div class="col-md-6 col-lg-3">
                            <div class="org-card text-center h-100">
                                <div class="org-avatar-wrapper overflow-hidden" style="width: 68px; height: 68px; font-size: 1.6rem; background: {{ $divGradients[$idx % count($divGradients)] }};">
                                    @if(!empty($div['foto_url']))
                                        <img src="{{ $div['foto_url'] }}" alt="{{ $div['nama'] }}">
                                    @else
                                        <i class="bi {{ $divIcons[$idx % count($divIcons)] }}"></i>
                                    @endif
                                </div>
                                <h6 class="fw-bold text-dark mb-1" style="font-size: 0.95rem;">{{ $div['nama'] }}</h6>
                                <span class="badge {{ $divBadges[$idx % count($divBadges)] }} fw-bold small mb-2">{{ $div['jabatan'] }}</span>
                                <p class="text-muted small mb-0" style="font-size: 0.8rem;">
                                    {{ $div['deskripsi'] }}
                                </p>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <!-- Dewan Asatidz Banner CTA -->
                    <div class="p-4 rounded-4 bg-white border shadow-sm">
                        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                            <div class="d-flex align-items-center gap-3">
                                <span class="p-3 bg-success text-white rounded-3 fs-3">
                                    <i class="bi bi-people-fill"></i>
                                </span>
                                <div>
                                    <h5 class="fw-bold text-dark mb-1">Didukung {{ $totalAsatidz }}+ Dewan Asatidz &amp; Mursyid Berdedikasi</h5>
                                    <p class="text-muted small mb-0">Lulusan universitas ternama dalam dan luar negeri (Al-Azhar Kairo, Yaman, Madinah, UIN, dan PTN Favorit).</p>
                                </div>
                            </div>
                            <div class="d-flex gap-2">
                                <a href="#formulir-ppdb" class="btn btn-pesantren">
                                    <i class="bi bi-pencil-square me-1"></i> Daftar Santri Baru
                                </a>
                                <a href="#kontak" class="btn btn-outline-secondary">
                                    <i class="bi bi-telephone me-1"></i> Kontak Pesantren
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- ========================================== -->
    <!-- SECTION 1: DOKUMENTASI KEGIATAN PESANTREN -->
    <!-- ========================================== -->
    <section id="kegiatan" class="py-5">
        <div class="container py-lg-4">
            <div class="text-center max-w-xl mx-auto mb-4">
                <span class="section-tag"><i class="bi bi-camera me-1"></i> Portal Dokumentasi</span>
                <h2 class="section-title mb-2">Dokumentasi Kegiatan Pondok Pesantren</h2>
                <p class="text-muted">Potret aktivitas pembelajaran kitab turats, hafalan Al-Qur'an, pengembangan bakat
                    bahasa asing, kepemimpinan santri, dan pengabdian umat.</p>
            </div>

            <!-- Filter Buttons -->
            <div class="d-flex flex-wrap justify-content-center gap-2 mb-5">
                <button type="button" class="filter-btn active" onclick="filterKegiatan('all', this)">Semua
                    Kegiatan</button>
                <button type="button" class="filter-btn" onclick="filterKegiatan('tahfidz', this)">Kajian &amp;
                    Tahfidz</button>
                <button type="button" class="filter-btn" onclick="filterKegiatan('phbi', this)">Hari Besar &amp;
                    Maulid</button>
                <button type="button" class="filter-btn" onclick="filterKegiatan('ekskul', this)">Bahasa &amp;
                    Ekstrakurikuler</button>
                <button type="button" class="filter-btn" onclick="filterKegiatan('sosial', this)">Sosial &amp;
                    Kemandirian</button>
            </div>

            <!-- Activities Grid (Dikelola Dinamis dari Admin) -->
            <div class="row g-4" id="kegiatanGrid">
                @forelse($kegiatans as $kegiatan)
                    <div class="col-md-6 col-lg-4 kegiatan-item" data-category="{{ $kegiatan->kategori }}">
                        <div class="activity-card">
                            <div class="activity-img-wrapper">
                                <img src="{{ $kegiatan->gambar_url }}" alt="{{ $kegiatan->judul }}" loading="lazy">
                                <span class="activity-category-badge">
                                    <i class="bi bi-tag-fill me-1"></i> {{ $kegiatan->kategori_label }}
                                </span>
                                <span class="activity-date-badge">
                                    <i class="bi bi-calendar3 me-1"></i>
                                    {{ $kegiatan->tanggal->translatedFormat('d M Y') }}
                                </span>
                            </div>
                            <div class="p-4 d-flex flex-column flex-grow-1">
                                <h5 class="fw-bold text-dark mb-2">{{ $kegiatan->judul }}</h5>
                                <p class="text-muted small mb-3 flex-grow-1">
                                    {{ Str::limit($kegiatan->deskripsi, 135) }}
                                </p>
                                <div class="d-flex align-items-center justify-content-between pt-3 border-top mt-auto">
                                    <span class="small text-muted"><i class="bi bi-geo-alt me-1 text-danger"></i>
                                        {{ $kegiatan->lokasi }}</span>
                                    <button type="button" class="btn btn-sm btn-outline-success fw-bold"
                                        onclick="lihatDetailKegiatan('{{ addslashes($kegiatan->judul) }}', '{{ $kegiatan->tanggal->translatedFormat('d F Y') }}', '{{ addslashes($kegiatan->lokasi) }}', '{{ $kegiatan->kategori_label }}', '{{ $kegiatan->gambar_url }}', '{{ addslashes(str_replace(["\r", "\n"], ' ', $kegiatan->deskripsi)) }}')">
                                        Detail <i class="bi bi-arrow-right"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <i class="bi bi-images text-muted fs-1 mb-2 d-block"></i>
                        <h5 class="fw-bold text-muted">Belum ada dokumentasi kegiatan</h5>
                        <p class="text-muted small">Dokumentasi dapat ditambahkan dari panel admin SIMPONPES.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- ========================================== -->
    <!-- SECTION 2: VIDEO KEGIATAN PESANTREN       -->
    <!-- ========================================== -->
    <section id="video" class="py-5" style="background-color: #f8fafc;">
        <div class="container py-lg-4">
            <div class="text-center max-w-xl mx-auto mb-5">
                <span class="section-tag"><i class="bi bi-play-circle-fill me-1"></i> Video Galeri</span>
                <h2 class="section-title mb-2">Video Kegiatan Santri &amp; Liputan Resmi</h2>
                <p class="text-muted">Saksikan suasana langsung kehidupan berasrama 24 jam, rekaman lantunan tahfidz
                    Qur'an, dan cuplikan prestasi santri kami.</p>
            </div>

            <!-- Featured Video Player Block (Dikelola Dinamis dari Admin) -->
            @if ($featuredVideo)
                <div class="row g-4 align-items-center mb-5">
                    <div class="col-lg-8">
                        <div class="video-box-main ratio ratio-16x9">
                            @if ($featuredVideo->is_local_video)
                                <video controls class="w-100 h-100 rounded-4"
                                    style="background:#000; object-fit:contain;"
                                    poster="{{ $featuredVideo->thumbnail_url }}">
                                    <source src="{{ $featuredVideo->video_url }}">
                                    Browser Anda tidak mendukung pemutar video HTML5.
                                </video>
                            @else
                                <iframe id="mainFeaturedPlayer" src="{{ $featuredVideo->embed_url }}?rel=0"
                                    title="{{ $featuredVideo->judul }}"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                    allowfullscreen></iframe>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div
                            class="bg-white p-4 rounded-4 border shadow-sm h-100 d-flex flex-column justify-content-between">
                            <div>
                                <span class="badge bg-danger mb-2"><i class="bi bi-broadcast me-1"></i> VIDEO UTAMA
                                    TERPILIH</span>
                                <h4 class="fw-bold text-dark mb-3">{{ $featuredVideo->judul }}</h4>
                                <p class="text-muted small mb-3">
                                    {{ $featuredVideo->deskripsi ?? 'Tayangan video liputan resmi aktivitas santri Pondok Pesantren Modern Li Ulil Albab.' }}
                                </p>
                                <div class="p-3 bg-light rounded-3 mb-3 small">
                                    <div class="d-flex justify-content-between mb-1">
                                        <span class="text-muted">Kategori:</span>
                                        <strong class="text-success">{{ $featuredVideo->kategori }}</strong>
                                    </div>
                                    <div class="d-flex justify-content-between mb-1">
                                        <span class="text-muted">Kualitas:</span>
                                        <span class="badge bg-success">Full HD 1080p</span>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <span class="text-muted">Durasi:</span>
                                        <strong>{{ $featuredVideo->durasi }}</strong>
                                    </div>
                                </div>
                            </div>
                            <a href="#formulir-ppdb" class="btn btn-pesantren w-100">
                                <i class="bi bi-mortarboard-fill me-1"></i> Tertarik Mondok? Daftar PPDB
                            </a>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Video Playlist Cards Grid (Dikelola Dinamis dari Admin) -->
            <div class="row g-4">
                @forelse($galeriVideos as $video)
                    <div class="col-md-6 col-lg-4">
                        <div class="video-card"
                            onclick="putarVideoModal('{{ $video->is_local_video ? $video->video_url : $video->youtube_id }}', '{{ addslashes($video->judul) }}', {{ $video->is_local_video ? 'true' : 'false' }})">
                            <div class="video-thumb-container">
                                <img src="{{ $video->thumbnail_url }}" alt="{{ $video->judul }}" loading="lazy">
                                <div class="play-button-overlay">
                                    <i class="bi bi-play-fill fs-3"></i>
                                </div>
                                <span
                                    class="position-absolute bottom-0 end-0 bg-dark text-white small px-2 py-1 m-2 rounded">
                                    {{ $video->durasi }}
                                </span>
                            </div>
                            <div class="p-3">
                                <span
                                    class="badge bg-success bg-opacity-10 text-success small mb-1">{{ $video->kategori }}</span>
                                <h6 class="fw-bold text-dark mb-1"
                                    style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                                    {{ $video->judul }}
                                </h6>
                                <p class="text-muted small mb-0"
                                    style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                                    {{ $video->deskripsi ?? 'Dokumentasi video kegiatan santri Li Ulil Albab.' }}
                                </p>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <i class="bi bi-play-btn text-muted fs-1 mb-2 d-block"></i>
                        <h5 class="fw-bold text-muted">Belum ada video kegiatan</h5>
                        <p class="text-muted small">Video dapat ditambahkan dari panel admin SIMPONPES.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- ============================================================== -->
    <!-- SECTION 3: ALUR PERSYARATAN & UJIAN MASUK PPDB (IN-DEPTH)      -->
    <!-- ============================================================== -->
    <section id="alur-ujian" class="py-5 bg-white">
        <div class="container py-lg-4">
            <div class="text-center max-w-xl mx-auto mb-4">
                <span class="section-tag"><i class="bi bi-card-checklist me-1"></i> Panduan Masuk</span>
                <h2 class="section-title mb-2">Informasi Penerimaan &amp; Jadwal PPDB Online</h2>
                <p class="text-muted">Prosedur resmi, jadwal gelombang seleksi, dan persyaratan calon santri baru
                    {{ $ppdbSetting->nama_pesantren }} Tahun Ajaran {{ $ppdbSetting->tahun_ajaran }}.</p>
            </div>

            <!-- Kartu Informasi Jadwal & Gelombang PPDB Dinamis (Dikelola Admin) -->
            <div class="card border-0 shadow-sm rounded-4 mb-5 overflow-hidden"
                style="background: linear-gradient(135deg, #022c22 0%, #064e3b 50%, #065f46 100%); color: #ffffff;">
                <div class="card-body p-4 p-lg-5">
                    <div class="row align-items-center g-4">
                        <div class="col-lg-7">
                            <div class="d-flex align-items-center gap-2 mb-2 flex-wrap">
                                <span
                                    class="badge {{ $ppdbSetting->status_badge_class }} px-3 py-2 fw-bold text-uppercase fs-6">
                                    <i class="bi bi-dot"></i> {{ $ppdbSetting->status_label }}
                                </span>
                                <span class="badge bg-warning text-dark px-3 py-2 fw-bold fs-6">
                                    {{ $ppdbSetting->gelombang_aktif }}
                                </span>
                            </div>
                            <h3 class="fw-bold text-white mb-2">Jadwal Penting Penerimaan Santri Baru
                                {{ $ppdbSetting->tahun_ajaran }}</h3>
                            <p class="text-white-50 mb-4 small">
                                Seluruh rangkaian seleksi penerimaan santri baru dilaksanakan secara transparan dan
                                akuntabel di bawah pengawasan Mudir &amp; Panitia PPDB.
                            </p>

                            <div class="row g-3">
                                <div class="col-sm-6">
                                    <div
                                        class="p-3 rounded-3 bg-white bg-opacity-10 border border-white border-opacity-10">
                                        <div class="text-warning small fw-bold text-uppercase"><i
                                                class="bi bi-calendar-range me-1"></i> Masa Pendaftaran</div>
                                        <div class="fw-bold fs-6 mt-1 text-white">
                                            {{ $ppdbSetting->tanggal_buka_pendaftaran }} -
                                            {{ $ppdbSetting->tanggal_tutup_pendaftaran }}</div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div
                                        class="p-3 rounded-3 bg-white bg-opacity-10 border border-white border-opacity-10">
                                        <div class="text-warning small fw-bold text-uppercase"><i
                                                class="bi bi-stopwatch me-1"></i> Ujian Seleksi Masuk</div>
                                        <div class="fw-bold fs-6 mt-1 text-white">
                                            {{ $ppdbSetting->tanggal_ujian_seleksi }}</div>
                                        <small class="text-white-50 d-block mt-1">Pukul
                                            {{ $ppdbSetting->jam_ujian }}</small>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div
                                        class="p-3 rounded-3 bg-white bg-opacity-10 border border-white border-opacity-10">
                                        <div class="text-warning small fw-bold text-uppercase"><i
                                                class="bi bi-broadcast me-1"></i> Pengumuman Kelulusan</div>
                                        <div class="fw-bold fs-6 mt-1 text-white">
                                            {{ $ppdbSetting->tanggal_pengumuman }}</div>
                                        <small class="text-white-50 d-block mt-1">Via Website &amp; WhatsApp
                                            Resmi</small>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div
                                        class="p-3 rounded-3 bg-white bg-opacity-10 border border-white border-opacity-10">
                                        <div class="text-warning small fw-bold text-uppercase"><i
                                                class="bi bi-check2-all me-1"></i> Rentang Daftar Ulang</div>
                                        <div class="fw-bold fs-6 mt-1 text-white">
                                            {{ $ppdbSetting->tanggal_daftar_ulang }}</div>
                                        <small class="text-white-50 d-block mt-1">Konfirmasi &amp; Pengambilan
                                            Seragam</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-5">
                            <div class="p-4 rounded-4 bg-white text-dark shadow-sm text-center">
                                <span
                                    class="badge bg-success-subtle text-success px-3 py-2 fw-bold text-uppercase mb-2">Informasi
                                    Kuota &amp; Biaya</span>
                                <div class="display-6 fw-bold text-success mb-1">{{ $ppdbSetting->biaya_pendaftaran }}
                                </div>
                                <div class="text-muted small mb-3">Biaya Formulir Pendaftaran PPDB Online</div>

                                <div class="p-3 bg-light rounded-3 text-start mb-3">
                                    <div class="d-flex justify-content-between mb-1 small">
                                        <span class="text-muted">Total Kuota Penerimaan:</span>
                                        <strong>{{ $ppdbSetting->kuota_penerimaan }} Santri</strong>
                                    </div>
                                    <div class="d-flex justify-content-between mb-1 small">
                                        <span class="text-muted">Calon Santri Terdaftar:</span>
                                        <strong class="text-primary">{{ $totalPendaftarPpdb }} Santri</strong>
                                    </div>
                                    <div class="d-flex justify-content-between small">
                                        <span class="text-muted">Sisa Kuota Tersedia:</span>
                                        <strong class="text-danger">{{ $sisaKuotaPpdb }} Santri</strong>
                                    </div>
                                    <div class="progress mt-2" style="height: 6px;">
                                        @php
                                            $percent =
                                                $ppdbSetting->kuota_penerimaan > 0
                                                    ? min(
                                                        100,
                                                        round(
                                                            ($totalPendaftarPpdb / $ppdbSetting->kuota_penerimaan) *
                                                                100,
                                                        ),
                                                    )
                                                    : 0;
                                        @endphp
                                        <div class="progress-bar bg-success" role="progressbar"
                                            style="width: {{ $percent }}%;" aria-valuenow="{{ $percent }}"
                                            aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>

                                <div class="d-grid gap-2">
                                    <a href="#formulir-ppdb" class="btn btn-gold py-2 fw-bold shadow-sm">
                                        <i class="bi bi-pencil-square me-1"></i> Isi Formulir PPDB Sekarang
                                    </a>
                                    @if ($ppdbSetting->link_brosur)
                                        <a href="{{ $ppdbSetting->link_brosur }}" target="_blank"
                                            class="btn btn-outline-secondary btn-sm py-2">
                                            <i class="bi bi-file-earmark-pdf me-1 text-danger"></i> Unduh Brosur Resmi
                                            PPDB (PDF)
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 5 Steps Flow Alur Pendaftaran -->
            <div class="row g-4 mb-5">
                @if (count($ppdbSetting->alur_list) > 0)
                    @foreach ($ppdbSetting->alur_list as $alur)
                        <div class="col-md-6 col-lg">
                            <div class="ppdb-step-box">
                                <div class="step-number">{{ $alur['step'] ?? $loop->iteration }}</div>
                                <h6 class="fw-bold text-dark mb-2">{{ $alur['judul'] ?? 'Tahapan' }}</h6>
                                <p class="small text-muted mb-0">{{ $alur['deskripsi'] ?? '' }}</p>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-md-6 col-lg">
                        <div class="ppdb-step-box">
                            <div class="step-number">1</div>
                            <h6 class="fw-bold text-dark mb-2">Pengisian Formulir</h6>
                            <p class="small text-muted mb-0">Isi formulir pendaftaran daring secara lengkap dengan data
                                calon santri dan orang tua/wali.</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg">
                        <div class="ppdb-step-box">
                            <div class="step-number">2</div>
                            <h6 class="fw-bold text-dark mb-2">Cetak Kartu Ujian</h6>
                            <p class="small text-muted mb-0">Sistem langsung menerbitkan Nomor Registrasi dan Kartu
                                Peserta Ujian Masuk resmi siap cetak PDF.</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg">
                        <div class="ppdb-step-box">
                            <div class="step-number">3</div>
                            <h6 class="fw-bold text-dark mb-2">Pelaksanaan Ujian</h6>
                            <p class="small text-muted mb-0">Mengikuti tes seleksi baca Al-Qur'an, hafalan surat
                                pendek, tes akademik dasar, serta wawancara.</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg">
                        <div class="ppdb-step-box">
                            <div class="step-number">4</div>
                            <h6 class="fw-bold text-dark mb-2">Yudisium Kelulusan</h6>
                            <p class="small text-muted mb-0">Hasil kelulusan diumumkan melalui portal website resmi dan
                                notifikasi WhatsApp panitia PPDB.</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg">
                        <div class="ppdb-step-box">
                            <div class="step-number">5</div>
                            <h6 class="fw-bold text-dark mb-2">Daftar Ulang &amp; Masuk</h6>
                            <p class="small text-muted mb-0">Penyelesaian administrasi, fitting seragam pesantren,
                                pembagian kamar asrama, dan ta'aruf wali.</p>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Persyaratan & Dokumen Persiapan Dinamis -->
            <div class="row g-4 mb-5">
                <!-- Kolom Persyaratan Umum -->
                <div class="col-lg-6">
                    <div class="p-4 rounded-4 border bg-light h-100">
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <span class="p-2 bg-success text-white rounded-3">
                                <i class="bi bi-patch-check-fill fs-4"></i>
                            </span>
                            <div>
                                <h5 class="fw-bold mb-0">Persyaratan Umum Calon Santri</h5>
                                <small class="text-muted">Kriteria kelayakan calon peserta didik baru</small>
                            </div>
                        </div>

                        <ul class="list-group list-group-flush bg-transparent">
                            @forelse($ppdbSetting->persyaratan_list as $syarat)
                                <li class="list-group-item bg-transparent px-0 d-flex gap-2">
                                    <i class="bi bi-check-circle-fill text-success mt-1"></i>
                                    <div>{{ $syarat }}</div>
                                </li>
                            @empty
                                <li class="list-group-item bg-transparent px-0 text-muted">Belum ada persyaratan yang
                                    dikonfigurasi.</li>
                            @endforelse
                        </ul>
                    </div>
                </div>

                <!-- Kolom Berkas Wajib Dibawa Saat Ujian -->
                <div class="col-lg-6">
                    <div class="p-4 rounded-4 border bg-light h-100">
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <span class="p-2 bg-warning text-dark rounded-3">
                                <i class="bi bi-folder-fill fs-4"></i>
                            </span>
                            <div>
                                <h5 class="fw-bold mb-0">Berkas Wajib Dibawa Saat Ujian</h5>
                                <small class="text-muted">Dokumen fisik diserahkan ke meja panitia verifikasi</small>
                            </div>
                        </div>

                        <ul class="list-group list-group-flush bg-transparent">
                            @forelse($ppdbSetting->berkas_list as $berkas)
                                <li class="list-group-item bg-transparent px-0 d-flex gap-2">
                                    <i class="bi bi-file-earmark-check-fill text-warning mt-1"></i>
                                    <div>{{ $berkas }}</div>
                                </li>
                            @empty
                                <li class="list-group-item bg-transparent px-0 text-muted">Belum ada berkas yang
                                    dikonfigurasi.</li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Rincian Materi Ujian Seleksi Masuk Dinamis -->
            <div class="p-4 p-md-5 rounded-4 bg-light border">
                <div class="row align-items-center mb-4">
                    <div class="col-md-8">
                        <span class="badge bg-success mb-1">MATERI UJIAN MASUK</span>
                        <h4 class="fw-bold text-dark mb-0">Rincian Materi Ujian Seleksi Masuk Santri Baru</h4>
                    </div>
                    <div class="col-md-4 text-md-end mt-2 mt-md-0">
                        <span class="text-muted small"><i class="bi bi-geo-alt-fill text-danger me-1"></i>
                            {{ $ppdbSetting->lokasi_ujian }}</span>
                    </div>
                </div>

                <div class="row g-3">
                    @forelse($ppdbSetting->materi_ujian_list as $materi)
                        <div class="col-md-6 col-lg-3">
                            <div class="exam-subject-card h-100">
                                <div class="{{ $materi['color'] ?? 'text-success' }} fs-3 mb-2"><i
                                        class="bi {{ $materi['icon'] ?? 'bi-book-half' }}"></i></div>
                                <h6 class="fw-bold mb-1">{{ $materi['judul'] ?? 'Materi Ujian' }}</h6>
                                <p class="small text-muted mb-0">{{ $materi['deskripsi'] ?? '' }}</p>
                            </div>
                        </div>
                    @empty
                        <div class="col-md-6 col-lg-3">
                            <div class="exam-subject-card h-100">
                                <div class="text-success fs-3 mb-2"><i class="bi bi-book-half"></i></div>
                                <h6 class="fw-bold mb-1">1. Baca Tulis Al-Qur'an (BTQ)</h6>
                                <p class="small text-muted mb-0">Kelancaran membaca mushaf, penguasaan hukum tajwid,
                                    dan imla' ayat.</p>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div class="exam-subject-card h-100">
                                <div class="text-warning fs-3 mb-2"><i class="bi bi-bookmark-star-fill"></i></div>
                                <h6 class="fw-bold mb-1">2. Hafalan Surat Pilihan</h6>
                                <p class="small text-muted mb-0">Tes hafalan Juz 30 dan surat pilihan.</p>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div class="exam-subject-card h-100">
                                <div class="text-primary fs-3 mb-2"><i class="bi bi-mortarboard"></i></div>
                                <h6 class="fw-bold mb-1">3. Tes Potensi Akademik</h6>
                                <p class="small text-muted mb-0">Matematika dasar, nalar bahasa, dan pengetahuan agama
                                    Islam.</p>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div class="exam-subject-card h-100">
                                <div class="text-danger fs-3 mb-2"><i class="bi bi-people-fill"></i></div>
                                <h6 class="fw-bold mb-1">4. Wawancara Santri &amp; Wali</h6>
                                <p class="small text-muted mb-0">Penggalian motivasi belajar mondok dan komitmen wali.
                                </p>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </section>

    <!-- ======================================================= -->
    <!-- SECTION 4: FORMULIR PENDAFTARAN ONLINE PPDB 2026/2027   -->
    <!-- ======================================================= -->
    <section id="formulir-ppdb" class="py-5"
        style="background: linear-gradient(180deg, #f8fafc 0%, #edf2f7 100%);">
        <div class="container py-lg-4">
            <div class="text-center max-w-xl mx-auto mb-5">
                <span class="section-tag"><i class="bi bi-pencil-fill me-1"></i> Registrasi Online</span>
                <h2 class="section-title mb-2">Formulir PPDB Online Santri Baru</h2>
                <p class="text-muted">Isi data calon santri dengan teliti dan benar. Setelah mengirimkan formulir, Anda
                    dapat langsung mencetak <strong>Kartu Peserta Ujian Masuk PPDB 2026/2027</strong>.</p>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-10 col-xl-9">
                    <div class="form-ppdb-card p-4 p-md-5">

                        <!-- Form Brand Header -->
                        <div class="d-flex align-items-center justify-content-between pb-3 mb-4 border-bottom">
                            <div class="d-flex align-items-center gap-3">
                                <span
                                    class="d-inline-flex align-items-center justify-content-center bg-success text-white rounded-3 shadow-sm"
                                    style="width: 48px; height: 48px;">
                                    <i class="bi bi-card-heading fs-3"></i>
                                </span>
                                <div>
                                    <h5 class="fw-bold text-dark mb-0">Penerimaan Peserta Didik Baru (PPDB)
                                        {{ $ppdbSetting->tahun_ajaran }}</h5>
                                    <small class="text-muted">{{ $ppdbSetting->nama_pesantren }}</small>
                                </div>
                            </div>
                            <span class="badge {{ $ppdbSetting->status_badge_class }} px-3 py-2 fw-bold fs-6">
                                <i class="bi bi-shield-check me-1"></i> {{ $ppdbSetting->status_label }}
                            </span>
                        </div>

                        <!-- PPDB Status Notice Alerts -->
                        @if ($ppdbSetting->status_ppdb === 'tutup')
                            <div class="alert alert-danger d-flex align-items-center gap-3 p-4 rounded-4 mb-4 shadow-sm"
                                role="alert">
                                <i class="bi bi-exclamation-octagon-fill fs-2"></i>
                                <div>
                                    <h5 class="fw-bold mb-1">Pendaftaran PPDB Saat Ini Telah Ditutup</h5>
                                    <p class="mb-0 small">Penerimaan santri baru untuk gelombang ini sedang ditutup.
                                        Silakan menghubungi panitia PPDB melalui WhatsApp
                                        <strong>{{ $ppdbSetting->telepon }}</strong> untuk info pembukaan gelombang
                                        berikutnya.
                                    </p>
                                </div>
                            </div>
                        @elseif($ppdbSetting->status_ppdb === 'segera')
                            <div class="alert alert-warning d-flex align-items-center gap-3 p-4 rounded-4 mb-4 shadow-sm"
                                role="alert">
                                <i class="bi bi-clock-history fs-2"></i>
                                <div>
                                    <h5 class="fw-bold mb-1">Pendaftaran PPDB Segera Dibuka</h5>
                                    <p class="mb-0 small">Pendaftaran resmi akan dibuka pada
                                        <strong>{{ $ppdbSetting->tanggal_buka_pendaftaran }}</strong>. Anda dapat
                                        melihat syarat berkas dan jadwal ujian seleksi di atas untuk persiapan.
                                    </p>
                                </div>
                            </div>
                        @else
                            <div class="alert alert-success d-flex flex-wrap align-items-center justify-content-between gap-2 p-3 rounded-3 mb-4 border border-success-subtle shadow-sm"
                                role="alert">
                                <div class="d-flex align-items-center gap-2">
                                    <i class="bi bi-check-circle-fill fs-5 text-success"></i>
                                    <span class="small">Pendaftaran
                                        <strong>{{ $ppdbSetting->gelombang_aktif }}</strong> aktif sampai
                                        <strong>{{ $ppdbSetting->tanggal_tutup_pendaftaran }}</strong>.</span>
                                </div>
                                <span class="badge bg-success px-3 py-2">Sisa Kuota: {{ $sisaKuotaPpdb }}
                                    Santri</span>
                            </div>
                        @endif

                        <!-- Registration Form -->
                        <form id="formPPDBSantri" action="{{ route('ppdb.daftar') }}" method="POST"
                            onsubmit="handlePPDBSubmit(event)">
                            @csrf

                            <!-- BAGIAN 1: DATA CALON SANTRI -->
                            <div class="form-section-divider">
                                <i class="bi bi-person-fill"></i> Bagian 1: Data Identitas Calon Santri
                            </div>

                            <div class="row g-3 mb-4">
                                <div class="col-md-8">
                                    <label class="form-label" for="nama_lengkap">Nama Lengkap Santri <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap"
                                        placeholder="Contoh: Muhammad Rayhan Al-Fatih" required>
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label" for="jenis_kelamin">Jenis Kelamin <span
                                            class="text-danger">*</span></label>
                                    <select class="form-select" id="jenis_kelamin" name="jenis_kelamin" required>
                                        <option value="" disabled selected>-- Pilih --</option>
                                        <option value="Laki-laki">Laki-laki (Santri Putra)</option>
                                        <option value="Perempuan">Perempuan (Santri Putri)</option>
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label" for="tempat_lahir">Tempat Lahir <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir"
                                        placeholder="Contoh: Surabaya" required>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label" for="tanggal_lahir">Tanggal Lahir <span
                                            class="text-danger">*</span></label>
                                    <input type="date" class="form-control" id="tanggal_lahir"
                                        name="tanggal_lahir" required>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label" for="nisn">NISN (Nomor Induk Siswa Nasional)</label>
                                    <input type="text" class="form-control" id="nisn" name="nisn"
                                        placeholder="10 Digit NISN (jika ada)">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label" for="asal_sekolah">Asal Sekolah / Madrasah <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="asal_sekolah" name="asal_sekolah"
                                        placeholder="Contoh: SDN / MIN 1 Kota Surabaya" required>
                                </div>

                                <div class="col-12">
                                    <label class="form-label" for="jenjang">Pilihan Jenjang Pendidikan di Pesantren
                                        <span class="text-danger">*</span></label>
                                    <select class="form-select" id="jenjang" name="jenjang" required>
                                        <option value="" disabled selected>-- Pilih Jenjang Pendidikan --
                                        </option>
                                        <option value="Madrasah Tsanawiyah (MTs Terpadu)">Madrasah Ibtidaiyah (MI
                                            Terpadu) - Setingkat SD</option>
                                        <option value="Madrasah Tsanawiyah (MTs Terpadu)">Madrasah Tsanawiyah (MTs
                                            Terpadu) - Setingkat SMP</option>
                                        <option value="Madrasah Aliyah (MA Unggulan IPA/Agama)">Madrasah Aliyah (MA
                                            Unggulan IPA / Keagamaan) - Setingkat SMA</option>
                                        <option value="Takhasus Tahfidzul Qur'an 30 Juz">Program Takhasus Tahfidzul
                                            Qur'an 30 Juz Mutqin</option>
                                    </select>
                                </div>
                            </div>

                            <!-- BAGIAN 2: DATA ORANG TUA / WALI -->
                            <div class="form-section-divider">
                                <i class="bi bi-people-fill"></i> Bagian 2: Data Orang Tua / Wali Santri
                            </div>

                            <div class="row g-3 mb-4">
                                <div class="col-md-6">
                                    <label class="form-label" for="nama_wali">Nama Lengkap Orang Tua / Wali <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="nama_wali" name="nama_wali"
                                        placeholder="Nama Ayah, Ibu, atau Wali Santri" required>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label" for="no_wa">Nomor WhatsApp Aktif (Untuk Notifikasi
                                        Ujian) <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light text-success fw-bold"><i
                                                class="bi bi-whatsapp"></i></span>
                                        <input type="tel" class="form-control" id="no_wa" name="no_wa"
                                            placeholder="08xxxxxxxxxx" required>
                                    </div>
                                    <small class="text-muted" style="font-size: 0.78rem;">Kartu ujian &amp; informasi
                                        kelulusan akan dikirimkan juga ke nomor ini.</small>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label" for="pekerjaan_wali">Pekerjaan Orang Tua / Wali</label>
                                    <input type="text" class="form-control" id="pekerjaan_wali"
                                        name="pekerjaan_wali" placeholder="PNS / Wiraswasta / Karyawan / Lainnya">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label" for="pendidikan_wali">Pendidikan Terakhir Orang
                                        Tua</label>
                                    <select class="form-select" id="pendidikan_wali" name="pendidikan_wali">
                                        <option value="SMA / Sederajat">Madrasah Ibtidaiyah</option>
                                        <option value="Diploma (D3)">Madrasa Tsanawiyah (MTs)</option>
                                        <option value="Sarjana (S1)">Madrasah Aliyah (MA)</option>
                                        <option value="Magister (S2)">Kelas Khusus (Tahfidz Qur'an)</option>
                                    </select>
                                </div>

                                <div class="col-12">
                                    <label class="form-label" for="alamat">Alamat Lengkap Tempat Tinggal <span
                                            class="text-danger">*</span></label>
                                    <textarea class="form-control" id="alamat" name="alamat" rows="2"
                                        placeholder="Nama Jalan, No. Rumah, RT/RW, Kelurahan, Kecamatan, Kota/Kabupaten, Provinsi" required></textarea>
                                </div>
                            </div>

                            <!-- BAGIAN 3: JALUR PENDAFTARAN & MODEL UJIAN -->
                            <div class="form-section-divider">
                                <i class="bi bi-award-fill"></i> Bagian 3: Jalur Pendaftaran &amp; Model Ujian Masuk
                            </div>

                            <div class="row g-3 mb-4">
                                <div class="col-md-6">
                                    <label class="form-label" for="jalur">Pilihan Jalur Pendaftaran <span
                                            class="text-danger">*</span></label>
                                    <select class="form-select" id="jalur" name="jalur" required>
                                        <option value="Reguler" selected>Jalur Reguler (Tes Umum)</option>
                                        <option value="Prestasi Tahfidz">Jalur Prestasi Tahfidz (Min. 3-5 Juz Hafal)
                                        </option>
                                        <option value="Prestasi Akademik / Sains">Jalur Prestasi Olimpiade Sains /
                                            Juara Kelas</option>
                                        <option value="Beasiswa Afirmasi Yatim Dhuafa">Jalur Beasiswa Yatim / Dhuafa
                                            Berprestasi</option>
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label" for="model_ujian">Model Pelaksanaan Ujian Masuk <span
                                            class="text-danger">*</span></label>
                                    <select class="form-select" id="model_ujian" name="model_ujian" required>
                                        <option value="Tatap Muka di Pesantren" selected>Ujian Tatap Muka Langsung di
                                            Kampus Pesantren</option>
                                        <option value="Online / Jarak Jauh">Ujian Daring Online (Khusus Luar Provinsi /
                                            Pulau)</option>
                                    </select>
                                </div>

                                <div class="col-12">
                                    <label class="form-label" for="catatan_prestasi">Catatan Hafalan / Prestasi Calon
                                        Santri (Bila Ada)</label>
                                    <input type="text" class="form-control" id="catatan_prestasi"
                                        name="catatan_prestasi"
                                        placeholder="Contoh: Hafal Juz 30 & Juz 1 lancar, Juara 2 MTQ Tingkat Kabupaten">
                                </div>
                            </div>

                            <!-- Deklarasi & Persetujuan -->
                            <div class="form-check p-3 bg-light rounded-3 mb-4 border">
                                <input class="form-check-input ms-0 me-2" type="checkbox" id="persetujuan" required>
                                <label class="form-check-label small text-dark" for="persetujuan">
                                    Dengan ini saya menyatakan bahwa data yang saya isikan adalah benar, dan saya
                                    bersedia mengikuti rangkaian <strong>Ujian Masuk Seleksi Santri Baru</strong> sesuai
                                    tata tertib Pondok Pesantren Li Ulil Albab.
                                </label>
                            </div>

                            <!-- Tombol Submit -->
                            <div class="d-grid gap-2">
                                @if ($ppdbSetting->status_ppdb === 'tutup')
                                    <button type="button" class="btn btn-secondary btn-lg py-3 fw-bold fs-6"
                                        disabled>
                                        <i class="bi bi-x-circle-fill me-2"></i> Pendaftaran PPDB Saat Ini Ditutup
                                    </button>
                                @else
                                    <button type="submit" class="btn btn-gold btn-lg py-3 fw-bold fs-6">
                                        <i class="bi bi-send-check-fill me-2"></i> Kirim Formulir &amp; Terbitkan Kartu
                                        Ujian Masuk
                                    </button>
                                @endif
                                <div class="text-center text-muted small mt-2">
                                    <i class="bi bi-shield-lock-fill text-success me-1"></i> Data Anda dienkripsi aman
                                    dan tidak disebarluaskan.
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ========================================== -->
    <!-- SECTION 5: FAQ & KONTAK LAYANAN PPDB       -->
    <!-- ========================================== -->
    <section id="kontak" class="py-5 bg-white">
        <div class="container py-lg-4">
            <div class="row g-5">
                <div class="col-lg-6">
                    <span class="section-tag"><i class="bi bi-question-circle me-1"></i> Tanya Jawab</span>
                    <h3 class="section-title mb-4">Pertanyaan Seputar Ujian Masuk PPDB</h3>

                    <div class="accordion" id="faqAccordion">
                        <div class="accordion-item mb-2 border rounded-3 overflow-hidden">
                            <h2 class="accordion-header" id="faq1Heading">
                                <button class="accordion-button fw-bold text-dark" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#faq1" aria-expanded="true"
                                    aria-controls="faq1">
                                    Bagaimana jika calon santri belum lancar tajwid Al-Qur'an?
                                </button>
                            </h2>
                            <div id="faq1" class="accordion-collapse collapse show"
                                aria-labelledby="faq1Heading" data-bs-parent="#faqAccordion">
                                <div class="accordion-body text-muted small">
                                    Tidak perlu berkecil hati. Tim penguji akan mengukur potensi dasar serta minat
                                    belajar calon santri. Bagi santri yang lulus seleksi dengan catatan bacaan belum
                                    mutqin, pesantren menyediakan program matrikulasi tahsin intensif sebelum kelas
                                    reguler dimulai.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item mb-2 border rounded-3 overflow-hidden">
                            <h2 class="accordion-header" id="faq2Heading">
                                <button class="accordion-button collapsed fw-bold text-dark" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#faq2" aria-expanded="false"
                                    aria-controls="faq2">
                                    Apakah orang tua / wali wajib hadir saat ujian wawancara?
                                </button>
                            </h2>
                            <div id="faq2" class="accordion-collapse collapse" aria-labelledby="faq2Heading"
                                data-bs-parent="#faqAccordion">
                                <div class="accordion-body text-muted small">
                                    Ya, kehadiran minimal salah satu orang tua atau wali adalah wajib. Wawancara
                                    bertujuan menyelaraskan komitmen antara orang tua dan dewan pengasuh pesantren dalam
                                    membina karakter santri selama mukim di asrama.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item mb-2 border rounded-3 overflow-hidden">
                            <h2 class="accordion-header" id="faq3Heading">
                                <button class="accordion-button collapsed fw-bold text-dark" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#faq3" aria-expanded="false"
                                    aria-controls="faq3">
                                    Kapan kartu peserta ujian dapat diambil atau dicetak?
                                </button>
                            </h2>
                            <div id="faq3" class="accordion-collapse collapse" aria-labelledby="faq3Heading"
                                data-bs-parent="#faqAccordion">
                                <div class="accordion-body text-muted small">
                                    Kartu Peserta Ujian diterbitkan secara otomatis sesaat setelah Anda menekan tombol
                                    "Kirim Formulir" di halaman website ini. Kartu tersebut dapat langsung Anda unduh
                                    dalam format PDF atau dicetak untuk dibawa saat hari pelaksanaan ujian masuk.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item border rounded-3 overflow-hidden">
                            <h2 class="accordion-header" id="faq4Heading">
                                <button class="accordion-button collapsed fw-bold text-dark" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#faq4" aria-expanded="false"
                                    aria-controls="faq4">
                                    Bagaimana prosedur bagi santri dari luar pulau yang memilih ujian online?
                                </button>
                            </h2>
                            <div id="faq4" class="accordion-collapse collapse" aria-labelledby="faq4Heading"
                                data-bs-parent="#faqAccordion">
                                <div class="accordion-body text-muted small">
                                    Bagi pendaftar luar provinsi/luar pulau yang memilih model ujian daring, panitia
                                    akan mengirimkan tautan Zoom Meeting resmi dan jadwal sesi ujian tatap muka virtual
                                    via WhatsApp H-2 sebelum tanggal ujian seleksi.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Kontak & Sekretariat -->
                <div class="col-lg-6">
                    <span class="section-tag"><i class="bi bi-headset me-1"></i> Layanan Informasi</span>
                    <h3 class="section-title mb-4">Sekretariat Panitia PPDB</h3>

                    <div class="p-4 rounded-4 bg-light border mb-4">
                        <div class="d-flex align-items-start gap-3 mb-3">
                            <i class="bi bi-geo-alt-fill text-danger fs-3"></i>
                            <div>
                                <h6 class="fw-bold mb-1">Alamat Kampus Pesantren</h6>
                                <p class="text-muted small mb-0">{{ $ppdbSetting->alamat }}</p>
                            </div>
                        </div>

                        <div class="d-flex align-items-start gap-3 mb-3">
                            <i class="bi bi-telephone-fill text-success fs-3"></i>
                            <div>
                                <h6 class="fw-bold mb-1">Telepon &amp; Helpdesk PPDB</h6>
                                <p class="text-muted small mb-0">{{ $ppdbSetting->telepon }}</p>
                            </div>
                        </div>

                        <div class="d-flex align-items-start gap-3 mb-3">
                            <i class="bi bi-whatsapp text-success fs-3"></i>
                            <div>
                                <h6 class="fw-bold mb-1">Hotline WhatsApp Panitia PPDB</h6>
                                <p class="text-muted small mb-0">{{ $ppdbSetting->telepon }} (Layanan Fast Response)
                                </p>
                            </div>
                        </div>

                        <div class="d-flex align-items-start gap-3">
                            <i class="bi bi-envelope-fill text-primary fs-3"></i>
                            <div>
                                <h6 class="fw-bold mb-1">Email Resmi PPDB</h6>
                                <p class="text-muted small mb-0">{{ $ppdbSetting->email }}</p>
                            </div>
                        </div>
                    </div>

                    @php
                        $cleanPhone = preg_replace('/[^0-9]/', '', $ppdbSetting->telepon);
                        if (str_starts_with($cleanPhone, '0')) {
                            $cleanPhone = '62' . substr($cleanPhone, 1);
                        }
                    @endphp
                    <a href="https://wa.me/{{ $cleanPhone }}?text=Assalamu%27alaikum%20Panitia%20PPDB%20Pesantren%20Li%20Ulil%20Albab,%20saya%20ingin%20berkonsultasi%20mengenai%20pendaftaran%20santri%20baru"
                        target="_blank"
                        class="btn btn-pesantren w-100 py-3 fw-bold d-flex align-items-center justify-content-center gap-2">
                        <i class="bi bi-whatsapp fs-5"></i> Chat Langsung dengan Panitia PPDB di WhatsApp
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- ========================================== -->
    <!-- FOOTER                                     -->
    <!-- ========================================== -->
    <footer class="bg-dark text-white pt-5 pb-4" style="background-color: #022c22 !important;">
        <div class="container">
            <div class="row gy-4 mb-5">
                <div class="col-lg-5">
                    <div class="d-flex align-items-center gap-2 mb-3">
                        @if ($ppdbSetting->logo_url)
                            <img src="{{ $ppdbSetting->logo_url }}" alt="Logo Pesantren"
                                class="rounded-3 shadow-sm flex-shrink-0 bg-white p-1"
                                style="width: 42px; height: 42px; object-fit: contain;">
                        @else
                            <span
                                class="d-inline-flex align-items-center justify-content-center bg-success text-white rounded-3"
                                style="width: 42px; height: 42px;">
                                <i class="bi bi-book-half fs-4"></i>
                            </span>
                        @endif
                        <div>
                            <h5 class="fw-bold mb-0">PP. LI ULIL ALBAB</h5>
                            <small class="text-warning">Islamic Boarding School</small>
                        </div>
                    </div>
                    <p class="text-white-50 small mb-4 pe-lg-4">
                        Portal pusat dokumentasi kegiatan, galeri video, dan sistem penerimaan santri baru terpadu
                        Pondok Pesantren Modern Li Ulil Albab. Membina generasi qur'ani, tafaqquh fiddin, mandiri, dan
                        berwawasan global.
                    </p>
                    <div class="d-flex gap-2">
                        <a href="#" class="btn btn-sm btn-outline-light rounded-circle"><i
                                class="bi bi-facebook"></i></a>
                        <a href="#" class="btn btn-sm btn-outline-light rounded-circle"><i
                                class="bi bi-instagram"></i></a>
                        <a href="#" class="btn btn-sm btn-outline-light rounded-circle"><i
                                class="bi bi-youtube"></i></a>
                        <a href="https://wa.me/6287799107735" target="_blank"
                            class="btn btn-sm btn-outline-light rounded-circle"><i class="bi bi-whatsapp"></i></a>
                    </div>
                </div>

                <div class="col-6 col-lg-3">
                    <h6 class="fw-bold text-warning mb-3">Navigasi Portal</h6>
                    <ul class="list-unstyled small text-white-50 d-flex flex-column gap-2 mb-0">
                        <li><a href="#beranda" class="text-white-50 text-decoration-none">Beranda Utama</a></li>
                        <li><a href="#profil" onclick="switchProfilTab('tab-profil-btn')" class="text-white-50 text-decoration-none"><i class="bi bi-building text-warning me-1"></i> Profil &amp; Sejarah</a></li>
                        <li><a href="#profil" onclick="switchProfilTab('tab-visimisi-btn')" class="text-white-50 text-decoration-none"><i class="bi bi-compass text-warning me-1"></i> Visi, Misi &amp; Nilai</a></li>
                        <li><a href="#profil" onclick="switchProfilTab('tab-struktur-btn')" class="text-white-50 text-decoration-none"><i class="bi bi-diagram-3-fill text-warning me-1"></i> Struktur Kepengurusan</a></li>
                        <li><a href="#kegiatan" class="text-white-50 text-decoration-none">Dokumentasi Foto Kegiatan</a></li>
                        <li><a href="#video" class="text-white-50 text-decoration-none">Video Galeri Santri</a></li>
                        <li><a href="#alur-ujian" class="text-white-50 text-decoration-none">Alur Persyaratan &amp; Ujian</a></li>
                        <li><a href="#formulir-ppdb" class="text-white-50 text-decoration-none">Formulir PPDB Online</a></li>
                    </ul>
                </div>

                <div class="col-6 col-lg-4">
                    <h6 class="fw-bold text-warning mb-3">Akses Sistem Manajemen</h6>
                    <p class="small text-white-50 mb-3">Akses SIMPONPES khusus untuk Dewan Asatidz, Pengurus Asrama,
                        dan
                        Pimpinan Pondok (Login Terproteksi):</p>
                    <div class="d-flex flex-column gap-2">
                        @auth
                            <a href="{{ route('dashboard') }}"
                                class="btn btn-sm btn-warning text-dark fw-bold d-inline-flex align-items-center gap-2">
                                <i class="bi bi-speedometer2"></i> Dashboard SIMPONPES
                            </a>
                        @else
                            <a href="{{ route('login') }}"
                                class="btn btn-sm btn-outline-success text-white fw-bold d-inline-flex align-items-center gap-2">
                                <i class="bi bi-shield-lock-fill"></i> Masuk SIMPONPES Pesantren
                            </a>
                        @endauth
                        <span class="text-white-50 small">&copy; {{ date('Y') }} Pondok Pesantren Li Ulil Albab.
                            All
                            Rights Reserved.</span>
                    </div>
                </div>
            </div>

            <div class="pt-4 border-top border-secondary border-opacity-25 text-center text-white-50 small">
                Portal Informasi Kegiatan &amp; PPDB Online Resmi Pondok Pesantren Li Ulil Albab.
            </div>
        </div>
    </footer>

    <!-- ============================================================== -->
    <!-- MODAL 1: DETAIL DOKUMENTASI KEGIATAN                          -->
    <!-- ============================================================== -->
    <div class="modal fade" id="modalDetailKegiatan" tabindex="-1" aria-labelledby="modalKegiatanTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
                <div class="position-relative">
                    <img id="modalKegiatanImg" src="" alt="Dokumentasi" class="w-100"
                        style="height: 320px; object-fit: cover;">
                    <button type="button"
                        class="btn-close btn-close-white position-absolute top-0 end-0 m-3 p-2 bg-dark rounded-circle"
                        data-bs-dismiss="modal" aria-label="Close"></button>
                    <span id="modalKegiatanBadge"
                        class="position-absolute bottom-0 start-0 m-3 badge bg-success fs-6"></span>
                </div>
                <div class="modal-body p-4 p-md-5">
                    <div class="d-flex flex-wrap align-items-center gap-3 text-muted small mb-3">
                        <span><i class="bi bi-calendar-event text-success me-1"></i> <span
                                id="modalKegiatanTanggal"></span></span>
                        <span><i class="bi bi-geo-alt-fill text-danger me-1"></i> <span
                                id="modalKegiatanLokasi"></span></span>
                    </div>
                    <h3 class="fw-bold text-dark mb-3" id="modalKegiatanTitle"></h3>
                    <p class="text-muted leading-relaxed" id="modalKegiatanDesc"></p>

                    <div class="mt-4 pt-3 border-top d-flex justify-content-between align-items-center">
                        <span class="text-muted small"><i class="bi bi-camera me-1"></i> Dokumentasi Media Center Li
                            Ulil Albab</span>
                        <button type="button" class="btn btn-secondary btn-sm"
                            data-bs-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ============================================================== -->
    <!-- MODAL 2: VIDEO PLAYER MODAL                                   -->
    <!-- ============================================================== -->
    <div class="modal fade" id="modalVideoPlayer" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content bg-dark border-0 rounded-4 overflow-hidden text-white">
                <div class="modal-header border-secondary py-2 px-3">
                    <h6 class="modal-title fw-bold" id="modalVideoTitle">Putar Video Kegiatan</h6>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close" onclick="stopVideoModal()"></button>
                </div>
                <div class="modal-body p-0 ratio ratio-16x9">
                    <iframe id="modalVideoIframe" src="" title="Video Player"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen></iframe>
                    <video id="modalVideoPlayerHtml5" controls class="w-100 h-100 d-none"
                        style="object-fit: contain; background: #000;"></video>
                </div>
            </div>
        </div>
    </div>

    <!-- ============================================================== -->
    <!-- MODAL 3: KARTU PESERTA UJIAN MASUK PPDB (OFFICIAL RECEIPT)     -->
    <!-- ============================================================== -->
    <div class="modal fade" id="modalKartuUjian" tabindex="-1" aria-labelledby="modalKartuUjianTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
                <div class="modal-header bg-success text-white py-3 px-4">
                    <div class="d-flex align-items-center gap-2">
                        <i class="bi bi-check-circle-fill fs-4 text-warning"></i>
                        <h5 class="modal-title fw-bold mb-0" id="modalKartuUjianTitle">Kartu Bukti Pendaftaran &amp;
                            Tiket Ujian Masuk</h5>
                    </div>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>

                <div class="modal-body p-4 p-md-5" id="kartuUjianArea">
                    <!-- Kartu Fisik Preview -->
                    <div class="kartu-ujian">
                        <!-- Kop Surat Kartu -->
                        <div class="kartu-header d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center gap-3">
                                @if ($ppdbSetting->logo_url)
                                    <img src="{{ $ppdbSetting->logo_url }}" alt="Logo Pesantren"
                                        class="rounded-3 shadow-sm bg-white p-1"
                                        style="width: 50px; height: 50px; object-fit: contain;">
                                @else
                                    <span
                                        class="d-inline-flex align-items-center justify-content-center bg-success text-white rounded-3"
                                        style="width: 50px; height: 50px;">
                                        <i class="bi bi-book-half fs-3"></i>
                                    </span>
                                @endif
                                <div>
                                    <h5 class="fw-bold mb-0 text-success">PANITIA PENERIMAAN SANTRI BARU (PPDB)</h5>
                                    <h6 class="fw-bold mb-0 text-dark">PONDOK PESANTREN MODERN LI ULIL ALBAB</h6>
                                    <small class="text-muted">Tahun Ajaran 2026/2027 | Sekretariat: (+62)
                                        877-9910-7735</small>
                                </div>
                            </div>
                            <div class="text-end d-none d-sm-block">
                                <div class="badge bg-danger fs-6 mb-1">KARTU UJIAN SELEKSI</div>
                                <div class="small text-muted font-monospace" id="kartuTanggalCetak"></div>
                            </div>
                        </div>

                        <!-- Info Nomor Ujian & Barcode Dummy -->
                        <div class="row align-items-center p-3 bg-light rounded-3 mb-4 border">
                            <div class="col-sm-7">
                                <span class="text-muted small">NOMOR REGISTRASI / PESERTA UJIAN:</span>
                                <h3 class="fw-bold text-success font-monospace mb-0" id="kartuNoUjian">
                                    PPDB-2026-0000
                                </h3>
                            </div>
                            <div class="col-sm-5 text-sm-end mt-2 mt-sm-0">
                                <span class="badge bg-warning text-dark px-3 py-2 fw-bold"
                                    id="kartuJalurUjian">Jalur
                                    Reguler</span>
                            </div>
                        </div>

                        <!-- Data Calon Santri Table -->
                        <div class="table-responsive mb-4">
                            <table class="table table-sm table-borderless mb-0">
                                <tbody>
                                    <tr>
                                        <td style="width: 35%;" class="text-muted">Nama Lengkap Santri</td>
                                        <td style="width: 5%;">:</td>
                                        <td class="fw-bold text-dark fs-6" id="kartuNamaSantri">-</td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">Jenis Kelamin</td>
                                        <td>:</td>
                                        <td class="fw-semibold text-dark" id="kartuJenisKelamin">-</td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">Pilihan Jenjang Pendidikan</td>
                                        <td>:</td>
                                        <td class="fw-bold text-success" id="kartuJenjang">-</td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">Model Pelaksanaan Ujian</td>
                                        <td>:</td>
                                        <td class="fw-semibold text-dark" id="kartuModelUjian">-</td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">Jadwal Pelaksanaan Ujian</td>
                                        <td>:</td>
                                        <td class="fw-bold text-danger" id="kartuJadwalUjian">Sabtu, 13 Juni 2027
                                            (08.00 WIB)</td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">Lokasi / Ruang Ujian</td>
                                        <td>:</td>
                                        <td class="fw-bold text-dark" id="kartuRuangUjian">Gedung Rektorat Lt. 2
                                            (Ruang Al-Fatih)</td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">Nama Orang Tua / Wali</td>
                                        <td>:</td>
                                        <td class="fw-semibold text-dark" id="kartuNamaWali">-</td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">No. WhatsApp Wali Santri</td>
                                        <td>:</td>
                                        <td class="fw-semibold text-dark" id="kartuNoWa">-</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- Catatan Penting Saat Ujian -->
                        <div
                            class="p-3 bg-warning bg-opacity-10 border border-warning rounded-3 small text-dark mb-2">
                            <strong><i class="bi bi-info-circle-fill text-warning me-1"></i> Petunjuk Pelaksanaan
                                Ujian
                                Masuk:</strong>
                            <ol class="mb-0 ps-3 mt-1">
                                <li>Wajib membawa cetak kartu ujian ini dan kartu tanda pengenal (jika ada).</li>
                                <li>Membawa berkas fisik (FC Akta Lahir, FC KK, FC Rapor dilegalisir, dan Pasfoto 3x4).
                                </li>
                                <li>Hadir di lokasi ujian 30 menit sebelum jadwal dimulai dengan mengenakan busana
                                    muslim/muslimah rapi dan bersepatu.</li>
                                <li>Didampingi oleh orang tua / wali santri untuk sesi wawancara khusus.</li>
                            </ol>
                        </div>
                    </div>
                </div>

                <div class="modal-footer bg-light px-4 py-3 d-flex justify-content-between align-items-center">
                    <button type="button" class="btn btn-outline-secondary"
                        data-bs-dismiss="modal">Tutup</button>
                    <div class="d-flex gap-2">
                        <button type="button" class="btn btn-success fw-bold" onclick="window.print()">
                            <i class="bi bi-printer-fill me-1"></i> Cetak Kartu Ujian (PDF / Print)
                        </button>
                        <a id="btnKonfirmasiWA" href="#" target="_blank"
                            class="btn btn-warning fw-bold text-dark">
                            <i class="bi bi-whatsapp me-1"></i> Konfirmasi ke WA Panitia
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom JavaScript Functions -->
    <script>
        // 1. Filter Dokumentasi Kegiatan
        function filterKegiatan(category, btnElement) {
            // Update active button
            const buttons = document.querySelectorAll('.filter-btn');
            buttons.forEach(btn => btn.classList.remove('active'));
            btnElement.classList.add('active');

            // Filter cards
            const items = document.querySelectorAll('.kegiatan-item');
            items.forEach(item => {
                if (category === 'all' || item.getAttribute('data-category') === category) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
        }

        // 2. Tampilkan Detail Modal Kegiatan
        function lihatDetailKegiatan(title, date, location, category, imgUrl, description) {
            document.getElementById('modalKegiatanTitle').innerText = title;
            document.getElementById('modalKegiatanTanggal').innerText = date;
            document.getElementById('modalKegiatanLokasi').innerText = location;
            document.getElementById('modalKegiatanBadge').innerText = category;
            document.getElementById('modalKegiatanImg').src = imgUrl;
            document.getElementById('modalKegiatanDesc').innerText = description;

            const modal = new bootstrap.Modal(document.getElementById('modalDetailKegiatan'));
            modal.show();
        }

        // 3. Putar Video di Modal (Mendukung YouTube & Video Upload Perangkat)
        function putarVideoModal(source, title, isLocal = false) {
            document.getElementById('modalVideoTitle').innerText = title;
            const iframe = document.getElementById('modalVideoIframe');
            const html5Player = document.getElementById('modalVideoPlayerHtml5');

            if (isLocal) {
                if (iframe) {
                    iframe.src = '';
                    iframe.classList.add('d-none');
                }
                if (html5Player) {
                    html5Player.src = source;
                    html5Player.classList.remove('d-none');
                    html5Player.play().catch(e => console.log('Autoplay blocked:', e));
                }
            } else {
                if (html5Player) {
                    html5Player.pause();
                    html5Player.src = '';
                    html5Player.classList.add('d-none');
                }
                if (iframe) {
                    iframe.classList.remove('d-none');
                    iframe.src = `https://www.youtube-nocookie.com/embed/${source}?autoplay=1&rel=0`;
                }
            }

            const modal = new bootstrap.Modal(document.getElementById('modalVideoPlayer'));
            modal.show();
        }

        function stopVideoModal() {
            const iframe = document.getElementById('modalVideoIframe');
            if (iframe) {
                iframe.src = '';
            }

            const html5Player = document.getElementById('modalVideoPlayerHtml5');
            if (html5Player) {
                html5Player.pause();
                html5Player.src = '';
            }
        }

        document.getElementById('modalVideoPlayer').addEventListener('hidden.bs.modal', function() {
            stopVideoModal();
        });

        // 4. Handle PPDB Form Submission & Tampilkan Kartu Ujian Masuk
        function handlePPDBSubmit(event) {
            const form = document.getElementById('formPPDBSantri');
            if (!form.checkValidity()) {
                return true;
            }

            event.preventDefault();

            const submitBtn = form.querySelector('button[type="submit"]');
            const originalBtnHtml = submitBtn.innerHTML;
            submitBtn.disabled = true;
            submitBtn.innerHTML =
                '<span class="spinner-border spinner-border-sm me-2"></span> Menyimpan Data & Menerbitkan Tiket...';

            const formData = new FormData(form);

            fetch(form.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    }
                })
                .then(res => res.json())
                .then(res => {
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = originalBtnHtml;

                    if (res.success && res.data) {
                        const data = res.data;

                        // Set Data ke Modal Kartu Ujian
                        document.getElementById('kartuNoUjian').innerText = data.no_pendaftaran;
                        document.getElementById('kartuJalurUjian').innerText = `Jalur: ${data.jalur}`;
                        document.getElementById('kartuNamaSantri').innerText = data.nama_lengkap;
                        document.getElementById('kartuJenisKelamin').innerText = data.jenis_kelamin;
                        document.getElementById('kartuJenjang').innerText = data.jenjang;
                        document.getElementById('kartuModelUjian').innerText = data.model_ujian;
                        document.getElementById('kartuJadwalUjian').innerText = data.jadwal_ujian;
                        document.getElementById('kartuRuangUjian').innerText = data.ruang_ujian;
                        document.getElementById('kartuNamaWali').innerText = data.nama_wali;
                        document.getElementById('kartuNoWa').innerText = data.no_wa;
                        document.getElementById('kartuTanggalCetak').innerText = `Tanggal: ${data.tanggal_daftar}`;

                        const waText = encodeURIComponent(
                            `Assalamu'alaikum Panitia PPDB Pesantren Li Ulil Albab. Saya sudah mengisi formulir PPDB online dengan Nomor Pendaftaran: ${data.no_pendaftaran} atas nama santri: ${data.nama_lengkap} (${data.jenjang}). Mohon konfirmasi jadwal ujian masuk. Terima kasih.`
                        );
                        document.getElementById('btnKonfirmasiWA').href = `https://wa.me/6287799107735?text=${waText}`;

                        // Update Dynamic Quick Stats di Halaman Beranda Secara Real-Time!
                        const statPpdb = document.getElementById('statPendaftarPpdb');
                        if (statPpdb) {
                            const current = parseInt(statPpdb.innerText.replace(/[^0-9]/g, '')) || 0;
                            statPpdb.innerText = (current + 1).toString();
                        }

                        const statSisa = document.getElementById('statSisaKuota');
                        if (statSisa) {
                            const currentSisa = parseInt(statSisa.innerText.replace(/[^0-9]/g, '')) || 0;
                            statSisa.innerText = Math.max(0, currentSisa - 1).toString();
                        }

                        // Tampilkan Modal Kartu Ujian
                        const modalKartu = new bootstrap.Modal(document.getElementById('modalKartuUjian'));
                        modalKartu.show();

                        form.reset();
                    } else {
                        alert('Gagal memproses pendaftaran. Silakan periksa kelengkapan formulir Anda.');
                    }
                })
                .catch(err => {
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = originalBtnHtml;
                    console.error('PPDB Error:', err);
                    // Fallback submit form secara standard bila fetch jaringan terkendala
                    form.submit();
                });
        }

        // 5. Buka Kartu Ujian jika dari Session Flash Laravel
        @if (session('ppdb_success'))
            function bukaKartuUjianDariSession() {
                document.getElementById('kartuNoUjian').innerText = "{{ session('ppdb_success')['no_pendaftaran'] }}";
                document.getElementById('kartuJalurUjian').innerText = "Jalur: {{ session('ppdb_success')['jalur'] }}";
                document.getElementById('kartuNamaSantri').innerText = "{{ session('ppdb_success')['nama_lengkap'] }}";
                document.getElementById('kartuJenisKelamin').innerText = "{{ session('ppdb_success')['jenis_kelamin'] }}";
                document.getElementById('kartuJenjang').innerText = "{{ session('ppdb_success')['jenjang'] }}";
                document.getElementById('kartuModelUjian').innerText = "{{ session('ppdb_success')['model_ujian'] }}";
                document.getElementById('kartuJadwalUjian').innerText = "{{ session('ppdb_success')['jadwal_ujian'] }}";
                document.getElementById('kartuRuangUjian').innerText = "{{ session('ppdb_success')['ruang_ujian'] }}";
                document.getElementById('kartuNamaWali').innerText = "{{ session('ppdb_success')['nama_wali'] }}";
                document.getElementById('kartuNoWa').innerText = "{{ session('ppdb_success')['no_wa'] }}";
                document.getElementById('kartuTanggalCetak').innerText =
                    "Tanggal: {{ session('ppdb_success')['tanggal_daftar'] }}";

                const waText = encodeURIComponent(
                    "Assalamu'alaikum Panitia PPDB Pesantren Li Ulil Albab. Saya sudah mengisi formulir PPDB online dengan Nomor Pendaftaran: {{ session('ppdb_success')['no_pendaftaran'] }} atas nama santri: {{ session('ppdb_success')['nama_lengkap'] }} ({{ session('ppdb_success')['jenjang'] }}). Mohon konfirmasi jadwal ujian masuk. Terima kasih."
                );
                document.getElementById('btnKonfirmasiWA').href = `https://wa.me/6281234567890?text=${waText}`;

                const modalKartu = new bootstrap.Modal(document.getElementById('modalKartuUjian'));
                modalKartu.show();
            }

            // Otomatis buka modal saat pertama kali load dari redirect sukses
            window.addEventListener('DOMContentLoaded', () => {
                bukaKartuUjianDariSession();
            });
        @endif

        // 6. Switch Profil Tabs & URL Hash Listener
        function switchProfilTab(tabBtnId) {
            const btn = document.getElementById(tabBtnId);
            if (btn) {
                const tab = new bootstrap.Tab(btn);
                tab.show();
            }
        }

        // Auto switch tab if URL hash points to specific sub-topic
        window.addEventListener('DOMContentLoaded', () => {
            const hash = window.location.hash;
            if (hash === '#visi-misi' || hash === '#visi' || hash === '#misi') {
                switchProfilTab('tab-visimisi-btn');
                const profilEl = document.getElementById('profil');
                if (profilEl) {
                    profilEl.scrollIntoView({ behavior: 'smooth' });
                }
            } else if (hash === '#struktur' || hash === '#struktur-pengurus' || hash === '#struktur-organisasi') {
                switchProfilTab('tab-struktur-btn');
                const profilEl = document.getElementById('profil');
                if (profilEl) {
                    profilEl.scrollIntoView({ behavior: 'smooth' });
                }
            } else if (hash === '#profil' || hash === '#profil-sejarah') {
                switchProfilTab('tab-profil-btn');
            }
        });
    </script>
</body>

</html>
