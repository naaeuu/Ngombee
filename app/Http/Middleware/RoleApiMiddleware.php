<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleApiMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Gunakan guard 'api' secara eksplisit untuk JWT
        if (!Auth::guard('api')->check()) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized. Token tidak ditemukan atau tidak valid.'
            ], 401);
        }

        $user = Auth::guard('api')->user();

        // Cek apakah role user ada dalam daftar role yang diizinkan
        if (!in_array($user->role, $roles)) {
            return response()->json([
                'success' => false,
                'message' => 'Akses ditolak. Role Anda (' . $user->role . ') tidak memiliki izin.'
            ], 403);
        }

        return $next($request);
    }
}
