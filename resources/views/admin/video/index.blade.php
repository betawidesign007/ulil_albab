@extends('layouts.app')

@section('content')
<div class="row gy-4">
    <!-- Header -->
    <div class="col-12">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
            <div>
                <h1 class="h3 fw-bold text-dark mb-1">
                    <i class="bi bi-play-btn-fill text-danger me-2"></i> Manajemen Video Kegiatan &amp; Slideshow
                </h1>
                <p class="text-muted mb-0">
                    Kelola video kegiatan santri dan atur <strong>4 Video Slideshow Paling Atas</strong> di halaman website utama.
                </p>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('landing') }}#video-slideshow" target="_blank" class="btn btn-outline-secondary shadow-sm">
                    <i class="bi bi-eye me-1"></i> Preview Slideshow Website
                </a>
                <a href="{{ route('video.create') }}" class="btn btn-pesantren shadow-sm">
                    <i class="bi bi-plus-circle me-1"></i> + Tambah Video
                </a>
            </div>
        </div>
    </div>

    <!-- Alert Success -->
    @if(session('success'))
        <div class="col-12">
            <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        </div>
    @endif

    <!-- Information Status Box -->
    <div class="col-12">
        <div class="alert alert-warning border-0 shadow-sm d-flex flex-wrap align-items-center justify-content-between gap-3 p-3">
            <div class="d-flex align-items-center gap-3">
                <span class="p-2 bg-warning bg-opacity-25 rounded-circle text-dark">
                    <i class="bi bi-sliders2-vertical fs-4"></i>
                </span>
                <div>
                    <strong class="d-block text-dark">Status 4 Video Slideshow Teratas:</strong>
                    <span class="small text-muted">
                        Saat ini terdapat <strong>{{ $heroCount }} video</strong> yang ditandai untuk tayang di Slide Show Paling Atas halaman utama portal.
                    </span>
                </div>
            </div>
            <span class="badge {{ $heroCount >= 4 ? 'bg-success' : 'bg-warning text-dark' }} px-3 py-2 fs-6">
                <i class="bi bi-check-circle me-1"></i> {{ $heroCount }} / 4 Slot Aktif
            </span>
        </div>
    </div>

    <!-- Video Grid -->
    <div class="col-12">
        <div class="row g-4">
            @forelse($videos as $video)
                <div class="col-md-6 col-lg-4">
                    <div class="card border-0 shadow-sm h-100 overflow-hidden d-flex flex-column {{ $video->is_hero_slider ? 'border-2 border-warning' : '' }}">
                        <div class="position-relative bg-dark" style="height: 190px;">
                            <img src="{{ $video->thumbnail_url }}" alt="{{ $video->judul }}" class="w-100 h-100" style="object-fit: cover;">
                            
                            <!-- Badges -->
                            <div class="position-absolute top-0 start-0 m-2 d-flex flex-column gap-1">
                                <span class="badge bg-dark bg-opacity-75">{{ $video->kategori }}</span>
                                @if($video->is_hero_slider)
                                    <span class="badge bg-warning text-dark fw-bold">
                                        <i class="bi bi-star-fill me-1"></i> Slideshow Atas
                                    </span>
                                @endif
                                @if($video->is_featured)
                                    <span class="badge bg-danger">
                                        <i class="bi bi-broadcast me-1"></i> Video Utama
                                    </span>
                                @endif
                            </div>

                            <span class="position-absolute bottom-0 end-0 m-2 badge bg-dark">
                                <i class="bi bi-clock me-1"></i> {{ $video->durasi }}
                            </span>

                            <!-- Play Overlay Button -->
                            <button type="button" class="btn btn-danger position-absolute top-50 start-50 translate-middle rounded-circle shadow-lg"
                                style="width: 48px; height: 48px; display: flex; align-items: center; justify-content: center;"
                                onclick="previewVideo('{{ $video->youtube_id }}', '{{ addslashes($video->judul) }}')">
                                <i class="bi bi-play-fill fs-4"></i>
                            </button>
                        </div>

                        <div class="card-body p-4 d-flex flex-column flex-grow-1">
                            <h5 class="fw-bold text-dark mb-2" style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                                {{ $video->judul }}
                            </h5>
                            <p class="text-muted small mb-3 flex-grow-1" style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                                {{ $video->deskripsi ?? 'Tidak ada deskripsi tambahan.' }}
                            </p>

                            <div class="small text-muted mb-3 d-flex justify-content-between align-items-center">
                                <span>ID: <code class="text-dark">{{ $video->youtube_id }}</code></span>
                                <span>Urutan: <strong>#{{ $video->urutan }}</strong></span>
                            </div>

                            <div class="d-flex justify-content-between align-items-center pt-3 border-top mt-auto">
                                <a href="{{ route('video.edit', $video) }}" class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-pencil-square me-1"></i> Edit
                                </a>
                                <form action="{{ route('video.destroy', $video) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus video ini?')">
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
            @empty
                <div class="col-12">
                    <div class="card border-0 shadow-sm text-center py-5">
                        <div class="card-body">
                            <i class="bi bi-play-btn text-muted" style="font-size: 3rem;"></i>
                            <h5 class="fw-bold mt-3">Belum ada video kegiatan</h5>
                            <p class="text-muted">Tambahkan video YouTube kegiatan santri untuk ditampilkan di galeri dan slideshow.</p>
                            <a href="{{ route('video.create') }}" class="btn btn-pesantren">
                                + Tambah Video Sekarang
                            </a>
                        </div>
                    </div>
                </div>
            @endforelse
        </div>
    </div>

    <!-- Pagination -->
    <div class="col-12">
        {{ $videos->links() }}
    </div>
</div>

<!-- Modal Video Preview -->
<div class="modal fade" id="modalAdminVideo" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content bg-dark border-0 rounded-4 overflow-hidden text-white">
            <div class="modal-header border-secondary py-2 px-3">
                <h6 class="modal-title fw-bold" id="modalAdminVideoTitle">Preview Video</h6>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close" onclick="closeAdminVideo()"></button>
            </div>
            <div class="modal-body p-0 ratio ratio-16x9">
                <iframe id="modalAdminVideoIframe" src="" allowfullscreen allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"></iframe>
            </div>
        </div>
    </div>
</div>

<script>
    function previewVideo(youtubeId, title) {
        document.getElementById('modalAdminVideoTitle').innerText = title;
        document.getElementById('modalAdminVideoIframe').src = 'https://www.youtube-nocookie.com/embed/' + youtubeId + '?autoplay=1&rel=0';
        new bootstrap.Modal(document.getElementById('modalAdminVideo')).show();
    }
    function closeAdminVideo() {
        document.getElementById('modalAdminVideoIframe').src = '';
    }
    document.getElementById('modalAdminVideo').addEventListener('hidden.bs.modal', function () {
        closeAdminVideo();
    });
</script>
@endsection
