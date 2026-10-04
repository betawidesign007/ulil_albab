@extends('layouts.app')

@section('content')
    <div class="row gy-4">

        <!-- Welcome Hero Card based on Role -->
        <div class="col-12">
            <div class="card border-0 shadow-sm overflow-hidden text-white"
                style="background: linear-gradient(135deg, #022c22 0%, #065f46 100%);">
                <div class="card-body p-4 p-md-5 position-relative">
                    <div class="row align-items-center">
                        <div class="col-lg-8">
                            <div class="d-flex align-items-center gap-2 mb-2">
                                <span class="badge {{ $user->role_badge_class }} px-3 py-1 fs-6">
                                    <i class="bi bi-shield-check me-1"></i> Peran Anda: {{ $user->role_label }}
                                </span>
                                <span class="text-white-50 small">&bull; SIMPONPES Li Ulil Albab</span>
                            </div>
                            <h2 class="fw-bold mb-2">Ahlan wa Sahlan, {{ $user->name }}!</h2>
                            <p class="text-white-70 mb-3 fs-6">
                                @if ($user->isAdmin())
                                    Anda memiliki <strong>Hak Akses Administrator Penuh</strong>. Anda berwenang mengelola
                                    master data santri (tambah, edit, hapus) serta mengontrol akun dan hak akses pengguna.
                                @elseif($user->isPengajar())
                                    Anda memiliki <strong>Hak Akses Dewan Pengajar / Asatidz</strong>. Anda dapat memantau
                                    data seluruh santri, melihat persebaran santri di tiap kelas dan kamar asrama, serta
                                    memeriksa biodata lengkap.
                                @elseif($user->isPemilik())
                                    Anda memiliki <strong>Hak Akses Pemilik &amp; Mudir Yayasan</strong>. Anda dapat
                                    memonitor perkembangan statistik santri secara berkala, kapasitas asrama, serta mencetak
                                    laporan rekapitulasi resmi pondok pesantren.
                                @endif
                            </p>

                            <div class="d-flex flex-wrap gap-2">
                                <a href="{{ route('jadwal.index') }}"
                                    class="btn btn-warning text-dark fw-bold btn-sm px-3 py-2">
                                    <i class="bi bi-journal-bookmark-fill me-1"></i> Jadwal &amp; Acuan Kerja
                                </a>

                                <a href="{{ route('santri.index') }}"
                                    class="btn btn-outline-light btn-sm px-3 py-2">
                                    <i class="bi bi-people-fill me-1"></i> Data Santri ({{ $totalSantri }})
                                </a>

                                @if ($user->isAdmin())
                                    <a href="{{ route('admin.ppdb.index') }}" class="btn btn-outline-light btn-sm px-3 py-2">
                                        <i class="bi bi-sliders2 me-1"></i> Pengaturan PPDB &amp; Web
                                    </a>
                                    <a href="{{ route('santri.create') }}" class="btn btn-outline-light btn-sm px-3 py-2">
                                        <i class="bi bi-person-plus-fill me-1"></i> + Tambah Santri
                                    </a>
                                    <a href="{{ route('users.index') }}" class="btn btn-outline-light btn-sm px-3 py-2">
                                        <i class="bi bi-people me-1"></i> Pengguna
                                    </a>
                                @endif

                                @if ($user->isPemilik() || $user->isAdmin())
                                    <a href="{{ route('laporan.santri') }}"
                                        class="btn btn-light text-dark btn-sm px-3 py-2">
                                        <i class="bi bi-printer-fill me-1"></i> Cetak Rekap Laporan
                                    </a>
                                @endif
                            </div>
                        </div>

                        <div class="col-lg-4 text-center text-lg-end mt-4 mt-lg-0">
                            <div
                                class="d-inline-flex flex-column align-items-center p-3 rounded-4 bg-white bg-opacity-10 border border-white border-opacity-10">
                                <i class="bi bi-building-check display-4 text-warning mb-1"></i>
                                <div class="fw-bold text-white">Status Pesantren</div>
                                <small class="text-white-50">Tahun Ajaran 2026/2027</small>
                                <span class="badge bg-success mt-2">Sistem Aktif &amp; Terpadu</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Metric Cards Row -->
        <div class="col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4 d-flex align-items-center justify-content-between">
                    <div>
                        <div class="text-muted small fw-semibold text-uppercase">Total Santri</div>
                        <div class="fs-2 fw-bold text-dark mt-1">{{ $totalSantri }}</div>
                        <small class="text-success fw-medium"><i class="bi bi-check-circle me-1"></i> Terdaftar di
                            Database</small>
                    </div>
                    <div class="p-3 bg-success bg-opacity-10 text-success rounded-4">
                        <i class="bi bi-people-fill fs-2"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4 d-flex align-items-center justify-content-between">
                    <div>
                        <div class="text-muted small fw-semibold text-uppercase">Santri Putra (Banin)</div>
                        <div class="fs-2 fw-bold text-primary mt-1">{{ $totalPutra }}</div>
                        <small class="text-muted">{{ $totalSantri > 0 ? round(($totalPutra / $totalSantri) * 100) : 0 }}%
                            dari total santri</small>
                    </div>
                    <div class="p-3 bg-primary bg-opacity-10 text-primary rounded-4">
                        <i class="bi bi-gender-male fs-2"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4 d-flex align-items-center justify-content-between">
                    <div>
                        <div class="text-muted small fw-semibold text-uppercase">Santri Putri (Banat)</div>
                        <div class="fs-2 fw-bold text-danger mt-1">{{ $totalPutri }}</div>
                        <small class="text-muted">{{ $totalSantri > 0 ? round(($totalPutri / $totalSantri) * 100) : 0 }}%
                            dari total santri</small>
                    </div>
                    <div class="p-3 bg-danger bg-opacity-10 text-danger rounded-4">
                        <i class="bi bi-gender-female fs-2"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4 d-flex align-items-center justify-content-between">
                    <div>
                        <div class="text-muted small fw-semibold text-uppercase">Pengguna Sistem</div>
                        <div class="fs-2 fw-bold text-warning mt-1">{{ $totalUsers }}</div>
                        <small class="text-muted">Admin, Guru, Mudir</small>
                    </div>
                    <div class="p-3 bg-warning bg-opacity-10 text-warning rounded-4">
                        <i class="bi bi-person-badge fs-2"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Distribution Statistics: Kamar & Kelas -->
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white border-0 pt-4 px-4 pb-2 d-flex justify-content-between align-items-center">
                    <h5 class="fw-bold mb-0 text-dark">
                        <i class="bi bi-houses-fill text-success me-2"></i> Sebaran Santri per Asrama / Kamar
                    </h5>
                    <span class="badge bg-light text-muted border">Asrama Putra &amp; Putri</span>
                </div>
                <div class="card-body px-4 pb-4">
                    <div class="d-flex flex-column gap-3 mt-2">
                        @forelse($kamarStats as $stat)
                            <div>
                                <div class="d-flex justify-content-between small fw-semibold mb-1">
                                    <span>{{ $stat->kamar ?? 'Belum Ditentukan' }}</span>
                                    <span class="text-muted">{{ $stat->total }} Santri</span>
                                </div>
                                <div class="progress" style="height: 10px; border-radius: 999px;">
                                    @php
                                        $percent = $totalSantri > 0 ? ($stat->total / $totalSantri) * 100 : 0;
                                    @endphp
                                    <div class="progress-bar bg-success" role="progressbar"
                                        style="width: {{ $percent }}%;" aria-valuenow="{{ $percent }}"
                                        aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-4 text-muted small">Belum ada data kamar terdaftar.</div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white border-0 pt-4 px-4 pb-2 d-flex justify-content-between align-items-center">
                    <h5 class="fw-bold mb-0 text-dark">
                        <i class="bi bi-mortarboard-fill text-primary me-2"></i> Sebaran Jenjang Santri per Kelas
                    </h5>
                    <span class="badge bg-light text-muted border">Tsanawiyah &amp; Aliyah</span>
                </div>
                <div class="card-body px-4 pb-4">
                    <div class="d-flex flex-column gap-3 mt-2">
                        @forelse($kelasStats as $stat)
                            <div>
                                <div class="d-flex justify-content-between small fw-semibold mb-1">
                                    <span>{{ $stat->kelas ?? 'Belum Ditentukan' }}</span>
                                    <span class="text-muted">{{ $stat->total }} Santri</span>
                                </div>
                                <div class="progress" style="height: 10px; border-radius: 999px;">
                                    @php
                                        $percent = $totalSantri > 0 ? ($stat->total / $totalSantri) * 100 : 0;
                                    @endphp
                                    <div class="progress-bar bg-primary" role="progressbar"
                                        style="width: {{ $percent }}%;" aria-valuenow="{{ $percent }}"
                                        aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-4 text-muted small">Belum ada data kelas terdaftar.</div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Santri Table with Role-appropriate Actions -->
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div
                    class="card-header bg-white border-0 pt-4 px-4 pb-3 d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-2">
                    <div>
                        <h5 class="fw-bold mb-1 text-dark">
                            <i class="bi bi-clock-history text-secondary me-2"></i> Data Santri Terbaru
                        </h5>
                        <p class="text-muted small mb-0">Daftar santri yang baru ditambahkan ke sistem pondok pesantren</p>
                    </div>
                    <div class="d-flex gap-2">
                        <a href="{{ route('santri.index') }}" class="btn btn-sm btn-outline-success">
                            Lihat Seluruh Data Santri &rarr;
                        </a>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light small">
                                <tr>
                                    <th class="py-3 px-4">NIS</th>
                                    <th class="py-3">Nama Santri</th>
                                    <th class="py-3">Jenis Kelamin</th>
                                    <th class="py-3">Kamar / Asrama</th>
                                    <th class="py-3">Kelas</th>
                                    <th class="py-3 text-center">Hak Akses &amp; Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentSantris as $santri)
                                    <tr>
                                        <td class="px-4 fw-bold text-success">{{ $santri->nis }}</td>
                                        <td>
                                            <div class="fw-semibold text-dark">{{ $santri->nama_lengkap }}</div>
                                            <small class="text-muted">{{ $santri->tempat_lahir }}</small>
                                        </td>
                                        <td>
                                            <span
                                                class="badge {{ $santri->jenis_kelamin == 'Laki-laki' ? 'bg-primary-subtle text-primary border border-primary-subtle' : 'bg-danger-subtle text-danger border border-danger-subtle' }} rounded-pill px-2 py-1">
                                                {{ $santri->jenis_kelamin }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge bg-light text-dark border">
                                                <i class="bi bi-door-closed me-1"></i> {{ $santri->kamar ?? '-' }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge bg-light text-dark border">
                                                <i class="bi bi-bookmark me-1"></i> {{ $santri->kelas ?? '-' }}
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('santri.show', $santri->id) }}"
                                                class="btn btn-sm btn-outline-success">
                                                <i class="bi bi-eye"></i> Detail
                                            </a>

                                            {{-- Tombol Edit & Hapus Khusus Administrator --}}
                                            @if ($user->isAdmin())
                                                <a href="{{ route('santri.edit', $santri->id) }}"
                                                    class="btn btn-sm btn-outline-primary ms-1">
                                                    <i class="bi bi-pencil"></i> Edit
                                                </a>
                                                <form action="{{ route('santri.destroy', $santri->id) }}" method="POST"
                                                    class="d-inline"
                                                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus data santri ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger ms-1">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-4 text-muted">Belum ada data santri yang
                                            tersimpan.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
