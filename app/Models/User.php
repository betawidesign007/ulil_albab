<?php

namespace App\Models;

use App\Enums\Role;
use App\Notifications\ResetPasswordNotification;
use Carbon\Carbon;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable([
    'name',
    'email',
    'password',
    'role',
    'no_hp',
    'jabatan',
    'tanggal_lahir',
    'usia',
    'nama_orang_tua',
    'alamat',
])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'tanggal_lahir' => 'date',
            'usia' => 'integer',
            'role' => Role::class,
        ];
    }

    /**
     * Get the calculated age if usia is not stored directly.
     */
    public function getUsiaAttribute(?int $value): ?int
    {
        if ($value !== null) {
            return $value;
        }

        if ($this->tanggal_lahir) {
            return Carbon::parse($this->tanggal_lahir)->age;
        }

        return null;
    }

    /**
     * Transaksi pembayaran yang diproses oleh user / petugas ini.
     */
    public function pembayarans(): HasMany
    {
        return $this->hasMany(Pembayaran::class, 'user_id');
    }

    /**
     * Role checking helpers
     */
    public function isAdmin(): bool
    {
        return $this->role === Role::Admin || $this->role === 'admin' || $this->role?->value === 'admin';
    }

    public function isPengajar(): bool
    {
        return $this->role === Role::Pengajar || $this->role === 'pengajar' || $this->role?->value === 'pengajar';
    }

    public function isPemilik(): bool
    {
        return $this->role === Role::Pemilik || $this->role === 'pemilik' || $this->role?->value === 'pemilik';
    }

    /**
     * Mengecek apakah user berhak melihat transaksi pembayaran.
     * Pengajar tidak memiliki hak akses pembayaran.
     */
    public function canViewPembayaran(): bool
    {
        return ! $this->isPengajar();
    }

    /**
     * Mengecek apakah user berwenang mengelola (tambah, edit, hapus) pembayaran.
     */
    public function canManagePembayaran(): bool
    {
        return $this->isAdmin();
    }

    /**
     * Mendapatkan nilai string dari peran pengguna.
     */
    public function getRoleValueAttribute(): string
    {
        return $this->role instanceof Role ? $this->role->value : (string) $this->role;
    }

    public function getRoleBadgeClassAttribute(): string
    {
        $role = $this->role instanceof Role ? $this->role : Role::tryFrom((string) $this->role);

        return $role?->badgeClass() ?? 'bg-secondary';
    }

    public function getRoleLabelAttribute(): string
    {
        $role = $this->role instanceof Role ? $this->role : Role::tryFrom((string) $this->role);

        return $role?->label() ?? ucfirst((string) ($this->role?->value ?? $this->role));
    }

    /**
     * Kirim notifikasi reset password kustom SIMPONPES
     */
    public function sendPasswordResetNotification($token): void
    {
        $this->notify(new ResetPasswordNotification($token));
    }
}
