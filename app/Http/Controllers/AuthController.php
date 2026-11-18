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

            // Rute dashboard bersifat umum / dinamis menangani role di dalam controller-nya
            return redirect()->intended(route('dashboard'))
                ->with('success', "Selamat datang kembali, {$user->name}! Anda login sebagai {$user->role_label}.");
        }

        // 4. Jika gagal, periksa apakah email ada di database untuk deteksi salah akun
        $userExists = User::where('email', $credentials['email'])->exists();

        if (! $userExists) {
            return back()->withErrors([
                'email' => 'Akun dengan email tersebut tidak terdaftar di sistem SIMPONPES. Mohon periksa kembali jika Anda salah memasukkan akun.',
            ])->onlyInput('email');
        }

        return back()->withErrors([
            'password' => 'Kata sandi yang Anda masukkan salah untuk akun ini. Silakan periksa kembali kata sandi Anda.',
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
