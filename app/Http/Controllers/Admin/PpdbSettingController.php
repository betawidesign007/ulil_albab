<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PpdbRegistration;
use App\Models\PpdbSetting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

class PpdbSettingController extends Controller
{
    /**
     * Tampilkan Form Pengaturan Informasi PPDB & Landing Page
     */
    public function index()
    {
        $setting = PpdbSetting::getActive();
        $totalPendaftar = PpdbRegistration::count();
        $sisaKuota = max(0, $setting->kuota_penerimaan - $totalPendaftar);
        $users = User::select('id', 'name', 'jabatan', 'role')->orderBy('name')->get();

        return view('admin.ppdb.index', compact('setting', 'totalPendaftar', 'sisaKuota', 'users'));
    }

    /**
     * Simpan Perubahan Pengaturan Informasi PPDB & Landing Page
     */
    public function update(Request $request)
    {
        $imageRule = [
            'nullable',
            'file',
            'max:20480',
            function ($attribute, $value, $fail) {
                if ($value instanceof UploadedFile) {
                    $allowed = ['png', 'jpg', 'jpeg', 'webp', 'svg', 'ico', 'gif', 'bmp', 'jfif', 'avif'];
                    $ext = strtolower($value->getClientOriginalExtension());
                    if (! in_array($ext, $allowed)) {
                        $fail('Format file gambar tidak didukung (harus PNG, JPG, JPEG, WEBP, SVG, GIF).');
                    }
                }
            },
        ];

        $validated = $request->validate([
            'nama_pesantren' => 'required|string|max:255',
            'tagline_pesantren' => 'required|string|max:500',
            'telepon' => 'required|string|max:50',
            'email' => 'required|email|max:100',
            'alamat' => 'required|string|max:500',
            'status_ppdb' => 'required|in:buka,tutup,segera',
            'tahun_ajaran' => 'required|string|max:50',
            'gelombang_aktif' => 'required|string|max:255',
            'kuota_penerimaan' => 'required|integer|min:1',
            'biaya_pendaftaran' => 'required|string|max:100',
            'tanggal_buka_pendaftaran' => 'required|string|max:100',
            'tanggal_tutup_pendaftaran' => 'required|string|max:100',
            'tanggal_ujian_seleksi' => 'required|string|max:150',
            'tanggal_pengumuman' => 'required|string|max:100',
            'tanggal_daftar_ulang' => 'required|string|max:150',
            'jam_ujian' => 'required|string|max:100',
            'lokasi_ujian' => 'required|string|max:255',
            'persyaratan_santri' => 'nullable|string',
            'berkas_wajib' => 'nullable|string',
            'pengumuman_banner' => 'nullable|string',
            'link_brosur' => 'nullable|url|max:500',
            'sambutan_pengasuh_nama' => 'nullable|string|max:255',
            'sambutan_pengasuh_jabatan' => 'nullable|string|max:255',
            'sambutan_pengasuh_quote' => 'nullable|string|max:500',
            'sambutan_pengasuh_teks' => 'nullable|string',
            'sejarah_singkat' => 'nullable|string',
            'filosofi_nama' => 'nullable|string',
            'sarana_prasarana' => 'nullable|string',
            'visi_pesantren' => 'nullable|string',
            'misi_pesantren' => 'nullable|string',
            'motto_pesantren' => 'nullable|string|max:255',
            'standar_kelulusan' => 'nullable|string',
            'struktur_organisasi' => 'nullable|string',
            'struktur' => 'nullable|array',
            'logo_file' => $imageRule,
            'hapus_logo' => 'nullable|boolean',
            'sambutan_pengasuh_foto_file' => $imageRule,
            'hapus_sambutan_pengasuh_foto' => 'nullable|boolean',
            'sejarah_foto_file' => $imageRule,
            'hapus_sejarah_foto' => 'nullable|boolean',
            'visi_misi_foto_file' => $imageRule,
            'hapus_visi_misi_foto' => 'nullable|boolean',
            'foto_struktur_puncak' => $imageRule,
            'hapus_foto_struktur_puncak' => 'nullable|boolean',
            'foto_struktur_bph.*' => $imageRule,
            'hapus_foto_struktur_bph.*' => 'nullable|boolean',
            'foto_struktur_divisi.*' => $imageRule,
            'hapus_foto_struktur_divisi.*' => 'nullable|boolean',
        ], [
            'logo_file.max' => 'Ukuran file logo maksimal 20 MB.',
            'sambutan_pengasuh_foto_file.max' => 'Ukuran foto pengasuh maksimal 20 MB.',
            'sejarah_foto_file.max' => 'Ukuran foto sejarah lembaga maksimal 20 MB.',
            'visi_misi_foto_file.max' => 'Ukuran foto visi misi maksimal 20 MB.',
        ]);

        $setting = PpdbSetting::getActive();

        // 1. Handle Logo Pesantren
        if ($request->boolean('hapus_logo')) {
            if ($setting->logo && file_exists(public_path('images/'.$setting->logo))) {
                @unlink(public_path('images/'.$setting->logo));
            }
            $setting->logo = null;
        }

        if ($request->hasFile('logo_file')) {
            $filename = $this->handleImageUpload($request->file('logo_file'), 'logo_pesantren', $setting->logo);
            @copy(public_path('images/'.$filename), public_path('images/logo.png'));
            $validated['logo'] = $filename;
        }

        // 2. Handle Foto Sambutan Pengasuh
        if ($request->boolean('hapus_sambutan_pengasuh_foto')) {
            if ($setting->sambutan_pengasuh_foto && file_exists(public_path('images/'.$setting->sambutan_pengasuh_foto))) {
                @unlink(public_path('images/'.$setting->sambutan_pengasuh_foto));
            }
            $validated['sambutan_pengasuh_foto'] = null;
        } elseif ($request->hasFile('sambutan_pengasuh_foto_file')) {
            $validated['sambutan_pengasuh_foto'] = $this->handleImageUpload(
                $request->file('sambutan_pengasuh_foto_file'),
                'pengasuh',
                $setting->sambutan_pengasuh_foto
            );
        }

        // 3. Handle Foto Sejarah / Gedung Lembaga
        if ($request->boolean('hapus_sejarah_foto')) {
            if ($setting->sejarah_foto && file_exists(public_path('images/'.$setting->sejarah_foto))) {
                @unlink(public_path('images/'.$setting->sejarah_foto));
            }
            $validated['sejarah_foto'] = null;
        } elseif ($request->hasFile('sejarah_foto_file')) {
            $validated['sejarah_foto'] = $this->handleImageUpload(
                $request->file('sejarah_foto_file'),
                'sejarah_lembaga',
                $setting->sejarah_foto
            );
        }

        // 4. Handle Foto / Banner Visi Misi
        if ($request->boolean('hapus_visi_misi_foto')) {
            if ($setting->visi_misi_foto && file_exists(public_path('images/'.$setting->visi_misi_foto))) {
                @unlink(public_path('images/'.$setting->visi_misi_foto));
            }
            $validated['visi_misi_foto'] = null;
        } elseif ($request->hasFile('visi_misi_foto_file')) {
            $validated['visi_misi_foto'] = $this->handleImageUpload(
                $request->file('visi_misi_foto_file'),
                'visi_misi',
                $setting->visi_misi_foto
            );
        }

        // 5. Handle Struktur Organisasi & Foto Tiap Pengurus
        $currentStruktur = $setting->struktur_organisasi_list;
        $strukturInput = $request->input('struktur', $currentStruktur);

        if (is_array($strukturInput)) {
            // Puncak
            $puncakFoto = $currentStruktur['puncak']['foto'] ?? null;
            if ($request->boolean('hapus_foto_struktur_puncak')) {
                if ($puncakFoto && file_exists(public_path('images/'.$puncakFoto))) {
                    @unlink(public_path('images/'.$puncakFoto));
                }
                $puncakFoto = null;
            } elseif ($request->hasFile('foto_struktur_puncak')) {
                $puncakFoto = $this->handleImageUpload($request->file('foto_struktur_puncak'), 'puncak', $puncakFoto);
            }
            if (isset($strukturInput['puncak'])) {
                $strukturInput['puncak']['foto'] = $puncakFoto;
            }

            // BPH
            if (isset($strukturInput['bph']) && is_array($strukturInput['bph'])) {
                $bphProcessed = [];
                foreach ($strukturInput['bph'] as $idx => $bphItem) {
                    if (empty(trim($bphItem['nama'] ?? ''))) {
                        continue;
                    }
                    $bphFoto = $bphItem['old_foto'] ?? ($currentStruktur['bph'][$idx]['foto'] ?? null);
                    if ($request->boolean("hapus_foto_struktur_bph.{$idx}")) {
                        if ($bphFoto && file_exists(public_path('images/'.$bphFoto))) {
                            @unlink(public_path('images/'.$bphFoto));
                        }
                        $bphFoto = null;
                    } elseif ($request->hasFile("foto_struktur_bph.{$idx}")) {
                        $bphFoto = $this->handleImageUpload($request->file("foto_struktur_bph.{$idx}"), 'bph_'.$idx, $bphFoto);
                    }
                    $bphItem['foto'] = $bphFoto;
                    unset($bphItem['old_foto']);
                    $bphProcessed[] = $bphItem;
                }
                $strukturInput['bph'] = $bphProcessed;
            }

            // Divisi
            if (isset($strukturInput['divisi']) && is_array($strukturInput['divisi'])) {
                $divProcessed = [];
                foreach ($strukturInput['divisi'] as $idx => $divItem) {
                    if (empty(trim($divItem['nama'] ?? ''))) {
                        continue;
                    }
                    $divFoto = $divItem['old_foto'] ?? ($currentStruktur['divisi'][$idx]['foto'] ?? null);
                    if ($request->boolean("hapus_foto_struktur_divisi.{$idx}")) {
                        if ($divFoto && file_exists(public_path('images/'.$divFoto))) {
                            @unlink(public_path('images/'.$divFoto));
                        }
                        $divFoto = null;
                    } elseif ($request->hasFile("foto_struktur_divisi.{$idx}")) {
                        $divFoto = $this->handleImageUpload($request->file("foto_struktur_divisi.{$idx}"), 'divisi_'.$idx, $divFoto);
                    }
                    $divItem['foto'] = $divFoto;
                    unset($divItem['old_foto']);
                    $divProcessed[] = $divItem;
                }
                $strukturInput['divisi'] = $divProcessed;
            }

            $validated['struktur_organisasi'] = json_encode($strukturInput, JSON_UNESCAPED_UNICODE);
        }

        // Bersihkan atribut sementara non-kolom sebelum mass-assignment
        $keysToUnset = [
            'logo_file', 'hapus_logo',
            'sambutan_pengasuh_foto_file', 'hapus_sambutan_pengasuh_foto',
            'sejarah_foto_file', 'hapus_sejarah_foto',
            'visi_misi_foto_file', 'hapus_visi_misi_foto',
            'foto_struktur_puncak', 'hapus_foto_struktur_puncak',
            'foto_struktur_bph', 'hapus_foto_struktur_bph',
            'foto_struktur_divisi', 'hapus_foto_struktur_divisi',
            'struktur',
        ];
        foreach ($keysToUnset as $key) {
            unset($validated[$key]);
        }

        $setting->update($validated);

        return redirect()->route('admin.ppdb.index')->with('success', 'Pengaturan Informasi PPDB, Profil, Visi Misi, Foto/Logo & Struktur Organisasi berhasil disimpan dan langsung tayang di website.');
    }

    /**
     * Helper Simpan File Gambar ke public/images
     */
    protected function handleImageUpload(?UploadedFile $file, string $prefix, ?string $oldFilename = null): ?string
    {
        if (! $file) {
            return $oldFilename;
        }

        if (! file_exists(public_path('images'))) {
            mkdir(public_path('images'), 0755, true);
        }

        if ($oldFilename && file_exists(public_path('images/'.$oldFilename))) {
            @unlink(public_path('images/'.$oldFilename));
        }

        $extension = strtolower($file->getClientOriginalExtension() ?: 'png');
        $filename = $prefix.'_'.time().'_'.bin2hex(random_bytes(4)).'.'.$extension;
        $file->move(public_path('images'), $filename);

        return $filename;
    }
}
