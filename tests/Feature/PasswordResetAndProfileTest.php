<?php

namespace Tests\Feature;

use App\Models\User;
use App\Notifications\ResetPasswordNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Password;
use Tests\TestCase;

class PasswordResetAndProfileTest extends TestCase
{
    use RefreshDatabase;

    public function test_forgot_password_screen_can_be_rendered(): void
    {
        $response = $this->get('/forgot-password');

        $response->assertStatus(200);
        $response->assertSee('Lupa Kata Sandi?');
    }

    public function test_reset_password_link_can_be_requested(): void
    {
        Notification::fake();

        $user = User::factory()->create([
            'email' => 'admin.pesantren@gmail.com',
        ]);

        $response = $this->post('/forgot-password', [
            'email' => 'admin.pesantren@gmail.com',
        ]);

        $response->assertSessionHas('status');
        Notification::assertSentTo($user, ResetPasswordNotification::class);
    }

    public function test_reset_password_screen_can_be_rendered(): void
    {
        $user = User::factory()->create([
            'email' => 'admin.pesantren@gmail.com',
        ]);

        $token = Password::createToken($user);

        $response = $this->get('/reset-password/'.$token.'?email='.$user->email);

        $response->assertStatus(200);
        $response->assertSee('Atur Kata Sandi Baru');
    }

    public function test_password_can_be_reset_with_valid_token(): void
    {
        $user = User::factory()->create([
            'email' => 'admin.pesantren@gmail.com',
            'password' => Hash::make('oldpassword123'),
        ]);

        $token = Password::createToken($user);

        $response = $this->post('/reset-password', [
            'token' => $token,
            'email' => 'admin.pesantren@gmail.com',
            'password' => 'newpassword456',
            'password_confirmation' => 'newpassword456',
        ]);

        $response->assertRedirect('/login');
        $response->assertSessionHas('success');

        $user->refresh();
        $this->assertTrue(Hash::check('newpassword456', $user->password));
    }

    public function test_user_can_update_own_email_to_gmail_and_change_password(): void
    {
        $user = User::factory()->create([
            'email' => 'defaultadmin@ulilalbab.ac.id',
            'password' => Hash::make('password123'),
        ]);

        $response = $this->actingAs($user)->put('/profil-saya', [
            'name' => 'Admin Baru Li Ulil Albab',
            'email' => 'adminbaru@gmail.com',
            'current_password' => 'password123',
            'password' => 'rahasia12345',
            'password_confirmation' => 'rahasia12345',
        ]);

        $response->assertRedirect('/profil-saya');
        $response->assertSessionHas('success');

        $user->refresh();
        $this->assertEquals('adminbaru@gmail.com', $user->email);
        $this->assertEquals('Admin Baru Li Ulil Albab', $user->name);
        $this->assertTrue(Hash::check('rahasia12345', $user->password));
    }
}
