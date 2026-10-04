<?php

namespace Tests\Feature;

use App\Models\PpdbSetting;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class ProfilVisiMisiStrukturAdminTest extends TestCase
{
    use RefreshDatabase;

    protected User $admin;

    protected User $pengajar;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = User::create([
            'name' => 'Admin Utama',
            'email' => 'admin_setting@ulilalbab.test',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        $this->pengajar = User::create([
            'name' => 'Ustadz Pengajar',
            'email' => 'pengajar_setting@ulilalbab.test',
            'password' => bcrypt('password'),
            'role' => 'pengajar',
        ]);
    }

    /**
     * Admin dapat melihat form kelola profil, visi misi, dan struktur di halaman setting
     */
    public function test_admin_can_access_ppdb_setting_page_and_see_profil_sections(): void
    {
        $response = $this->actingAs($this->admin)->get('/admin/ppdb-setting');

        $response->assertStatus(200);
        $response->assertSee('Pengaturan Profil &amp; Sejarah Lembaga Pesantren', false);
        $response->assertSee('Pengaturan Visi, Misi &amp; Standar Kelulusan', false);
        $response->assertSee('Pengaturan Struktur Kepengurusan &amp; Organisasi', false);
        $response->assertSee('sambutan_pengasuh_nama');
        $response->assertSee('visi_pesantren');
        $response->assertSee('struktur[puncak][nama]');
    }

    /**
     * Pengguna selain admin tidak diizinkan mengakses halaman kelola web admin
     */
    public function test_non_admin_cannot_access_ppdb_setting_page(): void
    {
        $response = $this->actingAs($this->pengajar)->get('/admin/ppdb-setting');
        $response->assertStatus(403);
    }

    /**
     * Admin dapat memperbarui profil, visi misi, dan struktur organisasi
     */
    public function test_admin_can_update_profil_visi_misi_and_struktur(): void
    {
        $setting = PpdbSetting::getActive();

        $updateData = [
            'nama_pesantren' => $setting->nama_pesantren,
            'tagline_pesantren' => $setting->tagline_pesantren,
            'telepon' => $setting->telepon,
            'email' => $setting->email,
            'alamat' => $setting->alamat,
            'status_ppdb' => 'buka',
            'tahun_ajaran' => $setting->tahun_ajaran,
            'gelombang_aktif' => $setting->gelombang_aktif,
            'kuota_penerimaan' => 120,
            'biaya_pendaftaran' => '250.000',
            'tanggal_buka_pendaftaran' => $setting->tanggal_buka_pendaftaran,
            'tanggal_tutup_pendaftaran' => $setting->tanggal_tutup_pendaftaran,
            'tanggal_ujian_seleksi' => $setting->tanggal_ujian_seleksi,
            'tanggal_pengumuman' => $setting->tanggal_pengumuman,
            'tanggal_daftar_ulang' => $setting->tanggal_daftar_ulang,
            'jam_ujian' => '08.00 - 11.30 WIB',
            'lokasi_ujian' => 'Gedung Rektorat Lt. 2',
            'pengumuman_banner' => 'Pendaftaran Resmi Dibuka!',
            'persyaratan_santri' => "Syarat 1\nSyarat 2",
            'berkas_wajib' => "Berkas 1\nBerkas 2",
            // Bagian 5: Profil
            'sambutan_pengasuh_nama' => 'Prof. Dr. KH. Ahmad Zaki, MA',
            'sambutan_pengasuh_jabatan' => 'Mudir Pesantren & Pengasuh',
            'sambutan_pengasuh_quote' => 'Mencetak Santri Berakhlaq Qurani & Berdaya Saing Global.',
            'sambutan_pengasuh_teks' => 'Sambutan hangat dari mudir kami untuk seluruh calon wali santri.',
            'sejarah_singkat' => 'Didirikan pada tahun 2010 dengan penuh keberkahan.',
            'filosofi_nama' => 'Ulil Albab adalah generasi cendekia yang berdzikir dan berfikir.',
            'sarana_prasarana' => "Masjid Raya 3 Lantai\nPerpustakaan Ber-AC Digital\nLaboratorium Robotika",
            // Bagian 6: Visi Misi
            'visi_pesantren' => 'Visi Khusus: Unggul dalam IPTEK dan Kokoh dalam IMTAQ.',
            'misi_pesantren' => "Misi Keimanan: Membina tauhid yang murni.\nMisi Keilmuan: Mengembangkan nalar riset islami.",
            'motto_pesantren' => 'Cerdas, Berakhlak, Mandiri',
            'standar_kelulusan' => "Tahfidz: Minimal 20 Juz Mutqin\nBahasa: Fasih Bahasa Arab & Inggris",
            // Bagian 7: Struktur Organisasi
            'struktur' => [
                'puncak' => [
                    'nama' => 'Prof. Dr. KH. Ahmad Zaki, MA',
                    'jabatan' => 'Pengasuh Utama',
                    'deskripsi' => 'Pengarah kebijakan umum pesantren.',
                ],
                'bph' => [
                    [
                        'nama' => 'Ustadz Ridwan, M.Pd',
                        'jabatan' => 'Wakil Pengasuh Bidang Pendidikan',
                        'deskripsi' => 'Supervisi akademik.',
                    ],
                ],
                'divisi' => [
                    [
                        'nama' => 'Ustadzah Fatimah, Lc',
                        'jabatan' => 'Direktur Tahfidz',
                        'deskripsi' => 'Pengasuhan tahfidz bersanad.',
                    ],
                ],
            ],
        ];

        $response = $this->actingAs($this->admin)->put('/admin/ppdb-setting', $updateData);

        $response->assertRedirect('/admin/ppdb-setting');
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('ppdb_settings', [
            'sambutan_pengasuh_nama' => 'Prof. Dr. KH. Ahmad Zaki, MA',
            'visi_pesantren' => 'Visi Khusus: Unggul dalam IPTEK dan Kokoh dalam IMTAQ.',
            'motto_pesantren' => 'Cerdas, Berakhlak, Mandiri',
        ]);

        $freshSetting = PpdbSetting::getActive();
        $this->assertEquals('Prof. Dr. KH. Ahmad Zaki, MA', $freshSetting->sambutan_pengasuh_nama);
        $this->assertCount(3, $freshSetting->sarana_list);
        $this->assertEquals('Masjid Raya 3 Lantai', $freshSetting->sarana_list[0]);
        $this->assertCount(2, $freshSetting->misi_list);
        $this->assertEquals('Misi Keimanan', $freshSetting->misi_list[0]['judul']);
        $this->assertCount(2, $freshSetting->standar_kelulusan_list);
        $this->assertEquals('Tahfidz', $freshSetting->standar_kelulusan_list[0]['kategori']);
        $this->assertEquals('Prof. Dr. KH. Ahmad Zaki, MA', $freshSetting->struktur_organisasi_list['puncak']['nama']);
    }

    /**
     * Landing page menampilkan konten profil, visi misi, dan struktur yang telah diupdate
     */
    public function test_landing_page_displays_updated_profil_visi_misi_and_struktur(): void
    {
        $setting = PpdbSetting::getActive();
        $setting->update([
            'sambutan_pengasuh_nama' => 'Kiai Haji Nawawi Al-Bantani',
            'sambutan_pengasuh_quote' => 'Generasi Emas Bersanad Al-Qur\'an.',
            'visi_pesantren' => 'Visi Baru: Pesantren Rujukan Nusantara.',
            'motto_pesantren' => 'Beramal Tanpa Henti, Mengabdi Sepenuh Hati',
        ]);

        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Kiai Haji Nawawi Al-Bantani');
        $response->assertSee('Generasi Emas Bersanad Al-Qur\'an.');
        $response->assertSee('Visi Baru: Pesantren Rujukan Nusantara.');
        $response->assertSee('Beramal Tanpa Henti, Mengabdi Sepenuh Hati');
    }

    /**
     * Admin dapat mengunggah dan menghapus foto pada profil, visi misi, dan struktur organisasi
     */
    public function test_admin_can_upload_and_delete_photos_for_profil_visimisi_and_struktur(): void
    {
        $setting = PpdbSetting::getActive();

        $fotoPengasuh = UploadedFile::fake()->image('kyai.jpg', 300, 300);
        $fotoSejarah = UploadedFile::fake()->image('gedung.jpg', 600, 300);
        $fotoVisiMisi = UploadedFile::fake()->image('banner.jpg', 800, 400);
        $fotoPuncak = UploadedFile::fake()->image('puncak.jpg', 300, 300);
        $fotoBph0 = UploadedFile::fake()->image('bph0.jpg', 300, 300);
        $fotoDiv0 = UploadedFile::fake()->image('div0.jpg', 300, 300);

        $payload = [
            'nama_pesantren' => $setting->nama_pesantren,
            'tagline_pesantren' => $setting->tagline_pesantren,
            'telepon' => $setting->telepon,
            'email' => $setting->email,
            'alamat' => $setting->alamat,
            'status_ppdb' => 'buka',
            'tahun_ajaran' => $setting->tahun_ajaran,
            'gelombang_aktif' => $setting->gelombang_aktif,
            'kuota_penerimaan' => 100,
            'biaya_pendaftaran' => '200.000',
            'tanggal_buka_pendaftaran' => $setting->tanggal_buka_pendaftaran,
            'tanggal_tutup_pendaftaran' => $setting->tanggal_tutup_pendaftaran,
            'tanggal_ujian_seleksi' => $setting->tanggal_ujian_seleksi,
            'tanggal_pengumuman' => $setting->tanggal_pengumuman,
            'tanggal_daftar_ulang' => $setting->tanggal_daftar_ulang,
            'jam_ujian' => '08.00 - 11.30 WIB',
            'lokasi_ujian' => 'Gedung Utama',
            'sambutan_pengasuh_foto_file' => $fotoPengasuh,
            'sejarah_foto_file' => $fotoSejarah,
            'visi_misi_foto_file' => $fotoVisiMisi,
            'foto_struktur_puncak' => $fotoPuncak,
            'foto_struktur_bph' => [0 => $fotoBph0],
            'foto_struktur_divisi' => [0 => $fotoDiv0],
        ];

        $response = $this->actingAs($this->admin)->put('/admin/ppdb-setting', $payload);
        $response->assertRedirect('/admin/ppdb-setting');
        $response->assertSessionHas('success');

        $fresh = PpdbSetting::getActive();
        $this->assertNotNull($fresh->sambutan_pengasuh_foto);
        $this->assertNotNull($fresh->sejarah_foto);
        $this->assertNotNull($fresh->visi_misi_foto);
        $this->assertNotNull($fresh->struktur_organisasi_list['puncak']['foto']);
        $this->assertNotNull($fresh->struktur_organisasi_list['bph'][0]['foto']);
        $this->assertNotNull($fresh->struktur_organisasi_list['divisi'][0]['foto']);

        // Uji bahwa landing page menampilkan URL gambar yang diunggah
        $landingResponse = $this->get('/');
        $landingResponse->assertStatus(200);
        $landingResponse->assertSee($fresh->sambutan_pengasuh_foto);
        $landingResponse->assertSee($fresh->sejarah_foto);
        $landingResponse->assertSee($fresh->visi_misi_foto);

        // Uji penghapusan foto oleh admin
        $deletePayload = [
            'nama_pesantren' => $setting->nama_pesantren,
            'tagline_pesantren' => $setting->tagline_pesantren,
            'telepon' => $setting->telepon,
            'email' => $setting->email,
            'alamat' => $setting->alamat,
            'status_ppdb' => 'buka',
            'tahun_ajaran' => $setting->tahun_ajaran,
            'gelombang_aktif' => $setting->gelombang_aktif,
            'kuota_penerimaan' => 100,
            'biaya_pendaftaran' => '200.000',
            'tanggal_buka_pendaftaran' => $setting->tanggal_buka_pendaftaran,
            'tanggal_tutup_pendaftaran' => $setting->tanggal_tutup_pendaftaran,
            'tanggal_ujian_seleksi' => $setting->tanggal_ujian_seleksi,
            'tanggal_pengumuman' => $setting->tanggal_pengumuman,
            'tanggal_daftar_ulang' => $setting->tanggal_daftar_ulang,
            'jam_ujian' => '08.00 - 11.30 WIB',
            'lokasi_ujian' => 'Gedung Utama',
            'hapus_sambutan_pengasuh_foto' => 1,
            'hapus_sejarah_foto' => 1,
            'hapus_visi_misi_foto' => 1,
            'hapus_foto_struktur_puncak' => 1,
            'hapus_foto_struktur_bph' => [0 => 1],
            'hapus_foto_struktur_divisi' => [0 => 1],
        ];

        $delResponse = $this->actingAs($this->admin)->put('/admin/ppdb-setting', $deletePayload);
        $delResponse->assertRedirect('/admin/ppdb-setting');

        $afterDelete = PpdbSetting::getActive();
        $this->assertNull($afterDelete->sambutan_pengasuh_foto);
        $this->assertNull($afterDelete->sejarah_foto);
        $this->assertNull($afterDelete->visi_misi_foto);
        $this->assertNull($afterDelete->struktur_organisasi_list['puncak']['foto']);
    }

    /**
     * Admin dapat menambahkan SDM baru pada struktur organisasi (BPH dan Divisi) dan muncul di landing page
     */
    public function test_admin_can_add_new_sdm_to_struktur_organisasi_and_view_on_landing_page(): void
    {
        $setting = PpdbSetting::getActive();

        $payload = [
            'nama_pesantren' => $setting->nama_pesantren,
            'tagline_pesantren' => $setting->tagline_pesantren,
            'telepon' => $setting->telepon,
            'email' => $setting->email,
            'alamat' => $setting->alamat,
            'status_ppdb' => 'buka',
            'tahun_ajaran' => $setting->tahun_ajaran,
            'gelombang_aktif' => $setting->gelombang_aktif,
            'kuota_penerimaan' => 100,
            'biaya_pendaftaran' => '200.000',
            'tanggal_buka_pendaftaran' => $setting->tanggal_buka_pendaftaran,
            'tanggal_tutup_pendaftaran' => $setting->tanggal_tutup_pendaftaran,
            'tanggal_ujian_seleksi' => $setting->tanggal_ujian_seleksi,
            'tanggal_pengumuman' => $setting->tanggal_pengumuman,
            'tanggal_daftar_ulang' => $setting->tanggal_daftar_ulang,
            'jam_ujian' => '08.00 - 11.30 WIB',
            'lokasi_ujian' => 'Gedung Utama',
            'struktur' => [
                'puncak' => [
                    'nama' => 'KH. Dr. Abdullah Syukri, M.Ag',
                    'jabatan' => 'Pengasuh Utama',
                    'deskripsi' => 'Pengasuh Pesantren',
                ],
                'bph' => [
                    [
                        'nama' => 'Dr. KH. Ahmad Rofi\'i, M.Pd.I',
                        'jabatan' => 'Wakil Mudir',
                        'deskripsi' => 'Bidang Tarbiyah',
                    ],
                    [
                        'nama' => 'Ustadz Baru BPH 1, M.Ag',
                        'jabatan' => 'Wakil Pengasuh Bidang Kemandirian',
                        'deskripsi' => 'Mengelola unit usaha dan kemandirian pesantren.',
                    ],
                ],
                'divisi' => [
                    [
                        'nama' => 'Ustadz Baru Divisi Sarpras, S.T',
                        'jabatan' => 'Kepala Bagian Sarana & Prasarana',
                        'deskripsi' => 'Pemeliharaan fasilitas asrama dan laboratorium.',
                    ],
                ],
            ],
        ];

        $response = $this->actingAs($this->admin)->put('/admin/ppdb-setting', $payload);
        $response->assertRedirect('/admin/ppdb-setting');
        $response->assertSessionHas('success');

        $fresh = PpdbSetting::getActive();
        $this->assertCount(2, $fresh->struktur_organisasi_list['bph']);
        $this->assertEquals('Ustadz Baru BPH 1, M.Ag', $fresh->struktur_organisasi_list['bph'][1]['nama']);
        $this->assertCount(1, $fresh->struktur_organisasi_list['divisi']);
        $this->assertEquals('Ustadz Baru Divisi Sarpras, S.T', $fresh->struktur_organisasi_list['divisi'][0]['nama']);

        // Verifikasi tampil di landing page
        $landing = $this->get('/');
        $landing->assertStatus(200);
        $landing->assertSee('Ustadz Baru BPH 1, M.Ag');
        $landing->assertSee('Wakil Pengasuh Bidang Kemandirian');
        $landing->assertSee('Ustadz Baru Divisi Sarpras, S.T');
        $landing->assertSee('Kepala Bagian Sarana &amp; Prasarana', false);
    }
}
