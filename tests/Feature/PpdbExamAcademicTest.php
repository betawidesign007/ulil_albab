<?php

namespace Tests\Feature;

use App\Models\PpdbExamResult;
use App\Models\PpdbRegistration;
use App\Models\PpdbSoal;
use App\Models\User;
use Database\Seeders\PpdbSoalSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PpdbExamAcademicTest extends TestCase
{
    use RefreshDatabase;

    protected User $admin;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = User::create([
            'name' => 'Admin Penguji',
            'email' => 'admin_penguji@ulilalbab.test',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        $this->seed(PpdbSoalSeeder::class);
    }

    /**
     * Calon santri dapat melihat halaman gerbang ujian masuk.
     */
    public function test_calon_santri_dapat_melihat_halaman_gerbang_ujian_masuk(): void
    {
        $response = $this->get(route('ppdb.exam.index'));

        $response->assertStatus(200);
        $response->assertSee('Tes Akademik &amp; Potensi Dasar Santri', false);
        $response->assertSee('Nomor Pendaftaran');
    }

    /**
     * Calon santri terdaftar dapat memulai sesi ujian CBT.
     */
    public function test_calon_santri_dapat_memulai_ujian_cbt_dengan_nomor_registrasi(): void
    {
        $registration = PpdbRegistration::create([
            'no_pendaftaran' => 'PPDB-2026-9901',
            'nama_lengkap' => 'Ahmad Fakhri Santoso',
            'jenis_kelamin' => 'Laki-laki',
            'tempat_lahir' => 'Surabaya',
            'tanggal_lahir' => '2012-05-10',
            'asal_sekolah' => 'MIN 1 Surabaya',
            'jenjang' => 'Madrasah Tsanawiyah (MTs Terpadu)',
            'nama_wali' => 'Santoso',
            'no_wa' => '081234567899',
            'alamat' => 'Jl. Ketintang No. 10',
            'jalur' => 'Reguler',
            'model_ujian' => 'Online / Jarak Jauh',
            'status' => 'Pending',
        ]);

        $response = $this->post(route('ppdb.exam.start'), [
            'no_pendaftaran' => $registration->no_pendaftaran,
        ]);

        $response->assertStatus(200);
        $response->assertSee('Ahmad Fakhri Santoso');
        $response->assertSee('SISA WAKTU UJIAN');
        $response->assertSee('Daftar Soal');
    }

    /**
     * Calon santri dapat submit jawaban dan mendapatkan nilai otomatis.
     */
    public function test_calon_santri_dapat_mengumpulkan_ujian_dan_sistem_menghitung_nilai_otomatis(): void
    {
        $registration = PpdbRegistration::create([
            'no_pendaftaran' => 'PPDB-2026-9902',
            'nama_lengkap' => 'Nurul Fatimah Zahra',
            'jenis_kelamin' => 'Perempuan',
            'tempat_lahir' => 'Gresik',
            'tanggal_lahir' => '2012-03-15',
            'asal_sekolah' => 'SDN 1 Gresik',
            'jenjang' => 'Madrasah Tsanawiyah (MTs Terpadu)',
            'nama_wali' => 'H. Suherman',
            'no_wa' => '081299887711',
            'alamat' => 'Jl. Veteran No. 25',
            'jalur' => 'Reguler',
            'model_ujian' => 'Online / Jarak Jauh',
            'status' => 'Pending',
        ]);

        // Ambil beberapa soal untuk dijawab
        $soals = PpdbSoal::aktif()->orderBy('nomor_urut')->take(5)->get();
        $answers = [];
        foreach ($soals as $s) {
            $answers[$s->id] = $s->kunci_jawaban; // Jawab benar semua
        }

        $response = $this->post(route('ppdb.exam.submit'), [
            'no_pendaftaran' => $registration->no_pendaftaran,
            'answers' => $answers,
        ]);

        $response->assertRedirect(route('ppdb.exam.result', $registration->no_pendaftaran));

        $this->assertDatabaseHas('ppdb_exam_results', [
            'no_pendaftaran' => $registration->no_pendaftaran,
            'nama_santri' => 'Nurul Fatimah Zahra',
        ]);

        // Cek halaman hasil pengumuman nilai
        $resultResponse = $this->get(route('ppdb.exam.result', $registration->no_pendaftaran));
        $resultResponse->assertStatus(200);
        $resultResponse->assertSee('Nurul Fatimah Zahra');
        $resultResponse->assertSee('NILAI AKHIR');
        $resultResponse->assertSee('SURAT KETERANGAN HASIL UJIAN');

        // Cek halaman cetak SKHU
        $cetakResponse = $this->get(route('ppdb.exam.cetak', $registration->no_pendaftaran));
        $cetakResponse->assertStatus(200);
        $cetakResponse->assertSee('SURAT KETERANGAN HASIL UJIAN SELEKSI MASUK');
    }

    /**
     * Admin dapat melihat bank soal dan menambah butir soal baru.
     */
    public function test_admin_dapat_mengakses_bank_soal_dan_menambah_soal(): void
    {
        $response = $this->actingAs($this->admin)->get(route('admin.ppdb.soal.index'));
        $response->assertStatus(200);
        $response->assertSee('Bank Soal Tes Akademik Ujian Masuk PPDB');

        // Tambah soal baru
        $storeResponse = $this->actingAs($this->admin)->post(route('admin.ppdb.soal.store'), [
            'nomor_urut' => 999,
            'kategori' => 'Pendidikan Agama Islam & Fiqih Dasar',
            'pertanyaan' => 'Berapakah jumlah rukun Islam yang wajib diyakini dan diamalkan?',
            'opsi_a' => '3 perkara',
            'opsi_b' => '4 perkara',
            'opsi_c' => '5 perkara',
            'opsi_d' => '6 perkara',
            'kunci_jawaban' => 'C',
            'bobot' => 2,
            'penjelasan' => 'Rukun Islam terdiri dari 5 perkara sesuai hadits riwayat Bukhari Muslim.',
            'is_aktif' => 1,
        ]);

        $storeResponse->assertRedirect(route('admin.ppdb.soal.index'));

        $this->assertDatabaseHas('ppdb_soals', [
            'nomor_urut' => 999,
            'kunci_jawaban' => 'C',
        ]);
    }

    /**
     * Admin dapat mengevaluasi dan memberikan catatan pada nilai santri.
     */
    public function test_admin_dapat_memperbarui_status_kelulusan_dan_memberi_catatan_evaluasi(): void
    {
        $registration = PpdbRegistration::create([
            'no_pendaftaran' => 'PPDB-2026-9903',
            'nama_lengkap' => 'Muhammad Zulfikar',
            'jenis_kelamin' => 'Laki-laki',
            'tempat_lahir' => 'Malang',
            'tanggal_lahir' => '2011-08-20',
            'asal_sekolah' => 'SDN 2 Malang',
            'jenjang' => 'Madrasah Tsanawiyah (MTs Terpadu)',
            'nama_wali' => 'Drs. Hendro',
            'no_wa' => '081233445588',
            'alamat' => 'Jl. Ijen No. 12',
            'jalur' => 'Reguler',
            'model_ujian' => 'Online / Jarak Jauh',
            'status' => 'Pending',
        ]);

        $examResult = PpdbExamResult::create([
            'ppdb_registration_id' => $registration->id,
            'no_pendaftaran' => $registration->no_pendaftaran,
            'nama_santri' => $registration->nama_lengkap,
            'jenjang' => $registration->jenjang,
            'total_soal' => 50,
            'jawaban_benar' => 45,
            'jawaban_salah' => 5,
            'jawaban_kosong' => 0,
            'nilai' => 90.00,
            'status_kelulusan' => 'Lulus',
            'catatan_admin' => 'Hasil ujian awal.',
            'detail_jawaban' => [],
            'waktu_mulai' => now()->subMinutes(60),
            'waktu_selesai' => now(),
            'durasi_menit' => 60,
        ]);

        // Admin buka halaman show nilai
        $showResponse = $this->actingAs($this->admin)->get(route('admin.ppdb.nilai.show', $examResult));
        $showResponse->assertStatus(200);
        $showResponse->assertSee('Muhammad Zulfikar');
        $showResponse->assertSee('Input Evaluasi &amp; Catatan Admin', false);

        // Admin update status dan catatan evaluasi resmi
        $updateResponse = $this->actingAs($this->admin)->put(route('admin.ppdb.nilai.update', $examResult), [
            'status_kelulusan' => 'Lulus',
            'nilai' => 95.00,
            'catatan_admin' => 'Selamat, ananda lulus seleksi dengan predikat Mumtaz (Istimewa) dan direkomendasikan masuk kelas unggulan tahfidz.',
        ]);

        $updateResponse->assertRedirect(route('admin.ppdb.nilai.show', $examResult));

        $this->assertDatabaseHas('ppdb_exam_results', [
            'id' => $examResult->id,
            'nilai' => 95.00,
            'catatan_admin' => 'Selamat, ananda lulus seleksi dengan predikat Mumtaz (Istimewa) dan direkomendasikan masuk kelas unggulan tahfidz.',
        ]);

        // Verifikasi bahwa santri melihat pesan catatan admin tersebut di portal hasil ujian
        $santriViewResponse = $this->get(route('ppdb.exam.result', $registration->no_pendaftaran));
        $santriViewResponse->assertStatus(200);
        $santriViewResponse->assertSee('Selamat, ananda lulus seleksi dengan predikat Mumtaz');
    }
}
