<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Tampilkan halaman pengaturan profil pengguna login
     */
    public function edit(): View
    {
        $user = Auth::user();

        return view('profile.edit', compact('user'));
    }

    /**
     * Perbarui data profil, email, dan kata sandi pengguna
     */
    public function update(Request $request): RedirectResponse
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'no_hp' => 'nullable|string|max:30',
            'current_password' => 'nullable|required_with:password|current_password',
            'password' => 'nullable|string|min:6|confirmed',
        ], [
            'name.required' => 'Nama lengkap wajib diisi.',
            'email.required' => 'Alamat email wajib diisi.',
            'email.unique' => 'Alamat email tersebut telah digunakan oleh pengguna lain.',
            'current_password.current_password' => 'Kata sandi saat ini tidak cocok.',
            'current_password.required_with' => 'Harap masukkan kata sandi saat ini jika ingin mengganti kata sandi.',
            'password.min' => 'Kata sandi baru minimal 6 karakter.',
            'password.confirmed' => 'Konfirmasi kata sandi baru tidak cocok.',
        ]);

        $updateData = [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'no_hp' => $validated['no_hp'] ?? null,
        ];

        if (! empty($validated['password'])) {
            $updateData['password'] = Hash::make($validated['password']);
        }

        $user->update($updateData);

        return redirect()->route('profile.edit')
            ->with('success', 'Data profil dan akun Anda berhasil diperbarui!');
    }
}
