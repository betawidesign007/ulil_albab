<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\View\View;

class PasswordResetController extends Controller
{
    /**
     * Tampilkan formulir permintaan tautan lupa password
     */
    public function showForgotForm(): View|RedirectResponse
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }

        return view('auth.forgot-password');
    }

    /**
     * Kirim tautan reset kata sandi ke email pengguna
     */
    public function sendResetLink(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => 'required|email',
        ], [
            'email.required' => 'Mohon masukkan alamat email Anda.',
            'email.email' => 'Format alamat email tidak valid.',
        ]);

        $userExists = User::where('email', $request->email)->exists();
        if (! $userExists) {
            return back()->withErrors([
                'email' => 'Alamat email tersebut tidak terdaftar di sistem SIMPONPES.',
            ])->onlyInput('email');
        }

        $status = Password::sendResetLink($request->only('email'));

        if ($status === Password::RESET_LINK_SENT) {
            return back()->with('status', 'Tautan untuk mereset kata sandi telah dikirim ke email Anda! Silakan periksa kotak masuk (Inbox) atau folder Spam email Anda.');
        }

        return back()->withErrors([
            'email' => 'Gagal mengirim email reset kata sandi. Pastikan konfigurasi email server aktif atau hubungi administrator.',
        ])->onlyInput('email');
    }

    /**
     * Tampilkan formulir penetapan kata sandi baru
     */
    public function showResetForm(Request $request, string $token): View
    {
        return view('auth.reset-password', [
            'token' => $token,
            'email' => $request->email,
        ]);
    }

    /**
     * Proses pembaruan kata sandi baru
     */
    public function resetPassword(Request $request): RedirectResponse
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|string|min:6|confirmed',
        ], [
            'password.required' => 'Kata sandi baru wajib diisi.',
            'password.min' => 'Kata sandi baru minimal 6 karakter.',
            'password.confirmed' => 'Konfirmasi kata sandi tidak cocok dengan kata sandi baru.',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                    'remember_token' => Str::random(60),
                ])->save();
            }
        );

        if ($status === Password::PASSWORD_RESET) {
            return redirect()->route('login')
                ->with('success', 'Kata sandi berhasil diperbarui! Silakan masuk menggunakan kata sandi baru Anda.');
        }

        return back()->withErrors([
            'email' => 'Tautan reset kata sandi tidak valid atau telah kedaluwarsa (lebih dari 60 menit). Silakan ajukan tautan baru.',
        ])->onlyInput('email');
    }
}
