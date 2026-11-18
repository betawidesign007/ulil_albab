<?php

namespace App\Http\Middleware;

use App\Enums\Role;
use BackedEnum;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request and ensure the user has the required role.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next, string|BackedEnum ...$roles): Response
    {
        if (! $request->user()) {
            return redirect()->route('login')->with('warning', 'Silakan login terlebih dahulu untuk mengakses halaman ini.');
        }

        $user = $request->user();
        $userRoleValue = $user->role instanceof BackedEnum ? $user->role->value : (string) $user->role;

        // Mendukung argumen berupa BackedEnum, string tunggal, atau comma-delimited string 'admin,pemilik'
        $allowedRoles = [];
        foreach ($roles as $role) {
            if ($role instanceof BackedEnum) {
                $allowedRoles[] = $role->value;
            } else {
                foreach (explode(',', (string) $role) as $part) {
                    $trimmed = trim($part);
                    if ($trimmed !== '') {
                        $allowedRoles[] = $trimmed;
                    }
                }
            }
        }

        if (empty($allowedRoles) || in_array($userRoleValue, $allowedRoles, true)) {
            return $next($request);
        }

        $userRoleLabel = $user->role_label ?? Role::tryFrom($userRoleValue)?->label() ?? ucfirst($userRoleValue);
        $allowedRolesFormatted = implode(', ', array_map(function (string $r) {
            $enumRole = Role::tryFrom($r);

            return $enumRole ? $enumRole->label() : match ($r) {
                'admin' => 'Administrator',
                'pengajar' => 'Dewan Pengajar / Asatidz',
                'pemilik' => 'Pemilik / Mudir Yayasan',
                default => ucfirst($r),
            };
        }, array_unique($allowedRoles)));

        abort(403, "Akses Ditolak: Anda saat ini masuk dengan akun '{$user->name}' sebagai [{$userRoleLabel}]. Halaman ini hanya dapat diakses oleh: [{$allowedRolesFormatted}]. Jika Anda salah masuk akun, silakan keluar dan login kembali dengan akun yang berwenang.");
    }
}
