@extends('layouts.app', ['title' => 'Pengaturan Informasi PPDB & Website'])

@section('content')
<div class="container-fluid px-3 px-lg-4 py-3" style="max-width: 1400px;">

    <!-- Header & Breadcrumb -->
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 mb-3 pb-2 border-bottom">
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-1" style="font-size: 0.8rem;">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-decoration-none text-success">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Pengaturan Informasi PPDB &amp; Web</li>
                </ol>
            </nav>
            <h2 class="h4 fw-bold mb-1 text-dark d-flex align-items-center gap-2">
                <i class="bi bi-sliders2 text-success"></i> Pengaturan Informasi PPDB &amp; Website
            </h2>
            <p class="text-muted mb-0 small" style="font-size: 0.78rem;">
                Seluruh data informasi penerimaan, jadwal, kuota, persyaratan, dan kontak di halaman utama website dapat dikontrol langsung dari halaman ini.
            </p>
        </div>
        <div class="d-flex align-items-center gap-2">
            <a href="{{ route('landing') }}#alur-ujian" target="_blank" class="btn btn-sm btn-outline-success shadow-sm py-2 px-3 fw-semibold" style="font-size: 0.8rem;">
                <i class="bi bi-box-arrow-up-right me-1"></i> Preview di Website Utama
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show d-flex align-items-center gap-2 shadow-sm mb-4" role="alert">
            <i class="bi bi-check-circle-fill fs-5"></i>
            <div>{{ session('success') }}</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show shadow-sm mb-4" role="alert">
            <div class="fw-bold mb-1"><i class="bi bi-exclamation-triangle-fill me-1"></i> Terdapat kesalahan pengisian formulir:</div>
            <ul class="mb-0 ps-3">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Status Overview Cards -->
    <div class="row g-3 mb-4">
        <div class="col-md-3 col-sm-6">
            <div class="card border-0 shadow-sm bg-white p-3 h-100 border-start border-4 border-success">
                <div class="text-muted small fw-semibold text-uppercase">Status Penerimaan</div>
                <div class="d-flex align-items-center justify-content-between mt-2">
                    <span class="badge {{ $setting->status_badge_class }} fs-6 px-3 py-2 rounded-pill">
                        <i class="bi bi-dot"></i> {{ $setting->status_label }}
                    </span>
                    <i class="bi bi-door-open-fill fs-3 text-success opacity-50"></i>
                </div>
                <small class="text-muted mt-2 d-block">Tahun Ajaran: <strong>{{ $setting->tahun_ajaran }}</strong></small>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="card border-0 shadow-sm bg-white p-3 h-100 border-start border-4 border-primary">
                <div class="text-muted small fw-semibold text-uppercase">Pendaftar Masuk</div>
                <div class="d-flex align-items-center justify-content-between mt-2">
                    <h3 class="fw-bold mb-0 text-primary">{{ number_format($totalPendaftar) }}</h3>
                    <i class="bi bi-people-fill fs-3 text-primary opacity-50"></i>
                </div>
                <small class="text-muted mt-2 d-block">Calon santri online tercatat</small>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="card border-0 shadow-sm bg-white p-3 h-100 border-start border-4 border-warning">
                <div class="text-muted small fw-semibold text-uppercase">Sisa Kuota Penerimaan</div>
                <div class="d-flex align-items-center justify-content-between mt-2">
                    <h3 class="fw-bold mb-0 text-warning">{{ number_format($sisaKuota) }}</h3>
                    <i class="bi bi-pie-chart-fill fs-3 text-warning opacity-50"></i>
                </div>
                <small class="text-muted mt-2 d-block">Dari total kuota: <strong>{{ $setting->kuota_penerimaan }}</strong> santri</small>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="card border-0 shadow-sm bg-white p-3 h-100 border-start border-4 border-info">
                <div class="text-muted small fw-semibold text-uppercase">Biaya Pendaftaran</div>
                <div class="d-flex align-items-center justify-content-between mt-2">
                    <h4 class="fw-bold mb-0 text-dark">{{ $setting->biaya_pendaftaran }}</h4>
                    <i class="bi bi-cash-coin fs-3 text-info opacity-50"></i>
                </div>
                <small class="text-muted mt-2 d-block text-truncate" title="{{ $setting->gelombang_aktif }}">{{ $setting->gelombang_aktif }}</small>
            </div>
        </div>
    </div>

    <!-- Main Settings Form -->
    <form action="{{ route('admin.ppdb.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Bagian 1: Status & Jadwal Penting PPDB -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white py-3 border-bottom">
                <h5 class="fw-bold mb-0 text-dark d-flex align-items-center gap-2">
                    <span class="badge bg-success bg-opacity-10 text-success p-2 rounded-circle">
                        <i class="bi bi-calendar-event fs-6"></i>
                    </span>
                    1. Pengaturan Status &amp; Jadwal Penerimaan PPDB Online
                </h5>
            </div>
            <div class="card-body p-4">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label fw-bold text-dark">Status PPDB Website <span class="text-danger">*</span></label>
                        <select name="status_ppdb" class="form-select @error('status_ppdb') is-invalid @enderror" required>
                            <option value="buka" {{ old('status_ppdb', $setting->status_ppdb) === 'buka' ? 'selected' : '' }}>
                                🟢 Pendaftaran Dibuka (Formulir Aktif & Dapat Digunakan)
                            </option>
                            <option value="segera" {{ old('status_ppdb', $setting->status_ppdb) === 'segera' ? 'selected' : '' }}>
                                🟡 Segera Dibuka (Tampilkan Countdown / Persiapan)
                            </option>
                            <option value="tutup" {{ old('status_ppdb', $setting->status_ppdb) === 'tutup' ? 'selected' : '' }}>
                                🔴 Pendaftaran Ditutup (Formulir Dinonaktifkan)
                            </option>
                        </select>
                        <div class="form-text">Status ini langsung mengontrol badge dan fungsi formulir pendaftaran di halaman utama website.</div>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-bold text-dark">Tahun Ajaran <span class="text-danger">*</span></label>
                        <input type="text" name="tahun_ajaran" class="form-control @error('tahun_ajaran') is-invalid @enderror" value="{{ old('tahun_ajaran', $setting->tahun_ajaran) }}" placeholder="Contoh: 2026/2027" required>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-bold text-dark">Gelombang Aktif <span class="text-danger">*</span></label>
                        <input type="text" name="gelombang_aktif" class="form-control @error('gelombang_aktif') is-invalid @enderror" value="{{ old('gelombang_aktif', $setting->gelombang_aktif) }}" placeholder="Contoh: Gelombang I (Jalur Prestasi & Reguler)" required>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-bold text-dark">Total Kuota Penerimaan (Santri) <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input type="number" min="1" name="kuota_penerimaan" class="form-control @error('kuota_penerimaan') is-invalid @enderror" value="{{ old('kuota_penerimaan', $setting->kuota_penerimaan) }}" required>
                            <span class="input-group-text">Santri</span>
                        </div>
                        <div class="form-text">Sisa kuota di halaman utama website akan otomatis berkurang saat ada santri baru yang mendaftar.</div>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-bold text-dark">Biaya Formulir Pendaftaran <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="text" name="biaya_pendaftaran" class="form-control @error('biaya_pendaftaran') is-invalid @enderror" value="{{ old('biaya_pendaftaran', $setting->biaya_pendaftaran) }}" placeholder="Contoh: 250.000 atau Gratis" required>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-bold text-dark">Tanggal Buka Pendaftaran <span class="text-danger">*</span></label>
                        <input type="text" name="tanggal_buka_pendaftaran" class="form-control @error('tanggal_buka_pendaftaran') is-invalid @enderror" value="{{ old('tanggal_buka_pendaftaran', $setting->tanggal_buka_pendaftaran) }}" placeholder="Contoh: 01 Januari 2026" required>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-bold text-dark">Tanggal Batas Tutup Pendaftaran <span class="text-danger">*</span></label>
                        <input type="text" name="tanggal_tutup_pendaftaran" class="form-control @error('tanggal_tutup_pendaftaran') is-invalid @enderror" value="{{ old('tanggal_tutup_pendaftaran', $setting->tanggal_tutup_pendaftaran) }}" placeholder="Contoh: 30 Mei 2026" required>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-bold text-dark">Jadwal Tanggal Ujian Seleksi <span class="text-danger">*</span></label>
                        <input type="text" name="tanggal_ujian_seleksi" class="form-control @error('tanggal_ujian_seleksi') is-invalid @enderror" value="{{ old('tanggal_ujian_seleksi', $setting->tanggal_ujian_seleksi) }}" placeholder="Contoh: Sabtu & Minggu, 13 - 14 Juni 2026" required>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-bold text-dark">Waktu / Jam Pelaksanaan Ujian <span class="text-danger">*</span></label>
                        <input type="text" name="jam_ujian" class="form-control @error('jam_ujian') is-invalid @enderror" value="{{ old('jam_ujian', $setting->jam_ujian) }}" placeholder="Contoh: 08.00 - 11.30 WIB" required>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-bold text-dark">Jadwal Tanggal Pengumuman Kelulusan <span class="text-danger">*</span></label>
                        <input type="text" name="tanggal_pengumuman" class="form-control @error('tanggal_pengumuman') is-invalid @enderror" value="{{ old('tanggal_pengumuman', $setting->tanggal_pengumuman) }}" placeholder="Contoh: 20 Juni 2026" required>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-bold text-dark">Jadwal Rentang Daftar Ulang Santri <span class="text-danger">*</span></label>
                        <input type="text" name="tanggal_daftar_ulang" class="form-control @error('tanggal_daftar_ulang') is-invalid @enderror" value="{{ old('tanggal_daftar_ulang', $setting->tanggal_daftar_ulang) }}" placeholder="Contoh: 25 Juni - 05 Juli 2026" required>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-bold text-dark">Tempat / Ruang Ujian Masuk <span class="text-danger">*</span></label>
                        <input type="text" name="lokasi_ujian" class="form-control @error('lokasi_ujian') is-invalid @enderror" value="{{ old('lokasi_ujian', $setting->lokasi_ujian) }}" placeholder="Contoh: Gedung Rektorat Lt. 2 (Ruang Al-Fatih) & Online" required>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bagian 2: Identitas Website, Banner Pengumuman & Kontak Resmi -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white py-3 border-bottom">
                <h5 class="fw-bold mb-0 text-dark d-flex align-items-center gap-2">
                    <span class="badge bg-warning bg-opacity-10 text-warning p-2 rounded-circle">
                        <i class="bi bi-info-circle-fill fs-6"></i>
                    </span>
                    2. Identitas Pesantren, Banner Pengumuman &amp; Kontak Panitia
                </h5>
            </div>
            <div class="card-body p-4">
                <div class="row g-3">
                    <!-- Upload & Preview Logo Pesantren -->
                    <div class="col-12 mb-2">
                        <div class="p-3 rounded-3 bg-light border">
                            <div class="row align-items-center g-3">
                                <div class="col-auto">
                                    <div class="text-center">
                                        <div class="p-2 bg-white rounded-3 border shadow-sm d-inline-block" style="width: 80px; height: 80px;">
                                            @if($setting->logo_url)
                                                <img src="{{ $setting->logo_url }}" id="logoPreview" alt="Logo Pesantren" class="w-100 h-100" style="object-fit: contain;">
                                            @else
                                                <div id="logoPreviewPlaceholder" class="w-100 h-100 d-flex align-items-center justify-content-center bg-success text-white rounded">
                                                    <i class="bi bi-book-half fs-2"></i>
                                                </div>
                                                <img src="" id="logoPreview" alt="Logo Pesantren" class="w-100 h-100 d-none" style="object-fit: contain;">
                                            @endif
                                        </div>
                                        <small class="text-muted d-block mt-1" style="font-size: 0.72rem;">Logo Saat Ini</small>
                                    </div>
                                </div>
                                <div class="col">
                                    <label class="form-label fw-bold text-dark mb-1">
                                        <i class="bi bi-image text-success me-1"></i> Logo Resmi Lembaga / Pondok Pesantren
                                    </label>
                                    <input type="file" name="logo_file" id="logoFileInput" class="form-control form-control-sm @error('logo_file') is-invalid @enderror" accept="image/*" onchange="previewLogo(event)">
                                    @error('logo_file')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text small text-muted mt-1">
                                        Format disarankan: <strong>PNG atau WebP transparan</strong>, bisa juga JPG, SVG, GIF, atau BMP. Rasio persegi (1:1), maks. 20 MB. Logo ini otomatis tampil di navigasi atas website, footer, bukti cetak kartu ujian santri, dan kop surat.
                                    </div>
                                </div>
                                @if($setting->logo)
                                    <div class="col-auto">
                                        <div class="form-check form-switch pt-2">
                                            <input class="form-check-input" type="checkbox" name="hapus_logo" value="1" id="hapusLogoCheck">
                                            <label class="form-check-label small text-danger fw-semibold" for="hapusLogoCheck">
                                                Reset ke Logo Bawaan
                                            </label>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold text-dark">Nama Pondok Pesantren <span class="text-danger">*</span></label>
                        <input type="text" name="nama_pesantren" class="form-control @error('nama_pesantren') is-invalid @enderror" value="{{ old('nama_pesantren', $setting->nama_pesantren) }}" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold text-dark">Tagline / Slogan Resmi <span class="text-danger">*</span></label>
                        <input type="text" name="tagline_pesantren" class="form-control @error('tagline_pesantren') is-invalid @enderror" value="{{ old('tagline_pesantren', $setting->tagline_pesantren) }}" required>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-bold text-dark">No. WhatsApp / Call Center PPDB <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-whatsapp text-success"></i></span>
                            <input type="text" name="telepon" class="form-control @error('telepon') is-invalid @enderror" value="{{ old('telepon', $setting->telepon) }}" placeholder="(+62) 877-9910-7735" required>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-bold text-dark">Email Resmi Panitia PPDB <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-envelope text-primary"></i></span>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $setting->email) }}" placeholder="ppdb@ulilalbab.ac.id" required>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-bold text-dark">Link File Brosur PPDB (PDF)</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-file-earmark-pdf text-danger"></i></span>
                            <input type="url" name="link_brosur" class="form-control @error('link_brosur') is-invalid @enderror" value="{{ old('link_brosur', $setting->link_brosur) }}" placeholder="https://example.com/brosur-ppdb-2026.pdf">
                        </div>
                    </div>

                    <div class="col-12">
                        <label class="form-label fw-bold text-dark">Alamat Lengkap Pesantren <span class="text-danger">*</span></label>
                        <input type="text" name="alamat" class="form-control @error('alamat') is-invalid @enderror" value="{{ old('alamat', $setting->alamat) }}" required>
                    </div>

                    <div class="col-12">
                        <label class="form-label fw-bold text-dark">Teks Banner Pengumuman Penting di Halaman Utama</label>
                        <textarea name="pengumuman_banner" rows="2" class="form-control @error('pengumuman_banner') is-invalid @enderror" placeholder="Teks banner ini akan tampil di bagian atas halaman utama website sebagai pengumuman publik...">{{ old('pengumuman_banner', $setting->pengumuman_banner) }}</textarea>
                        <div class="form-text">Pesan informasi penting yang menyambut calon wali santri di beranda website. Kosongkan jika tidak ingin menampilkan banner.</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bagian 3: Persyaratan Calon Santri & Berkas Wajib -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white py-3 border-bottom">
                <h5 class="fw-bold mb-0 text-dark d-flex align-items-center gap-2">
                    <span class="badge bg-primary bg-opacity-10 text-primary p-2 rounded-circle">
                        <i class="bi bi-card-checklist fs-6"></i>
                    </span>
                    3. Persyaratan Umum Calon Santri &amp; Berkas Fisik Wajib
                </h5>
            </div>
            <div class="card-body p-4">
                <div class="row g-4">
                    <div class="col-lg-6">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <label class="form-label fw-bold text-dark mb-0">Persyaratan Umum Calon Santri</label>
                            <span class="badge bg-secondary">Satu baris = satu poin checklist</span>
                        </div>
                        <textarea name="persyaratan_santri" rows="8" class="form-control font-monospace @error('persyaratan_santri') is-invalid @enderror" style="font-size: 0.9rem;" placeholder="Tuliskan persyaratan umum, pisahkan tiap poin dengan baris baru (Enter)...">{{ old('persyaratan_santri', $setting->persyaratan_santri) }}</textarea>
                        <div class="form-text">Setiap baris teks di atas otomatis dijadikan daftar centang persyaratan di landing page.</div>
                    </div>

                    <div class="col-lg-6">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <label class="form-label fw-bold text-dark mb-0">Berkas Wajib Dibawa Saat Ujian</label>
                            <span class="badge bg-secondary">Satu baris = satu dokumen</span>
                        </div>
                        <textarea name="berkas_wajib" rows="8" class="form-control font-monospace @error('berkas_wajib') is-invalid @enderror" style="font-size: 0.9rem;" placeholder="Tuliskan berkas wajib, pisahkan tiap dokumen dengan baris baru (Enter)...">{{ old('berkas_wajib', $setting->berkas_wajib) }}</textarea>
                        <div class="form-text">Setiap baris teks di atas otomatis ditampilkan dalam kotak berkas fisik di landing page.</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bagian 5: Profil & Sejarah Lembaga Pesantren -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white py-3 border-bottom d-flex align-items-center justify-content-between">
                <h5 class="fw-bold mb-0 text-dark d-flex align-items-center gap-2">
                    <span class="badge bg-success bg-opacity-10 text-success p-2 rounded-circle">
                        <i class="bi bi-building fs-6"></i>
                    </span>
                    5. Pengaturan Profil &amp; Sejarah Lembaga Pesantren
                </h5>
                <span class="badge bg-light text-muted border">Tampil di Tab "Profil &amp; Sejarah"</span>
            </div>
            <div class="card-body p-4">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label fw-bold text-dark">Nama Pengasuh / Pimpinan Pondok</label>
                        <input type="text" name="sambutan_pengasuh_nama" class="form-control" value="{{ old('sambutan_pengasuh_nama', $setting->sambutan_pengasuh_nama) }}" placeholder="Contoh: KH. Dr. Abdullah Syukri, M.Ag">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold text-dark">Jabatan Pengasuh</label>
                        <input type="text" name="sambutan_pengasuh_jabatan" class="form-control" value="{{ old('sambutan_pengasuh_jabatan', $setting->sambutan_pengasuh_jabatan) }}" placeholder="Contoh: Pengasuh & Mudir 'Aam">
                    </div>
                    <div class="col-12">
                        <label class="form-label fw-bold text-dark">Foto Resmi Pengasuh / Pimpinan Pondok</label>
                        <div class="d-flex align-items-center gap-3 p-3 bg-light rounded-3 border">
                            @if($setting->sambutan_pengasuh_foto_url)
                                <img src="{{ $setting->sambutan_pengasuh_foto_url }}" alt="Foto Pengasuh" class="rounded-circle shadow-sm border border-2 border-warning" style="width: 70px; height: 70px; object-fit: cover;">
                            @else
                                <div class="rounded-circle bg-warning text-dark d-flex align-items-center justify-content-center shadow-sm" style="width: 70px; height: 70px; font-size: 1.8rem;">
                                    <i class="bi bi-person-badge-fill"></i>
                                </div>
                            @endif
                            <div class="flex-grow-1">
                                <input type="file" name="sambutan_pengasuh_foto_file" class="form-control form-control-sm" accept="image/*">
                                <div class="form-text small">Unggah pasfoto resmi pimpinan/pengasuh (JPG, PNG, WEBP maks. 20 MB). Tampil di kartu sambutan pengasuh.</div>
                                @if($setting->sambutan_pengasuh_foto)
                                    <div class="form-check mt-1">
                                        <input class="form-check-input" type="checkbox" name="hapus_sambutan_pengasuh_foto" value="1" id="hapusFotoPengasuh">
                                        <label class="form-check-label small text-danger" for="hapusFotoPengasuh">
                                            Hapus foto kustom dan gunakan avatar ikon default
                                        </label>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <label class="form-label fw-bold text-dark">Kutipan / Headline Sambutan Pengasuh</label>
                        <input type="text" name="sambutan_pengasuh_quote" class="form-control" value="{{ old('sambutan_pengasuh_quote', $setting->sambutan_pengasuh_quote) }}" placeholder="Contoh: Membina Generasi yang Hafal Al-Qur'an, Berwawasan Luas, dan Berakhlak Mulia.">
                    </div>
                    <div class="col-12">
                        <label class="form-label fw-bold text-dark">Teks Lengkap Sambutan Pengasuh</label>
                        <textarea name="sambutan_pengasuh_teks" rows="4" class="form-control" placeholder="Tuliskan pesan sambutan hangat pimpinan pondok...">{{ old('sambutan_pengasuh_teks', $setting->sambutan_pengasuh_teks) }}</textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold text-dark">Sejarah Singkat Pendirian Pesantren</label>
                        <textarea name="sejarah_singkat" rows="5" class="form-control" placeholder="Tuliskan latar belakang pendirian, tahun berdiri, dan perkembangan pesantren...">{{ old('sejarah_singkat', $setting->sejarah_singkat) }}</textarea>
                        <div class="mt-2 p-2 bg-light rounded-3 border">
                            <label class="form-label small fw-bold text-dark mb-1">Foto Gedung / Dokumentasi Sejarah (Opsional)</label>
                            @if($setting->sejarah_foto_url)
                                <div class="mb-2">
                                    <img src="{{ $setting->sejarah_foto_url }}" alt="Foto Sejarah" class="rounded-2 shadow-sm border" style="max-height: 80px; object-fit: cover;">
                                </div>
                            @endif
                            <input type="file" name="sejarah_foto_file" class="form-control form-control-sm" accept="image/*">
                            @if($setting->sejarah_foto)
                                <div class="form-check mt-1">
                                    <input class="form-check-input" type="checkbox" name="hapus_sejarah_foto" value="1" id="hapusFotoSejarah">
                                    <label class="form-check-label text-danger small" for="hapusFotoSejarah">Hapus foto gedung</label>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold text-dark">Filosofi Nama Pesantren</label>
                        <textarea name="filosofi_nama" rows="5" class="form-control" placeholder="Tuliskan makna dan landasan nama pesantren...">{{ old('filosofi_nama', $setting->filosofi_nama) }}</textarea>
                    </div>
                    <div class="col-12">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <label class="form-label fw-bold text-dark mb-0">Sarana &amp; Fasilitas Pembelajaran Asrama</label>
                            <span class="badge bg-secondary">Satu baris = satu fasilitas</span>
                        </div>
                        <textarea name="sarana_prasarana" rows="5" class="form-control font-monospace" placeholder="Tuliskan fasilitas pesantren, pisahkan dengan baris baru (Enter)...">{{ old('sarana_prasarana', is_array($setting->sarana_list) ? implode("\n", $setting->sarana_list) : '') }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bagian 6: Visi, Misi & Nilai Luhur Pesantren -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white py-3 border-bottom d-flex align-items-center justify-content-between">
                <h5 class="fw-bold mb-0 text-dark d-flex align-items-center gap-2">
                    <span class="badge bg-warning bg-opacity-10 text-warning p-2 rounded-circle">
                        <i class="bi bi-compass fs-6"></i>
                    </span>
                    6. Pengaturan Visi, Misi &amp; Standar Kelulusan
                </h5>
                <span class="badge bg-light text-muted border">Tampil di Tab "Visi, Misi &amp; Nilai"</span>
            </div>
            <div class="card-body p-4">
                <div class="row g-3">
                    <div class="col-12">
                        <label class="form-label fw-bold text-dark">Visi Akbar Pesantren</label>
                        <textarea name="visi_pesantren" rows="3" class="form-control" placeholder="Tuliskan kalimat visi jangka panjang pesantren...">{{ old('visi_pesantren', $setting->visi_pesantren) }}</textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold text-dark">Motto Pendidikan Santri</label>
                        <input type="text" name="motto_pesantren" class="form-control" value="{{ old('motto_pesantren', $setting->motto_pesantren) }}" placeholder="Contoh: Berilmu Amaliah, Beramal Ilmiah, & Berakhlakul Karimah">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold text-dark">Foto / Banner Ilustrasi Visi Misi (Opsional)</label>
                        @if($setting->visi_misi_foto_url)
                            <div class="mb-2">
                                <img src="{{ $setting->visi_misi_foto_url }}" alt="Banner Visi Misi" class="rounded-2 shadow-sm border" style="max-height: 80px; object-fit: cover;">
                            </div>
                        @endif
                        <input type="file" name="visi_misi_foto_file" class="form-control form-control-sm" accept="image/*">
                        <div class="form-text small">Gambar latar belakang untuk banner Visi Pesantren di halaman utama.</div>
                        @if($setting->visi_misi_foto)
                            <div class="form-check mt-1">
                                <input class="form-check-input" type="checkbox" name="hapus_visi_misi_foto" value="1" id="hapusFotoVisiMisi">
                                <label class="form-check-label text-danger small" for="hapusFotoVisiMisi">Hapus banner kustom</label>
                            </div>
                        @endif
                    </div>
                    <div class="col-12">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <label class="form-label fw-bold text-dark mb-0">Misi Strategis Pesantren</label>
                            <span class="badge bg-secondary">Format tiap baris: Judul Misi: Penjelasan singkat</span>
                        </div>
                        @php
                            $misiFormatted = [];
                            foreach ($setting->misi_list as $m) {
                                $misiFormatted[] = ($m['judul'] ?? '') . ': ' . ($m['deskripsi'] ?? '');
                            }
                        @endphp
                        <textarea name="misi_pesantren" rows="6" class="form-control font-monospace" placeholder="Contoh:&#10;Tarbiyah Qur'aniyah: Menyelenggarakan program Tahfidzul Qur'an 30 Juz...&#10;Tafaqquh Fiddin: Mengintegrasikan kurikulum salaf dan sains...">{{ old('misi_pesantren', implode("\n", $misiFormatted)) }}</textarea>
                    </div>
                    <div class="col-12">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <label class="form-label fw-bold text-dark mb-0">Standar Kompetensi Lulusan (SKL)</label>
                            <span class="badge bg-secondary">Format tiap baris: Kategori: Target capaian</span>
                        </div>
                        @php
                            $sklFormatted = [];
                            foreach ($setting->standar_kelulusan_list as $s) {
                                if (is_array($s)) {
                                    $sklFormatted[] = ($s['kategori'] ?? '') . ': ' . ($s['deskripsi'] ?? '');
                                } else {
                                    $sklFormatted[] = (string) $s;
                                }
                            }
                        @endphp
                        <textarea name="standar_kelulusan" rows="4" class="form-control font-monospace" placeholder="Tuliskan target kelulusan santri per baris...">{{ old('standar_kelulusan', implode("\n", $sklFormatted)) }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bagian 7: Struktur Kepengurusan & Organisasi Pesantren -->
        @php
            $struktur = $setting->struktur_organisasi_list;
            $puncak = $struktur['puncak'] ?? [];
            $bph = $struktur['bph'] ?? [];
            $divisi = $struktur['divisi'] ?? [];
            $userList = $users ?? collect();
        @endphp
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white py-3 border-bottom d-flex align-items-center justify-content-between">
                <h5 class="fw-bold mb-0 text-dark d-flex align-items-center gap-2">
                    <span class="badge bg-primary bg-opacity-10 text-primary p-2 rounded-circle">
                        <i class="bi bi-diagram-3-fill fs-6"></i>
                    </span>
                    7. Pengaturan Struktur Kepengurusan &amp; Organisasi
                </h5>
                <span class="badge bg-light text-muted border">Tampil di Tab "Struktur Kepengurusan"</span>
            </div>
            <div class="card-body p-4">
                <!-- Level 1: Pimpinan Puncak -->
                <div class="p-3 bg-light rounded-3 border mb-4">
                    <h6 class="fw-bold text-success mb-3"><i class="bi bi-award-fill me-1 text-warning"></i> Level 1: Pimpinan Puncak (Mudir 'Aam / Pengasuh)</h6>
                    <div class="row g-3">
                        <div class="col-md-5">
                            <label class="form-label small fw-bold text-dark">Nama Lengkap &amp; Gelar</label>
                            <input type="text" name="struktur[puncak][nama]" class="form-control form-control-sm" value="{{ old('struktur.puncak.nama', $puncak['nama'] ?? '') }}" placeholder="Nama Pengasuh">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small fw-bold text-dark">Jabatan Resmi</label>
                            <input type="text" name="struktur[puncak][jabatan]" class="form-control form-control-sm" value="{{ old('struktur.puncak.jabatan', $puncak['jabatan'] ?? '') }}" placeholder="Pengasuh & Mudir 'Aam">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label small fw-bold text-dark">Label Badge</label>
                            <input type="text" name="struktur[puncak][badge]" class="form-control form-control-sm" value="{{ old('struktur.puncak.badge', $puncak['badge'] ?? 'PIMPINAN PUNCAK') }}">
                        </div>
                        <div class="col-12">
                            <label class="form-label small fw-bold text-dark">Deskripsi Peran &amp; Tanggung Jawab</label>
                            <input type="text" name="struktur[puncak][deskripsi]" class="form-control form-control-sm" value="{{ old('struktur.puncak.deskripsi', $puncak['deskripsi'] ?? '') }}" placeholder="Tugas utama pimpinan puncak">
                        </div>
                        <div class="col-12">
                            <label class="form-label small fw-bold text-dark mb-1">Foto Profil Pimpinan Puncak</label>
                            <div class="d-flex align-items-center gap-3 p-2 bg-white rounded-3 border">
                                @if(!empty($puncak['foto_url']))
                                    <img src="{{ $puncak['foto_url'] }}" alt="Foto Puncak" class="rounded-circle shadow-sm border border-2 border-warning" style="width: 50px; height: 50px; object-fit: cover;">
                                @else
                                    <div class="rounded-circle bg-warning text-dark d-flex align-items-center justify-content-center shadow-sm" style="width: 50px; height: 50px; font-size: 1.3rem;">
                                        <i class="bi bi-person-fill"></i>
                                    </div>
                                @endif
                                <div class="flex-grow-1">
                                    <input type="file" name="foto_struktur_puncak" class="form-control form-control-sm" accept="image/*">
                                    <div class="form-text small" style="font-size: 0.72rem;">Unggah pasfoto resmi pimpinan puncak (JPG, PNG, WEBP).</div>
                                    @if(!empty($puncak['foto']))
                                        <div class="form-check mt-1">
                                            <input class="form-check-input" type="checkbox" name="hapus_foto_struktur_puncak" value="1" id="hapusFotoPuncak">
                                            <label class="form-check-label text-danger small" for="hapusFotoPuncak" style="font-size: 0.75rem;">
                                                Hapus foto kustom
                                            </label>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Level 2: Badan Pengurus Harian (BPH) -->
                <div class="p-3 bg-light rounded-3 border mb-4">
                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 mb-3">
                        <div>
                            <h6 class="fw-bold text-primary mb-1"><i class="bi bi-people-fill me-1"></i> Level 2: Badan Pengurus Harian (Wakil Mudir, Sekretaris, Bendahara, dll)</h6>
                            <small class="text-muted">Kelola jajaran pimpinan harian pesantren. Anda dapat menambah atau menghapus SDM pengurus.</small>
                        </div>
                        <button type="button" class="btn btn-sm btn-primary d-inline-flex align-items-center gap-1 shadow-sm px-3 fw-semibold" onclick="tambahBphSDM()">
                            <i class="bi bi-person-plus-fill"></i> + Tambah SDM BPH
                        </button>
                    </div>

                    <div class="row g-3" id="bphContainer">
                        @foreach($bph as $idx => $item)
                            <div class="col-md-4 sdm-card-item" id="bphCard_{{ $idx }}" data-index="{{ $idx }}">
                                <div class="p-3 bg-white rounded-3 border h-100 shadow-sm d-flex flex-column justify-content-between position-relative">
                                    <div>
                                        <div class="d-flex align-items-center justify-content-between mb-2">
                                            <span class="badge bg-primary bph-badge">Pengurus BPH #{{ $idx + 1 }}</span>
                                            <button type="button" class="btn btn-sm btn-outline-danger py-0 px-2 border-0" title="Hapus SDM ini" onclick="hapusSdmCard(this, 'BPH')">
                                                <i class="bi bi-trash"></i> Hapus
                                            </button>
                                        </div>

                                        @if($userList->isNotEmpty())
                                            <div class="mb-2 p-2 bg-light rounded-2 border">
                                                <label class="form-label small text-muted mb-1 fw-bold" style="font-size: 0.72rem;">
                                                    <i class="bi bi-lightning-charge-fill text-warning"></i> Pilih Cepat dari SDM Pesantren
                                                </label>
                                                <select class="form-select form-select-sm" onchange="isiOtomatisSdm(this)" style="font-size: 0.75rem;">
                                                    <option value="">-- Pilih Akun SDM / Asatidz --</option>
                                                    @foreach($userList as $u)
                                                        <option value="{{ $u->name }}" data-jabatan="{{ $u->jabatan ?? '' }}">{{ $u->name }} ({{ $u->jabatan ?: $u->role_label }})</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        @endif

                                        <div class="mb-2">
                                            <label class="form-label small fw-bold text-dark mb-1">Nama Lengkap &amp; Gelar <span class="text-danger">*</span></label>
                                            <input type="text" name="struktur[bph][{{ $idx }}][nama]" class="form-control form-control-sm sdm-nama" value="{{ old("struktur.bph.{$idx}.nama", $item['nama'] ?? '') }}" placeholder="Nama Pengurus" required>
                                        </div>
                                        <div class="mb-2">
                                            <label class="form-label small fw-bold text-dark mb-1">Jabatan Resmi <span class="text-danger">*</span></label>
                                            <input type="text" name="struktur[bph][{{ $idx }}][jabatan]" class="form-control form-control-sm sdm-jabatan" value="{{ old("struktur.bph.{$idx}.jabatan", $item['jabatan'] ?? '') }}" placeholder="Jabatan Pengurus" required>
                                        </div>
                                        <div class="mb-2">
                                            <label class="form-label small fw-bold text-dark mb-1">Deskripsi Tugas</label>
                                            <textarea name="struktur[bph][{{ $idx }}][deskripsi]" rows="2" class="form-control form-control-sm" placeholder="Tugas & amanah pengurus...">{{ old("struktur.bph.{$idx}.deskripsi", $item['deskripsi'] ?? '') }}</textarea>
                                        </div>
                                    </div>
                                    <div class="pt-2 border-top">
                                        <label class="form-label small fw-bold text-dark mb-1">Foto Pengurus</label>
                                        <div class="d-flex align-items-center gap-2 mb-1">
                                            @if(!empty($item['foto_url']))
                                                <img src="{{ $item['foto_url'] }}" alt="{{ $item['nama'] ?? '' }}" class="rounded-circle shadow-sm border sdm-foto-preview" style="width: 38px; height: 38px; object-fit: cover;">
                                            @else
                                                <div class="rounded-circle bg-light text-primary border d-flex align-items-center justify-content-center sdm-foto-preview" style="width: 38px; height: 38px; font-size: 1rem;">
                                                    <i class="bi {{ $item['icon'] ?? 'bi-person-fill' }}"></i>
                                                </div>
                                            @endif
                                            <div class="flex-grow-1">
                                                <input type="file" name="foto_struktur_bph[{{ $idx }}]" class="form-control form-control-sm" accept="image/*" style="font-size: 0.72rem;">
                                            </div>
                                        </div>
                                        @if(!empty($item['foto']))
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="hapus_foto_struktur_bph[{{ $idx }}]" value="1" id="hapusFotoBph_{{ $idx }}">
                                                <label class="form-check-label text-danger" for="hapusFotoBph_{{ $idx }}" style="font-size: 0.72rem;">
                                                    Hapus foto
                                                </label>
                                            </div>
                                        @endif
                                        <input type="hidden" name="struktur[bph][{{ $idx }}][old_foto]" value="{{ $item['foto'] ?? '' }}">
                                        <input type="hidden" name="struktur[bph][{{ $idx }}][icon]" value="{{ $item['icon'] ?? 'bi-person-fill' }}">
                                        <input type="hidden" name="struktur[bph][{{ $idx }}][color]" value="{{ $item['color'] ?? 'primary' }}">
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Level 3: Kepala Bidang & Kesantrian -->
                <div class="p-3 bg-light rounded-3 border">
                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 mb-3">
                        <div>
                            <h6 class="fw-bold text-success mb-1"><i class="bi bi-grid-fill me-1"></i> Level 3: Kepala Bidang Teknis &amp; Pengasuhan Asrama (Divisi)</h6>
                            <small class="text-muted">Kelola jajaran kepala divisi, direktur bidang, dan pembina asrama santri.</small>
                        </div>
                        <button type="button" class="btn btn-sm btn-success d-inline-flex align-items-center gap-1 shadow-sm px-3 fw-semibold" onclick="tambahDivisiSDM()">
                            <i class="bi bi-person-plus-fill"></i> + Tambah SDM Divisi/Bidang
                        </button>
                    </div>

                    <div class="row g-3" id="divisiContainer">
                        @foreach($divisi as $idx => $item)
                            <div class="col-md-3 col-sm-6 sdm-card-item" id="divCard_{{ $idx }}" data-index="{{ $idx }}">
                                <div class="p-3 bg-white rounded-3 border h-100 shadow-sm d-flex flex-column justify-content-between position-relative">
                                    <div>
                                        <div class="d-flex align-items-center justify-content-between mb-2">
                                            <span class="badge bg-success divisi-badge">Divisi #{{ $idx + 1 }}</span>
                                            <button type="button" class="btn btn-sm btn-outline-danger py-0 px-2 border-0" title="Hapus SDM ini" onclick="hapusSdmCard(this, 'Divisi')">
                                                <i class="bi bi-trash"></i> Hapus
                                            </button>
                                        </div>

                                        @if($userList->isNotEmpty())
                                            <div class="mb-2 p-2 bg-light rounded-2 border">
                                                <label class="form-label small text-muted mb-1 fw-bold" style="font-size: 0.72rem;">
                                                    <i class="bi bi-lightning-charge-fill text-warning"></i> Pilih Cepat dari SDM Pesantren
                                                </label>
                                                <select class="form-select form-select-sm" onchange="isiOtomatisSdm(this)" style="font-size: 0.75rem;">
                                                    <option value="">-- Pilih Akun SDM / Asatidz --</option>
                                                    @foreach($userList as $u)
                                                        <option value="{{ $u->name }}" data-jabatan="{{ $u->jabatan ?? '' }}">{{ $u->name }} ({{ $u->jabatan ?: $u->role_label }})</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        @endif

                                        <div class="mb-2">
                                            <label class="form-label small fw-bold text-dark mb-1">Nama Pengurus <span class="text-danger">*</span></label>
                                            <input type="text" name="struktur[divisi][{{ $idx }}][nama]" class="form-control form-control-sm sdm-nama" value="{{ old("struktur.divisi.{$idx}.nama", $item['nama'] ?? '') }}" placeholder="Nama Pengurus" required>
                                        </div>
                                        <div class="mb-2">
                                            <label class="form-label small fw-bold text-dark mb-1">Jabatan Resmi <span class="text-danger">*</span></label>
                                            <input type="text" name="struktur[divisi][{{ $idx }}][jabatan]" class="form-control form-control-sm sdm-jabatan" value="{{ old("struktur.divisi.{$idx}.jabatan", $item['jabatan'] ?? '') }}" placeholder="Jabatan Divisi" required>
                                        </div>
                                        <div class="mb-2">
                                            <label class="form-label small fw-bold text-dark mb-1">Deskripsi Tugas</label>
                                            <textarea name="struktur[divisi][{{ $idx }}][deskripsi]" rows="2" class="form-control form-control-sm" placeholder="Tugas & amanah divisi...">{{ old("struktur.divisi.{$idx}.deskripsi", $item['deskripsi'] ?? '') }}</textarea>
                                        </div>
                                    </div>
                                    <div class="pt-2 border-top">
                                        <label class="form-label small fw-bold text-dark mb-1">Foto Pengurus</label>
                                        <div class="d-flex align-items-center gap-2 mb-1">
                                            @if(!empty($item['foto_url']))
                                                <img src="{{ $item['foto_url'] }}" alt="{{ $item['nama'] ?? '' }}" class="rounded-circle shadow-sm border sdm-foto-preview" style="width: 36px; height: 36px; object-fit: cover;">
                                            @else
                                                <div class="rounded-circle bg-light text-success border d-flex align-items-center justify-content-center sdm-foto-preview" style="width: 36px; height: 36px; font-size: 0.95rem;">
                                                    <i class="bi {{ $item['icon'] ?? 'bi-person-fill' }}"></i>
                                                </div>
                                            @endif
                                            <div class="flex-grow-1">
                                                <input type="file" name="foto_struktur_divisi[{{ $idx }}]" class="form-control form-control-sm" accept="image/*" style="font-size: 0.72rem;">
                                            </div>
                                        </div>
                                        @if(!empty($item['foto']))
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="hapus_foto_struktur_divisi[{{ $idx }}]" value="1" id="hapusFotoDiv_{{ $idx }}">
                                                <label class="form-check-label text-danger" for="hapusFotoDiv_{{ $idx }}" style="font-size: 0.72rem;">
                                                    Hapus foto
                                                </label>
                                            </div>
                                        @endif
                                        <input type="hidden" name="struktur[divisi][{{ $idx }}][old_foto]" value="{{ $item['foto'] ?? '' }}">
                                        <input type="hidden" name="struktur[divisi][{{ $idx }}][icon]" value="{{ $item['icon'] ?? 'bi-mortarboard' }}">
                                        <input type="hidden" name="struktur[divisi][{{ $idx }}][color]" value="{{ $item['color'] ?? 'success' }}">
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- Tombol Aksi Simpan -->
        <div class="card border-0 shadow-sm bg-white p-3 mb-5">
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                <div class="text-muted small">
                    <i class="bi bi-shield-check text-success me-1"></i> Data yang Anda ubah akan langsung terupdate secara real-time di halaman utama website dan formulir PPDB.
                </div>
                <div class="d-flex align-items-center gap-2">
                    <a href="{{ route('landing') }}" target="_blank" class="btn btn-outline-secondary">
                        <i class="bi bi-eye me-1"></i> Lihat Website
                    </a>
                    <button type="submit" class="btn btn-success px-4 fw-bold shadow-sm">
                        <i class="bi bi-save2-fill me-1"></i> Simpan &amp; Publikasikan Perubahan
                    </button>
                </div>
            </div>
        </div>

    </form>

</div>

<script>
function previewLogo(event) {
    const file = event.target.files && event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const preview = document.getElementById('logoPreview');
            const placeholder = document.getElementById('logoPreviewPlaceholder');
            if (preview) {
                preview.src = e.target.result;
                preview.classList.remove('d-none');
            }
            if (placeholder) {
                placeholder.classList.add('d-none');
            }
        };
        reader.readAsDataURL(file);
    }
}

// Global user options JSON for dynamic SDM cards
const userListOptions = @json($userList->map(fn($u) => ['name' => $u->name, 'jabatan' => $u->jabatan ?? '', 'role_label' => $u->role_label]));

function generateUserSelectHtml() {
    if (!userListOptions || userListOptions.length === 0) return '';
    let options = '<option value="">-- Pilih Akun SDM / Asatidz --</option>';
    userListOptions.forEach(u => {
        const label = u.jabatan ? `${u.name} (${u.jabatan})` : `${u.name} (${u.role_label})`;
        options += `<option value="${escapeHtml(u.name)}" data-jabatan="${escapeHtml(u.jabatan || '')}">${escapeHtml(label)}</option>`;
    });
    return `
        <div class="mb-2 p-2 bg-light rounded-2 border">
            <label class="form-label small text-muted mb-1 fw-bold" style="font-size: 0.72rem;">
                <i class="bi bi-lightning-charge-fill text-warning"></i> Pilih Cepat dari SDM Pesantren
            </label>
            <select class="form-select form-select-sm" onchange="isiOtomatisSdm(this)" style="font-size: 0.75rem;">
                ${options}
            </select>
        </div>
    `;
}

function escapeHtml(str) {
    if (!str) return '';
    return str.replace(/[&<>'"]/g, tag => ({
        '&': '&amp;',
        '<': '&lt;',
        '>': '&gt;',
        "'": '&#39;',
        '"': '&quot;'
    }[tag] || tag));
}

