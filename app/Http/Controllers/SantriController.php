<?php

namespace App\Http\Controllers;

use App\Models\Santri;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SantriController extends Controller
{
    /**
     * Display a listing of the resource.
     * Dapat diakses oleh Admin, Pengajar, dan Pemilik.
     */
    public function index(Request $request)
    {
        $query = Santri::query();

        // Fitur Pencarian (Nama / NIS)
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('nama_lengkap', 'like', "%{$search}%")
                    ->orWhere('nis', 'like', "%{$search}%")
                    ->orWhere('tempat_lahir', 'like', "%{$search}%");
            });
        }

        // Filter Kamar
        if ($request->filled('kamar')) {
            $query->where('kamar', $request->input('kamar'));
        }

        // Filter Kelas
        if ($request->filled('kelas')) {
            $query->where('kelas', $request->input('kelas'));
        }

        // Filter Jenis Kelamin
        if ($request->filled('jenis_kelamin')) {
            $query->where('jenis_kelamin', $request->input('jenis_kelamin'));
        }

        $santris = $query->orderBy('nama_lengkap')->paginate(10)->withQueryString();

        return view('santri.index', compact('santris'));
    }

    /**
     * Show the form for creating a new resource.
     * Khusus Admin
     */
    public function create()
    {
        $this->authorizeAdmin();

        return view('santri.create');
    }

    /**
     * Store a newly created resource in storage.
     * Khusus Admin
     */
    public function store(Request $request)
    {
        $this->authorizeAdmin();

        $validated = $request->validate([
            'nis' => 'required|unique:santris,nis',
            'nama_lengkap' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'usia' => 'nullable|integer|min:1|max:120',
            'nama_orang_tua' => 'nullable|string|max:255',
            'no_hp' => 'nullable|string|max:30',
            'kamar' => 'nullable|string|max:100',
            'kelas' => 'nullable|string|max:100',
            'alamat' => 'nullable|string',
        ]);

        if (empty($validated['usia']) && ! empty($validated['tanggal_lahir'])) {
            $validated['usia'] = Carbon::parse($validated['tanggal_lahir'])->age;
        }

        Santri::create($validated);

        return redirect()->route('santri.index')->with('success', 'Data santri baru berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     * Dapat diakses oleh Admin, Pengajar, dan Pemilik.
     */
    public function show(Santri $santri)
    {
        $santri->load(['pembayarans.petugas']);

        return view('santri.show', compact('santri'));
    }

    /**
     * Show the form for editing the specified resource.
     * Khusus Admin
     */
    public function edit(Santri $santri)
    {
        $this->authorizeAdmin();

        return view('santri.edit', compact('santri'));
    }

    /**
     * Update the specified resource in storage.
     * Khusus Admin
     */
    public function update(Request $request, Santri $santri)
    {
        $this->authorizeAdmin();

        $validated = $request->validate([
            'nis' => 'required|unique:santris,nis,'.$santri->id,
            'nama_lengkap' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'usia' => 'nullable|integer|min:1|max:120',
            'nama_orang_tua' => 'nullable|string|max:255',
            'no_hp' => 'nullable|string|max:30',
            'kamar' => 'nullable|string|max:100',
            'kelas' => 'nullable|string|max:100',
            'alamat' => 'nullable|string',
        ]);

        if (empty($validated['usia']) && ! empty($validated['tanggal_lahir'])) {
            $validated['usia'] = Carbon::parse($validated['tanggal_lahir'])->age;
        }

        $santri->update($validated);

        return redirect()->route('santri.index')->with('success', 'Data santri berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     * Khusus Admin
     */
    public function destroy(Santri $santri)
    {
        $this->authorizeAdmin();

        $santri->delete();

        return redirect()->route('santri.index')->with('success', 'Data santri berhasil dihapus!');
    }

    /**
     * Helper proteksi hanya Admin yang dapat mengubah data santri
     */
    private function authorizeAdmin(): void
    {
        if (! Auth::check() || ! Auth::user()->isAdmin()) {
            abort(403, 'Akses Ditolak: Hanya Administrator yang berwenang menambah, mengubah, atau menghapus data santri.');
        }
    }
}
