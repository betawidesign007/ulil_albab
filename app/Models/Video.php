<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Video extends Model
{
    protected $fillable = [
        'judul',
        'kategori',
        'youtube_id',
        'video_file',
        'durasi',
        'thumbnail',
        'deskripsi',
        'is_hero_slider',
        'is_featured',
        'urutan',
    ];

    protected function casts(): array
    {
        return [
            'is_hero_slider' => 'boolean',
            'is_featured' => 'boolean',
            'urutan' => 'integer',
        ];
    }

    /**
     * URL File Video Lokal
     */
    public function getVideoUrlAttribute(): ?string
    {
        if ($this->video_file) {
            if (file_exists(public_path('videos/'.$this->video_file))) {
                return asset('videos/'.$this->video_file);
            }
            if (file_exists(public_path('storage/videos/'.$this->video_file))) {
                return asset('storage/videos/'.$this->video_file);
            }

            return asset('videos/'.$this->video_file);
        }

        return null;
    }

    /**
     * Apakah Video Berupa File Lokal yang Diunggah
     */
    public function getIsLocalVideoAttribute(): bool
    {
        return ! empty($this->video_file);
    }

    /**
     * URL Thumbnail Video (Custom URL, File Storage, atau Otomatis dari YouTube)
     */
    public function getThumbnailUrlAttribute(): string
    {
        if (! empty($this->thumbnail)) {
            if (Str::startsWith($this->thumbnail, ['http://', 'https://'])) {
                return $this->thumbnail;
            }

            if (file_exists(public_path('images/'.$this->thumbnail))) {
                return asset('images/'.$this->thumbnail);
            }

            return asset('storage/'.$this->thumbnail);
        }

        if ($this->youtube_id) {
            return 'https://img.youtube.com/vi/'.$this->youtube_id.'/hqdefault.jpg';
        }

        return 'https://images.unsplash.com/photo-1542838132-92c53300491e?auto=format&fit=crop&w=800&q=80';
    }

    /**
     * URL Embed / Sumber Putar Video
     */
    public function getEmbedUrlAttribute(): string
    {
        if ($this->is_local_video) {
            return $this->video_url ?? '';
        }

        return 'https://www.youtube-nocookie.com/embed/'.$this->youtube_id;
    }

    /**
     * Helper statis untuk mengekstrak YouTube ID dari berbagai format link YouTube
     */
    public static function extractYoutubeId(string $urlOrId): string
    {
        $input = trim($urlOrId);

        // Jika hanya 11 karakter alfanumerik biasa (YouTube ID)
        if (preg_match('/^[a-zA-Z0-9_-]{11}$/', $input)) {
            return $input;
        }

        // Format: https://www.youtube.com/watch?v=ID
        if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $input, $match)) {
            return $match[1];
        }

        return $input;
    }
}
