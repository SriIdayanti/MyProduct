<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureUserRole
{
    public function handle(Request $request, Closure $next, $role)
    {
        // Cek apakah pengguna memiliki role yang sesuai
        if (Auth::check() && Auth::user()->role === $role) {
            return $next($request);
        }

        // Redirect jika role tidak sesuai
        return redirect('/home')->with('error', 'You do not have access to this page.');
    }
}