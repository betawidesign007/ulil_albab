<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string  ...$roles
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        if (! $request->user()) {
            return redirect()->route('login')->with('warning', 'Silakan login terlebih dahulu untuk mengakses halaman ini.');
        }

        if (empty($roles) || in_array($request->user()->role, $roles)) {
            return $next($request);
        }

        abort(403, 'Akses Ditolak: Peran akun Anda (' . ($request->user()->role_label ?? $request->user()->role) . ') tidak memiliki izin untuk mengakses halaman ini.');
    }
}
