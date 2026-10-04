@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <div>
                <h1 class="h3 fw-bold text-dark mb-1">
                    <i class="bi bi-plus-circle text-success me-2"></i> Tambah Dokumentasi Kegiatan
                </h1>
                <p class="text-muted mb-0">Publikasikan foto kegiatan santri baru ke galeri publik.</p>
            </div>
            <a href="{{ route('kegiatan.index') }}" class="btn btn-outline-secondary">
                &larr; Kembali
            </a>
        </div>

        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
            <div class="card-body p-4 p-md-5">
                <form action="{{ route('kegiatan.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label for="judul" class="form-label fw-bold text-dark">Judul Kegiatan <span class="text-danger">*</span></label>
                        <input type="text" name="judul" id="judul" value="{{ old('judul') }}" required
                            class="form-control @error('judul') is-invalid @enderror" placeholder="Contoh: Haflah Wisuda Tahfidzul Qur'an Angkatan XIV">
                        @error('judul')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label for="kategori" class="form-label fw-bold text-dark">Kategori Kegiatan <span class="text-danger">*</span></label>
                            <select name="kategori" id="kategori" required class="form-select @error('kategori') is-invalid @enderror">
                                <option value="" disabled selected>-- Pilih Kategori --</option>
                                <option value="tahfidz" {{ old('kategori') == 'tahfidz' ? 'selected' : '' }}>Kajian & Tahfidz Al-Qur'an</option>
                                <option value="phbi" {{ old('kategori') == 'phbi' ? 'selected' : '' }}>Hari Besar Islam (PHBI) & Maulid</option>
                                <option value="ekskul" {{ old('kategori') == 'ekskul' ? 'selected' : '' }}>Bahasa, IT & Ekstrakurikuler</option>
                                <option value="sosial" {{ old('kategori') == 'sosial' ? 'selected' : '' }}>Sosial & Kemandirian Santri</option>
                                <option value="umum" {{ old('kategori') == 'umum' ? 'selected' : '' }}>Kegiatan Umum Pesantren</option>
                            </select>
                            @error('kategori')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="tanggal" class="form-label fw-bold text-dark">Tanggal Pelaksanaan <span class="text-danger">*</span></label>
                            <input type="date" name="tanggal" id="tanggal" value="{{ old('tanggal', date('Y-m-d')) }}" required
                                class="form-control @error('tanggal') is-invalid @enderror">
                            @error('tanggal')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="lokasi" class="form-label fw-bold text-dark">Lokasi Kegiatan <span class="text-danger">*</span></label>
                        <input type="text" name="lokasi" id="lokasi" value="{{ old('lokasi') }}" required
                            class="form-control @error('lokasi') is-invalid @enderror" placeholder="Contoh: Masjid Jami' Li Ulil Albab / Gedung Rektorat">
                        @error('lokasi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="p-3 bg-light rounded-3 mb-3 border">
                        <label class="form-label fw-bold text-dark mb-2">Foto / Dokumentasi Kegiatan <span class="text-danger">*</span></label>

                        <div class="mb-3">
                            <label for="gambar_file" class="form-label small text-muted">Upload Gambar dari Perangkat:</label>
                            <input type="file" name="gambar_file" id="gambar_file" accept="image/*" class="form-control @error('gambar_file') is-invalid @enderror" onchange="handleFotoUpload(event)">
                            <div class="d-flex align-items-center justify-content-between mt-1">
                                <small class="text-muted"><i class="bi bi-check-circle-fill text-success me-1"></i> Mendukung semua format gambar (JPG, PNG, WEBP, HEIC, GIF, SVG, BMP) & otomatis dioptimasi.</small>
                                <span id="fileSizeBadge" class="badge bg-secondary d-none"></span>
                            </div>
                            @error('gambar_file')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror

                            <!-- Live Image Preview Container -->
                            <div id="imagePreviewBox" class="mt-3 d-none text-center p-2 bg-white rounded-3 border">
                                <img id="imagePreview" src="" alt="Pratinjau Foto" class="rounded shadow-sm" style="max-height: 240px; max-width: 100%; object-fit: contain;">
                                <div class="small text-success mt-1 fw-semibold"><i class="bi bi-check2-circle"></i> Foto siap diunggah</div>
                            </div>
                        </div>

                        <div class="text-center text-muted small my-2">&mdash; ATAU &mdash;</div>

                        <div>
                            <label for="gambar_url" class="form-label small text-muted">Gunakan URL Gambar Online (Unsplash / CDN):</label>
                            <input type="url" name="gambar_url" id="gambar_url" value="{{ old('gambar_url') }}"
                                class="form-control @error('gambar_url') is-invalid @enderror" placeholder="https://images.unsplash.com/photo-...">
                            @error('gambar_url')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="deskripsi" class="form-label fw-bold text-dark">Deskripsi & Liputan Kegiatan <span class="text-danger">*</span></label>
                        <textarea name="deskripsi" id="deskripsi" rows="5" required
                            class="form-control @error('deskripsi') is-invalid @enderror" placeholder="Tuliskan ulasan ringkas mengenai jalannya kegiatan, peserta, dan tujuan program...">{{ old('deskripsi') }}</textarea>
                        @error('deskripsi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('kegiatan.index') }}" class="btn btn-secondary">Batal</a>
                        <button type="submit" class="btn btn-pesantren px-4">
                            <i class="bi bi-save me-1"></i> Simpan Dokumentasi
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function handleFotoUpload(event) {
    const fileInput = event.target;
    const file = fileInput.files && fileInput.files[0];
    if (!file) return;

    const previewBox = document.getElementById('imagePreviewBox');
    const previewImg = document.getElementById('imagePreview');
    const sizeBadge = document.getElementById('fileSizeBadge');

    const sizeInMB = (file.size / (1024 * 1024)).toFixed(2);
    sizeBadge.innerText = `${sizeInMB} MB`;
    sizeBadge.className = 'badge bg-success';
    sizeBadge.classList.remove('d-none');

    const reader = new FileReader();
    reader.onload = function(e) {
        previewImg.src = e.target.result;
        previewBox.classList.remove('d-none');
    };
    reader.readAsDataURL(file);
}
</script>
@endsection
