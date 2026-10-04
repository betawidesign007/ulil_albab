<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kegiatan;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class KegiatanController extends Controller
{
    /**
     * Tampilkan daftar dokumentasi kegiatan
     */
    public function index()
    {
        $kegiatans = Kegiatan::orderBy('tanggal', 'desc')->paginate(12);

        return view('admin.kegiatan.index', compact('kegiatans'));
    }

    /**
     * Form tambah kegiatan
     */
    public function create()
    {
        return view('admin.kegiatan.create');
    }

    /**
     * Simpan kegiatan baru
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'kategori' => 'required|string|in:tahfidz,phbi,ekskul,sosial,umum',
            'tanggal' => 'required|date',
            'lokasi' => 'required|string|max:255',
            'gambar_url' => 'nullable|url|max:1000',
            'gambar_file' => [
                'nullable',
                'file',
                'max:51200',
                function ($attribute, $value, $fail) {
                    if ($value instanceof UploadedFile) {
                        $allowed = ['jpg', 'jpeg', 'png', 'webp', 'gif', 'svg', 'bmp', 'jfif', 'avif', 'heic', 'heif'];
                        $ext = strtolower($value->getClientOriginalExtension());
                        if (! in_array($ext, $allowed)) {
                            $fail('Format file gambar harus berupa: JPG, JPEG, PNG, WEBP, GIF, SVG, BMP, AVIF, HEIC.');
                        }
                    }
                },
            ],
            'deskripsi' => 'required|string',
        ], [
            'gambar_file.uploaded' => 'File gambar gagal diproses oleh server PHP. Pastikan terminal "php artisan serve" telah direstart untuk memuat direktori temporary baru.',
            'gambar_file.max' => 'Ukuran gambar maksimal adalah 50 MB.',
        ]);

        $gambarPath = 'https://images.unsplash.com/photo-1542838132-92c53300491e?auto=format&fit=crop&w=800&q=80';

        if ($request->hasFile('gambar_file')) {
            $file = $request->file('gambar_file');
            $extension = strtolower($file->getClientOriginalExtension() ?: 'jpg');
            $filename = 'kegiatan_'.time().'_'.bin2hex(random_bytes(4)).'.'.$extension;

            // Simpan ke public/images/kegiatan
            if (! file_exists(public_path('images/kegiatan'))) {
                mkdir(public_path('images/kegiatan'), 0755, true);
            }
            $file->move(public_path('images/kegiatan'), $filename);

            // Salin juga ke storage/app/public/kegiatan agar sinkron
            if (! file_exists(storage_path('app/public/kegiatan'))) {
                mkdir(storage_path('app/public/kegiatan'), 0755, true);
            }
            @copy(public_path('images/kegiatan/'.$filename), storage_path('app/public/kegiatan/'.$filename));

            $gambarPath = 'kegiatan/'.$filename;
        } elseif (! empty($validated['gambar_url'])) {
            $gambarPath = $validated['gambar_url'];
        }

        Kegiatan::create([
            'judul' => $validated['judul'],
            'kategori' => $validated['kategori'],
            'tanggal' => $validated['tanggal'],
            'lokasi' => $validated['lokasi'],
            'gambar' => $gambarPath,
            'deskripsi' => $validated['deskripsi'],
        ]);

        return redirect()->route('kegiatan.index')
            ->with('success', 'Dokumentasi kegiatan berhasil ditambahkan ke galeri.');
    }

    /**
     * Form edit kegiatan
     */
    public function edit(Kegiatan $kegiatan)
    {
        return view('admin.kegiatan.edit', compact('kegiatan'));
    }

    /**
     * Update data kegiatan
     */
    public function update(Request $request, Kegiatan $kegiatan)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'kategori' => 'required|string|in:tahfidz,phbi,ekskul,sosial,umum',
            'tanggal' => 'required|date',
            'lokasi' => 'required|string|max:255',
            'gambar_url' => 'nullable|url|max:1000',
            'gambar_file' => [
                'nullable',
                'file',
                'max:51200',
                function ($attribute, $value, $fail) {
                    if ($value instanceof UploadedFile) {
                        $allowed = ['jpg', 'jpeg', 'png', 'webp', 'gif', 'svg', 'bmp', 'jfif', 'avif', 'heic', 'heif'];
                        $ext = strtolower($value->getClientOriginalExtension());
                        if (! in_array($ext, $allowed)) {
                            $fail('Format file gambar harus berupa: JPG, JPEG, PNG, WEBP, GIF, SVG, BMP, AVIF, HEIC.');
                        }
                    }
                },
            ],
            'deskripsi' => 'required|string',
        ], [
            'gambar_file.uploaded' => 'File gambar gagal diproses oleh server PHP. Pastikan terminal "php artisan serve" telah direstart untuk memuat direktori temporary baru.',
            'gambar_file.max' => 'Ukuran gambar maksimal adalah 50 MB.',
        ]);

        $gambarPath = $kegiatan->gambar;

        if ($request->hasFile('gambar_file')) {
            // Hapus file lama jika bukan link external
            if (! str_starts_with($kegiatan->gambar, 'http')) {
                if (file_exists(public_path('images/'.$kegiatan->gambar))) {
                    @unlink(public_path('images/'.$kegiatan->gambar));
                }
                if (Storage::disk('public')->exists($kegiatan->gambar)) {
                    Storage::disk('public')->delete($kegiatan->gambar);
                }
            }

            $file = $request->file('gambar_file');
            $extension = strtolower($file->getClientOriginalExtension() ?: 'jpg');
            $filename = 'kegiatan_'.time().'_'.bin2hex(random_bytes(4)).'.'.$extension;

            if (! file_exists(public_path('images/kegiatan'))) {
                mkdir(public_path('images/kegiatan'), 0755, true);
            }
            $file->move(public_path('images/kegiatan'), $filename);

            if (! file_exists(storage_path('app/public/kegiatan'))) {
                mkdir(storage_path('app/public/kegiatan'), 0755, true);
            }
            @copy(public_path('images/kegiatan/'.$filename), storage_path('app/public/kegiatan/'.$filename));

            $gambarPath = 'kegiatan/'.$filename;
        } elseif (! empty($validated['gambar_url'])) {
            $gambarPath = $validated['gambar_url'];
        }

        $kegiatan->update([
            'judul' => $validated['judul'],
            'kategori' => $validated['kategori'],
            'tanggal' => $validated['tanggal'],
            'lokasi' => $validated['lokasi'],
            'gambar' => $gambarPath,
            'deskripsi' => $validated['deskripsi'],
        ]);

        return redirect()->route('kegiatan.index')
            ->with('success', 'Dokumentasi kegiatan berhasil diperbarui.');
    }

    /**
     * Hapus kegiatan
     */
    public function destroy(Kegiatan $kegiatan)
    {
        if (! str_starts_with($kegiatan->gambar, 'http') && Storage::disk('public')->exists($kegiatan->gambar)) {
            Storage::disk('public')->delete($kegiatan->gambar);
        }

        $kegiatan->delete();

        return redirect()->route('kegiatan.index')
            ->with('success', 'Dokumentasi kegiatan berhasil dihapus dari galeri.');
    }
}
