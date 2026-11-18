<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ErrorPagesAndRoleMiddlewareTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Uji halaman 404 ketika mengakses URL yang tidak terdaftar
     */
    public function test_404_page_rendered_for_non_existent_route(): void
    {
        $response = $this->get('/halaman-yang-pasti-tidak-ada-12345');

        $response->assertStatus(404);
        $response->assertSee('404 Halaman Tidak Ditemukan');
        $response->assertSee('SIMPONPES');
    }

    /**
     * Uji RoleMiddleware menolak pengajar yang mencoba mengakses modul khusus admin (403)
     * dan menampilkan informasi akun yang sedang aktif untuk menangani kasus 'salah masuk akun'
     */
    public function test_role_middleware_denies_unauthorized_user_with_403_and_account_details(): void
    {
        $pengajar = User::factory()->create([
            'name' => 'Ustadz Ahmad Fauzi',
            'email' => 'pengajar_test@simponpes.test',
            'role' => 'pengajar',
        ]);

        $response = $this->actingAs($pengajar)->get('/users');

        $response->assertStatus(403);
        $response->assertSee('Akses Ditolak');
        $response->assertSee('Ustadz Ahmad Fauzi');
        $response->assertSee('pengajar_test@simponpes.test');
        $response->assertSee('Salah masuk akun?');
        $response->assertSee('Ganti Akun / Keluar');
    }

    /**
     * Uji RoleMiddleware mengizinkan user dengan role yang sesuai (admin mengakses /users)
     */
    public function test_role_middleware_allows_authorized_role(): void
    {
        $admin = User::factory()->create([
            'role' => 'admin',
        ]);

        $response = $this->actingAs($admin)->get('/users');

        $response->assertStatus(200);
        $response->assertSee('Manajemen Pengguna');
    }

    /**
     * Uji RoleMiddleware mengalihkan guest ke halaman login
     */
    public function test_role_middleware_redirects_unauthenticated_user_to_login(): void
    {
        $response = $this->get('/users');

        $response->assertRedirect('/login');
    }

    /**
     * Uji halaman 419 Page Expired
     */
    public function test_419_error_page_renders_correctly(): void
    {
        $response = $this->get('/ujian-masuk');
        $this->get('/test-simulasi-419-status'); // Kita dapat menguji view langsung

        $view = $this->view('errors.419');
        $view->assertSee('419 Sesi Kedaluwarsa');
        $view->assertSee('Muat Ulang Halaman');
    }

    /**
     * Uji deteksi salah akun saat login gagal
     */
    public function test_login_gives_clear_indication_when_email_not_found(): void
    {
        $response = $this->post('/login', [
            'email' => 'akun_tidak_ada_sama_sekali@simponpes.test',
            'password' => 'secret123',
        ]);

        $response->assertSessionHasErrors(['email']);
        $this->assertGuest();
    }
}
