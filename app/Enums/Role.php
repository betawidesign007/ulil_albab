<?php

namespace App\Enums;

enum Role: string
{
    case Admin = 'admin';
    case Pengajar = 'pengajar';
    case Pemilik = 'pemilik';

    /**
     * Mendapatkan label resmi dalam bahasa Indonesia untuk masing-masing peran.
     */
    public function label(): string
    {
        return match ($this) {
            self::Admin => 'Administrator',
            self::Pengajar => 'Dewan Pengajar / Asatidz',
            self::Pemilik => 'Pemilik / Mudir Yayasan',
        };
    }

    /**
     * Mendapatkan CSS class badge Bootstrap untuk masing-masing peran.
     */
    public function badgeClass(): string
    {
        return match ($this) {
            self::Admin => 'bg-danger',
            self::Pengajar => 'bg-primary',
            self::Pemilik => 'bg-warning text-dark',
        };
    }

    /**
     * Mengecek apakah peran ini memiliki hak akses untuk melihat data transaksi pembayaran.
     * Pengajar tidak memiliki hak akses pembayaran.
     */
    public function canViewPembayaran(): bool
    {
        return match ($this) {
            self::Admin, self::Pemilik => true,
            self::Pengajar => false,
        };
    }

    /**
     * Mengecek apakah peran ini berwenang mengelola (tambah, sunting, hapus) transaksi pembayaran.
     */
    public function canManagePembayaran(): bool
    {
        return $this === self::Admin;
    }

    /**
     * Mendapatkan seluruh nilai string dari enum peran.
     *
     * @return array<int, string>
     */
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    /**
     * Mendapatkan opsi array value => label untuk keperluan dropdown form.
     *
     * @return array<string, string>
     */
    public static function options(): array
    {
        $options = [];
        foreach (self::cases() as $role) {
            $options[$role->value] = $role->label();
        }

        return $options;
    }
}
