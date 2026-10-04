<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

class VideoController extends Controller
{
    /**
     * Tampilkan daftar video kegiatan
     */
    public function index()
    {
        $videos = Video::orderBy('is_hero_slider', 'desc')
            ->orderBy('urutan')
            ->orderBy('id', 'desc')
            ->paginate(12);

        $heroCount = Video::where('is_hero_slider', true)->count();

        return view('admin.video.index', compact('videos', 'heroCount'));
    }

    /**
     * Form tambah video
     */
    public function create()
    {
        $heroCount = Video::where('is_hero_slider', true)->count();

        return view('admin.video.create', compact('heroCount'));
    }

    /**
     * Simpan video baru
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'kategori' => 'required|string|max:100',
            'youtube_url' => 'nullable|string|max:255',
            'video_file' => [
                'nullable',
                'file',
                'max:102400',
                function ($attribute, $value, $fail) {
                    if ($value instanceof UploadedFile) {
                        $allowed = ['mp4', 'webm', 'ogg', 'mov', 'mkv', 'avi', 'wmv', '3gp', 'm4v'];
                        $ext = strtolower($value->getClientOriginalExtension());
                        if (! in_array($ext, $allowed)) {
                            $fail('Format file video harus berupa: MP4, WebM, MOV, MKV, OGG, AVI.');
                        }
                    }
                },
            ],
            'thumbnail_file' => [
                'nullable',
                'file',
                'max:20480',
                function ($attribute, $value, $fail) {
                    if ($value instanceof UploadedFile) {
                        $allowed = ['jpg', 'jpeg', 'png', 'webp', 'gif', 'bmp', 'jfif', 'avif'];
                        $ext = strtolower($value->getClientOriginalExtension());
                        if (! in_array($ext, $allowed)) {
                            $fail('Format file thumbnail harus berupa gambar: JPG, PNG, WEBP, GIF, BMP.');
                        }
                    }
                },
            ],
            'durasi' => 'nullable|string|max:20',
            'thumbnail' => 'nullable|url|max:1000',
            'deskripsi' => 'nullable|string',
            'is_hero_slider' => 'nullable|boolean',
            'is_featured' => 'nullable|boolean',
            'urutan' => 'nullable|integer',
        ], [
            'video_file.uploaded' => 'File video gagal diproses oleh server PHP. Pastikan terminal "php artisan serve" telah direstart untuk memuat direktori temporary baru.',
            'thumbnail_file.uploaded' => 'File thumbnail gagal diproses oleh server PHP.',
            'video_file.max' => 'Ukuran file video maksimal adalah 100 MB.',
            'thumbnail_file.max' => 'Ukuran gambar thumbnail maksimal adalah 20 MB.',
        ]);

        if (empty($validated['youtube_url']) && ! $request->hasFile('video_file')) {
            return back()->withErrors(['video_file' => 'Mohon pilih file video untuk diunggah ATAU masukkan tautan video YouTube.'])->withInput();
        }

        $youtubeId = ! empty($validated['youtube_url']) ? Video::extractYoutubeId($validated['youtube_url']) : null;
        $videoFilename = null;

        if ($request->hasFile('video_file')) {
            $file = $request->file('video_file');
            $ext = strtolower($file->getClientOriginalExtension() ?: 'mp4');
            $videoFilename = 'video_'.time().'_'.bin2hex(random_bytes(4)).'.'.$ext;

            if (! file_exists(public_path('videos'))) {
                mkdir(public_path('videos'), 0755, true);
            }
            $file->move(public_path('videos'), $videoFilename);

            if (! file_exists(storage_path('app/public/videos'))) {
                mkdir(storage_path('app/public/videos'), 0755, true);
            }
            @copy(public_path('videos/'.$videoFilename), storage_path('app/public/videos/'.$videoFilename));
        }

        $thumbnailPath = $validated['thumbnail'] ?? null;
        if ($request->hasFile('thumbnail_file')) {
            $thumb = $request->file('thumbnail_file');
            $tExt = strtolower($thumb->getClientOriginalExtension() ?: 'jpg');
            $thumbName = 'thumb_'.time().'_'.bin2hex(random_bytes(4)).'.'.$tExt;
            if (! file_exists(public_path('images/thumbnails'))) {
                mkdir(public_path('images/thumbnails'), 0755, true);
            }
            $thumb->move(public_path('images/thumbnails'), $thumbName);
            $thumbnailPath = 'thumbnails/'.$thumbName;
        }

        $isHeroSlider = $request->boolean('is_hero_slider');
        $isFeatured = $request->boolean('is_featured');

        if ($isFeatured) {
            Video::where('is_featured', true)->update(['is_featured' => false]);
        }

        Video::create([
            'judul' => $validated['judul'],
            'kategori' => $validated['kategori'],
            'youtube_id' => $youtubeId,
            'video_file' => $videoFilename,
            'durasi' => $validated['durasi'] ?? '10:00',
            'thumbnail' => $thumbnailPath,
            'deskripsi' => $validated['deskripsi'] ?? null,
            'is_hero_slider' => $isHeroSlider,
            'is_featured' => $isFeatured,
            'urutan' => $validated['urutan'] ?? 0,
        ]);

        return redirect()->route('video.index')
            ->with('success', 'Video kegiatan berhasil ditambahkan.');
    }

    /**
     * Form edit video
     */
    public function edit(Video $video)
    {
        $heroCount = Video::where('is_hero_slider', true)->count();

        return view('admin.video.edit', compact('video', 'heroCount'));
    }

