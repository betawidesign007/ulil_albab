<?php

namespace Tests\Feature;

use App\Models\Kegiatan;
use App\Models\PpdbSetting;
use App\Models\User;
use App\Models\Video;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class UploadMediaTest extends TestCase
{
    use RefreshDatabase;

    private function getAdminUser(): User
    {
        return User::factory()->create([
            'role' => 'admin',
        ]);
    }

    /**
     * Test admin dapat upload logo institusi di pengaturan PPDB
     */
    public function test_admin_can_upload_logo(): void
    {
        Storage::fake('public');
        $admin = $this->getAdminUser();
        $setting = PpdbSetting::getActive();

        $logoFile = UploadedFile::fake()->create('custom_logo.png', 500, 'image/png');

        $response = $this->actingAs($admin)->put(route('admin.ppdb.update'), [
            'nama_pesantren' => 'Pondok Pesantren Li Ulil Albab',
            'tagline_pesantren' => 'Mencetak Generasi Qur\'ani',
            'telepon' => '087799107735',
            'email' => 'ppdb@ulilalbab.ac.id',
            'alamat' => 'Jl. Pesantren No. 1',
            'status_ppdb' => 'buka',
            'tahun_ajaran' => '2026/2027',
            'gelombang_aktif' => 'Gelombang 1',
            'kuota_penerimaan' => 120,
            'biaya_pendaftaran' => '250.000',
            'tanggal_buka_pendaftaran' => '01 Januari 2026',
            'tanggal_tutup_pendaftaran' => '30 Mei 2026',
            'tanggal_ujian_seleksi' => '13 Juni 2026',
            'tanggal_pengumuman' => '20 Juni 2026',
            'tanggal_daftar_ulang' => '25 Juni - 05 Juli 2026',
            'jam_ujian' => '08.00 WIB',
            'lokasi_ujian' => 'Gedung Rektorat',
            'logo_file' => $logoFile,
        ]);

        $response->assertRedirect(route('admin.ppdb.index'));
        $response->assertSessionHas('success');

        $setting->refresh();
        $this->assertNotNull($setting->logo);
        $this->assertStringContainsString('logo_pesantren_', $setting->logo);
        $this->assertFileExists(public_path('images/'.$setting->logo));

        // Bersihkan file yang di-generate dari tes
        @unlink(public_path('images/'.$setting->logo));
    }

    /**
     * Test admin dapat upload foto dokumentasi kegiatan
     */
    public function test_admin_can_upload_kegiatan_photo(): void
    {
        Storage::fake('public');
        $admin = $this->getAdminUser();

        $photoFile = UploadedFile::fake()->create('haflah_santri.webp', 1200, 'image/webp');

        $response = $this->actingAs($admin)->post(route('kegiatan.store'), [
            'judul' => 'Haflah Khotmil Qur\'an 30 Juz',
            'kategori' => 'tahfidz',
            'tanggal' => '2026-06-15',
            'lokasi' => 'Masjid Li Ulil Albab',
            'gambar_file' => $photoFile,
            'deskripsi' => 'Ujian terbuka hafalan 30 juz sekali duduk.',
        ]);

        $response->assertRedirect(route('kegiatan.index'));
        $response->assertSessionHas('success');

        $kegiatan = Kegiatan::where('judul', 'Haflah Khotmil Qur\'an 30 Juz')->first();
        $this->assertNotNull($kegiatan);
        $this->assertStringStartsWith('kegiatan/', $kegiatan->gambar);
        $this->assertFileExists(public_path('images/'.$kegiatan->gambar));

        // Bersihkan
        @unlink(public_path('images/'.$kegiatan->gambar));
    }

    /**
     * Test admin dapat upload file video langsung
     */
    public function test_admin_can_upload_video_file(): void
    {
        Storage::fake('public');
        $admin = $this->getAdminUser();

        $videoFile = UploadedFile::fake()->create('profil_santri.mp4', 5000, 'video/mp4');

        $response = $this->actingAs($admin)->post(route('video.store'), [
            'judul' => 'Profil Singkat Li Ulil Albab',
            'kategori' => 'Profil Lembaga',
            'video_file' => $videoFile,
            'durasi' => '05:30',
            'deskripsi' => 'Video profil sarana dan prasarana pondok.',
            'is_hero_slider' => 1,
            'is_featured' => 1,
            'urutan' => 1,
        ]);

        $response->assertRedirect(route('video.index'));
        $response->assertSessionHas('success');

        $video = Video::where('judul', 'Profil Singkat Li Ulil Albab')->first();
        $this->assertNotNull($video);
        $this->assertNotNull($video->video_file);
        $this->assertTrue($video->is_local_video);
        $this->assertFileExists(public_path('videos/'.$video->video_file));

        // Bersihkan
        @unlink(public_path('videos/'.$video->video_file));
    }
}
