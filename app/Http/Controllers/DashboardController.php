<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Upload; // Pastikan model Upload di-import

class DashboardController extends Controller
{
    public function index()
    {
        $uploads = Upload::all();
        dd($uploads); // Cek apakah data ada

        if (auth()->user()->role == 'admin' || auth()->user()->role == 'petugas') {
            return view('dashboard', compact('uploads'));
        }
        

        return view('user', compact('uploads')); // untuk user
    }

    public function dashboard()
    {
        // Ambil semua data dari tabel uploads
        $uploads = Upload::all();

        // Kirim data ke view
        return view('dashboard', compact('uploads'));
    }
}
