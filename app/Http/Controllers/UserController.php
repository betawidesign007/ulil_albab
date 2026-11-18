<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Tampilkan daftar seluruh pengguna sistem (khusus admin)
     */
    public function index()
    {
        $users = User::orderBy('role')->orderBy('name')->get();

        return view('users.index', compact('users'));
    }

    /**
     * Simpan pengguna baru
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role' => 'required|in:admin,pengajar,pemilik',
            'no_hp' => 'nullable|string|max:30',
            'jabatan' => 'nullable|string|max:100',
            'tanggal_lahir' => 'nullable|date',
            'usia' => 'nullable|integer|min:1|max:120',
            'nama_orang_tua' => 'nullable|string|max:255',
            'alamat' => 'nullable|string',
        ]);

        if (empty($validated['usia']) && ! empty($validated['tanggal_lahir'])) {
            $validated['usia'] = Carbon::parse($validated['tanggal_lahir'])->age;
        }

        $validated['password'] = Hash::make($validated['password']);

        User::create($validated);

        return redirect()->route('users.index')->with('success', 'Pengguna baru berhasil ditambahkan!');
    }

    /**
     * Tampilkan detail pengguna (JSON atau partial)
     */
    public function show(User $user)
    {
        if (request()->wantsJson() || request()->ajax()) {
            return response()->json(array_merge($user->toArray(), [
                'success' => true,
                'data' => $user,
            ]));
        }

        return redirect()->route('users.index');
    }

    /**
     * Update data pengguna
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'role' => 'required|in:admin,pengajar,pemilik',
            'no_hp' => 'nullable|string|max:30',
            'jabatan' => 'nullable|string|max:100',
            'tanggal_lahir' => 'nullable|date',
            'usia' => 'nullable|integer|min:1|max:120',
            'nama_orang_tua' => 'nullable|string|max:255',
            'alamat' => 'nullable|string',
            'password' => 'nullable|min:6',
        ]);

        if (empty($validated['usia']) && ! empty($validated['tanggal_lahir'])) {
            $validated['usia'] = Carbon::parse($validated['tanggal_lahir'])->age;
        }

        $updateData = [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'role' => $validated['role'],
            'no_hp' => $validated['no_hp'] ?? null,
            'jabatan' => $validated['jabatan'] ?? null,
            'tanggal_lahir' => $validated['tanggal_lahir'] ?? null,
            'usia' => $validated['usia'] ?? null,
            'nama_orang_tua' => $validated['nama_orang_tua'] ?? null,
            'alamat' => $validated['alamat'] ?? null,
        ];

        if (! empty($validated['password'])) {
            $updateData['password'] = Hash::make($validated['password']);
        }

        $user->update($updateData);

        return redirect()->route('users.index')->with('success', "Data pengguna {$user->name} berhasil diperbarui!");
    }

    /**
     * Hapus pengguna (tidak boleh menghapus akun sendiri)
     */
    public function destroy(User $user)
    {
        if (auth()->id() === $user->id) {
            return redirect()->route('users.index')->with('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
        }

        $nama = $user->name;
        $user->delete();

        return redirect()->route('users.index')->with('success', "Akun pengguna {$nama} berhasil dihapus!");
    }
}
