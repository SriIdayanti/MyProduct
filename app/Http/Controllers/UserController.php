<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Import Auth facade
use App\Upload; // Import pertanyaan model
use App\User;

class UserController extends Controller
{
    public function index(Request $request)
    {
        // Mendapatkan id pengguna yang sedang masuk
        $userId = Auth::id();

        // Mengambil laporan pertanyaan yang dimiliki oleh pengguna yang sedang masuk
        $uploads = Upload::where('userID', $userId)->get();

        // Meneruskan data ke tampilan
        return view('user', compact('upload'));
    }

    
}
