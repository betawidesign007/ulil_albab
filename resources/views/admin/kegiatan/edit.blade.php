@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <div>
                <h1 class="h3 fw-bold text-dark mb-1">
                    <i class="bi bi-pencil-square text-success me-2"></i> Edit Dokumentasi Kegiatan
                </h1>
                <p class="text-muted mb-0">Perbarui data atau gambar dokumentasi kegiatan santri.</p>
            </div>
            <a href="{{ route('kegiatan.index') }}" class="btn btn-outline-secondary">
                &larr; Kembali
            </a>
        </div>

        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
            <div class="card-body p-4 p-md-5">
                <form action="{{ route('kegiatan.update', $kegiatan) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="judul" class="form-label fw-bold text-dark">Judul Kegiatan <span class="text-danger">*</span></label>
                        <input type="text" name="judul" id="judul" value="{{ old('judul', $kegiatan->judul) }}" required
                            class="form-control @error('judul') is-invalid @enderror">
                        @error('judul')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label for="kategori" class="form-label fw-bold text-dark">Kategori Kegiatan <span class="text-danger">*</span></label>
                            <select name="kategori" id="kategori" required class="form-select @error('kategori') is-invalid @enderror">
                                <option value="tahfidz" {{ old('kategori', $kegiatan->kategori) == 'tahfidz' ? 'selected' : '' }}>Kajian & Tahfidz Al-Qur'an</option>
                                <option value="phbi" {{ old('kategori', $kegiatan->kategori) == 'phbi' ? 'selected' : '' }}>Hari Besar Islam (PHBI) & Maulid</option>
                                <option value="ekskul" {{ old('kategori', $kegiatan->kategori) == 'ekskul' ? 'selected' : '' }}>Bahasa, IT & Ekstrakurikuler</option>
                                <option value="sosial" {{ old('kategori', $kegiatan->kategori) == 'sosial' ? 'selected' : '' }}>Sosial & Kemandirian Santri</option>
                                <option value="umum" {{ old('kategori', $kegiatan->kategori) == 'umum' ? 'selected' : '' }}>Kegiatan Umum Pesantren</option>
                            </select>
                            @error('kategori')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="tanggal" class="form-label fw-bold text-dark">Tanggal Pelaksanaan <span class="text-danger">*</span></label>
                            <input type="date" name="tanggal" id="tanggal" value="{{ old('tanggal', $kegiatan->tanggal->format('Y-m-d')) }}" required
                                class="form-control @error('tanggal') is-invalid @enderror">
                            @error('tanggal')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="lokasi" class="form-label fw-bold text-dark">Lokasi Kegiatan <span class="text-danger">*</span></label>
                        <input type="text" name="lokasi" id="lokasi" value="{{ old('lokasi', $kegiatan->lokasi) }}" required
                            class="form-control @error('lokasi') is-invalid @enderror">
                        @error('lokasi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="p-3 bg-light rounded-3 mb-3 border">
                        <label class="form-label fw-bold text-dark mb-2">Foto / Dokumentasi Kegiatan</label>

                        <div class="d-flex align-items-center gap-3 mb-3">
                            <img src="{{ $kegiatan->gambar_url }}" id="currentImgPreview" alt="Preview" class="rounded border shadow-sm" style="width: 120px; height: 80px; object-fit: cover;">
                            <div class="small text-muted">
                                <strong>Gambar Saat Ini</strong><br>
                                Biarkan kosong bila tidak ingin mengganti gambar.
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="gambar_file" class="form-label small text-muted">Upload Gambar Baru (Opsional):</label>
                            <input type="file" name="gambar_file" id="gambar_file" accept="image/*" class="form-control @error('gambar_file') is-invalid @enderror" onchange="handleFotoUploadEdit(event)">
                            <div class="d-flex align-items-center justify-content-between mt-1">
                                <small class="text-muted"><i class="bi bi-check-circle-fill text-success me-1"></i> Mendukung semua format gambar (JPG, PNG, WEBP, HEIC, GIF, SVG, BMP) & otomatis dioptimasi.</small>
                                <span id="fileSizeBadgeEdit" class="badge bg-secondary d-none"></span>
                            </div>
                            @error('gambar_file')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror

                            <!-- Live Image Preview Container -->
                            <div id="imagePreviewBoxEdit" class="mt-3 d-none text-center p-2 bg-white rounded-3 border">
                                <img id="imagePreviewEdit" src="" alt="Pratinjau Foto Baru" class="rounded shadow-sm" style="max-height: 240px; max-width: 100%; object-fit: contain;">
                                <div class="small text-success mt-1 fw-semibold"><i class="bi bi-check2-circle"></i> Foto baru siap menggantikan foto lama</div>
                            </div>
                        </div>

                        <div class="text-center text-muted small my-2">&mdash; ATAU &mdash;</div>

                        <div>
                            <label for="gambar_url" class="form-label small text-muted">Ganti dengan URL Gambar Online Baru:</label>
                            <input type="url" name="gambar_url" id="gambar_url" value="{{ old('gambar_url', str_starts_with($kegiatan->gambar, 'http') ? $kegiatan->gambar : '') }}"
                                class="form-control @error('gambar_url') is-invalid @enderror" placeholder="https://images.unsplash.com/photo-...">
                            @error('gambar_url')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="deskripsi" class="form-label fw-bold text-dark">Deskripsi & Liputan Kegiatan <span class="text-danger">*</span></label>
                        <textarea name="deskripsi" id="deskripsi" rows="5" required
                            class="form-control @error('deskripsi') is-invalid @enderror">{{ old('deskripsi', $kegiatan->deskripsi) }}</textarea>
                        @error('deskripsi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('kegiatan.index') }}" class="btn btn-secondary">Batal</a>
                        <button type="submit" class="btn btn-pesantren px-4">
                            <i class="bi bi-save me-1"></i> Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function handleFotoUploadEdit(event) {
    const fileInput = event.target;
    const file = fileInput.files && fileInput.files[0];
    if (!file) return;

    const previewBox = document.getElementById('imagePreviewBoxEdit');
    const previewImg = document.getElementById('imagePreviewEdit');
    const sizeBadge = document.getElementById('fileSizeBadgeEdit');

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
