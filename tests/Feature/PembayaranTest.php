<?php

namespace Tests\Feature;

use App\Enums\Role;
use App\Models\Pembayaran;
use App\Models\Santri;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PembayaranTest extends TestCase
{
    use RefreshDatabase;

    private function createAdmin(): User
    {
        return User::create([
            'name' => 'Admin Penguji',
            'email' => 'admin.test@ulilalbab.ac.id',
            'password' => bcrypt('password123'),
            'role' => 'admin',
            'no_hp' => '081234567890',
            'jabatan' => 'Tata Usaha',
            'tanggal_lahir' => '1990-01-01',
            'usia' => 36,
            'nama_orang_tua' => 'Bapak Admin',
            'alamat' => 'Pondok Pesantren',
        ]);
    }

    private function createSantri(): Santri
    {
        return Santri::create([
            'nis' => '2026999',
            'nama_lengkap' => 'Santri Uji Coba',
            'jenis_kelamin' => 'Laki-laki',
            'tempat_lahir' => 'Surabaya',
            'tanggal_lahir' => '2010-05-15',
            'usia' => 16,
            'nama_orang_tua' => 'Wali Santri Uji',
            'no_hp' => '081298765432',
            'kamar' => 'Al-Ghazali',
            'kelas' => '1 Tsanawiyah',
            'alamat' => 'Jl. Uji No. 12',
        ]);
    }

    public function test_guest_cannot_access_pembayaran_routes(): void
    {
        $response = $this->get('/pembayaran');
        $response->assertRedirect('/login');

        $response = $this->get('/pembayaran-tambah/baru');
        $response->assertRedirect('/login');
    }

    public function test_admin_can_view_pembayaran_index(): void
    {
        $admin = $this->createAdmin();
        $santri = $this->createSantri();

        Pembayaran::create([
            'kode_transaksi' => 'TRX-202610-0001',
            'santri_id' => $santri->id,
            'user_id' => $admin->id,
            'kategori_pembayaran' => 'Syahriah / SPP Bulanan',
            'bulan_dibayar' => 'Oktober',
            'tahun_dibayar' => '2026',
            'jumlah' => 350000,
            'tanggal_pembayaran' => '2026-10-01',
            'metode_pembayaran' => 'Tunai',
            'status' => 'Lunas',
        ]);

        $response = $this->actingAs($admin)->get('/pembayaran');
        $response->assertStatus(200);
        $response->assertSee('TRX-202610-0001');
        $response->assertSee('Santri Uji Coba');
        $response->assertSee('Rp 350.000');
    }

    public function test_admin_can_store_pembayaran(): void
    {
        $admin = $this->createAdmin();
        $santri = $this->createSantri();

        $response = $this->actingAs($admin)->post('/pembayaran', [
            'santri_id' => $santri->id,
            'kategori_pembayaran' => 'Uang Gedung / Pangkal',
            'jumlah' => 1500000,
            'tanggal_pembayaran' => '2026-10-05',
            'metode_pembayaran' => 'Transfer Bank',
            'status' => 'Lunas',
            'catatan' => 'Uang muka pendaftaran gedung',
        ]);

        $this->assertDatabaseHas('pembayarans', [
            'santri_id' => $santri->id,
            'kategori_pembayaran' => 'Uang Gedung / Pangkal',
            'jumlah' => 1500000,
            'metode_pembayaran' => 'Transfer Bank',
            'status' => 'Lunas',
        ]);

        $pembayaran = Pembayaran::first();
        $this->assertNotNull($pembayaran);
        $this->assertStringStartsWith('TRX-', $pembayaran->kode_transaksi);
        $response->assertRedirect(route('pembayaran.show', $pembayaran->id));
    }

    public function test_admin_can_update_pembayaran(): void
    {
        $admin = $this->createAdmin();
        $santri = $this->createSantri();

        $pembayaran = Pembayaran::create([
            'kode_transaksi' => 'TRX-202610-0001',
            'santri_id' => $santri->id,
            'user_id' => $admin->id,
            'kategori_pembayaran' => 'Syahriah / SPP Bulanan',
            'jumlah' => 300000,
            'tanggal_pembayaran' => '2026-10-01',
            'metode_pembayaran' => 'Tunai',
            'status' => 'Pending',
        ]);

        $response = $this->actingAs($admin)->put("/pembayaran/{$pembayaran->id}", [
            'santri_id' => $santri->id,
            'kategori_pembayaran' => 'Syahriah / SPP Bulanan',
            'jumlah' => 350000,
            'tanggal_pembayaran' => '2026-10-01',
            'metode_pembayaran' => 'Tunai',
            'status' => 'Lunas',
            'catatan' => 'Sudah diverifikasi lunas',
        ]);

        $response->assertRedirect(route('pembayaran.show', $pembayaran->id));
        $this->assertDatabaseHas('pembayarans', [
            'id' => $pembayaran->id,
            'jumlah' => 350000,
            'status' => 'Lunas',
            'catatan' => 'Sudah diverifikasi lunas',
        ]);
    }

    public function test_admin_can_delete_pembayaran(): void
    {
        $admin = $this->createAdmin();
        $santri = $this->createSantri();

        $pembayaran = Pembayaran::create([
            'kode_transaksi' => 'TRX-202610-0001',
            'santri_id' => $santri->id,
            'user_id' => $admin->id,
            'kategori_pembayaran' => 'Lain-lain',
            'jumlah' => 100000,
            'tanggal_pembayaran' => '2026-10-01',
            'metode_pembayaran' => 'Tunai',
            'status' => 'Batal',
        ]);

        $response = $this->actingAs($admin)->delete("/pembayaran/{$pembayaran->id}");
        $response->assertRedirect(route('pembayaran.index'));

        $this->assertDatabaseMissing('pembayarans', [
            'id' => $pembayaran->id,
        ]);
    }

    public function test_pembayaran_receipt_and_print_view(): void
    {
        $admin = $this->createAdmin();
        $santri = $this->createSantri();

        $pembayaran = Pembayaran::create([
            'kode_transaksi' => 'TRX-202610-0001',
            'santri_id' => $santri->id,
            'user_id' => $admin->id,
            'kategori_pembayaran' => 'Syahriah / SPP Bulanan',
            'jumlah' => 350000,
            'tanggal_pembayaran' => '2026-10-01',
            'metode_pembayaran' => 'Tunai',
            'status' => 'Lunas',
        ]);

        // Show page
        $response = $this->actingAs($admin)->get("/pembayaran/{$pembayaran->id}");
        $response->assertStatus(200);
        $response->assertSee('KWITANSI PEMBAYARAN');
        $response->assertSee($santri->nama_lengkap);

        // Cetak view
        $response = $this->actingAs($admin)->get("/pembayaran/{$pembayaran->id}/cetak");
        $response->assertStatus(200);
        $response->assertSee('BUKTI PEMBAYARAN / KWITANSI RESMI');
    }

    public function test_santri_store_and_update_with_new_columns_and_auto_age(): void
    {
        $admin = $this->createAdmin();

        $response = $this->actingAs($admin)->post('/santri', [
            'nis' => '2026777',
            'nama_lengkap' => 'Santri Baru Auto Usia',
            'jenis_kelamin' => 'Laki-laki',
            'tempat_lahir' => 'Bandung',
            'tanggal_lahir' => '2012-01-10',
            'nama_orang_tua' => 'Deden Kurniawan',
            'no_hp' => '0812344321',
            'kamar' => 'Al-Ghazali',
            'kelas' => '1 Tsanawiyah',
            'alamat' => 'Jl. Diponegoro No. 10',
        ]);

        $response->assertRedirect(route('santri.index'));

        $santri = Santri::where('nis', '2026777')->first();
        $this->assertNotNull($santri);
        $this->assertEquals('Deden Kurniawan', $santri->nama_orang_tua);
        $this->assertEquals('0812344321', $santri->no_hp);
        $this->assertEquals('Jl. Diponegoro No. 10', $santri->alamat);
        $this->assertGreaterThan(0, $santri->usia);
    }

    public function test_user_store_with_new_columns_and_auto_age(): void
    {
        $admin = $this->createAdmin();

        $response = $this->actingAs($admin)->post('/users', [
            'name' => 'Ustadz Baru',
            'email' => 'ustadz.baru@ulilalbab.ac.id',
            'password' => 'password123',
            'role' => 'pengajar',
            'no_hp' => '0813778899',
            'jabatan' => 'Pengampu Fiqih',
            'tanggal_lahir' => '1998-03-25',
            'nama_orang_tua' => 'H. Syamsuddin',
            'alamat' => 'Wisma Guru Asatidz',
        ]);

        $response->assertRedirect(route('users.index'));

        $user = User::where('email', 'ustadz.baru@ulilalbab.ac.id')->first();
        $this->assertNotNull($user);
        $this->assertEquals('H. Syamsuddin', $user->nama_orang_tua);
        $this->assertEquals('0813778899', $user->no_hp);
        $this->assertEquals('Wisma Guru Asatidz', $user->alamat);
        $this->assertGreaterThan(0, $user->usia);
    }

    public function test_pengajar_cannot_access_pembayaran_index_and_is_denied_with_403(): void
    {
        $pengajar = User::create([
            'name' => 'Ustadz Ahmad Pengajar',
            'email' => 'pengajar.test@ulilalbab.ac.id',
            'password' => bcrypt('password123'),
            'role' => 'pengajar',
        ]);

        $response = $this->actingAs($pengajar)->get('/pembayaran');
        $response->assertStatus(403);
    }

    public function test_pengajar_cannot_access_pembayaran_show_and_cetak(): void
    {
        $admin = $this->createAdmin();
        $santri = $this->createSantri();
        $pengajar = User::create([
            'name' => 'Ustadz Pengajar 2',
            'email' => 'pengajar2@ulilalbab.ac.id',
            'password' => bcrypt('password123'),
            'role' => 'pengajar',
        ]);

        $pembayaran = Pembayaran::create([
            'kode_transaksi' => 'TRX-202610-0999',
            'santri_id' => $santri->id,
            'user_id' => $admin->id,
            'kategori_pembayaran' => 'Syahriah / SPP Bulanan',
            'jumlah' => 350000,
            'tanggal_pembayaran' => '2026-10-01',
            'metode_pembayaran' => 'Tunai',
            'status' => 'Lunas',
        ]);

        $responseShow = $this->actingAs($pengajar)->get("/pembayaran/{$pembayaran->id}");
        $responseShow->assertStatus(403);

        $responseCetak = $this->actingAs($pengajar)->get("/pembayaran/{$pembayaran->id}/cetak");
        $responseCetak->assertStatus(403);
    }

    public function test_pemilik_can_access_pembayaran_index(): void
    {
        $pemilik = User::create([
            'name' => 'Kyai Pemilik Pondok',
            'email' => 'pemilik.test@ulilalbab.ac.id',
            'password' => bcrypt('password123'),
            'role' => 'pemilik',
        ]);

        $response = $this->actingAs($pemilik)->get('/pembayaran');
        $response->assertStatus(200);
    }

    public function test_role_enum_methods_and_values(): void
    {
        $this->assertEquals(['admin', 'pengajar', 'pemilik'], Role::values());
        $this->assertEquals('Administrator', Role::Admin->label());
        $this->assertEquals('Dewan Pengajar / Asatidz', Role::Pengajar->label());
        $this->assertEquals('Pemilik / Mudir Yayasan', Role::Pemilik->label());

        $this->assertTrue(Role::Admin->canViewPembayaran());
        $this->assertTrue(Role::Pemilik->canViewPembayaran());
        $this->assertFalse(Role::Pengajar->canViewPembayaran());

        $this->assertTrue(Role::Admin->canManagePembayaran());
        $this->assertFalse(Role::Pemilik->canManagePembayaran());
        $this->assertFalse(Role::Pengajar->canManagePembayaran());
    }
}