let bphNextIndex = {{ count($bph) + 100 }};
function tambahBphSDM() {
    const container = document.getElementById('bphContainer');
    const newIdx = bphNextIndex++;
    const currentCount = container.querySelectorAll('.sdm-card-item').length + 1;
    const userSelectHtml = generateUserSelectHtml();

    const col = document.createElement('div');
    col.className = 'col-md-4 sdm-card-item';
    col.id = `bphCard_${newIdx}`;
    col.setAttribute('data-index', newIdx);
    col.innerHTML = `
        <div class="p-3 bg-white rounded-3 border border-2 border-primary h-100 shadow-sm d-flex flex-column justify-content-between position-relative">
            <div>
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="badge bg-primary bph-badge">Pengurus BPH #${currentCount} (Baru)</span>
                    <button type="button" class="btn btn-sm btn-outline-danger py-0 px-2 border-0" title="Hapus SDM ini" onclick="hapusSdmCard(this, 'BPH')">
                        <i class="bi bi-trash"></i> Hapus
                    </button>
                </div>
                ${userSelectHtml}
                <div class="mb-2">
                    <label class="form-label small fw-bold text-dark mb-1">Nama Lengkap &amp; Gelar <span class="text-danger">*</span></label>
                    <input type="text" name="struktur[bph][${newIdx}][nama]" class="form-control form-control-sm sdm-nama" placeholder="Contoh: Ustadz M. Ilyas, M.Pd" required>
                </div>
                <div class="mb-2">
                    <label class="form-label small fw-bold text-dark mb-1">Jabatan Resmi <span class="text-danger">*</span></label>
                    <input type="text" name="struktur[bph][${newIdx}][jabatan]" class="form-control form-control-sm sdm-jabatan" placeholder="Contoh: Wakil Sekretaris Lembaga" required>
                </div>
                <div class="mb-2">
                    <label class="form-label small fw-bold text-dark mb-1">Deskripsi Tugas</label>
                    <textarea name="struktur[bph][${newIdx}][deskripsi]" rows="2" class="form-control form-control-sm" placeholder="Tanggung jawab dan amanah tugas..."></textarea>
                </div>
            </div>
            <div class="pt-2 border-top">
                <label class="form-label small fw-bold text-dark mb-1">Foto Pengurus</label>
                <div class="d-flex align-items-center gap-2 mb-1">
                    <div class="rounded-circle bg-light text-primary border d-flex align-items-center justify-content-center" style="width: 38px; height: 38px; font-size: 1rem;">
                        <i class="bi bi-person-fill"></i>
                    </div>
                    <div class="flex-grow-1">
                        <input type="file" name="foto_struktur_bph[${newIdx}]" class="form-control form-control-sm" accept="image/*" style="font-size: 0.72rem;">
                    </div>
                </div>
                <input type="hidden" name="struktur[bph][${newIdx}][old_foto]" value="">
                <input type="hidden" name="struktur[bph][${newIdx}][icon]" value="bi-person-fill">
                <input type="hidden" name="struktur[bph][${newIdx}][color]" value="primary">
            </div>
        </div>
    `;
    container.appendChild(col);
    renumberBadges('BPH');
    col.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
}

