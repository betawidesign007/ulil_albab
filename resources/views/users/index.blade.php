@extends('layouts.app')

@section('content')
    <div class="row gy-4">

        <!-- Header & Action -->
        <div class="col-12">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
                <div>
                    <h1 class="h3 fw-bold text-dark mb-1">
                        <i class="bi bi-shield-lock-fill text-danger me-2"></i> Manajemen Pengguna &amp; Hak Akses
                    </h1>
                    <p class="text-muted mb-0">Kelola akun pengguna dengan 3 peran hak akses: <strong>Administrator</strong>,
                        <strong>Dewan Pengajar</strong>, dan <strong>Pemilik Pondok</strong>.
                    </p>
                </div>
                <div>
                    <button type="button" class="btn btn-pesantren shadow-sm" data-bs-toggle="modal"
                        data-bs-target="#modalTambahUser">
                        <i class="bi bi-person-plus-fill me-1"></i> + Tambah Pengguna Baru
                    </button>
                </div>
            </div>
        </div>

        <!-- Info Role Card -->
        <div class="col-12">
            <div class="row g-3">
                <div class="col-md-4">
                    <div class="p-3 bg-white rounded-3 border-start border-danger border-4 shadow-sm">
                        <div class="d-flex align-items-center justify-content-between mb-1">
                            <strong class="text-danger small text-uppercase">Administrator</strong>
                            <span class="badge bg-danger rounded-pill">{{ $users->where('role', 'admin')->count() }}
                                Akun</span>
                        </div>
                        <small class="text-muted">Akses CRUD lengkap data santri dan manajemen pengguna.</small>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-3 bg-white rounded-3 border-start border-primary border-4 shadow-sm">
                        <div class="d-flex align-items-center justify-content-between mb-1">
                            <strong class="text-primary small text-uppercase">Dewan Pengajar</strong>
                            <span class="badge bg-primary rounded-pill">{{ $users->where('role', 'pengajar')->count() }}
                                Akun</span>
                        </div>
                        <small class="text-muted">Melihat daftar santri, kelas, dan detail bimbingan.</small>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-3 bg-white rounded-3 border-start border-warning border-4 shadow-sm">
                        <div class="d-flex align-items-center justify-content-between mb-1">
                            <strong class="text-warning text-dark small text-uppercase">Pemilik / Mudir</strong>
                            <span
                                class="badge bg-warning text-dark rounded-pill">{{ $users->where('role', 'pemilik')->count() }}
                                Akun</span>
                        </div>
                        <small class="text-muted">Dashboard eksekutif dan cetak rekapitulasi santri.</small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Table of Users -->
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light small">
                                <tr>
                                    <th class="py-3 px-4">Nama Pengguna</th>
                                    <th class="py-3">Email Akun</th>
                                    <th class="py-3">Peran / Hak Akses</th>
                                    <th class="py-3">No. Handphone</th>
                                    <th class="py-3">Jabatan / Amanah</th>
                                    <th class="py-3 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($users as $u)
                                    <tr>
                                        <td class="px-4">
                                            <div class="fw-bold text-dark">{{ $u->name }}</div>
                                            @if (auth()->id() === $u->id)
                                                <span class="badge bg-secondary-subtle text-secondary small">(Akun
                                                    Anda)</span>
                                            @endif
                                        </td>
                                        <td>{{ $u->email }}</td>
                                        <td>
                                            <span class="badge {{ $u->role_badge_class }} px-2 py-1">
                                                {{ $u->role_label }}
                                            </span>
                                        </td>
                                        <td>{{ $u->no_hp ?? '-' }}</td>
                                        <td>{{ $u->jabatan ?? '-' }}</td>
                                        <td class="text-center">
                                            @if (auth()->id() !== $u->id)
                                                <form action="{{ route('users.destroy', $u->id) }}" method="POST"
                                                    class="d-inline"
                                                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus akun ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger"
                                                        title="Hapus Akun">
                                                        <i class="bi bi-trash"></i> Hapus
                                                    </button>
                                                </form>
                                            @else
                                                <span class="text-muted small">Aktif</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-4 text-muted">Belum ada akun pengguna.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Modal Tambah User -->
    <div class="modal fade" id="modalTambahUser" tabindex="-1" aria-labelledby="modalTambahUserLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow">
                <div class="modal-header bg-pesantren text-white">
                    <h5 class="modal-title fw-bold" id="modalTambahUserLabel">
                        <i class="bi bi-person-plus-fill me-1"></i> Tambah Pengguna Baru
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <form action="{{ route('users.store') }}" method="POST">
                    @csrf
                    <div class="modal-body p-4">
                        <div class="mb-3">
                            <label class="form-label fw-semibold small">Nama Lengkap &amp; Gelar</label>
                            <input type="text" name="name" required class="form-control"
                                placeholder="Contoh: Ustadz Ahmad, S.Pd">
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold small">Alamat Email (Untuk Login)</label>
                            <input type="email" name="email" required class="form-control"
                                placeholder="nama@ulilalbab.ac.id">
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold small">Kata Sandi (Minimal 6 Karakter)</label>
                            <input type="password" name="password" required minlength="6" class="form-control"
                                placeholder="••••••••">
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold small">Pilih Peran / Hak Akses</label>
                            <select name="role" required class="form-select">
                                <option value="pengajar">Dewan Pengajar / Asatidz (Hanya Lihat Santri)</option>
                                <option value="pemilik">Pemilik / Mudir Yayasan (Laporan &amp; Monitoring)</option>
                                <option value="admin">Administrator (Akses Penuh CRUD &amp; User)</option>
                            </select>
                        </div>

                        <div class="row g-2 mb-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold small">No. HP / WhatsApp</label>
                                <input type="text" name="no_hp" class="form-control" placeholder="08123456789">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold small">Jabatan / Bagian</label>
                                <input type="text" name="jabatan" class="form-control"
                                    placeholder="Contoh: Guru Tahfidz">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success btn-sm">Simpan Pengguna</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
