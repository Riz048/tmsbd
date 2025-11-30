<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleManual
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // Pastikan user sudah login
        if (!session('logged_in')) {
            return redirect('/login');
        }

        // Ambil role user dari session
        $currentRole = session('role');

        // Jika role TIDAK ada di daftar role yang diperbolehkan → tolak
        if (!in_array($currentRole, $roles)) {
            abort(403, 'Akses ditolak');
        }

        return $next($request);
    }
}
