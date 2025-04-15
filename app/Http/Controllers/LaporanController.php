<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Upload;



class LaporanController extends Controller
{
    public function index(Request $request)
    {
        return view('Laporan.index');
    }

    public function PDF(Request $request)
    {
        // Validasi input tanggal awal dan akhir
        $tglawal = $request->tglawal;
        $tglakhir = $request->tglakhir;

        // Ambil data pertanyaan yang sesuai dengan rentang tanggal
        $dataupload = Upload::whereBetween('created_at', [$tglawal, $tglakhir])->get();

        // Render view ke PDF
        $pdf = PDF::loadView('Laporan.pdf', compact('dataupload', 'tglawal', 'tglakhir'));

        // Jika data tidak ditemukan, gunakan tampilan kop surat tanpa data
        if ($dataupload->isEmpty()) {
            return $pdf->stream('laporan_kop_surat.pdf'); // Ganti nama file sesuai kebutuhan
        }

        // Menghasilkan output dalam bentuk file PDF dengan data
        return $pdf->stream('laporan_upload.pdf');
    }
}
