<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo()
    {
        if (auth()->user()->role == 'admin') {
            return route('admin.dashboard');
        } elseif (auth()->user()->role == 'petugas') {
            return route('petugas.dashboard');
        }
        return route('user.dashboard');
    }
    
    protected function authenticated(Request $request, $user)
{
    if ($user->role == 'admin') {
        return redirect()->route('admin.dashboard');
    } elseif ($user->role == 'petugas') {
        return redirect()->route('petugas.dashboard');
    } else {
        return redirect()->route('user.dashboard');
    }
}

}
