<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\UploadNotification;
use App\Models\Upload; // Pastikan model Upload ada
use Exception;

class EmailController extends Controller
{
    public function kirimEmail(): string
    {
        // Ambil data produk terbaru dari database (pastikan modelnya benar)
        $upload = Upload::latest()->first();

        // Jika tidak ada data, kembalikan pesan error
        if (!$upload) {
            return "Tidak ada produk yang ditemukan!";
        }

        try {
            // Kirim email dengan data produk
            Mail::to('user@example.com')->send(new UploadNotification($upload));

            return "Email berhasil dikirim!";
        } catch (Exception $e) {
            return "Gagal mengirim email: " . $e->getMessage();
        }
    }
}
