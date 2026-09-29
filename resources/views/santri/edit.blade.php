@extends('layouts.app')

@section('content')
<div class="container py-3">
    <div class="row justify-content-center">
        <div class="col-md-9 col-lg-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-pesantren text-white p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="fw-bold mb-1 text-white">
                                <i class="bi bi-pencil-square me-2"></i> Edit Data Santri
                            </h4>
                            <small class="text-white-50">Perbarui data: <strong>{{ $santri->nama_lengkap }}</strong> (NIS: {{ $santri->nis }})</small>
                        </div>
                        <a href="{{ route('santri.index') }}" class="btn btn-outline-light btn-sm">
                            &larr; Batal
                        </a>
                    </div>
                </div>

                <div class="card-body p-4">
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <ul class="mb-0 small">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form action="{{ route('santri.update', $santri->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold small">Nomor Induk Santri (NIS) <span class="text-danger">*</span></label>
                                <input type="text" name="nis" value="{{ old('nis', $santri->nis) }}" required
                                    class="form-control @error('nis') is-invalid @enderror">
                                @error('nis')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold small">Nama Lengkap Santri <span class="text-danger">*</span></label>
                                <input type="text" name="nama_lengkap"
                                    value="{{ old('nama_lengkap', $santri->nama_lengkap) }}" required
                                    class="form-control @error('nama_lengkap') is-invalid @enderror">
                                @error('nama_lengkap')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold small">Jenis Kelamin <span class="text-danger">*</span></label>
                                <select name="jenis_kelamin" class="form-select @error('jenis_kelamin') is-invalid @enderror" required>
                                    <option value="Laki-laki"
                                        {{ old('jenis_kelamin', $santri->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>
                                        Laki-laki (Banin)</option>
                                    <option value="Perempuan"
                                        {{ old('jenis_kelamin', $santri->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>
                                        Perempuan (Banat)</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold small">Tempat Lahir <span class="text-danger">*</span></label>
                                <input type="text" name="tempat_lahir"
                                    value="{{ old('tempat_lahir', $santri->tempat_lahir) }}" required
                                    class="form-control">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold small">Tanggal Lahir <span class="text-danger">*</span></label>
                                <input type="date" name="tanggal_lahir"
                                    value="{{ old('tanggal_lahir', $santri->tanggal_lahir) }}" required
                                    class="form-control">
                            </div>

                            <!-- Dropdown Kamar / Asrama -->
                            <div class="col-md-6">
                                <label class="form-label fw-semibold small">Kamar / Asrama</label>
                                <select name="kamar" class="form-select">
                                    <option value="">-- Pilih Kamar --</option>
                                    <option value="Al-Ghazali"
                                        {{ old('kamar', $santri->kamar) == 'Al-Ghazali' ? 'selected' : '' }}>Al-Ghazali (Putra)
                                    </option>
                                    <option value="Ali bin Abi Thalib"
                                        {{ old('kamar', $santri->kamar) == 'Ali bin Abi Thalib' ? 'selected' : '' }}>Ali bin Abi Thalib (Putra)</option>
                                    <option value="Fatimah"
                                        {{ old('kamar', $santri->kamar) == 'Fatimah' ? 'selected' : '' }}>Fatimah (Putri)
                                    </option>
                                    <option value="Aisyah"
                                        {{ old('kamar', $santri->kamar) == 'Aisyah' ? 'selected' : '' }}>Aisyah (Putri)
                                    </option>
                                </select>
                            </div>

                            <!-- Dropdown Kelas -->
                            <div class="col-12">
                                <label class="form-label fw-semibold small">Jenjang &amp; Kelas</label>
                                <select name="kelas" class="form-select">
                                    <option value="">-- Pilih Kelas --</option>
                                    <option value="1 Tsanawiyah"
                                        {{ old('kelas', $santri->kelas) == '1 Tsanawiyah' ? 'selected' : '' }}>1 Tsanawiyah (Kelas 7)</option>
                                    <option value="2 Tsanawiyah"
                                        {{ old('kelas', $santri->kelas) == '2 Tsanawiyah' ? 'selected' : '' }}>2 Tsanawiyah (Kelas 8)</option>
                                    <option value="3 Tsanawiyah"
                                        {{ old('kelas', $santri->kelas) == '3 Tsanawiyah' ? 'selected' : '' }}>3 Tsanawiyah (Kelas 9)</option>
                                    <option value="1 Aliyah"
                                        {{ old('kelas', $santri->kelas) == '1 Aliyah' ? 'selected' : '' }}>1 Aliyah (Kelas 10)</option>
                                    <option value="2 Aliyah"
                                        {{ old('kelas', $santri->kelas) == '2 Aliyah' ? 'selected' : '' }}>2 Aliyah (Kelas 11)</option>
                                    <option value="3 Aliyah"
                                        {{ old('kelas', $santri->kelas) == '3 Aliyah' ? 'selected' : '' }}>3 Aliyah (Kelas 12)</option>
                                </select>
                            </div>

                            <!-- Alamat Domisili -->
                            <div class="col-12">
                                <label class="form-label fw-semibold small">Alamat Asal / Domisili</label>
                                <textarea name="alamat" rows="2" class="form-control" placeholder="Alamat lengkap orang tua / wali santri">{{ old('alamat', $santri->alamat) }}</textarea>
                            </div>
                        </div>

                        <div class="mt-4 pt-3 border-top d-flex justify-content-end gap-2">
                            <a href="{{ route('santri.index') }}" class="btn btn-secondary">Batal</a>
                            <button type="submit" class="btn btn-primary px-4">
                                <i class="bi bi-arrow-repeat me-1"></i> Perbarui Data Santri
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