    /**
     * Update data video
     */
    public function update(Request $request, Video $video)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'kategori' => 'required|string|max:100',
            'youtube_url' => 'nullable|string|max:255',
            'video_file' => [
                'nullable',
                'file',
                'max:102400',
                function ($attribute, $value, $fail) {
                    if ($value instanceof UploadedFile) {
                        $allowed = ['mp4', 'webm', 'ogg', 'mov', 'mkv', 'avi', 'wmv', '3gp', 'm4v'];
                        $ext = strtolower($value->getClientOriginalExtension());
                        if (! in_array($ext, $allowed)) {
                            $fail('Format file video harus berupa: MP4, WebM, MOV, MKV, OGG, AVI.');
                        }
                    }
                },
            ],
            'thumbnail_file' => [
                'nullable',
                'file',
                'max:20480',
                function ($attribute, $value, $fail) {
                    if ($value instanceof UploadedFile) {
                        $allowed = ['jpg', 'jpeg', 'png', 'webp', 'gif', 'bmp', 'jfif', 'avif'];
                        $ext = strtolower($value->getClientOriginalExtension());
                        if (! in_array($ext, $allowed)) {
                            $fail('Format file thumbnail harus berupa gambar: JPG, PNG, WEBP, GIF, BMP.');
                        }
                    }
                },
            ],
            'durasi' => 'nullable|string|max:20',
            'thumbnail' => 'nullable|url|max:1000',
            'deskripsi' => 'nullable|string',
            'is_hero_slider' => 'nullable|boolean',
            'is_featured' => 'nullable|boolean',
            'urutan' => 'nullable|integer',
        ], [
            'video_file.uploaded' => 'File video gagal diproses oleh server PHP. Pastikan terminal "php artisan serve" telah direstart untuk memuat direktori temporary baru.',
            'thumbnail_file.uploaded' => 'File thumbnail gagal diproses oleh server PHP.',
            'video_file.max' => 'Ukuran file video maksimal adalah 100 MB.',
            'thumbnail_file.max' => 'Ukuran gambar thumbnail maksimal adalah 20 MB.',
        ]);

        $youtubeId = ! empty($validated['youtube_url']) ? Video::extractYoutubeId($validated['youtube_url']) : $video->youtube_id;
        $videoFilename = $video->video_file;

        if ($request->hasFile('video_file')) {
            if ($video->video_file && file_exists(public_path('videos/'.$video->video_file))) {
                @unlink(public_path('videos/'.$video->video_file));
            }

            $file = $request->file('video_file');
            $ext = strtolower($file->getClientOriginalExtension() ?: 'mp4');
            $videoFilename = 'video_'.time().'_'.bin2hex(random_bytes(4)).'.'.$ext;

            if (! file_exists(public_path('videos'))) {
                mkdir(public_path('videos'), 0755, true);
            }
            $file->move(public_path('videos'), $videoFilename);

            if (! file_exists(storage_path('app/public/videos'))) {
                mkdir(storage_path('app/public/videos'), 0755, true);
            }
            @copy(public_path('videos/'.$videoFilename), storage_path('app/public/videos/'.$videoFilename));
        }

        $thumbnailPath = $video->thumbnail;
        if ($request->hasFile('thumbnail_file')) {
            $thumb = $request->file('thumbnail_file');
            $tExt = strtolower($thumb->getClientOriginalExtension() ?: 'jpg');
            $thumbName = 'thumb_'.time().'_'.bin2hex(random_bytes(4)).'.'.$tExt;
            if (! file_exists(public_path('images/thumbnails'))) {
                mkdir(public_path('images/thumbnails'), 0755, true);
            }
            $thumb->move(public_path('images/thumbnails'), $thumbName);
            $thumbnailPath = 'thumbnails/'.$thumbName;
        } elseif (! empty($validated['thumbnail'])) {
            $thumbnailPath = $validated['thumbnail'];
        }

        $isHeroSlider = $request->boolean('is_hero_slider');
        $isFeatured = $request->boolean('is_featured');

        if ($isFeatured) {
            Video::where('id', '!=', $video->id)->where('is_featured', true)->update(['is_featured' => false]);
        }

        $video->update([
            'judul' => $validated['judul'],
            'kategori' => $validated['kategori'],
            'youtube_id' => $youtubeId,
            'video_file' => $videoFilename,
            'durasi' => $validated['durasi'] ?? $video->durasi,
            'thumbnail' => $thumbnailPath,
            'deskripsi' => $validated['deskripsi'] ?? null,
            'is_hero_slider' => $isHeroSlider,
            'is_featured' => $isFeatured,
            'urutan' => $validated['urutan'] ?? 0,
        ]);

        return redirect()->route('video.index')
            ->with('success', 'Video kegiatan berhasil diperbarui.');
    }

    /**
     * Hapus video
     */
    public function destroy(Video $video)
    {
        if ($video->video_file && file_exists(public_path('videos/'.$video->video_file))) {
            @unlink(public_path('videos/'.$video->video_file));
        }

        $video->delete();

        return redirect()->route('video.index')
            ->with('success', 'Video kegiatan berhasil dihapus.');
    }
}
