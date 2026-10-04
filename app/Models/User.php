<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'password', 'role', 'no_hp', 'jabatan'])]
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
        ];
    }

    /**
     * Role checking helpers
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isPengajar(): bool
    {
        return $this->role === 'pengajar';
    }

    public function isPemilik(): bool
    {
        return $this->role === 'pemilik';
    }

    public function getRoleBadgeClassAttribute(): string
    {
        return match ($this->role) {
            'admin' => 'bg-danger',
            'pengajar' => 'bg-primary',
            'pemilik' => 'bg-warning text-dark',
            default => 'bg-secondary'
        };
    }

    public function getRoleLabelAttribute(): string
    {
        return match ($this->role) {
            'admin' => 'Administrator',
            'pengajar' => 'Dewan Pengajar / Asatidz',
            'pemilik' => 'Pemilik / Mudir Yayasan',
            default => ucfirst($this->role)
        };
    }
}
