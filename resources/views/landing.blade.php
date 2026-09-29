<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Informasi Kegiatan &amp; PPDB - Pondok Pesantren Ulil Albab</title>
    <meta name="description"
        content="Portal resmi informasi kegiatan santri, dokumentasi foto, galeri video, serta alur persyaratan dan formulir pendaftaran PPDB online Pondok Pesantren Ulil Albab.">

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

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: #1e293b;
            overflow-x: hidden;
            scroll-behavior: smooth;
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
            background: rgba(255, 255, 255, 0.97);
            backdrop-filter: blur(14px);
            border-bottom: 1px solid rgba(226, 232, 240, 0.8);
            transition: all 0.3s ease;
        }

        .nav-link {
            font-weight: 500;
            color: #334155 !important;
            padding: 0.5rem 0.95rem !important;
            font-size: 0.83rem;
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
            padding: 0.75rem 1.5rem;
            border-radius: 12px;
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
            font-weight: 200;
            border: none;
            padding: 0.50rem 1.5rem;
            border-radius: 28px;
            box-shadow: 0 6px 18px rgba(217, 119, 6, 0.35);
            transition: all 0.25s ease;
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
    </style>
</head>

<body>

    <!-- Topbar Info -->
    <div class="topbar-info py-2 d-none d-md-block">
        <div class="container d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center gap-3">
                <span class="font-arabic fs-6 text-warning">بِسْمِ اللَّهِ الرَّحْمَٰنِ الرَّحِيمِ</span>
                <span class="text-white-50">|</span>
                <span><i class="bi bi-geo-alt-fill text-warning me-1"></i> Jl. Pesantren Modern No. 99, Ulil Albab
                    Center</span>
                <span><i class="bi bi-telephone-fill text-warning me-1"></i> (+62) 877-9910-7735</span>
            </div>
            <div class="d-flex align-items-center gap-3">
                <span class="badge bg-warning text-dark px-2 py-1 fw-bold">
                    <i class="bi bi-bell-fill me-1"></i> PPDB 2026/2027 Gelombang I Dibuka
                </span>
                <a href="{{ route('login') }}" class="text-white text-decoration-none small hover-underline">
                    <i class="bi bi-shield-lock-fill text-success me-1"></i> Login SIMPONPES
                </a>
            </div>
        </div>
    </div>

    <!-- Main Navigation Bar -->
    <nav class="navbar navbar-expand-lg main-navbar sticky-top py-3">
        <div class="container">
            <!-- Brand -->
            <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('landing') }}">
                <span
                    class="d-inline-flex align-items-center justify-content-center bg-success text-white rounded-3 shadow-sm"
                    style="width: 44px; height: 44px;">
                    <i class="bi bi-book-half fs-4"></i>
                </span>
                <div>
                    <span class="fw-bold fs-5 text-dark tracking-tight d-block lh-1">PONDOK PESANTERN LI ULIL
                        ALBAB</span>
                    <small class="text-muted" style="font-size: 0.72rem; letter-spacing: 0.05em;">PORTAL KEGIATAN &amp;
                        PPDB ONLINE</small>
                </div>
            </a>

            <!-- Mobile Toggler -->
            <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse"
                data-bs-target="#landingNav" aria-controls="landingNav" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Nav Links -->
            <div class="collapse navbar-collapse" id="landingNav">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link" href="#beranda">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link" href="#kegiatan">Dokumentasi Kegiatan</a></li>
                    <li class="nav-item"><a class="nav-link" href="#video">Video Kegiatan</a></li>
                    <li class="nav-item"><a class="nav-link" href="#alur-ujian">Alur &amp; Syarat Ujian</a></li>
                    <li class="nav-item"><a class="nav-link" href="#formulir-ppdb">Formulir PPDB</a></li>
                    <li class="nav-item"><a class="nav-link" href="#kontak">Kontak</a></li>
                </ul>

                <!-- Action Button Khusus Calon Santri & Wali -->
                <div class="d-flex align-items-center gap-2">
                    <a href="#formulir-ppdb" class="btn btn-gold d-inline-flex align-items-center gap-2 shadow-sm">
                        <i class="bi bi-pencil-square"></i> Daftar PPDB Online
                    </a>
                </div>
            </div>
        </div>
    </nav>

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
                <button type="button" class="btn btn-light btn-sm fw-bold px-3" onclick="bukaKartuUjianDariSession()">
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
                        Selamat datang di portal informasi resmi Pondok Pesantren Modern Ulil Albab. Saksikan
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

    <!-- Quick Stats -->
    <section class="py-4 bg-light border-bottom">
        <div class="container">
            <div class="row g-3 text-center">
                <div class="col-6 col-md-3">
                    <div class="p-3 bg-white rounded-3 shadow-sm border">
                        <div class="fs-2 fw-bold text-success">1.250+</div>
                        <div class="small fw-semibold text-secondary">Santri Aktif Mukim</div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="p-3 bg-white rounded-3 shadow-sm border">
                        <div class="fs-2 fw-bold text-warning">85+</div>
                        <div class="small fw-semibold text-secondary">Dewan Asatidz &amp; Mursyid</div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="p-3 bg-white rounded-3 shadow-sm border">
                        <div class="fs-2 fw-bold text-primary">30 Juz</div>
                        <div class="small fw-semibold text-secondary">Tahfidz Mutqin Bersanad</div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="p-3 bg-white rounded-3 shadow-sm border">
                        <div class="fs-2 fw-bold text-danger">350</div>
                        <div class="small fw-semibold text-secondary">Kuota Santri Baru (PPDB)</div>
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

            <!-- Activities Grid -->
            <div class="row g-4" id="kegiatanGrid">

                <!-- Kegiatan 1: Wisuda Tahfidz -->
                <div class="col-md-6 col-lg-4 kegiatan-item" data-category="tahfidz">
                    <div class="activity-card">
                        <div class="activity-img-wrapper">
                            <img src="https://images.unsplash.com/photo-1609599006353-e629aaabfeae?auto=format&fit=crop&w=700&q=80"
                                alt="Wisuda Tahfidz 30 Juz" loading="lazy">
                            <span class="activity-category-badge"><i class="bi bi-book me-1"></i> Tahfidz
                                Al-Qur'an</span>
                            <span class="activity-date-badge"><i class="bi bi-calendar3 me-1"></i> 18 Mei 2026</span>
                        </div>
                        <div class="p-4 d-flex flex-column flex-grow-1">
                            <h5 class="fw-bold text-dark mb-2">Wisuda Tahfidzul Qur'an &amp; Ujian Tasmi' 30 Juz</h5>
                            <p class="text-muted small mb-3 flex-grow-1">
                                Sebanyak 75 santri putra dan putri berhasil menuntaskan ujian tasmi' Al-Qur'an 30 juz
                                bil-ghaib sekali duduk dan menerima sanad qira'ah dari tim masyayikh.
                            </p>
                            <div class="d-flex align-items-center justify-content-between pt-3 border-top mt-auto">
                                <span class="small text-muted"><i class="bi bi-geo-alt me-1 text-danger"></i> Masjid
                                    Jami' Ulil Albab</span>
                                <button type="button" class="btn btn-sm btn-outline-success fw-bold"
                                    onclick="lihatDetailKegiatan('Wisuda Tahfidzul Qur\'an & Ujian Tasmi\' 30 Juz', '18 Mei 2026', 'Masjid Jami\' Ulil Albab', 'Tahfidz Al-Qur\'an', 'https://images.unsplash.com/photo-1609599006353-e629aaabfeae?auto=format&fit=crop&w=1000&q=80', 'Alhamdulillah, Pondok Pesantren Ulil Albab menggelar Haflah Wisuda Tahfidzul Qur\'an angkatan ke-XIV. Seluruh wisudawan telah melalui ujian tasmi\' bil-ghaib di hadapan dewan juri bersanad internasional. Momentum haru terjadi saat para santri menyematkan mahkota kemuliaan kepada kedua orang tua mereka.')">
                                    Detail <i class="bi bi-arrow-right"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Kegiatan 2: Pengajian Kitab Kuning -->
                <div class="col-md-6 col-lg-4 kegiatan-item" data-category="tahfidz">
                    <div class="activity-card">
                        <div class="activity-img-wrapper">
                            <img src="https://images.unsplash.com/photo-1542838132-92c53300491e?auto=format&fit=crop&w=700&q=80"
                                alt="Kajian Kitab Kuning Salaf" loading="lazy">
                            <span class="activity-category-badge"><i class="bi bi-journal-text me-1"></i> Kitab
                                Kuning</span>
                            <span class="activity-date-badge"><i class="bi bi-calendar3 me-1"></i> 22 Mei 2026</span>
                        </div>
                        <div class="p-4 d-flex flex-column flex-grow-1">
                            <h5 class="fw-bold text-dark mb-2">Kajian Kitab Fathul Qorib &amp; Ihya' Ulumuddin</h5>
                            <p class="text-muted small mb-3 flex-grow-1">
                                Pembacaan dan bedah kaidah fiqih madzhab Syafi'i secara bandongan dan sorogan yang
                                dipimpin langsung oleh Mudir Pesantren KH. Dr. Abdullah Syukri, M.Ag.
                            </p>
                            <div class="d-flex align-items-center justify-content-between pt-3 border-top mt-auto">
                                <span class="small text-muted"><i class="bi bi-geo-alt me-1 text-danger"></i> Selasar
                                    Utama Asrama</span>
                                <button type="button" class="btn btn-sm btn-outline-success fw-bold"
                                    onclick="lihatDetailKegiatan('Kajian Kitab Fathul Qorib & Ihya\' Ulumuddin', '22 Mei 2026', 'Selasar Utama Asrama', 'Kitab Kuning Salaf', 'https://images.unsplash.com/photo-1542838132-92c53300491e?auto=format&fit=crop&w=1000&q=80', 'Kegiatan kajian kitab kuning merupakan urat nadi pendidikan salafiyah di Pondok Pesantren Ulil Albab. Santri dilatih membaca naskah arab gundul (makna gandul/jenggot), memahami tata bahasa nahwu shorof, dan mengkontekstualisasikan hukum fiqih dalam kehidupan modern.')">
                                    Detail <i class="bi bi-arrow-right"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Kegiatan 3: Muhadharah 3 Bahasa -->
                <div class="col-md-6 col-lg-4 kegiatan-item" data-category="ekskul">
                    <div class="activity-card">
                        <div class="activity-img-wrapper">
                            <img src="https://images.unsplash.com/photo-1577495508048-b635879837f1?auto=format&fit=crop&w=700&q=80"
                                alt="Muhadharah Bahasa Asing" loading="lazy">
                            <span class="activity-category-badge"><i class="bi bi-translate me-1"></i> Public
                                Speaking</span>
                            <span class="activity-date-badge"><i class="bi bi-calendar3 me-1"></i> 27 Mei 2026</span>
                        </div>
                        <div class="p-4 d-flex flex-column flex-grow-1">
                            <h5 class="fw-bold text-dark mb-2">Muhadharah Kubro &amp; Debat Tiga Bahasa</h5>
                            <p class="text-muted small mb-3 flex-grow-1">
                                Asah kepemimpinan santri dalam berorasi ilmiah menggunakan bahasa Arab, Inggris, dan
                                Indonesia di hadapan ratusan santri dan dewan asatidz.
                            </p>
                            <div class="d-flex align-items-center justify-content-between pt-3 border-top mt-auto">
                                <span class="small text-muted"><i class="bi bi-geo-alt me-1 text-danger"></i> Gedung
                                    Auditorium</span>
                                <button type="button" class="btn btn-sm btn-outline-success fw-bold"
                                    onclick="lihatDetailKegiatan('Muhadharah Kubro & Debat Tiga Bahasa', '27 Mei 2026', 'Gedung Auditorium', 'Bahasa & Leadership', 'https://images.unsplash.com/photo-1577495508048-b635879837f1?auto=format&fit=crop&w=1000&q=80', 'Setiap malam Kamis dan Ahad, santri Ulil Albab wajib mengikuti kegiatan latihan pidato (muhadharah). Pada edisi kubro ini, para delegasi kelas menampilkan pidato bahasa Arab bertema peradaban Islam dan pidato bahasa Inggris tentang peran pemuda muslim dalam sains teknologi.')">
                                    Detail <i class="bi bi-arrow-right"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Kegiatan 4: Peringatan Maulid Nabi & Tabligh Akbar -->
                <div class="col-md-6 col-lg-4 kegiatan-item" data-category="phbi">
                    <div class="activity-card">
                        <div class="activity-img-wrapper">
                            <img src="https://images.unsplash.com/photo-1564769625905-50e93615e769?auto=format&fit=crop&w=700&q=80"
                                alt="Gema Shalawat dan Maulid Nabi" loading="lazy">
                            <span class="activity-category-badge"><i class="bi bi-moon-stars-fill me-1"></i> PHBI
                                &amp; Sholawat</span>
                            <span class="activity-date-badge"><i class="bi bi-calendar3 me-1"></i> 01 Juni 2026</span>
                        </div>
                        <div class="p-4 d-flex flex-column flex-grow-1">
                            <h5 class="fw-bold text-dark mb-2">Malam Gema Shalawat &amp; Tabligh Akbar</h5>
                            <p class="text-muted small mb-3 flex-grow-1">
                                Lantunan qashidah shalawat Simtudduror dan Burdah bersama grup hadrah santri,
                                dilanjutkan tausiyah kebangsaan oleh ulama tamu dari Tarim Yaman.
                            </p>
                            <div class="d-flex align-items-center justify-content-between pt-3 border-top mt-auto">
                                <span class="small text-muted"><i class="bi bi-geo-alt me-1 text-danger"></i> Lapangan
                                    Hijau Kampus</span>
                                <button type="button" class="btn btn-sm btn-outline-success fw-bold"
                                    onclick="lihatDetailKegiatan('Malam Gema Shalawat & Tabligh Akbar', '01 Juni 2026', 'Lapangan Hijau Kampus', 'PHBI & Sholawat', 'https://images.unsplash.com/photo-1564769625905-50e93615e769?auto=format&fit=crop&w=1000&q=80', 'Peringatan Hari Besar Islam dirayakan dengan khidmat dan meriah. Ribuan jamaah dari kalangan santri, wali santri, dan masyarakat sekitar larut dalam lantunan shalawat yang diiringi musik rebana klasik banjari hasil binaan sanggar seni pondok.')">
                                    Detail <i class="bi bi-arrow-right"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Kegiatan 5: Coding & Robotika Santri -->
                <div class="col-md-6 col-lg-4 kegiatan-item" data-category="ekskul">
                    <div class="activity-card">
                        <div class="activity-img-wrapper">
                            <img src="https://images.unsplash.com/photo-1531482615713-2afd69097998?auto=format&fit=crop&w=700&q=80"
                                alt="Santri Digital & Robotika" loading="lazy">
                            <span class="activity-category-badge"><i class="bi bi-cpu me-1"></i> Santri Digital</span>
                            <span class="activity-date-badge"><i class="bi bi-calendar3 me-1"></i> 05 Juni 2026</span>
                        </div>
                        <div class="p-4 d-flex flex-column flex-grow-1">
                            <h5 class="fw-bold text-dark mb-2">Santri Tech Expo: Coding &amp; Robotika MTs-MA</h5>
                            <p class="text-muted small mb-3 flex-grow-1">
                                Pameran inovasi teknologi santri, meliputi website manajemen zakat, sensor IoT penyiram
                                tanaman hidroponik pesantren, dan aplikasi tajwid interaktif.
                            </p>
                            <div class="d-flex align-items-center justify-content-between pt-3 border-top mt-auto">
                                <span class="small text-muted"><i class="bi bi-geo-alt me-1 text-danger"></i> Lab
                                    Sains &amp; Komputer</span>
                                <button type="button" class="btn btn-sm btn-outline-success fw-bold"
                                    onclick="lihatDetailKegiatan('Santri Tech Expo: Coding & Robotika MTs-MA', '05 Juni 2026', 'Lab Sains & Komputer', 'Sains & Robotika', 'https://images.unsplash.com/photo-1531482615713-2afd69097998?auto=format&fit=crop&w=1000&q=80', 'Menepis anggapan pesantren hanya belajar agama tradisional, santri Ulil Albab membuktikan prestasinya di kancah sains modern dengan memprogram mikrokontroler Arduino dan membuat software berbasis web yang bermanfaat untuk umat.')">
                                    Detail <i class="bi bi-arrow-right"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Kegiatan 6: Bakti Sosial & Poskestren -->
                <div class="col-md-6 col-lg-4 kegiatan-item" data-category="sosial">
                    <div class="activity-card">
                        <div class="activity-img-wrapper">
                            <img src="https://images.unsplash.com/photo-1593113598332-cd288d649433?auto=format&fit=crop&w=700&q=80"
                                alt="Bakti Sosial Santri" loading="lazy">
                            <span class="activity-category-badge"><i class="bi bi-heart-pulse-fill me-1"></i>
                                Pengabdian</span>
                            <span class="activity-date-badge"><i class="bi bi-calendar3 me-1"></i> 08 Juni 2026</span>
                        </div>
                        <div class="p-4 d-flex flex-column flex-grow-1">
                            <h5 class="fw-bold text-dark mb-2">Bakti Sosial &amp; Layanan Kesehatan Masyarakat</h5>
                            <p class="text-muted small mb-3 flex-grow-1">
                                Santri relawan Pos Kesehatan Pesantren (Poskestren) menyalurkan 500 paket sembako dan
                                mengadakan pemeriksaan kesehatan gratis bagi lansia di desa sekitar.
                            </p>
                            <div class="d-flex align-items-center justify-content-between pt-3 border-top mt-auto">
                                <span class="small text-muted"><i class="bi bi-geo-alt me-1 text-danger"></i> Desa
                                    Binaan Pesantren</span>
                                <button type="button" class="btn btn-sm btn-outline-success fw-bold"
                                    onclick="lihatDetailKegiatan('Bakti Sosial & Layanan Kesehatan Masyarakat', '08 Juni 2026', 'Desa Binaan Pesantren', 'Pengabdian Masyarakat', 'https://images.unsplash.com/photo-1593113598332-cd288d649433?auto=format&fit=crop&w=1000&q=80', 'Nilai kepedulian sosial ditanamkan secara langsung ke sanubari santri melalui program baksos tahunan. Santri diterjunkan langsung mendistribusikan kebutuhan pokok dan membantu paramedis dalam melayani masyarakat dhuafa.')">
                                    Detail <i class="bi bi-arrow-right"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

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

            <!-- Featured Video Player Block -->
            <div class="row g-4 align-items-center mb-5">
                <div class="col-lg-8">
                    <div class="video-box-main ratio ratio-16x9">
                        <iframe id="mainFeaturedPlayer" src="https://www.youtube-nocookie.com/embed/fD3_P_V0Q3Y?rel=0"
                            title="Profil Pondok Pesantren Ulil Albab"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen></iframe>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div
                        class="bg-white p-4 rounded-4 border shadow-sm h-100 d-flex flex-column justify-content-between">
                        <div>
                            <span class="badge bg-danger mb-2"><i class="bi bi-broadcast me-1"></i> VIDEO UTAMA
                                TERPILIH</span>
                            <h4 class="fw-bold text-dark mb-3">Dokumenter 24 Jam Kehidupan Santri di Pesantren</h4>
                            <p class="text-muted small mb-3">
                                Mulai dari qiyamul lail pukul 03.30 WIB, shalat subuh berjamaah, halaqah tahfidz shubuh,
                                sekolah formal MTs/MA, pengajian kitab kuning sore, hingga muthola'ah malam.
                            </p>
                            <div class="p-3 bg-light rounded-3 mb-3 small">
                                <div class="d-flex justify-content-between mb-1">
                                    <span class="text-muted">Produser:</span>
                                    <strong>Media Center Santri</strong>
                                </div>
                                <div class="d-flex justify-content-between mb-1">
                                    <span class="text-muted">Kualitas:</span>
                                    <span class="badge bg-success">Full HD 1080p</span>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <span class="text-muted">Durasi:</span>
                                    <strong>14 Menit 20 Detik</strong>
                                </div>
                            </div>
                        </div>
                        <a href="#formulir-ppdb" class="btn btn-pesantren w-100">
                            <i class="bi bi-mortarboard-fill me-1"></i> Tertarik Mondok? Daftar PPDB
                        </a>
                    </div>
                </div>
            </div>

            <!-- Video Playlist Cards Grid -->
            <div class="row g-4">

                <!-- Video Card 1 -->
                <div class="col-md-6 col-lg-4">
                    <div class="video-card"
                        onclick="putarVideoModal('fD3_P_V0Q3Y', 'Dokumenter: Sehari Penuh Menjadi Santri Ulil Albab')">
                        <div class="video-thumb-container">
                            <img src="https://images.unsplash.com/photo-1542838132-92c53300491e?auto=format&fit=crop&w=600&q=80"
                                alt="Video Thumbnail" loading="lazy">
                            <div class="play-button-overlay">
                                <i class="bi bi-play-fill fs-3"></i>
                            </div>
                            <span
                                class="position-absolute bottom-0 end-0 bg-dark text-white small px-2 py-1 m-2 rounded">14:20</span>
                        </div>
                        <div class="p-3">
                            <span class="badge bg-success bg-opacity-10 text-success small mb-1">Kehidupan
                                Santri</span>
                            <h6 class="fw-bold text-dark mb-1">Sehari Penuh Menjadi Santri Ulil Albab</h6>
                            <p class="text-muted small mb-0">Ritme kedisiplinan dan kehangatan ukhuwah para santri
                                asrama.</p>
                        </div>
                    </div>
                </div>

                <!-- Video Card 2 -->
                <div class="col-md-6 col-lg-4">
                    <div class="video-card"
                        onclick="putarVideoModal('fD3_P_V0Q3Y', 'Murottal Syahdu & Tasmi 30 Juz Sekali Duduk')">
                        <div class="video-thumb-container">
                            <img src="https://images.unsplash.com/photo-1609599006353-e629aaabfeae?auto=format&fit=crop&w=600&q=80"
                                alt="Video Thumbnail" loading="lazy">
                            <div class="play-button-overlay">
                                <i class="bi bi-play-fill fs-3"></i>
                            </div>
                            <span
                                class="position-absolute bottom-0 end-0 bg-dark text-white small px-2 py-1 m-2 rounded">08:45</span>
                        </div>
                        <div class="p-3">
                            <span class="badge bg-warning bg-opacity-10 text-warning small mb-1">Tahfidz Qur'an</span>
                            <h6 class="fw-bold text-dark mb-1">Murottal Syahdu &amp; Tasmi' 30 Juz Sekali Duduk</h6>
                            <p class="text-muted small mb-0">Ujian kelulusan hafalan juz 30 dengan tartil dan tajwid
                                mutqin.</p>
                        </div>
                    </div>
                </div>

                <!-- Video Card 3 -->
                <div class="col-md-6 col-lg-4">
                    <div class="video-card"
                        onclick="putarVideoModal('fD3_P_V0Q3Y', 'Pidato Bahasa Arab Santriwati di Festival Nasional')">
                        <div class="video-thumb-container">
                            <img src="https://images.unsplash.com/photo-1577495508048-b635879837f1?auto=format&fit=crop&w=600&q=80"
                                alt="Video Thumbnail" loading="lazy">
                            <div class="play-button-overlay">
                                <i class="bi bi-play-fill fs-3"></i>
                            </div>
                            <span
                                class="position-absolute bottom-0 end-0 bg-dark text-white small px-2 py-1 m-2 rounded">06:12</span>
                        </div>
                        <div class="p-3">
                            <span class="badge bg-primary bg-opacity-10 text-primary small mb-1">Bahasa Asing</span>
                            <h6 class="fw-bold text-dark mb-1">Pidato Bahasa Arab Santriwati Juara 1</h6>
                            <p class="text-muted small mb-0">Kefasihan penguasaan kosakata bahasa Arab dan dialek
                                fushah.</p>
                        </div>
                    </div>
                </div>

                <!-- Video Card 4 -->
                <div class="col-md-6 col-lg-4">
                    <div class="video-card"
                        onclick="putarVideoModal('fD3_P_V0Q3Y', 'Grup Hadrah El-Albab: Lantunan Qasidah Burdah')">
                        <div class="video-thumb-container">
                            <img src="https://images.unsplash.com/photo-1564769625905-50e93615e769?auto=format&fit=crop&w=600&q=80"
                                alt="Video Thumbnail" loading="lazy">
                            <div class="play-button-overlay">
                                <i class="bi bi-play-fill fs-3"></i>
                            </div>
                            <span
                                class="position-absolute bottom-0 end-0 bg-dark text-white small px-2 py-1 m-2 rounded">11:05</span>
                        </div>
                        <div class="p-3">
                            <span class="badge bg-danger bg-opacity-10 text-danger small mb-1">Seni Rebana</span>
                            <h6 class="fw-bold text-dark mb-1">Grup Hadrah Santri: Lantunan Shalawat Burdah</h6>
                            <p class="text-muted small mb-0">Harmoni tabuhan terbang dan vokal merdu shalawat para
                                santri.</p>
                        </div>
                    </div>
                </div>

                <!-- Video Card 5 -->
                <div class="col-md-6 col-lg-4">
                    <div class="video-card"
                        onclick="putarVideoModal('fD3_P_V0Q3Y', 'Inovasi Robotika & Coding Santri MTs-MA')">
                        <div class="video-thumb-container">
                            <img src="https://images.unsplash.com/photo-1531482615713-2afd69097998?auto=format&fit=crop&w=600&q=80"
                                alt="Video Thumbnail" loading="lazy">
                            <div class="play-button-overlay">
                                <i class="bi bi-play-fill fs-3"></i>
                            </div>
                            <span
                                class="position-absolute bottom-0 end-0 bg-dark text-white small px-2 py-1 m-2 rounded">09:30</span>
                        </div>
                        <div class="p-3">
                            <span class="badge bg-info bg-opacity-10 text-info small mb-1">Sains &amp; IT</span>
                            <h6 class="fw-bold text-dark mb-1">Inovasi Robotika &amp; Coding Santri Milenial</h6>
                            <p class="text-muted small mb-0">Santri mempresentasikan ciptaan robot line follower &amp;
                                sensor IoT.</p>
                        </div>
                    </div>
                </div>

                <!-- Video Card 6 -->
                <div class="col-md-6 col-lg-4">
                    <div class="video-card"
                        onclick="putarVideoModal('fD3_P_V0Q3Y', 'Latihan Silat & Olahraga Sunnah Memanah')">
                        <div class="video-thumb-container">
                            <img src="https://images.unsplash.com/photo-1593113598332-cd288d649433?auto=format&fit=crop&w=600&q=80"
                                alt="Video Thumbnail" loading="lazy">
                            <div class="play-button-overlay">
                                <i class="bi bi-play-fill fs-3"></i>
                            </div>
                            <span
                                class="position-absolute bottom-0 end-0 bg-dark text-white small px-2 py-1 m-2 rounded">07:18</span>
                        </div>
                        <div class="p-3">
                            <span class="badge bg-secondary bg-opacity-10 text-secondary small mb-1">Bela Diri</span>
                            <h6 class="fw-bold text-dark mb-1">Latihan Silat Pagar Nusa &amp; Olahraga Memanah</h6>
                            <p class="text-muted small mb-0">Menempa fisik yang kuat dan ketangkasan santri sesuai
                                ajaran Nabi.</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- ============================================================== -->
    <!-- SECTION 3: ALUR PERSYARATAN & UJIAN MASUK PPDB (IN-DEPTH)      -->
    <!-- ============================================================== -->
    <section id="alur-ujian" class="py-5 bg-white">
        <div class="container py-lg-4">
            <div class="text-center max-w-xl mx-auto mb-5">
                <span class="section-tag"><i class="bi bi-card-checklist me-1"></i> Panduan Masuk</span>
                <h2 class="section-title mb-2">Alur Persyaratan &amp; Ujian Seleksi Masuk</h2>
                <p class="text-muted">Prosedur resmi pendaftaran calon santri baru Pondok Pesantren Ulil Albab Tahun
                    Ajaran 2026/2027.</p>
            </div>

            <!-- 5 Steps Flow -->
            <div class="row g-4 mb-5">
                <div class="col-md-6 col-lg">
                    <div class="ppdb-step-box">
                        <div class="step-number">1</div>
                        <h6 class="fw-bold text-dark mb-2">Pengisian Formulir</h6>
                        <p class="small text-muted mb-0">Isi formulir pendaftaran daring di bawah ini secara lengkap
                            dengan data calon santri dan orang tua/wali.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg">
                    <div class="ppdb-step-box">
                        <div class="step-number">2</div>
                        <h6 class="fw-bold text-dark mb-2">Cetak Kartu Ujian</h6>
                        <p class="small text-muted mb-0">Sistem langsung menerbitkan Nomor Registrasi dan Kartu Peserta
                            Ujian Masuk resmi siap cetak/simpan PDF.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg">
                    <div class="ppdb-step-box">
                        <div class="step-number">3</div>
                        <h6 class="fw-bold text-dark mb-2">Pelaksanaan Ujian</h6>
                        <p class="small text-muted mb-0">Mengikuti tes seleksi baca Al-Qur'an, hafalan surat pendek,
                            tes akademik dasar, serta wawancara santri &amp; wali.</p>
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
                            pembagian kamar asrama, dan ta'aruf wali santri.</p>
                    </div>
                </div>
            </div>

            <!-- Persyaratan & Dokumen Persiapan -->
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
                            <li class="list-group-item bg-transparent px-0 d-flex gap-2">
                                <i class="bi bi-check-circle-fill text-success mt-1"></i>
                                <div><strong>Beragama Islam</strong> serta memiliki akhlaq dan kepribadian yang santun.
                                </div>
                            </li>
                            <li class="list-group-item bg-transparent px-0 d-flex gap-2">
                                <i class="bi bi-check-circle-fill text-success mt-1"></i>
                                <div><strong>Tamat SD/MI</strong> untuk pendaftar jenjang MTs Terpadu, atau
                                    <strong>Tamat SMP/MTs</strong> untuk pendaftar jenjang MA Unggulan / Takhasus
                                    Tahfidz.
                                </div>
                            </li>
                            <li class="list-group-item bg-transparent px-0 d-flex gap-2">
                                <i class="bi bi-check-circle-fill text-success mt-1"></i>
                                <div><strong>Sanggup Mukim di Asrama</strong> pesantren selama masa pendidikan
                                    berlangsung.</div>
                            </li>
                            <li class="list-group-item bg-transparent px-0 d-flex gap-2">
                                <i class="bi bi-check-circle-fill text-success mt-1"></i>
                                <div><strong>Bersedia Mematuhi Disiplin</strong> dan tata tertib yang ditetapkan
                                    pimpinan pondok dan dewan pengasuh.</div>
                            </li>
                            <li class="list-group-item bg-transparent px-0 d-flex gap-2">
                                <i class="bi bi-check-circle-fill text-success mt-1"></i>
                                <div><strong>Sehat Jasmani dan Rohani</strong>, bebas dari penyakit menular kronis
                                    (dibuktikan surat dokter).</div>
                            </li>
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
                            <li class="list-group-item bg-transparent px-0 d-flex gap-2">
                                <i class="bi bi-file-earmark-check-fill text-warning mt-1"></i>
                                <div><strong>Cetak Kartu Ujian Masuk PPDB</strong> yang diperoleh setelah mengisi
                                    formulir online di halaman ini.</div>
                            </li>
                            <li class="list-group-item bg-transparent px-0 d-flex gap-2">
                                <i class="bi bi-file-earmark-check-fill text-warning mt-1"></i>
                                <div><strong>Fotokopi Akta Kelahiran</strong> calon santri (2 lembar).</div>
                            </li>
                            <li class="list-group-item bg-transparent px-0 d-flex gap-2">
                                <i class="bi bi-file-earmark-check-fill text-warning mt-1"></i>
                                <div><strong>Fotokopi Kartu Keluarga (KK)</strong> dan KTP kedua Orang Tua / Wali (2
                                    lembar).</div>
                            </li>
                            <li class="list-group-item bg-transparent px-0 d-flex gap-2">
                                <i class="bi bi-file-earmark-check-fill text-warning mt-1"></i>
                                <div><strong>Fotokopi Rapor</strong> 2 semester terakhir yang dilegalisir kepala sekolah
                                    asal.</div>
                            </li>
                            <li class="list-group-item bg-transparent px-0 d-flex gap-2">
                                <i class="bi bi-file-earmark-check-fill text-warning mt-1"></i>
                                <div><strong>Pasfoto Berwarna 3x4</strong> terbaru (4 lembar, latar biru/merah,
                                    berbusana muslim rapi).</div>
                            </li>
                            <li class="list-group-item bg-transparent px-0 d-flex gap-2">
                                <i class="bi bi-file-earmark-check-fill text-warning mt-1"></i>
                                <div><strong>Piagam / Sertifikat Prestasi</strong> (wajib bagi pendaftar Jalur Beasiswa
                                    Tahfidz min. 3 Juz).</div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Rincian Materi Ujian Seleksi Masuk -->
            <div class="p-4 p-md-5 rounded-4 bg-light border">
                <div class="row align-items-center mb-4">
                    <div class="col-md-8">
                        <span class="badge bg-success mb-1">MATERI UJIAN MASUK</span>
                        <h4 class="fw-bold text-dark mb-0">Rincian Materi Ujian Seleksi Masuk Santri Baru</h4>
                    </div>
                    <div class="col-md-4 text-md-end mt-2 mt-md-0">
                        <span class="text-muted small"><i class="bi bi-stopwatch text-warning me-1"></i> Total Durasi
                            Ujian: ± 120 Menit</span>
                    </div>
                </div>

                <div class="row g-3">
                    <div class="col-md-6 col-lg-3">
                        <div class="exam-subject-card h-100">
                            <div class="text-success fs-3 mb-2"><i class="bi bi-book-half"></i></div>
                            <h6 class="fw-bold mb-1">1. Baca Tulis Al-Qur'an (BTQ)</h6>
                            <p class="small text-muted mb-0">Kelancaran membaca mushaf, penguasaan hukum tajwid (nun
                                mati, mad, waqaf), dan tes imla' / menulis ayat.</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="exam-subject-card h-100">
                            <div class="text-warning fs-3 mb-2"><i class="bi bi-bookmark-star-fill"></i></div>
                            <h6 class="fw-bold mb-1">2. Hafalan Surat Pilihan</h6>
                            <p class="small text-muted mb-0">Tes hafalan Juz 30 (Surat An-Naba s.d An-Nas). Bagi jalur
                                beasiswa tahfidz diuji sesuai jumlah juz yang diajukan.</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="exam-subject-card h-100">
                            <div class="text-primary fs-3 mb-2"><i class="bi bi-mortarboard"></i></div>
                            <h6 class="fw-bold mb-1">3. Tes Potensi Akademik</h6>
                            <p class="small text-muted mb-0">Matematika dasar, pemahaman nalar bahasa, pengetahuan
                                agama Islam dasar (Fikih Thaharah &amp; Shalat, Akhlaq).</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="exam-subject-card h-100">
                            <div class="text-danger fs-3 mb-2"><i class="bi bi-people-fill"></i></div>
                            <h6 class="fw-bold mb-1">4. Wawancara Santri &amp; Wali</h6>
                            <p class="small text-muted mb-0">Penggalian motivasi belajar mondok, kesiapan kemandirian
                                di asrama, serta komitmen kesepakatan wali santri.</p>
                        </div>
                    </div>
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
                                    <h5 class="fw-bold text-dark mb-0">Penerimaan Peserta Didik Baru (PPDB) 2026/2027
                                    </h5>
                                    <small class="text-muted">Pondok Pesantren Modern Li Ulil Albab</small>
                                </div>
                            </div>
                            <span class="badge bg-warning text-dark px-3 py-2 fw-bold d-none d-sm-inline-block">
                                <i class="bi bi-shield-check me-1"></i> Form Resmi
                            </span>
                        </div>

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
                                <button type="submit" class="btn btn-gold btn-lg py-3 fw-bold fs-6">
                                    <i class="bi bi-send-check-fill me-2"></i> Kirim Formulir &amp; Terbitkan Kartu
                                    Ujian Masuk
                                </button>
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
                                <p class="text-muted small mb-0">Jl. Pesantren Modern No. 99, Li Ulil Albab Islamic
                                    Center, Pandeglang Banten</p>
                            </div>
                        </div>

                        <div class="d-flex align-items-start gap-3 mb-3">
                            <i class="bi bi-telephone-fill text-success fs-3"></i>
                            <div>
                                <h6 class="fw-bold mb-1">Telepon Sekretariat</h6>
                                <p class="text-muted small mb-0">(+62) 877-9910-7735 / (+62) 8765-4322-2211</p>
                            </div>
                        </div>

                        <div class="d-flex align-items-start gap-3 mb-3">
                            <i class="bi bi-whatsapp text-success fs-3"></i>
                            <div>
                                <h6 class="fw-bold mb-1">Hotline WhatsApp Panitia PPDB</h6>
                                <p class="text-muted small mb-0">0877-9910-7735 (Layanan Fast Response Pukul 07.30 -
                                    16.00 WIB)</p>
                            </div>
                        </div>

                        <div class="d-flex align-items-start gap-3">
                            <i class="bi bi-envelope-fill text-primary fs-3"></i>
                            <div>
                                <h6 class="fw-bold mb-1">Email Resmi PPDB</h6>
                                <p class="text-muted small mb-0">ppdb@ulilalbab.ac.id / sekretariat@ulilalbab.ac.id</p>
                            </div>
                        </div>
                    </div>

                    <a href="https://wa.me/6281234567890?text=Assalamu%27alaikum%20Panitia%20PPDB%20Pesantren%20Ulil%20Albab,%20saya%20ingin%20berkonsultasi%20mengenai%20pendaftaran%20santri%20baru"
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
                        <span
                            class="d-inline-flex align-items-center justify-content-center bg-success text-white rounded-3"
                            style="width: 42px; height: 42px;">
                            <i class="bi bi-book-half fs-4"></i>
                        </span>
                        <div>
                            <h5 class="fw-bold mb-0">PP. ULIL ALBAB</h5>
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
                        <li><a href="#kegiatan" class="text-white-50 text-decoration-none">Dokumentasi Foto
                                Kegiatan</a></li>
                        <li><a href="#video" class="text-white-50 text-decoration-none">Video Galeri Santri</a></li>
                        <li><a href="#alur-ujian" class="text-white-50 text-decoration-none">Alur Persyaratan &amp;
                                Ujian</a></li>
                        <li><a href="#formulir-ppdb" class="text-white-50 text-decoration-none">Formulir PPDB
                                Online</a></li>
                    </ul>
                </div>

                <div class="col-6 col-lg-4">
                    <h6 class="fw-bold text-warning mb-3">Akses Sistem Manajemen</h6>
                    <p class="small text-white-50 mb-3">Akses SIMPONPES untuk Dewan Asatidz, Pengurus Asrama, dan
                        Pimpinan Pondok:</p>
                    <div class="d-flex flex-column gap-2">
                        <a href="{{ route('login') }}"
                            class="btn btn-sm btn-outline-success text-white fw-bold d-inline-flex align-items-center gap-2">
                            <i class="bi bi-box-arrow-in-right"></i> Masuk SIMPONPES Pesantren
                        </a>
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
                        <span class="text-muted small"><i class="bi bi-camera me-1"></i> Dokumentasi Media Center Ulil
                            Albab</span>
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
                                <span
                                    class="d-inline-flex align-items-center justify-content-center bg-success text-white rounded-3"
                                    style="width: 50px; height: 50px;">
                                    <i class="bi bi-book-half fs-3"></i>
                                </span>
                                <div>
                                    <h5 class="fw-bold mb-0 text-success">PANITIA PENERIMAAN SANTRI BARU (PPDB)</h5>
                                    <h6 class="fw-bold mb-0 text-dark">PONDOK PESANTREN MODERN ULIL ALBAB</h6>
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
                                <h3 class="fw-bold text-success font-monospace mb-0" id="kartuNoUjian">PPDB-2026-0000
                                </h3>
                            </div>
                            <div class="col-sm-5 text-sm-end mt-2 mt-sm-0">
                                <span class="badge bg-warning text-dark px-3 py-2 fw-bold" id="kartuJalurUjian">Jalur
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
                        <div class="p-3 bg-warning bg-opacity-10 border border-warning rounded-3 small text-dark mb-2">
                            <strong><i class="bi bi-info-circle-fill text-warning me-1"></i> Petunjuk Pelaksanaan Ujian
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
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Tutup</button>
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

        // 3. Putar Video di Modal
        function putarVideoModal(youtubeId, title) {
            document.getElementById('modalVideoTitle').innerText = title;
            const iframe = document.getElementById('modalVideoIframe');
            iframe.src = `https://www.youtube-nocookie.com/embed/${youtubeId}?autoplay=1&rel=0`;

            const modal = new bootstrap.Modal(document.getElementById('modalVideoPlayer'));
            modal.show();
        }

        function stopVideoModal() {
            const iframe = document.getElementById('modalVideoIframe');
            iframe.src = '';
        }

        document.getElementById('modalVideoPlayer').addEventListener('hidden.bs.modal', function() {
            stopVideoModal();
        });

        // 4. Handle PPDB Form Submission & Tampilkan Kartu Ujian Masuk
        function handlePPDBSubmit(event) {
            // Kita biarkan form divalidasi
            const form = document.getElementById('formPPDBSantri');
            if (!form.checkValidity()) {
                return true; // Let browser trigger HTML5 validation UI
            }

            event.preventDefault(); // Mencegah reload penuh seketika untuk menampilkan kartu interaktif

            // Ambil data form
            const nama = document.getElementById('nama_lengkap').value;
            const jk = document.getElementById('jenis_kelamin').value;
            const jenjang = document.getElementById('jenjang').value;
            const namaWali = document.getElementById('nama_wali').value;
            const noWa = document.getElementById('no_wa').value;
            const jalur = document.getElementById('jalur').value;
            const modelUjian = document.getElementById('model_ujian').value;

            // Generate nomor peserta unik
            const randomCode = Math.floor(1000 + Math.random() * 9000);
            const currentYear = new Date().getFullYear();
            const noUjian = `PPDB-${currentYear}-${randomCode}`;

            // Tentukan jadwal & ruang
            const jadwal = (jalur === 'Prestasi Tahfidz') ?
                'Sabtu, 13 Juni 2027 (08.00 - 11.30 WIB)' :
                'Minggu, 14 Juni 2027 (08.00 - 11.30 WIB)';
            const ruang = (modelUjian === 'Online / Jarak Jauh') ?
                'Ruang Virtual Zoom Seleksi 01' :
                'Gedung Rektorat Lt. 2 (Ruang Al-Fatih)';

            // Set ke Kartu Ujian Modal
            document.getElementById('kartuNoUjian').innerText = noUjian;
            document.getElementById('kartuJalurUjian').innerText = `Jalur: ${jalur}`;
            document.getElementById('kartuNamaSantri').innerText = nama;
            document.getElementById('kartuJenisKelamin').innerText = jk;
            document.getElementById('kartuJenjang').innerText = jenjang;
            document.getElementById('kartuModelUjian').innerText = modelUjian;
            document.getElementById('kartuJadwalUjian').innerText = jadwal;
            document.getElementById('kartuRuangUjian').innerText = ruang;
            document.getElementById('kartuNamaWali').innerText = namaWali;
            document.getElementById('kartuNoWa').innerText = noWa;

            const now = new Date();
            document.getElementById('kartuTanggalCetak').innerText =
                `Tanggal Daftar: ${now.toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' })}`;

            // Set WhatsApp confirmation link
            const waText = encodeURIComponent(
                `Assalamu'alaikum Panitia PPDB Pesantren Ulil Albab. Saya sudah mengisi formulir PPDB online dengan Nomor Pendaftaran: ${noUjian} atas nama santri: ${nama} (${jenjang}). Mohon konfirmasi jadwal ujian masuk. Terima kasih.`
            );
            document.getElementById('btnKonfirmasiWA').href = `https://wa.me/628779107735?text=${waText}`;

            // Tampilkan Modal Kartu Ujian
            const modalKartu = new bootstrap.Modal(document.getElementById('modalKartuUjian'));
            modalKartu.show();

            // Opsional: kirim ke server via fetch di latar belakang agar tersimpan di backend Laravel
            const formData = new FormData(form);
            fetch(form.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            }).catch(err => console.log('PPDB background sync:', err));
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
                    "Assalamu'alaikum Panitia PPDB Pesantren Ulil Albab. Saya sudah mengisi formulir PPDB online dengan Nomor Pendaftaran: {{ session('ppdb_success')['no_pendaftaran'] }} atas nama santri: {{ session('ppdb_success')['nama_lengkap'] }} ({{ session('ppdb_success')['jenjang'] }}). Mohon konfirmasi jadwal ujian masuk. Terima kasih."
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
    </script>
</body>

</html>
