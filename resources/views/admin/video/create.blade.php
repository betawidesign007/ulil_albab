@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <div>
                <h1 class="h3 fw-bold text-dark mb-1">
                    <i class="bi bi-plus-circle text-danger me-2"></i> Tambah Video Kegiatan
                </h1>
                <p class="text-muted mb-0">Tambahkan video baru dari YouTube untuk galeri atau slideshow teratas.</p>
            </div>
            <a href="{{ route('video.index') }}" class="btn btn-outline-secondary">
                &larr; Kembali
            </a>
        </div>

        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
            <div class="card-body p-4 p-md-5">
                <form action="{{ route('video.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label for="judul" class="form-label fw-bold text-dark">Judul Video <span class="text-danger">*</span></label>
                        <input type="text" name="judul" id="judul" value="{{ old('judul') }}" required
                            class="form-control @error('judul') is-invalid @enderror" placeholder="Contoh: Dokumenter 24 Jam Kehidupan Santri di Asrama">
                        @error('judul')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label for="kategori" class="form-label fw-bold text-dark">Kategori / Topik Video <span class="text-danger">*</span></label>
                            <input type="text" name="kategori" id="kategori" value="{{ old('kategori') }}" required
                                class="form-control @error('kategori') is-invalid @enderror" placeholder="Contoh: Tahfidz Qur'an / Seni Hadrah / Sains IT">
                            @error('kategori')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="durasi" class="form-label fw-bold text-dark">Perkiraan Durasi</label>
                            <input type="text" name="durasi" id="durasi" value="{{ old('durasi', '10:00') }}"
                                class="form-control @error('durasi') is-invalid @enderror" placeholder="Contoh: 14:20">
                            @error('durasi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Pilihan Sumber Video: Upload File atau Link YouTube -->
                    <div class="p-3 bg-light rounded-3 mb-3 border">
                        <label class="form-label fw-bold text-dark mb-2">Sumber Video Kegiatan <span class="text-danger">*</span></label>

                        <div class="mb-3">
                            <label for="video_file" class="form-label small text-dark fw-semibold"><i class="bi bi-upload text-success me-1"></i> Pilihan 1: Upload File Video Langsung dari Perangkat</label>
                            <input type="file" name="video_file" id="video_file" accept="video/*" class="form-control @error('video_file') is-invalid @enderror">
                            <small class="text-muted">Format: MP4, WebM, MOV, MKV (Maksimal 100MB)</small>
                            @error('video_file')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="text-center text-muted small my-2 fw-bold">&mdash; ATAU &mdash;</div>

                        <div>
                            <label for="youtube_url" class="form-label small text-dark fw-semibold"><i class="bi bi-youtube text-danger me-1"></i> Pilihan 2: Gunakan Tautan Video YouTube</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light text-danger"><i class="bi bi-youtube"></i></span>
                                <input type="text" name="youtube_url" id="youtube_url" value="{{ old('youtube_url') }}"
                                    class="form-control @error('youtube_url') is-invalid @enderror" placeholder="https://www.youtube.com/watch?v=... atau ID: fD3_P_V0Q3Y">
                            </div>
                            <small class="text-muted">Masukkan link jika video dihosting di YouTube.</small>
                            @error('youtube_url')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="p-3 bg-light rounded-3 mb-3 border">
                        <label class="form-label fw-bold text-dark mb-2">Thumbnail / Gambar Sampul Video (Opsional)</label>
                        <div class="mb-2">
                            <label for="thumbnail_file" class="form-label small text-muted">Upload Gambar Sampul dari Perangkat:</label>
                            <input type="file" name="thumbnail_file" id="thumbnail_file" accept="image/*" class="form-control @error('thumbnail_file') is-invalid @enderror">
                            <small class="text-muted">Format: JPG, PNG, WEBP (Maksimal 10MB)</small>
                            @error('thumbnail_file')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mt-2">
                            <label for="thumbnail" class="form-label small text-muted">Atau Gunakan Link URL Thumbnail:</label>
                            <input type="url" name="thumbnail" id="thumbnail" value="{{ old('thumbnail') }}"
                                class="form-control @error('thumbnail') is-invalid @enderror" placeholder="Biarkan kosong jika memakai link YouTube untuk otomatis mengambil thumbnail YouTube">
                            @error('thumbnail')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="deskripsi" class="form-label fw-bold text-dark">Ringkasan / Sinopsis Video</label>
                        <textarea name="deskripsi" id="deskripsi" rows="3"
                            class="form-control @error('deskripsi') is-invalid @enderror" placeholder="Tuliskan ulasan ringkas mengenai tayangan video...">{{ old('deskripsi') }}</textarea>
                        @error('deskripsi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Slide Show & Feature Settings Card -->
                    <div class="p-3 bg-light rounded-3 mb-4 border">
                        <h6 class="fw-bold text-dark mb-2">
                            <i class="bi bi-sliders text-success me-1"></i> Pengaturan Penayangan Slideshow
                        </h6>

                        <div class="form-check form-switch mb-2">
                            <input class="form-check-input" type="checkbox" name="is_hero_slider" id="is_hero_slider" value="1" {{ old('is_hero_slider', 1) ? 'checked' : '' }}>
                            <label class="form-check-label fw-semibold text-dark" for="is_hero_slider">
                                Tampilkan di Slide Show Paling Atas (4 Video Teratas)
                            </label>
                            <div class="small text-muted ps-0">
                                Video ini akan masuk ke dalam slider carousel video paling atas di halaman beranda.
                            </div>
                        </div>

                        <div class="form-check form-switch mb-3">
                            <input class="form-check-input" type="checkbox" name="is_featured" id="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }}>
                            <label class="form-check-label fw-semibold text-dark" for="is_featured">
                                Jadikan Video Utama Terpilih di Bagian Galeri Video
                            </label>
                        </div>

                        <div class="row align-items-center">
                            <div class="col-sm-4">
                                <label for="urutan" class="form-label small fw-bold text-dark mb-0">Nomor Urutan Tampil:</label>
                            </div>
                            <div class="col-sm-4">
                                <input type="number" name="urutan" id="urutan" value="{{ old('urutan', 1) }}" min="1" max="99" class="form-control form-control-sm">
                            </div>
                            <div class="col-sm-4">
                                <small class="text-muted">Urutan 1 tampil paling awal.</small>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('video.index') }}" class="btn btn-secondary">Batal</a>
                        <button type="submit" class="btn btn-pesantren px-4">
                            <i class="bi bi-save me-1"></i> Simpan Video
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
