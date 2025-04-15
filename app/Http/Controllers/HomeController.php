<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user(); // Ambil user yang sedang login
    
        if (!$user) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }
    
        // Ambil hanya upload yang dibuat oleh user yang sedang login
        $uploads = Upload::where('user_id', $user->id)->get();
    
        if ($user->role == 'Admin' || $user->role == 'Petugas') {
            return view('dashboard', compact('uploads'));
        } elseif ($user->role == 'User') {
            return view('user', compact('uploads'));
        }
    
        return abort(403, 'Unauthorized action.');
    }
    

}
