<?php

namespace Tests\Feature;

use App\Models\JadwalPelajaran;
use App\Models\PpdbSetting;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class PpdbAndJadwalTest extends TestCase
{
    use RefreshDatabase;

    protected User $admin;

    protected User $pengajar;

    protected User $pemilik;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = User::create([
            'name' => 'Admin Test',
            'email' => 'admin_test@ulilalbab.test',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        $this->pengajar = User::create([
            'name' => 'Ustadz Pengajar Test',
            'email' => 'pengajar_test@ulilalbab.test',
            'password' => bcrypt('password'),
            'role' => 'pengajar',
        ]);

        $this->pemilik = User::create([
            'name' => 'Mudir Pemilik Test',
            'email' => 'pemilik_test@ulilalbab.test',
            'password' => bcrypt('password'),
            'role' => 'pemilik',
        ]);
    }

    /**
     * Uji bahwa tamu tidak dapat mengakses halaman manajemen jadwal dan pengaturan PPDB
     */
    public function test_guest_cannot_access_jadwal_and_ppdb_admin(): void
    {
        $this->get('/jadwal')->assertRedirect('/login');
        $this->get('/admin/ppdb-setting')->assertRedirect('/login');
        $this->get('/jadwal-tambah/baru')->assertRedirect('/login');
    }

    /**
     * Uji Admin dapat mengubah pengaturan PPDB & informasi website dan langsung tampil di landing page
     */
    public function test_admin_can_update_ppdb_settings_and_reflects_on_landing_page(): void
    {
        $payload = [
            'nama_pesantren' => 'Pesantren Modern Li Ulil Albab Mandiri',
            'tagline_pesantren' => 'Mencetak Ulama Intelektual Berwawasan Qurani',
            'telepon' => '087799107735',
            'email' => 'panitia.ppdb@ulilalbab.ac.id',
            'alamat' => 'Kompleks Islamic Center Li Ulil Albab No. 99',
            'status_ppdb' => 'buka',
            'tahun_ajaran' => '2027/2028',
            'gelombang_aktif' => 'Gelombang II Khusus Beasiswa Tahfidz',
            'kuota_penerimaan' => 450,
            'biaya_pendaftaran' => '300.000',
            'tanggal_buka_pendaftaran' => '01 Maret 2027',
            'tanggal_tutup_pendaftaran' => '30 Juli 2027',
            'tanggal_ujian_seleksi' => 'Sabtu, 08 Agustus 2027',
            'tanggal_pengumuman' => '15 Agustus 2027',
            'tanggal_daftar_ulang' => '20 - 25 Agustus 2027',
            'jam_ujian' => '08.30 - 12.00 WIB',
            'lokasi_ujian' => 'Auditorium Utama & Online Zoom',
            'persyaratan_santri' => "Muslim berakhlaq mulia\nLulus SD/MI atau SMP/MTs sederajat",
            'berkas_wajib' => "Cetak Kartu Ujian PPDB\nFotokopi Akta & Kartu Keluarga",
            'pengumuman_banner' => 'Pendaftaran Gelombang 2 Resmi Dibuka dengan Beasiswa Penuh Tahfidz!',
        ];

        $response = $this->actingAs($this->admin)->put('/admin/ppdb-setting', $payload);

        $response->assertRedirect('/admin/ppdb-setting');
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('ppdb_settings', [
            'nama_pesantren' => 'Pesantren Modern Li Ulil Albab Mandiri',
            'tahun_ajaran' => '2027/2028',
            'gelombang_aktif' => 'Gelombang II Khusus Beasiswa Tahfidz',
            'kuota_penerimaan' => 450,
        ]);

        // Cek halaman utama website menampilkan data yang baru diubah
        $landingResponse = $this->get('/');
        $landingResponse->assertStatus(200);
        $landingResponse->assertSee('Pesantren Modern Li Ulil Albab Mandiri');
        $landingResponse->assertSee('2027/2028');
        $landingResponse->assertSee('Gelombang II Khusus Beasiswa Tahfidz');
        $landingResponse->assertSee('Pendaftaran Gelombang 2 Resmi Dibuka dengan Beasiswa Penuh Tahfidz!');
        $landingResponse->assertSee('Auditorium Utama &amp; Online Zoom', false);
    }

    /**
     * Uji Admin dapat mengunggah file logo baru dan tampil di website
     */
    public function test_admin_can_upload_and_change_pesantren_logo(): void
    {
        $file = UploadedFile::fake()->image('logo_lembaga_test.png', 200, 200);

        $payload = [
            'nama_pesantren' => 'Pondok Pesantren Li Ulil Albab',
            'tagline_pesantren' => 'Pendidikan Islam Modern',
            'telepon' => '087799107735',
            'email' => 'ppdb@ulilalbab.ac.id',
            'alamat' => 'Jl. Pesantren Modern No. 99',
            'status_ppdb' => 'buka',
            'tahun_ajaran' => '2026/2027',
            'gelombang_aktif' => 'Gelombang I',
            'kuota_penerimaan' => 350,
            'biaya_pendaftaran' => 'Rp 250.000',
            'tanggal_buka_pendaftaran' => '01 Januari 2026',
            'tanggal_tutup_pendaftaran' => '30 Mei 2026',
            'tanggal_ujian_seleksi' => '13 Juni 2026',
            'tanggal_pengumuman' => '20 Juni 2026',
            'tanggal_daftar_ulang' => '25 Juni 2026',
            'jam_ujian' => '08.00 WIB',
            'lokasi_ujian' => 'Gedung Rektorat',
            'logo_file' => $file,
        ];

        $response = $this->actingAs($this->admin)->put('/admin/ppdb-setting', $payload);

        $response->assertRedirect('/admin/ppdb-setting');
        $response->assertSessionHas('success');

        $setting = PpdbSetting::first();
        $this->assertNotNull($setting->logo);
        $this->assertFileExists(public_path('images/'.$setting->logo));

        // Bersihkan file test
        if (file_exists(public_path('images/'.$setting->logo))) {
            @unlink(public_path('images/'.$setting->logo));
        }
    }

    /**
     * Uji Admin dapat menambah jadwal pelajaran baru beserta konsep acuan kerja
     */
    public function test_admin_can_create_jadwal_pelajaran_with_acuan_kerja(): void
    {
        $payload = [
            'user_id' => $this->pengajar->id,
            'hari' => 'Senin',
            'jam_mulai' => '07:30',
            'jam_selesai' => '09:00',
            'mata_pelajaran' => 'Kajian Nahwu & Matan Al-Jurumiyyah',
            'kelas' => 'VII-A MTs',
            'ruangan' => 'Ruang Kelas Umar Lt. 2',
            'tahun_ajaran' => '2026/2027',
            'semester' => 'Ganjil',
            'kitab_referensi' => 'Matan Al-Jurumiyyah',
            'target_capaian' => 'Santri mampu membaca dan menguraikan Irob kalam dasar.',
            'metode_pembelajaran' => 'Sorogan Matan dan Latihan Bedah Ayat',
            'silabus_ringkas' => 'Pekan 1-4: Bab Kalam; Pekan 5-8: Bab Irob.',
        ];

        $response = $this->actingAs($this->admin)->post('/jadwal', $payload);

        $response->assertRedirect('/jadwal');
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('jadwal_pelajarans', [
            'mata_pelajaran' => 'Kajian Nahwu & Matan Al-Jurumiyyah',
            'kelas' => 'VII-A MTs',
            'kitab_referensi' => 'Matan Al-Jurumiyyah',
            'user_id' => $this->pengajar->id,
        ]);
    }

    /**
     * Uji Pengajar dapat mengontrol dan mengupdate jurnal capaian materi acuan kerja miliknya
     */
    public function test_pengajar_can_update_jurnal_acuan_kerja(): void
    {
        $jadwal = JadwalPelajaran::create([
            'user_id' => $this->pengajar->id,
            'hari' => 'Selasa',
            'jam_mulai' => '09:30',
            'jam_selesai' => '11:00',
            'mata_pelajaran' => 'Fikih Ibadah',
            'kelas' => 'VIII-B MTs',
            'ruangan' => 'Ruang 8B',
            'tahun_ajaran' => '2026/2027',
            'semester' => 'Ganjil',
            'status_pelaksanaan' => 'aktif',
            'status_verifikasi' => 'disetujui_mudir',
        ]);

        $response = $this->actingAs($this->pengajar)->post("/jadwal/{$jadwal->id}/jurnal", [
            'status_pelaksanaan' => 'tuntas',
            'jurnal_terakhir' => 'Pembahasan Bab Thaharah tuntas dipraktikkan oleh seluruh santri.',
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('success');

        $jadwal->refresh();
        $this->assertEquals('tuntas', $jadwal->status_pelaksanaan);
        $this->assertEquals('Pembahasan Bab Thaharah tuntas dipraktikkan oleh seluruh santri.', $jadwal->jurnal_terakhir);
        $this->assertEquals('menunggu_verifikasi', $jadwal->status_verifikasi);
    }

    /**
     * Uji Pemilik / Mudir dapat melakukan supervisi dan memverifikasi acuan kerja asatidz
     */
    public function test_pemilik_can_supervise_and_verify_acuan_kerja(): void
    {
        $jadwal = JadwalPelajaran::create([
            'user_id' => $this->pengajar->id,
            'hari' => 'Rabu',
            'jam_mulai' => '07:30',
            'jam_selesai' => '09:00',
            'mata_pelajaran' => 'Hadits Arba\'in An-Nawawiyyah',
            'kelas' => 'IX MTs',
            'ruangan' => 'Masjid Utama',
            'tahun_ajaran' => '2026/2027',
            'semester' => 'Ganjil',
            'status_pelaksanaan' => 'aktif',
            'status_verifikasi' => 'menunggu_verifikasi',
        ]);

        $response = $this->actingAs($this->pemilik)->post("/jadwal/{$jadwal->id}/supervisi", [
            'status_verifikasi' => 'disetujui_mudir',
            'catatan_supervisi' => 'Target hafalan hadits terlaksana sangat baik sesuai kurikulum pesantren.',
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('success');

        $jadwal->refresh();
        $this->assertEquals('disetujui_mudir', $jadwal->status_verifikasi);
        $this->assertEquals('Target hafalan hadits terlaksana sangat baik sesuai kurikulum pesantren.', $jadwal->catatan_supervisi);
        $this->assertEquals($this->pemilik->id, $jadwal->supervisi_by);
    }

    /**
     * Uji halaman cetak jadwal dapat diakses dan menampilkan data
     */
    public function test_jadwal_cetak_page_is_accessible(): void
    {
        $response = $this->actingAs($this->admin)->get('/jadwal/cetak');
        $response->assertStatus(200);
        $response->assertSee('MATRIKS JADWAL PELAJARAN &amp; KONSEP ACUAN KERJA ASATIDZ', false);
    }

    /**
     * Uji Pengajar & Admin dapat mengupdate dokumen target acuan kerja
     */
    public function test_pengajar_can_update_acuan_kerja(): void
    {
        $jadwal = JadwalPelajaran::create([
            'user_id' => $this->pengajar->id,
            'hari' => 'Kamis',
            'jam_mulai' => '07:30',
            'jam_selesai' => '09:00',
            'mata_pelajaran' => 'Fikih Ibadah',
            'kelas' => 'VIII MTs',
            'ruangan' => 'Kelas VIII-B',
            'tahun_ajaran' => '2026/2027',
            'semester' => 'Ganjil',
            'status_pelaksanaan' => 'aktif',
            'status_verifikasi' => 'menunggu_verifikasi',
        ]);

        $response = $this->actingAs($this->pengajar)->post("/jadwal/{$jadwal->id}/acuan", [
            'kitab_referensi' => 'Fathul Qarib Al-Mujib',
            'metode_pembelajaran' => 'Sorogan & Bandongan Interaktif',
            'target_capaian' => 'Santri mampu mempraktikkan wudhu, tayamum, dan shalat sesuai rukun madzhab Syafi\'i.',
            'silabus_ringkas' => 'Pekan 1-4 Thaharah, Pekan 5-8 Shalat Berjamaah.',
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('success');

        $jadwal->refresh();
        $this->assertEquals('Fathul Qarib Al-Mujib', $jadwal->kitab_referensi);
        $this->assertEquals('Santri mampu mempraktikkan wudhu, tayamum, dan shalat sesuai rukun madzhab Syafi\'i.', $jadwal->target_capaian);
    }

    /**
     * Uji Admin dapat mengelola pengguna: view JSON detail, update data pengguna, dan delete
     */
    public function test_admin_can_view_update_and_delete_user(): void
    {
        $targetUser = User::create([
            'name' => 'Ustadz Target Edit',
            'email' => 'target.user@ulilalbab.test',
            'password' => bcrypt('password123'),
            'role' => 'pengajar',
            'jabatan' => 'Guru Pengampu Tajwid',
        ]);

        // 1. Detail (JSON / Show)
        $detailResponse = $this->actingAs($this->admin)->getJson("/users/{$targetUser->id}");
        $detailResponse->assertStatus(200)
            ->assertJsonPath('name', 'Ustadz Target Edit')
            ->assertJsonPath('role', 'pengajar');

        // 2. Update
        $updateResponse = $this->actingAs($this->admin)->put("/users/{$targetUser->id}", [
            'name' => 'Ustadz Target Terupdate',
            'email' => 'target.updated@ulilalbab.test',
            'role' => 'pengajar',
            'jabatan' => 'Koordinator Tahfidz & Tajwid',
            'no_telepon' => '081234567890',
        ]);
        $updateResponse->assertRedirect('/users');
        $updateResponse->assertSessionHas('success');

        $targetUser->refresh();
        $this->assertEquals('Ustadz Target Terupdate', $targetUser->name);
        $this->assertEquals('target.updated@ulilalbab.test', $targetUser->email);
        $this->assertEquals('Koordinator Tahfidz & Tajwid', $targetUser->jabatan);

        // 3. Delete
        $deleteResponse = $this->actingAs($this->admin)->delete("/users/{$targetUser->id}");
        $deleteResponse->assertRedirect('/users');
        $deleteResponse->assertSessionHas('success');

        $this->assertDatabaseMissing('users', ['id' => $targetUser->id]);
    }

    /**
     * Uji Admin dapat mengganti logo di panel admin dan logo tersebut tampil pada setiap navbar (landing & dashboard/admin) serta halaman login
     */
    public function test_admin_can_change_navbar_logo_and_it_reflects_on_all_navbars(): void
    {
        $fakeLogo = UploadedFile::fake()->image('custom_pesantren_logo.png', 200, 200);

        $payload = [
            'nama_pesantren' => 'Pesantren Li Ulil Albab Berlogo Baru',
            'tagline_pesantren' => 'Pendidikan Berkualitas Berbasis Pesantren',
            'telepon' => '087799107735',
            'email' => 'info@ulilalbab.ac.id',
            'alamat' => 'Kompleks Pesantren',
            'status_ppdb' => 'buka',
            'tahun_ajaran' => '2026/2027',
            'gelombang_aktif' => 'Gelombang I',
            'kuota_penerimaan' => 300,
            'biaya_pendaftaran' => '250.000',
            'tanggal_buka_pendaftaran' => '01 Januari 2026',
            'tanggal_tutup_pendaftaran' => '30 Mei 2026',
            'tanggal_ujian_seleksi' => 'Sabtu, 13 Juni 2026',
            'tanggal_pengumuman' => '20 Juni 2026',
            'tanggal_daftar_ulang' => '25 Juni 2026',
            'jam_ujian' => '08.00 WIB',
            'lokasi_ujian' => 'Ruang Ujian',
            'logo_file' => $fakeLogo,
        ];

        $response = $this->actingAs($this->admin)->put('/admin/ppdb-setting', $payload);
        $response->assertRedirect('/admin/ppdb-setting');
        $response->assertSessionHas('success');

        $setting = PpdbSetting::first();
        $this->assertNotNull($setting->logo);
        $this->assertFileExists(public_path('images/'.$setting->logo));

        $logoUrl = $setting->logo_url;

        // 1. Tampil pada Navbar Landing Page
        $landingResponse = $this->get('/');
        $landingResponse->assertStatus(200);
        $landingResponse->assertSee($logoUrl);

        // 2. Tampil pada Navbar Dashboard / Panel Admin (layouts.app)
        $dashboardResponse = $this->actingAs($this->admin)->get('/dashboard');
        $dashboardResponse->assertStatus(200);
        $dashboardResponse->assertSee($logoUrl);
        $dashboardResponse->assertSee('Pesantren Li Ulil Albab Berlogo Baru');

        // 3. Tampil pada Halaman Login (sebagai guest)
        auth()->logout();
        $loginResponse = $this->get('/login');
        $loginResponse->assertStatus(200);
        $loginResponse->assertSee($logoUrl);

        // Bersihkan file upload testing
        if ($setting->logo && file_exists(public_path('images/'.$setting->logo))) {
            @unlink(public_path('images/'.$setting->logo));
        }
    }

    /**
     * Uji Admin dapat menambah, melihat, mengedit, dan menghapus jadwal acuan kerja secara lengkap (CRUD)
     */
    public function test_admin_full_crud_jadwal_acuan_kerja(): void
    {
        // 1. TAMBAH (Create) Jadwal Acuan Kerja Baru
        $storePayload = [
            'user_id' => $this->pengajar->id,
            'hari' => 'Senin',
            'jam_mulai' => '07:30',
            'jam_selesai' => '09:00',
            'mata_pelajaran' => 'Nahwu Wadhih Dasar',
            'kelas' => 'VII-A MTs',
            'ruangan' => 'Ruang Imam Bukhari',
            'tahun_ajaran' => '2026/2027',
            'semester' => 'Ganjil',
            'kitab_referensi' => 'An-Nahw Al-Wadhih Juz 1',
            'metode_pembelajaran' => 'Tamyiz & Drill Qawaid',
            'target_capaian' => 'Santri mampu mengidentifikasi isim, fi\'il, dan huruf dengan tepat.',
            'silabus_ringkas' => 'Pekan 1: Pengenalan Kalimat. Pekan 2: Tanda-tanda Isim dan Fi\'il.',
        ];

        $storeResponse = $this->actingAs($this->admin)->post('/jadwal', $storePayload);
        $storeResponse->assertRedirect('/jadwal');
        $storeResponse->assertSessionHas('success');

        $this->assertDatabaseHas('jadwal_pelajarans', [
            'mata_pelajaran' => 'Nahwu Wadhih Dasar',
            'kelas' => 'VII-A MTs',
            'kitab_referensi' => 'An-Nahw Al-Wadhih Juz 1',
        ]);

        $jadwal = JadwalPelajaran::where('mata_pelajaran', 'Nahwu Wadhih Dasar')->first();
        $this->assertNotNull($jadwal);

        // 2. LIHAT (Read / Show) Detail Acuan Kerja
        $showResponse = $this->actingAs($this->admin)->get("/jadwal/{$jadwal->id}");
        $showResponse->assertStatus(200);
        $showResponse->assertSee('Nahwu Wadhih Dasar');
        $showResponse->assertSee('An-Nahw Al-Wadhih Juz 1');
        $showResponse->assertSee('Santri mampu mengidentifikasi isim, fi\'il, dan huruf dengan tepat.');

        // 3. EDIT (Update) Jadwal Acuan Kerja
        $updatePayload = array_merge($storePayload, [
            'mata_pelajaran' => 'Nahwu Wadhih Lanjutan',
            'ruangan' => 'Lab Bahasa Arab',
            'kitab_referensi' => 'An-Nahw Al-Wadhih Juz 2',
            'target_capaian' => 'Santri menguasai i\'rab marfu\'at al-asma.',
            'status_pelaksanaan' => 'aktif',
        ]);

        $updateResponse = $this->actingAs($this->admin)->put("/jadwal/{$jadwal->id}", $updatePayload);
        $updateResponse->assertRedirect('/jadwal');
        $updateResponse->assertSessionHas('success');

        $jadwal->refresh();
        $this->assertEquals('Nahwu Wadhih Lanjutan', $jadwal->mata_pelajaran);
        $this->assertEquals('Lab Bahasa Arab', $jadwal->ruangan);
        $this->assertEquals('An-Nahw Al-Wadhih Juz 2', $jadwal->kitab_referensi);
        $this->assertEquals('Santri menguasai i\'rab marfu\'at al-asma.', $jadwal->target_capaian);

        // 4. HAPUS (Delete) Jadwal Acuan Kerja
        $deleteResponse = $this->actingAs($this->admin)->delete("/jadwal/{$jadwal->id}");
        $deleteResponse->assertRedirect('/jadwal');
        $deleteResponse->assertSessionHas('success');

        $this->assertDatabaseMissing('jadwal_pelajarans', ['id' => $jadwal->id]);
    }
}
