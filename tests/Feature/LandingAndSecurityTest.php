<?php

namespace Tests\Feature;

use App\Models\Kegiatan;
use App\Models\Santri;
use App\Models\User;
use App\Models\Video;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LandingAndSecurityTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Uji bahwa publik/tamu tidak dapat langsung masuk ke dashboard atau halaman admin
     */
    public function test_guest_cannot_access_protected_admin_pages(): void
    {
        // 1. Dashboard
        $response = $this->get('/dashboard');
        $response->assertRedirect('/login');

        // 2. Data Santri
        $response = $this->get('/santri');
        $response->assertRedirect('/login');

        // 3. Manajemen Users
        $response = $this->get('/users');
        $response->assertRedirect('/login');

        // 4. Manajemen Galeri Kegiatan
        $response = $this->get('/kegiatan');
        $response->assertRedirect('/login');

        // 5. Manajemen Video
        $response = $this->get('/video');
        $response->assertRedirect('/login');
    }

    /**
     * Uji bahwa landing page dapat diakses publik dengan konten dinamis
     */
    public function test_landing_page_renders_with_dynamic_data(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Slide Show 4 Video Unggulan Santri');
        $response->assertSee('Santri Aktif Mukim');
        $response->assertSee('Dewan Asatidz');
        $response->assertSee('Santri Baru Terdaftar (PPDB)');
        $response->assertSee('Dokumentasi Kegiatan Pondok Pesantren');
        $response->assertSee('Video Kegiatan Santri');
    }

    /**
     * Uji pendaftaran PPDB online menyimpan data ke database secara dinamis
     */
    public function test_ppdb_registration_persists_to_database(): void
    {
        $payload = [
            'nama_lengkap' => 'Ahmad Fathan Mubarok',
            'jenis_kelamin' => 'Laki-laki',
            'tempat_lahir' => 'Bandung',
            'tanggal_lahir' => '2012-04-15',
            'nisn' => '1234567890',
            'asal_sekolah' => 'SD Islam Al-Azhar',
            'jenjang' => 'Madrasah Tsanawiyah (MTs Terpadu)',
            'nama_wali' => 'H. Hendra Wijaya',
            'no_wa' => '081234567899',
            'alamat' => 'Jl. Merdeka No. 45, Bandung',
            'jalur' => 'Prestasi Tahfidz',
            'model_ujian' => 'Tatap Muka di Pesantren',
        ];

        $response = $this->postJson('/ppdb/daftar', $payload);

        $response->assertStatus(200);
        $response->assertJsonPath('success', true);
        $response->assertJsonPath('data.nama_lengkap', 'Ahmad Fathan Mubarok');

        $this->assertDatabaseHas('ppdb_registrations', [
            'nama_lengkap' => 'Ahmad Fathan Mubarok',
            'nama_wali' => 'H. Hendra Wijaya',
            'jalur' => 'Prestasi Tahfidz',
        ]);
    }

    /**
     * Uji admin dapat mengelola video dan galeri kegiatan
     */
    public function test_admin_can_manage_videos_and_kegiatan(): void
    {
        $admin = User::firstOrCreate(
            ['email' => 'admin_test@simponpes.test'],
            [
                'name' => 'Admin Test',
                'password' => bcrypt('password'),
                'role' => 'admin',
            ]
        );

        // Admin tambah video baru
        $videoResponse = $this->actingAs($admin)->post('/video', [
            'judul' => 'Ujian Terbuka Tahfidz Santri Putri 2026',
            'kategori' => 'Tahfidz',
            'youtube_url' => 'https://www.youtube.com/watch?v=fD3_P_V0Q3Y',
            'durasi' => '12:30',
            'is_hero_slider' => 1,
            'is_featured' => 0,
            'urutan' => 1,
        ]);

        $videoResponse->assertRedirect('/video');
        $this->assertDatabaseHas('videos', [
            'judul' => 'Ujian Terbuka Tahfidz Santri Putri 2026',
            'youtube_id' => 'fD3_P_V0Q3Y',
            'is_hero_slider' => 1,
        ]);

        // Admin tambah kegiatan foto baru
        $kegiatanResponse = $this->actingAs($admin)->post('/kegiatan', [
            'judul' => 'Pawai Obor Tahun Baru Hijriyah',
            'kategori' => 'phbi',
            'tanggal' => '2026-07-15',
            'lokasi' => 'Area Pesantren & Sekitar',
            'gambar_url' => 'https://images.unsplash.com/photo-1564769625905-50e93615e769',
            'deskripsi' => 'Pawai obor menyambut pergantian tahun baru Islam bersama ribuan santri dan warga.',
        ]);

        $kegiatanResponse->assertRedirect('/kegiatan');
        $this->assertDatabaseHas('kegiatans', [
            'judul' => 'Pawai Obor Tahun Baru Hijriyah',
            'kategori' => 'phbi',
        ]);
    }
}
