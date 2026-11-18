<?php

namespace App\Enums;

enum UserRole: string
{
    case Admin = 'admin';
    case Pengajar = 'pengajar';
    case Pemilik = 'pemilik';

    /**
     * Mendapatkan label resmi dalam bahasa Indonesia.
     */
    public function label(): string
    {
        return Role::from($this->value)->label();
    }

    /**
     * Mendapatkan CSS class badge Bootstrap.
     */
    public function badgeClass(): string
    {
        return Role::from($this->value)->badgeClass();
    }

    /**
     * Mengecek izin melihat transaksi pembayaran.
     */
    public function canViewPembayaran(): bool
    {
        return Role::from($this->value)->canViewPembayaran();
    }

    /**
     * Mengecek izin mengelola transaksi pembayaran.
     */
    public function canManagePembayaran(): bool
    {
        return Role::from($this->value)->canManagePembayaran();
    }

    /**
     * Mendapatkan seluruh nilai string dari peran.
     *
     * @return array<int, string>
     */
    public static function values(): array
    {
        return Role::values();
    }

    /**
     * Mendapatkan opsi array value => label.
     *
     * @return array<string, string>
     */
    public static function options(): array
    {
        return Role::options();
    }
}
