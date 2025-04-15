<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Silakan login.');
        }
    
        if (!in_array(auth()->user()->role, $roles)) {
            return redirect()->route('dashboard')->with('error', 'Akses ditolak!');
        }
    
        return $next($request);
    }
    
}
