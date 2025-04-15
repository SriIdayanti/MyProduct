<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Upload;

class WelcomeController extends Controller
{
    public function index()
    {
        // Ambil semua data dari tabel uploads
        $uploads = Upload::all();

        // Kirim data ke view
        return view('welcome', compact('uploads'));
    }
}
