<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleApiMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Cek apakah user sudah login via JWT
        if (!auth('api')->check()) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $user = auth('api')->user();

        // Cek role
        if (!in_array($user->role, $roles)) {
            return response()->json(['message' => 'Akses ditolak'], 403);
        }

        return $next($request);
    }
}
