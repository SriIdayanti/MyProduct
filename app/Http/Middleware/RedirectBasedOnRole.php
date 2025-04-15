<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RedirectBasedOnRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next)
    {
        if (auth()->check()) {
            $role = auth()->user()->role;
            
            if ($role == 'admin') {
                return redirect('/admin/dashboard');
            } elseif ($role == 'petugas') {
                return redirect('/petugas/dashboard');
            }
        }
        
        return $next($request);
    }
    
}
