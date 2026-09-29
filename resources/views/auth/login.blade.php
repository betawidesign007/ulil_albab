<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk Sistem SIMPONPES - Pondok Pesantren Ulil Albab</title>

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
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: linear-gradient(135deg, #022c22 0%, #065f46 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1.5rem;
        }

        .login-card {
            background: #ffffff;
            border-radius: 20px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            max-width: 950px;
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
        }

        .btn-pesantren:hover {
            background-color: #044332;
            color: #ffffff;
        }

        .quick-role-btn {
            border-radius: 12px;
            padding: 0.85rem 1rem;
            transition: all 0.2s ease;
            text-align: left;
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            border: 1px solid #e2e8f0;
        }

        .quick-role-btn:hover {
            transform: translateX(4px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }
    </style>
</head>

<body>

    <div class="login-card">
        <div class="row g-0">
            <!-- Left Info Panel -->
            <div class="col-lg-5 p-4 p-md-5 d-flex flex-column justify-content-between text-white"
                style="background: linear-gradient(145deg, #044332 0%, #065f46 100%);">
                <div>
                    <a href="{{ route('landing') }}"
                        class="text-white-50 text-decoration-none small d-inline-flex align-items-center gap-1 mb-4">
                        <i class="bi bi-arrow-left"></i> Kembali ke Website
                    </a>

                    <div class="d-flex align-items-center gap-2 mb-3">
                        <span
                            class="d-inline-flex align-items-center justify-content-center bg-white text-success rounded-circle shadow-sm"
                            style="width: 44px; height: 44px;">
                            <i class="bi bi-book-half fs-4 text-success"></i>
                        </span>
                        <div>
                            <h4 class="fw-bold mb-0">SIMPONPES</h4>
                            <small class="text-warning">PP.Li Ulil Albab</small>
                        </div>
                    </div>

                    <h3 class="fw-bold mb-3 mt-4">Sistem Manajemen Pesantren Terpadu</h3>
                    <p class="text-white-50 small mb-4">
                        Kelola data santri, pantau perkembangan pendidikan, dan dapatkan laporan statistik secara
                        real-time dengan hak akses terintegrasi.
                    </p>

                    <div class="p-3 rounded-3 bg-white bg-opacity-10 border border-white border-opacity-10 small mb-4">
                        <div class="fw-bold text-warning mb-2"><i class="bi bi-info-circle-fill me-1"></i> 3 Peran
                            Pengguna Aktif:</div>
                        <ul class="list-unstyled mb-0 d-flex flex-column gap-1 text-white-75">
                            <li>&bull; <strong>Admin</strong>: Hak akses penuh kelola data santri &amp; akun.</li>
                            <li>&bull; <strong>Pengajar</strong>: Pantau santri per kamar &amp; kelas.</li>
                            <li>&bull; <strong>Pemilik</strong>: Laporan eksekutif &amp; rekapitulasi data.</li>
                        </ul>
                    </div>
                </div>

                <div class="text-white-50 small">
                    &copy; {{ date('Y') }} Pondok Pesantren Ulil Albab.
                </div>
            </div>

            <!-- Right Form Panel -->
            <div class="col-lg-7 p-4 p-md-5 bg-white d-flex flex-column justify-content-center">
                <div class="mb-4">
                    <h3 class="fw-bold text-dark mb-1">Masuk ke Portal</h3>
                    <p class="text-muted small">Silakan pilih peran untuk <strong>Akses Cepat 1-Klik</strong> atau
                        masukkan akun manual di bawah ini.</p>
                </div>

                <!-- Alert Feedback -->
                @if (session('warning'))
                    <div class="alert alert-warning alert-dismissible fade show small" role="alert">
                        <i class="bi bi-exclamation-triangle-fill me-1"></i> {{ session('warning') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show small" role="alert">
                        <i class="bi bi-x-circle-fill me-1"></i> {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <!-- 1-Click Role Login Shortcuts (Demo Feature) -->
                <div class="mb-4">
                    <label class="form-label fw-bold text-dark small text-uppercase" style="letter-spacing: 0.05em;">
                        <i class="bi bi-lightning-charge-fill text-warning"></i> Akses Cepat Berdasarkan Peran (1-Klik)
                    </label>

                    <div class="d-flex flex-column gap-2">
                        <!-- Admin -->
                        <a href="{{ route('login', 'admin') }}"
                            class="quick-role-btn bg-danger bg-opacity-10 border-danger-subtle text-dark">
                            <span class="p-2 rounded-2 bg-danger text-white">
                                <i class="bi bi-shield-lock-fill"></i>
                            </span>
                            <div class="flex-grow-1">
                                <div class="fw-bold small text-danger">Masuk sebagai Administrator</div>
                                <div class="text-muted" style="font-size: 0.75rem;">Full CRUD santri &amp; manajemen
                                    user (admin@ulilalbab.ac.id)</div>
                            </div>
                            <i class="bi bi-chevron-right text-danger"></i>
                        </a>

                        <!-- Pengajar -->
                        <a href="{{ route('login', 'pengajar') }}"
                            class="quick-role-btn bg-primary bg-opacity-10 border-primary-subtle text-dark">
                            <span class="p-2 rounded-2 bg-primary text-white">
                                <i class="bi bi-mortarboard-fill"></i>
                            </span>
                            <div class="flex-grow-1">
                                <div class="fw-bold small text-primary">Masuk sebagai Dewan Pengajar / Asatidz</div>
                                <div class="text-muted" style="font-size: 0.75rem;">Melihat data santri &amp; kelas
                                    (pengajar@ulilalbab.ac.id)</div>
                            </div>
                            <i class="bi bi-chevron-right text-primary"></i>
                        </a>

                        <!-- Pemilik -->
                        <a href="{{ route('login', 'pemilik') }}"
                            class="quick-role-btn bg-warning bg-opacity-10 border-warning-subtle text-dark">
                            <span class="p-2 rounded-2 bg-warning text-dark">
                                <i class="bi bi-award-fill"></i>
                            </span>
                            <div class="flex-grow-1">
                                <div class="fw-bold small text-dark">Masuk sebagai Pemilik / Mudir Yayasan</div>
                                <div class="text-muted" style="font-size: 0.75rem;">Dashboard eksekutif &amp; cetak
                                    laporan (pemilik@ulilalbab.ac.id)</div>
                            </div>
                            <i class="bi bi-chevron-right text-dark"></i>
                        </a>
                    </div>
                </div>

                <div class="position-relative text-center my-3">
                    <hr>
                    <span class="position-absolute top-50 start-50 translate-middle bg-white px-3 text-muted small">atau
                        login manual</span>
                </div>

                <!-- Form Login Biasa -->
                <form action="{{ route('login.post') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="email" class="form-label fw-medium small text-dark">Alamat Email</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0"><i
                                    class="bi bi-envelope text-muted"></i></span>
                            <input type="email" name="email" id="email" value="{{ old('email') }}" required
                                autofocus class="form-control border-start-0 @error('email') is-invalid @enderror"
                                placeholder="nama@ulilalbab.ac.id">
                        </div>
                        @error('email')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label fw-medium small text-dark">Kata Sandi</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0"><i
                                    class="bi bi-key text-muted"></i></span>
                            <input type="password" name="password" id="password" required
                                class="form-control border-start-0" placeholder="••••••••">
                        </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember">
                            <label class="form-check-label small text-muted" for="remember">
                                Ingat saya di perangkat ini
                            </label>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-pesantren w-100 py-2">
                        <i class="bi bi-box-arrow-in-right me-1"></i> Masuk Sekarang
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
