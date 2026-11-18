<?php

namespace App\Http\Middleware;

/**
 * Class EnsureRole
 *
 * Dipertahankan untuk kompatibilitas ke belakang (backward compatibility).
 * Logika utama didelegasikan ke RoleMiddleware.
 */
class EnsureRole extends RoleMiddleware
{
    // Mewarisi seluruh penanganan logika peran dari RoleMiddleware
}
