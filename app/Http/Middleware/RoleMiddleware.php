<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  mixed  ...$roles
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!Auth::check()) {
            return redirect('/login'); // Redirect ke login jika belum login
        }

        // Dapatkan role user
        $userRole = Auth::user()->role;

        // Cek apakah user memiliki salah satu role yang diizinkan
        if (!in_array($userRole, $roles)) {
            return redirect('/forbidden')->with('error', 'You do not have access to this page.');
        }

        return $next($request);
    }
}
