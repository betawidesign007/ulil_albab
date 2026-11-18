@extends('layouts.app')

@section('content')
    <div class="row gy-4">
        <!-- Header -->
        <div class="col-12">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
                <div>
                    <h1 class="h3 fw-bold text-dark mb-1">
                        <i class="bi bi-images text-success me-2"></i> Manajemen Galeri Foto Kegiatan
                    </h1>
                    <p class="text-muted mb-0">
                        Kelola dokumentasi foto kegiatan santri yang tampil pada portal publik dan landing page.
                    </p>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('landing') }}#kegiatan" target="_blank" class="btn btn-outline-secondary shadow-sm">
                        <i class="bi bi-eye me-1"></i> Preview di Website
                    </a>
                    <a href="{{ route('kegiatan.create') }}" class="btn btn-pesantren shadow-sm">
                        <i class="bi bi-plus-circle me-1"></i> + Tambah Kegiatan
                    </a>
                </div>
            </div>
        </div>

        <!-- Alert Success -->
        @if (session('success'))
            <div class="col-12">
                <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            </div>
        @endif

        <!-- Cards Grid -->
        <div class="col-12">
            <div class="row g-4">
                @forelse($kegiatans as $kegiatan)
                    <div class="col-md-6 col-lg-4">
                        <div class="card border-0 shadow-sm h-100 overflow-hidden d-flex flex-column">
                            <div class="position-relative" style="height: 200px; background-color: #0f172a;">
                                <img src="{{ $kegiatan->gambar_url }}" alt="{{ $kegiatan->judul }}" class="w-100 h-100"
                                    style="object-fit: cover;">
                                <span class="position-absolute top-0 start-0 m-3 badge bg-dark bg-opacity-75">
                                    {{ $kegiatan->kategori_label }}
                                </span>
                                <span class="position-absolute bottom-0 end-0 m-2 badge bg-secondary">
                                    <i class="bi bi-calendar3 me-1"></i> {{ $kegiatan->tanggal->translatedFormat('d M Y') }}
                                </span>
                            </div>
                            <div class="card-body p-4 d-flex flex-column flex-grow-1">
                                <h5 class="fw-bold text-dark mb-2 line-clamp-2">{{ $kegiatan->judul }}</h5>
                                <p class="text-muted small mb-3 flex-grow-1"
                                    style="display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;">
                                    {{ $kegiatan->deskripsi }}
                                </p>
                                <div class="small text-muted mb-3">
                                    <i class="bi bi-geo-alt text-danger me-1"></i> {{ $kegiatan->lokasi }}
                                </div>
                                <div
                                    class="d-flex justify-content-between align-items-center pt-3 border-top mt-auto gap-2">
                                    <button type="button" class="btn btn-sm btn-outline-success btn-preview-kegiatan"
                                        data-judul="{{ $kegiatan->judul }}"
                                        data-tanggal="{{ $kegiatan->tanggal->translatedFormat('d F Y') }}"
                                        data-lokasi="{{ $kegiatan->lokasi }}"
                                        data-kategori="{{ $kegiatan->kategori_label }}"
                                        data-gambar="{{ $kegiatan->gambar_url }}"
                                        data-deskripsi="{{ $kegiatan->deskripsi }}">
                                        <i class="bi bi-eye me-1"></i> Detail
                                    </button>
                                    <div class="d-flex gap-1">
                                        <a href="{{ route('kegiatan.edit', $kegiatan) }}"
                                            class="btn btn-sm btn-outline-primary">
                                            <i class="bi bi-pencil-square me-1"></i> Edit
                                        </a>
                                        <form action="{{ route('kegiatan.destroy', $kegiatan) }}" method="POST"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus dokumentasi kegiatan ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                                <i class="bi bi-trash me-1"></i> Hapus
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="card border-0 shadow-sm text-center py-5">
                            <div class="card-body">
                                <i class="bi bi-images text-muted" style="font-size: 3rem;"></i>
                                <h5 class="fw-bold mt-3">Belum ada dokumentasi kegiatan</h5>
                                <p class="text-muted">Mulai tambahkan foto dan berita kegiatan santri ke galeri portal.</p>
                                <a href="{{ route('kegiatan.create') }}" class="btn btn-pesantren">
                                    + Tambah Kegiatan Sekarang
                                </a>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Pagination -->
        <div class="col-12">
            {{ $kegiatans->links() }}
        </div>
    </div>

    <!-- Modal Detail Dokumentasi Admin -->
    <div class="modal fade" id="modalAdminKegiatan" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
                <div class="position-relative bg-dark">
                    <img id="adminKegiatanImg" src="" alt="Dokumentasi" class="w-100"
                        style="height: 320px; object-fit: cover;">
                    <button type="button"
                        class="btn-close btn-close-white position-absolute top-0 end-0 m-3 p-2 bg-dark rounded-circle"
                        data-bs-dismiss="modal" aria-label="Close"></button>
                    <span id="adminKegiatanBadge"
                        class="position-absolute bottom-0 start-0 m-3 badge bg-success fs-6"></span>
                </div>
                <div class="modal-body p-4 p-md-5">
                    <div class="d-flex flex-wrap align-items-center gap-3 text-muted small mb-3">
                        <span><i class="bi bi-calendar-event text-success me-1"></i> <span
                                id="adminKegiatanTanggal"></span></span>
                        <span><i class="bi bi-geo-alt-fill text-danger me-1"></i> <span
                                id="adminKegiatanLokasi"></span></span>
                    </div>
                    <h4 class="fw-bold text-dark mb-3" id="adminKegiatanTitle"></h4>
                    <p class="text-muted leading-relaxed mb-0" id="adminKegiatanDesc" style="white-space: pre-line;"></p>
                    <div class="mt-4 pt-3 border-top d-flex justify-content-end">
                        <button type="button" class="btn btn-secondary btn-sm px-3"
                            data-bs-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('click', function(e) {
            const btn = e.target.closest('.btn-preview-kegiatan');
            if (!btn) return;

            document.getElementById('adminKegiatanTitle').textContent = btn.dataset.judul || '';
            document.getElementById('adminKegiatanTanggal').textContent = btn.dataset.tanggal || '';
            document.getElementById('adminKegiatanLokasi').textContent = btn.dataset.lokasi || '';
            document.getElementById('adminKegiatanBadge').textContent = btn.dataset.kategori || '';
            document.getElementById('adminKegiatanImg').src = btn.dataset.gambar || '';
            document.getElementById('adminKegiatanDesc').textContent = btn.dataset.deskripsi || '';

            bootstrap.Modal.getOrCreateInstance(document.getElementById('modalAdminKegiatan')).show();
        });
    </script>
@endsection