let divisiNextIndex = {{ count($divisi) + 100 }};
function tambahDivisiSDM() {
    const container = document.getElementById('divisiContainer');
    const newIdx = divisiNextIndex++;
    const currentCount = container.querySelectorAll('.sdm-card-item').length + 1;
    const userSelectHtml = generateUserSelectHtml();

    const col = document.createElement('div');
    col.className = 'col-md-3 col-sm-6 sdm-card-item';
    col.id = `divCard_${newIdx}`;
    col.setAttribute('data-index', newIdx);
    col.innerHTML = `
        <div class="p-3 bg-white rounded-3 border border-2 border-success h-100 shadow-sm d-flex flex-column justify-content-between position-relative">
            <div>
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="badge bg-success divisi-badge">Divisi #${currentCount} (Baru)</span>
                    <button type="button" class="btn btn-sm btn-outline-danger py-0 px-2 border-0" title="Hapus SDM ini" onclick="hapusSdmCard(this, 'Divisi')">
                        <i class="bi bi-trash"></i> Hapus
                    </button>
                </div>
                ${userSelectHtml}
                <div class="mb-2">
                    <label class="form-label small fw-bold text-dark mb-1">Nama Pengurus <span class="text-danger">*</span></label>
                    <input type="text" name="struktur[divisi][${newIdx}][nama]" class="form-control form-control-sm sdm-nama" placeholder="Contoh: Ustadz Zainal Arifin, S.Pd" required>
                </div>
                <div class="mb-2">
                    <label class="form-label small fw-bold text-dark mb-1">Jabatan Resmi <span class="text-danger">*</span></label>
                    <input type="text" name="struktur[divisi][${newIdx}][jabatan]" class="form-control form-control-sm sdm-jabatan" placeholder="Contoh: Kepala Bagian Sarpras" required>
                </div>
                <div class="mb-2">
                    <label class="form-label small fw-bold text-dark mb-1">Deskripsi Tugas</label>
                    <textarea name="struktur[divisi][${newIdx}][deskripsi]" rows="2" class="form-control form-control-sm" placeholder="Tanggung jawab dan amanah tugas..."></textarea>
                </div>
            </div>
            <div class="pt-2 border-top">
                <label class="form-label small fw-bold text-dark mb-1">Foto Pengurus</label>
                <div class="d-flex align-items-center gap-2 mb-1">
                    <div class="rounded-circle bg-light text-success border d-flex align-items-center justify-content-center" style="width: 36px; height: 36px; font-size: 0.95rem;">
                        <i class="bi bi-person-fill"></i>
                    </div>
                    <div class="flex-grow-1">
                        <input type="file" name="foto_struktur_divisi[${newIdx}]" class="form-control form-control-sm" accept="image/*" style="font-size: 0.72rem;">
                    </div>
                </div>
                <input type="hidden" name="struktur[divisi][${newIdx}][old_foto]" value="">
                <input type="hidden" name="struktur[divisi][${newIdx}][icon]" value="bi-mortarboard">
                <input type="hidden" name="struktur[divisi][${newIdx}][color]" value="success">
            </div>
        </div>
    `;
    container.appendChild(col);
    renumberBadges('Divisi');
    col.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
}

