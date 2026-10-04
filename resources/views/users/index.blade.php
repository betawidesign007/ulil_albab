@extends('layouts.app', ['title' => 'Manajemen Pengguna & Hak Akses'])

@section('content')
<div class="container-fluid px-3 px-lg-4 py-3">

    <!-- Header & Action -->
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 mb-3 pb-2 border-bottom">
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-1" style="font-size: 0.8rem;">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-decoration-none text-success">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Pengguna &amp; Hak Akses</li>
                </ol>
            </nav>
            <h2 class="h4 fw-bold text-dark mb-0 d-flex align-items-center gap-2">
                <i class="bi bi-shield-lock-fill text-danger"></i> Manajemen Pengguna &amp; Hak Akses
            </h2>
            <small class="text-muted" style="font-size: 0.78rem;">
                Kelola akun pengguna, hak akses peran (Administrator, Dewan Pengajar, dan Pemilik), serta penugasan amanah.
            </small>
        </div>
        <div class="d-flex align-items-center gap-2">
            <button type="button" class="btn btn-sm btn-pesantren d-flex align-items-center gap-1 shadow-sm px-3 py-2 fw-semibold" data-bs-toggle="modal" data-bs-target="#modalTambahUser">
                <i class="bi bi-person-plus-fill"></i> Tambah Pengguna Baru
            </button>
        </div>
    </div>

    <!-- Alert Messages -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show d-flex align-items-center gap-2 py-2 px-3 small shadow-sm mb-3" role="alert">
            <i class="bi bi-check-circle-fill fs-5"></i>
            <div>{{ session('success') }}</div>
            <button type="button" class="btn-close btn-sm p-2" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center gap-2 py-2 px-3 small shadow-sm mb-3" role="alert">
            <i class="bi bi-exclamation-triangle-fill fs-5"></i>
            <div>{{ session('error') }}</div>
            <button type="button" class="btn-close btn-sm p-2" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show py-2 px-3 small shadow-sm mb-3" role="alert">
            <div class="fw-bold mb-1"><i class="bi bi-exclamation-circle-fill me-1"></i> Terjadi kesalahan input:</div>
            <ul class="mb-0 ps-3">
                @foreach($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close btn-sm p-2" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Compact Role Summary Cards -->
    <div class="row g-2 mb-3">
        <div class="col-md-4 col-sm-6">
            <div class="p-2 px-3 bg-white rounded-3 border-start border-danger border-4 shadow-sm d-flex align-items-center justify-content-between">
                <div>
                    <div class="text-danger small fw-bold text-uppercase" style="font-size: 0.72rem;">Administrator</div>
                    <small class="text-muted" style="font-size: 0.75rem;">Akses Penuh Master Data &amp; Konfigurasi</small>
                </div>
                <span class="badge bg-danger rounded-pill px-2 py-1 fs-6">{{ $users->where('role', 'admin')->count() }}</span>
            </div>
        </div>
        <div class="col-md-4 col-sm-6">
            <div class="p-2 px-3 bg-white rounded-3 border-start border-primary border-4 shadow-sm d-flex align-items-center justify-content-between">
                <div>
                    <div class="text-primary small fw-bold text-uppercase" style="font-size: 0.72rem;">Dewan Pengajar / Asatidz</div>
                    <small class="text-muted" style="font-size: 0.75rem;">Jadwal Mengajar, Jurnal &amp; Acuan Kerja</small>
                </div>
                <span class="badge bg-primary rounded-pill px-2 py-1 fs-6">{{ $users->where('role', 'pengajar')->count() }}</span>
            </div>
        </div>
        <div class="col-md-4 col-sm-12">
            <div class="p-2 px-3 bg-white rounded-3 border-start border-warning border-4 shadow-sm d-flex align-items-center justify-content-between">
                <div>
                    <div class="text-warning-emphasis small fw-bold text-uppercase" style="font-size: 0.72rem;">Pemilik / Mudir Pesantren</div>
                    <small class="text-muted" style="font-size: 0.75rem;">Supervisi Acuan Kerja &amp; Laporan Eksekutif</small>
                </div>
                <span class="badge bg-warning text-dark rounded-pill px-2 py-1 fs-6">{{ $users->where('role', 'pemilik')->count() }}</span>
            </div>
        </div>
    </div>

    <!-- User Table Card -->
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white py-2 px-3 border-bottom d-flex align-items-center justify-content-between">
            <div class="fw-bold text-dark small d-flex align-items-center gap-2">
                <i class="bi bi-people-fill text-success"></i> Daftar Pengguna Aktif ({{ $users->count() }} Akun)
            </div>
            <small class="text-muted">Aksi: Detail, Edit Profil &amp; Hak Akses, Hapus</small>
        </div>
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0 w-100" style="font-size: 0.83rem;">
                <thead class="table-light text-secondary" style="font-size: 0.78rem;">
                    <tr>
                        <th class="ps-3 py-2 text-center" style="width: 45px;">No</th>
                        <th class="py-2" style="width: 25%;">Nama Pengguna</th>
                        <th class="py-2" style="width: 22%;">Email Login</th>
                        <th class="py-2" style="width: 15%;">Peran</th>
                        <th class="py-2" style="width: 14%;">No. WhatsApp</th>
                        <th class="py-2" style="width: 14%;">Jabatan / Amanah</th>
                        <th class="py-2 text-center pe-3" style="width: 10%; white-space: nowrap;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $index => $u)
                        <tr>
                            <td class="ps-3 text-muted">{{ $index + 1 }}</td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <span class="rounded-circle d-flex align-items-center justify-content-center text-white fw-bold shadow-sm"
                                        style="width: 32px; height: 32px; font-size: 0.78rem; background: {{ $u->isAdmin() ? '#dc2626' : ($u->isPengajar() ? '#2563eb' : '#d97706') }};">
                                        {{ strtoupper(substr($u->name, 0, 1)) }}
                                    </span>
                                    <div>
                                        <span class="fw-bold text-dark d-block">{{ $u->name }}</span>
                                        @if(auth()->id() === $u->id)
                                            <span class="badge bg-secondary-subtle text-secondary" style="font-size: 0.68rem;">(Akun Anda)</span>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="text-muted"><i class="bi bi-envelope me-1"></i>{{ $u->email }}</span>
                            </td>
                            <td>
                                <span class="badge {{ $u->role_badge_class }} px-2 py-1" style="font-size: 0.75rem;">
                                    {{ $u->role_label }}
                                </span>
                            </td>
                            <td>
                                @if($u->no_hp)
                                    <span class="text-dark"><i class="bi bi-whatsapp text-success me-1"></i>{{ $u->no_hp }}</span>
                                @else
                                    <span class="text-muted fst-italic">-</span>
                                @endif
                            </td>
                            <td>
                                <span class="text-dark">{{ $u->jabatan ?? '-' }}</span>
                            </td>
                            <td class="text-center pe-3">
                                <div class="btn-group btn-group-sm" role="group">
                                    <!-- Aksi Detail -->
                                    <button type="button" class="btn btn-outline-info p-1 px-2" data-bs-toggle="modal" data-bs-target="#modalDetailUser{{ $u->id }}" title="Lihat Detail Profil">
                                        <i class="bi bi-eye-fill"></i>
                                    </button>

                                    <!-- Aksi Edit -->
                                    <button type="button" class="btn btn-outline-primary p-1 px-2" data-bs-toggle="modal" data-bs-target="#modalEditUser{{ $u->id }}" title="Edit Pengguna">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>

                                    <!-- Aksi Hapus -->
                                    @if(auth()->id() !== $u->id)
                                        <button type="button" class="btn btn-outline-danger p-1 px-2" data-bs-toggle="modal" data-bs-target="#modalHapusUser{{ $u->id }}" title="Hapus Akun">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    @else
                                        <button type="button" class="btn btn-outline-secondary p-1 px-2 disabled" title="Tidak dapat menghapus akun sendiri" disabled>
                                            <i class="bi bi-lock-fill"></i>
                                        </button>
                                    @endif
                                </div>
                            </td>
                        </tr>

                        <!-- MODAL DETAIL USER -->
                        <div class="modal fade text-start" id="modalDetailUser{{ $u->id }}" tabindex="-1" aria-labelledby="modalDetailUserLabel{{ $u->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content border-0 shadow">
                                    <div class="modal-header bg-pesantren text-white py-2 px-3">
                                        <h6 class="modal-title fw-bold" id="modalDetailUserLabel{{ $u->id }}">
                                            <i class="bi bi-person-badge-fill me-1"></i> Profil Pengguna: {{ $u->name }}
                                        </h6>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body p-3">
                                        <div class="d-flex align-items-center gap-3 mb-3 p-3 bg-light rounded-3">
                                            <div class="rounded-circle d-flex align-items-center justify-content-center text-white fw-bold fs-4 shadow-sm"
                                                style="width: 50px; height: 50px; background: {{ $u->isAdmin() ? '#dc2626' : ($u->isPengajar() ? '#2563eb' : '#d97706') }};">
                                                {{ strtoupper(substr($u->name, 0, 1)) }}
                                            </div>
                                            <div>
                                                <h6 class="fw-bold text-dark mb-0">{{ $u->name }}</h6>
                                                <small class="text-muted d-block">{{ $u->email }}</small>
                                                <span class="badge {{ $u->role_badge_class }} mt-1">{{ $u->role_label }}</span>
                                            </div>
                                        </div>

                                        <div class="list-group list-group-flush border rounded-3 small">
                                            <div class="list-group-item d-flex justify-content-between py-2">
                                                <span class="text-muted">Amanah / Jabatan</span>
                                                <strong class="text-dark">{{ $u->jabatan ?? '-' }}</strong>
                                            </div>
                                            <div class="list-group-item d-flex justify-content-between py-2">
                                                <span class="text-muted">Nomor WhatsApp</span>
                                                <strong class="text-dark">{{ $u->no_hp ?? '-' }}</strong>
                                            </div>
                                            <div class="list-group-item d-flex justify-content-between py-2">
                                                <span class="text-muted">Terdaftar Sejak</span>
                                                <span class="text-dark">{{ $u->created_at?->translatedFormat('d F Y, H:i') ?? '-' }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer bg-light py-2 px-3">
                                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Tutup</button>
                                        <button type="button" class="btn btn-primary btn-sm" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#modalEditUser{{ $u->id }}">
                                            <i class="bi bi-pencil-square me-1"></i> Edit Pengguna
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- MODAL EDIT USER -->
                        <div class="modal fade text-start" id="modalEditUser{{ $u->id }}" tabindex="-1" aria-labelledby="modalEditUserLabel{{ $u->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content border-0 shadow">
                                    <form action="{{ route('users.update', $u->id) }}" method="POST" autocomplete="off">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-header bg-primary text-white py-2 px-3">
                                            <h6 class="modal-title fw-bold" id="modalEditUserLabel{{ $u->id }}">
                                                <i class="bi bi-pencil-square me-1"></i> Edit Pengguna: {{ $u->name }}
                                            </h6>
                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body p-3">
                                            <div class="mb-2">
                                                <label class="form-label fw-bold small text-dark mb-1">Nama Lengkap &amp; Gelar <span class="text-danger">*</span></label>
                                                <input type="text" name="name" required class="form-control form-control-sm" value="{{ old('name', $u->name) }}">
                                            </div>

                                            <div class="mb-2">
                                                <label class="form-label fw-bold small text-dark mb-1">Alamat Email Login <span class="text-danger">*</span></label>
                                                <input type="email" name="email" required class="form-control form-control-sm" value="{{ old('email', $u->email) }}">
                                            </div>

                                            <div class="mb-2">
                                                <label class="form-label fw-bold small text-dark mb-1">Peran / Hak Akses <span class="text-danger">*</span></label>
                                                <select name="role" required class="form-select form-select-sm">
                                                    <option value="pengajar" {{ old('role', $u->role) === 'pengajar' ? 'selected' : '' }}>
                                                        Dewan Pengajar / Asatidz (Jadwal Mengajar, Jurnal &amp; Acuan Kerja)
                                                    </option>
                                                    <option value="pemilik" {{ old('role', $u->role) === 'pemilik' ? 'selected' : '' }}>
                                                        Pemilik / Mudir Yayasan (Supervisi &amp; Monitoring Eksekutif)
                                                    </option>
                                                    <option value="admin" {{ old('role', $u->role) === 'admin' ? 'selected' : '' }}>
                                                        Administrator (Akses Penuh Master Data, Jadwal &amp; Pengguna)
                                                    </option>
                                                </select>
                                            </div>

                                            <div class="row g-2 mb-2">
                                                <div class="col-md-6">
                                                    <label class="form-label fw-bold small text-dark mb-1">No. WhatsApp / HP</label>
                                                    <input type="text" name="no_hp" class="form-control form-control-sm" value="{{ old('no_hp', $u->no_hp) }}" placeholder="08123456789">
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label fw-bold small text-dark mb-1">Jabatan / Bagian</label>
                                                    <input type="text" name="jabatan" class="form-control form-control-sm" value="{{ old('jabatan', $u->jabatan) }}" placeholder="Guru Tahfidz">
                                                </div>
                                            </div>

                                            <div class="mb-2 pt-2 border-top">
                                                <label class="form-label fw-bold small text-dark mb-1">Ganti Kata Sandi (Opsional)</label>
                                                <div class="input-group input-group-sm">
                                                    <input type="password" name="password" id="editPassword{{ $u->id }}" minlength="6" autocomplete="new-password" class="form-control form-control-sm" placeholder="Kosongkan jika tidak ingin mengubah sandi">
                                                    <button class="btn btn-outline-secondary toggle-password-btn" type="button" data-target="#editPassword{{ $u->id }}" title="Tampilkan/Sembunyikan kata sandi" tabindex="-1">
                                                        <i class="bi bi-eye"></i>
                                                    </button>
                                                </div>
                                                <div class="text-muted" style="font-size: 0.72rem;">Minimal 6 karakter bila diisi.</div>
                                            </div>
                                        </div>
                                        <div class="modal-footer bg-light py-2 px-3">
                                            <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-primary btn-sm fw-bold">
                                                <i class="bi bi-save me-1"></i> Simpan Perubahan
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- MODAL HAPUS USER -->
                        @if(auth()->id() !== $u->id)
                            <div class="modal fade text-start" id="modalHapusUser{{ $u->id }}" tabindex="-1" aria-labelledby="modalHapusUserLabel{{ $u->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-sm">
                                    <div class="modal-content border-0 shadow">
                                        <form action="{{ route('users.destroy', $u->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <div class="modal-header bg-danger text-white py-2 px-3">
                                                <h6 class="modal-title fw-bold" id="modalHapusUserLabel{{ $u->id }}">
                                                    <i class="bi bi-exclamation-triangle-fill me-1"></i> Hapus Pengguna
                                                </h6>
                                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body p-3 text-center">
                                                <p class="mb-1 text-dark">Apakah Anda yakin ingin menghapus akun:</p>
                                                <strong class="text-danger d-block mb-2">{{ $u->name }}</strong>
                                                <small class="text-muted">Aksi ini tidak dapat dibatalkan.</small>
                                            </div>
                                            <div class="modal-footer bg-light py-2 px-3 justify-content-center">
                                                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-danger btn-sm fw-bold">Ya, Hapus</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endif

                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-4 text-muted">Belum ada akun pengguna yang terdaftar.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

<!-- Modal Tambah User -->
<div class="modal fade" id="modalTambahUser" tabindex="-1" aria-labelledby="modalTambahUserLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-pesantren text-white py-2 px-3">
                <h6 class="modal-title fw-bold" id="modalTambahUserLabel">
                    <i class="bi bi-person-plus-fill me-1"></i> Tambah Pengguna Baru
                </h6>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('users.store') }}" method="POST" autocomplete="off">
                @csrf
                <div class="modal-body p-3">
                    <div class="mb-2">
                        <label class="form-label fw-bold small text-dark mb-1">Nama Lengkap &amp; Gelar <span class="text-danger">*</span></label>
                        <input type="text" name="name" required class="form-control form-control-sm" placeholder="Contoh: Ustadz Ahmad, S.Pd" value="{{ old('name') }}">
                    </div>

                    <div class="mb-2">
                        <label class="form-label fw-bold small text-dark mb-1">Alamat Email (Untuk Login) <span class="text-danger">*</span></label>
                        <input type="email" name="email" required autocomplete="off" class="form-control form-control-sm" placeholder="nama@ulilalbab.ac.id" value="{{ old('email') }}">
                    </div>

                    <div class="mb-2">
                        <label class="form-label fw-bold small text-dark mb-1">Kata Sandi (Minimal 6 Karakter) <span class="text-danger">*</span></label>
                        <div class="input-group input-group-sm">
                            <input type="password" name="password" id="tambahPassword" required minlength="6" autocomplete="new-password" class="form-control form-control-sm" placeholder="••••••••">
                            <button class="btn btn-outline-secondary toggle-password-btn" type="button" data-target="#tambahPassword" title="Tampilkan/Sembunyikan kata sandi" tabindex="-1">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>
                    </div>

                    <div class="mb-2">
                        <label class="form-label fw-bold small text-dark mb-1">Pilih Peran / Hak Akses <span class="text-danger">*</span></label>
                        <select name="role" required class="form-select form-select-sm">
                            <option value="pengajar" {{ old('role') === 'pengajar' ? 'selected' : '' }}>
                                Dewan Pengajar / Asatidz (Jadwal Mengajar, Jurnal &amp; Acuan Kerja)
                            </option>
                            <option value="pemilik" {{ old('role') === 'pemilik' ? 'selected' : '' }}>
                                Pemilik / Mudir Yayasan (Supervisi &amp; Monitoring Eksekutif)
                            </option>
                            <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>
                                Administrator (Akses Penuh Master Data, Jadwal &amp; Pengguna)
                            </option>
                        </select>
                    </div>

                    <div class="row g-2 mb-2">
                        <div class="col-md-6">
                            <label class="form-label fw-bold small text-dark mb-1">No. WhatsApp / HP</label>
                            <input type="text" name="no_hp" class="form-control form-control-sm" placeholder="08123456789" value="{{ old('no_hp') }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold small text-dark mb-1">Jabatan / Amanah</label>
                            <input type="text" name="jabatan" class="form-control form-control-sm" placeholder="Guru Tahfidz" value="{{ old('jabatan') }}">
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light py-2 px-3">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success btn-sm fw-bold">
                        <i class="bi bi-check-circle me-1"></i> Simpan Pengguna
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Toggle password visibility
        document.querySelectorAll('.toggle-password-btn').forEach(function (button) {
            button.addEventListener('click', function () {
                const targetSelector = this.getAttribute('data-target');
                const targetInput = document.querySelector(targetSelector);
                const icon = this.querySelector('i');

                if (targetInput) {
                    const isPassword = targetInput.getAttribute('type') === 'password';
                    targetInput.setAttribute('type', isPassword ? 'text' : 'password');
                    if (icon) {
                        icon.classList.toggle('bi-eye', !isPassword);
                        icon.classList.toggle('bi-eye-slash', isPassword);
                    }
                }
            });
        });

        // Cegah browser autofill mengisi email/password login yang tersimpan di modal Tambah User
        const modalTambah = document.getElementById('modalTambahUser');
        if (modalTambah) {
            const clearTambahInputs = function () {
                const emailInput = modalTambah.querySelector('input[name="email"]');
                const passInput = modalTambah.querySelector('input[name="password"]');
                @if(!old('email'))
                if (emailInput) {
                    emailInput.value = '';
                }
                @endif
                if (passInput) {
                    passInput.value = '';
                }
            };

            modalTambah.addEventListener('show.bs.modal', function () {
                setTimeout(clearTambahInputs, 50);
            });
            modalTambah.addEventListener('shown.bs.modal', function () {
                setTimeout(clearTambahInputs, 100);
            });
        }

        // Cegah browser autofill mengisi password pada modal Edit User
        document.querySelectorAll('[id^="modalEditUser"]').forEach(function (modal) {
            const clearEditPassword = function () {
                const passInput = modal.querySelector('input[type="password"]');
                if (passInput) {
                    passInput.value = '';
                }
            };
            modal.addEventListener('show.bs.modal', function () {
                setTimeout(clearEditPassword, 50);
            });
            modal.addEventListener('shown.bs.modal', function () {
                setTimeout(clearEditPassword, 100);
            });
        });
    });
</script>
@endpush
