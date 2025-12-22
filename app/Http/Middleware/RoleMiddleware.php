<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // Jika tidak login
        if (!Auth::check()) {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Unauthenticated.'], 401);
            }
            return redirect('/login');
        }

        // Jika role sesuai
        if (in_array(Auth::user()->role, $roles)) {
            return $next($request);
        }

        // Jika role TIDAK sesuai (Bukan Admin)
        if ($request->expectsJson()) {
            return response()->json(['message' => 'Forbidden: Anda bukan Admin!'], 403);
        }

        return redirect('/dashboard');
    }
}