function hapusSdmCard(btn, tipe) {
    if (confirm(`Apakah Anda yakin ingin menghapus SDM pengurus ini dari daftar ${tipe}?`)) {
        const card = btn.closest('.sdm-card-item');
        if (card) {
            card.remove();
            renumberBadges(tipe);
        }
    }
}

function renumberBadges(tipe) {
    if (tipe === 'BPH') {
        const badges = document.querySelectorAll('#bphContainer .bph-badge');
        badges.forEach((b, idx) => {
            b.innerText = `Pengurus BPH #${idx + 1}`;
        });
    } else if (tipe === 'Divisi') {
        const badges = document.querySelectorAll('#divisiContainer .divisi-badge');
        badges.forEach((b, idx) => {
            b.innerText = `Divisi #${idx + 1}`;
        });
    }
}

function isiOtomatisSdm(selectEl) {
    const card = selectEl.closest('.sdm-card-item');
    if (!card) return;
    const selectedOption = selectEl.options[selectEl.selectedIndex];
    const nama = selectEl.value;
    const jabatan = selectedOption.getAttribute('data-jabatan') || '';

    if (nama) {
        const inputNama = card.querySelector('.sdm-nama');
        const inputJabatan = card.querySelector('.sdm-jabatan');
        if (inputNama) inputNama.value = nama;
        if (inputJabatan && jabatan && (!inputJabatan.value || inputJabatan.value.trim() === '')) {
            inputJabatan.value = jabatan;
        }
    }
}
</script>
@endsection
