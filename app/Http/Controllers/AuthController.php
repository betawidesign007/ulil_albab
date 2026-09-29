<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Tampilkan form login
     */
    public function showLoginForm()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }

        return view('auth.login');
    }

    /**
     * Proses login user berdasarkan email dan password
     */
    public function login(Request $request)
    {
        // 1. Validasi input dari form login
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $remember = $request->boolean('remember');

        // 2. Coba autentikasi menggunakan Auth::attempt
        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            $user = Auth::user();

            // 3. (Opsional) Jika Anda ingin mengarahkan ke dashboard spesifik per role:
            // if ($user->role === 'admin') {
            //     return redirect()->intended(route('admin.dashboard'))
            //         ->with('success', "Selamat datang kembali, {$user->name}! Anda login sebagai {$user->role_label}.");
            // }

            // Jika rute dashboard bersifat umum / dinamis menangani role di dalam controller-nya:
            return redirect()->intended(route('dashboard'))
                ->with('success', "Selamat datang kembali, {$user->name}! Anda login sebagai {$user->role_label}.");
        }

        // 4. Jika gagal, kembalikan ke halaman login dengan pesan error
        return back()->withErrors([
            'email' => 'Email atau password yang Anda masukkan tidak sesuai.',
        ])->onlyInput('email');
    }

    /**
     * Logout user
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('landing')
            ->with('success', 'Anda telah berhasil keluar dari sistem.');
    }
}
