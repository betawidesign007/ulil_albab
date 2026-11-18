@extends('layouts.app', ['title' => 'Sunting Transaksi Pembayaran'])

@section('content')
<div class="py-2 py-sm-3">
    <div class="row justify-content-center">
        <div class="col-md-9 col-lg-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white p-3 p-sm-4">
                    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-2">
                        <div>
                            <h4 class="fw-bold mb-1 text-white">
                                <i class="bi bi-pencil-square me-2"></i> Edit Transaksi Pembayaran
                            </h4>
                            <small class="text-white-50">Perbarui rincian transaksi nomor: <strong class="text-white font-monospace">{{ $pembayaran->kode_transaksi }}</strong></small>
                        </div>
                        <a href="{{ route('pembayaran.show', $pembayaran->id) }}" class="btn btn-outline-light btn-sm align-self-start align-self-sm-center">
                            &larr; Batal
                        </a>
                    </div>
                </div>

                <div class="card-body p-4">
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <div class="fw-bold mb-1"><i class="bi bi-exclamation-circle-fill me-1"></i> Mohon periksa kembali formulir:</div>
                            <ul class="mb-0 small">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form action="{{ route('pembayaran.update', $pembayaran->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Kode Transaksi Info -->
                        <div class="p-3 bg-light rounded-3 mb-4 border d-flex justify-content-between align-items-center">
                            <div>
                                <span class="text-muted small d-block">Nomor Transaksi</span>
                                <span class="fw-bold fs-6 text-dark font-monospace">{{ $pembayaran->kode_transaksi }}</span>
                            </div>
                            <span class="badge {{ $pembayaran->status_badge_class }} px-3 py-2">
                                Status: {{ $pembayaran->status }}
                            </span>
                        </div>

                        <div class="row g-3">
                            <!-- Santri Pemilik Transaksi -->
                            <div class="col-12">
                                <label class="form-label fw-semibold small">Pilih Santri <span class="text-danger">*</span></label>
                                <select name="santri_id" class="form-select @error('santri_id') is-invalid @enderror" required>
                                    @foreach($santris as $s)
                                        <option value="{{ $s->id }}" {{ old('santri_id', $pembayaran->santri_id) == $s->id ? 'selected' : '' }}>
                                            {{ $s->nis }} - {{ $s->nama_lengkap }} (Kelas: {{ $s->kelas ?? '-' }} | Asrama: {{ $s->kamar ?? '-' }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('santri_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Kategori Pembayaran -->
                            <div class="col-md-6">
                                <label class="form-label fw-semibold small">Kategori Pembayaran <span class="text-danger">*</span></label>
                                <select name="kategori_pembayaran" class="form-select @error('kategori_pembayaran') is-invalid @enderror" required>
                                    @foreach($kategoris as $kat)
                                        <option value="{{ $kat }}" {{ old('kategori_pembayaran', $pembayaran->kategori_pembayaran) == $kat ? 'selected' : '' }}>
                                            {{ $kat }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('kategori_pembayaran')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Nominal Pembayaran -->
                            <div class="col-md-6">
                                <label class="form-label fw-semibold small">Nominal (Rupiah) <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light fw-bold">Rp</span>
                                    <input type="number" name="jumlah" value="{{ old('jumlah', (int) $pembayaran->jumlah) }}" required min="0" step="1000"
                                        class="form-control @error('jumlah') is-invalid @enderror">
                                </div>
                                @error('jumlah')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Periode Bulan & Tahun -->
                            <div class="col-md-6">
                                <label class="form-label fw-semibold small">Untuk Bulan (Opsional / SPP)</label>
                                <select name="bulan_dibayar" class="form-select">
                                    <option value="">-- Pilih Bulan --</option>
                                    @foreach($bulanList as $bln)
                                        <option value="{{ $bln }}" {{ old('bulan_dibayar', $pembayaran->bulan_dibayar) == $bln ? 'selected' : '' }}>{{ $bln }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold small">Tahun Ajaran / Tahun (Opsional)</label>
                                <input type="text" name="tahun_dibayar" value="{{ old('tahun_dibayar', $pembayaran->tahun_dibayar) }}"
                                    class="form-control" placeholder="Contoh: 2026 atau 2026/2027">
                            </div>

                            <!-- Tanggal Pembayaran -->
                            <div class="col-md-4">
                                <label class="form-label fw-semibold small">Tanggal Pembayaran <span class="text-danger">*</span></label>
                                <input type="date" name="tanggal_pembayaran" value="{{ old('tanggal_pembayaran', $pembayaran->tanggal_pembayaran->format('Y-m-d')) }}" required
                                    class="form-control @error('tanggal_pembayaran') is-invalid @enderror">
                                @error('tanggal_pembayaran')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Metode Pembayaran -->
                            <div class="col-md-4">
                                <label class="form-label fw-semibold small">Metode Pembayaran <span class="text-danger">*</span></label>
                                <select name="metode_pembayaran" class="form-select @error('metode_pembayaran') is-invalid @enderror" required>
                                    <option value="Tunai" {{ old('metode_pembayaran', $pembayaran->metode_pembayaran) == 'Tunai' ? 'selected' : '' }}>Tunai / Cash Langsung</option>
                                    <option value="Transfer Bank" {{ old('metode_pembayaran', $pembayaran->metode_pembayaran) == 'Transfer Bank' ? 'selected' : '' }}>Transfer Bank</option>
                                    <option value="QRIS" {{ old('metode_pembayaran', $pembayaran->metode_pembayaran) == 'QRIS' ? 'selected' : '' }}>QRIS / Dompet Digital</option>
                                </select>
                            </div>

                            <!-- Status Pembayaran -->
                            <div class="col-md-4">
                                <label class="form-label fw-semibold small">Status Pembayaran <span class="text-danger">*</span></label>
                                <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                                    <option value="Lunas" {{ old('status', $pembayaran->status) == 'Lunas' ? 'selected' : '' }}>Lunas (Diterima)</option>
                                    <option value="Pending" {{ old('status', $pembayaran->status) == 'Pending' ? 'selected' : '' }}>Pending (Menunggu Verifikasi)</option>
                                    <option value="Batal" {{ old('status', $pembayaran->status) == 'Batal' ? 'selected' : '' }}>Batal</option>
                                </select>
                            </div>

                            <!-- Upload Bukti Bayar Baru -->
                            <div class="col-12">
                                <label class="form-label fw-semibold small">Ganti Bukti Bayar / Slip Transfer (Opsional)</label>
                                <input type="file" name="bukti_bayar" class="form-control @error('bukti_bayar') is-invalid @enderror"
                                    accept=".jpg,.jpeg,.png,.webp,.pdf">
                                @if($pembayaran->bukti_bayar)
                                    <div class="mt-2 small text-muted">
                                        <i class="bi bi-paperclip me-1"></i> File saat ini:
                                        <a href="{{ asset($pembayaran->bukti_bayar) }}" target="_blank" class="fw-semibold text-primary">Lihat Bukti Bayar Saat Ini</a>
                                    </div>
                                @endif
                                @error('bukti_bayar')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Catatan / Keterangan -->
                            <div class="col-12">
                                <label class="form-label fw-semibold small">Catatan / Keterangan Tambahan (Opsional)</label>
                                <textarea name="catatan" rows="3" class="form-control">{{ old('catatan', $pembayaran->catatan) }}</textarea>
                            </div>
                        </div>

                        <div class="mt-4 pt-3 border-top d-flex justify-content-end gap-2">
                            <a href="{{ route('pembayaran.show', $pembayaran->id) }}" class="btn btn-secondary">Batal</a>
                            <button type="submit" class="btn btn-primary px-4 shadow-sm">
                                <i class="bi bi-check2-circle me-1"></i> Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
