<?php

namespace App\Http\Controllers;

use App\Models\Penilaian;
use App\Models\Upload;
use Illuminate\Http\Request;

class PenilaianController extends Controller
{
    public function index()
    {
        // Fetch all penilaians with related upload only
        $penilaians = Penilaian::with('upload')->get();

        return view('penilaian.index', compact('penilaians'));
    }
    public function cetakPenilaian(Request $request) // Perbaiki nama fungsi
    {
        $penilaianCetak = Penilaian::with('upload', 'user')->latest()->get();
        return view('penilaian.cetakpenilaian', compact('penilaianCetak'));
    }

    public function cetakForm()
    {
        return view('penilaian.Cetak-penilaian-form');
    }

    public function cetakPenilaianPertanggal($tglawal = null, $tglakhir = null)
    {
        if ($tglawal && $tglakhir) {
            $penilaian = Penilaian::whereBetween('created_at', [$tglawal, $tglakhir])->get();
            return view('penilaian.cetak-data-penilaian-pertanggal', ['penilaian' => $penilaian]);
        } else {
            return view('penilaian.cetak-data-penilaian-pertanggal');
        }
    
    }
    public function create()
    {
        $uploads = Upload::all();
        $penilaianUploadIDs = Penilaian::pluck('uploadID')->toArray(); // ambil uploadID yang sudah dinilai
    
        return view('penilaian.create', compact('uploads', 'penilaianUploadIDs'));
    }
    

    public function store(Request $request)
    {
        // Debug input (hanya untuk pengembangan, hapus di produksi)
        logger('Request Data: ', $request->all());
    
        // Validasi data
        $validatedData = $request->validate([
            'uploadID' => 'required|exists:upload,uploadID',
            'rating' => 'required|integer|min:1|max:5',
            'komentar' => 'nullable|string',
            'tanggal' => 'required|date',
        ]);
    
        // Pastikan data uploadID ditemukan
        $upload = Upload::find($validatedData['uploadID']);
        if (!$upload) {
            logger('Upload Not Found: ', ['uploadID' => $validatedData['uploadID']]);
            return redirect()->back()->withErrors(['uploadID' => 'Upload not found.'])->withInput();
        }
    
        try {
            // Simpan data ke tabel `penilaian`
            Penilaian::create($validatedData);
    
            return redirect()->route('penilaian.index')->with('success', 'Penilaian berhasil disimpan!');
        } catch (\Exception $e) {
            logger('Error saving penilaian: ', ['error' => $e->getMessage()]);
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan saat menyimpan penilaian.'])->withInput();
        }
    }
    
    public function edit($id)
    {
        $penilaian = Penilaian::findOrFail($id); 
        $upload = Upload::all();
    
        return view('penilaian.edit', compact('penilaian', 'upload'));
    }
    

    public function update(Request $request, $id)
    {
        $penilaian = Penilaian::findOrFail($id);
    
        // Update data dengan validasi
        $penilaian->update([
            'uploadID' => $request->uploadID,
            'rating' => $request->rating,
            'komentar' => $request->komentar,
            'tanggal' => $request->tanggal,
        ]);
    
        return redirect()->route('penilaian.index')->with('success', 'Penilaian berhasil diperbarui!');
    }
    
    
    public function destroy($id)
    {
        // Delete penilaian
        $penilaian = Penilaian::findOrFail($id);
        $penilaian->delete();

        return redirect()->route('penilaian.index')->with('success', 'Penilaian berhasil dihapus!');
    }
}
