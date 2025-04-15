<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    // Menampilkan daftar siswa
    public function index()
    {
        $siswas = Siswa::all(); // Ambil semua data siswa
        return view('siswas.index', compact('siswas'));
    }

    // Menampilkan form untuk membuat siswa baru
    public function create()
    {
        return view('siswas.create');
    }

    // Menyimpan data siswa baru
    public function store(Request $request)
    {
        // Validasi data yang dikirimkan
        $request->validate([
           
            'jeniskelamin' => 'required|string',
            'tanggallahir' => 'required|date',
            'alamat' => 'required|string',
            'nisn' => 'required|string',
            'email' => 'required|email',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi gambar
        ]);

        // Upload image if provided
        $imageName = null; // Inisialisasi nama gambar
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
        }

        // Simpan data siswa baru
        Siswa::create(array_merge($request->all(), ['image' => $imageName]));

        // Redirect atau beri feedback setelah sukses
        return redirect()->route('siswas.index')->with('success', 'Siswa berhasil ditambahkan.');
    }

    // Menampilkan detail siswa
    public function show($id)
    {
        $siswa = Siswa::findOrFail($id);
        return view('siswas.show', compact('siswa'));
    }

    // Menampilkan form untuk mengedit siswa
    public function edit($id)
    {
        // Ambil data siswa berdasarkan ID
        $siswa = Siswa::findOrFail($id);
        return view('siswas.edit', compact('siswa')); // Kirim data siswa ke form edit
    }

    // Menyimpan perubahan data siswa
    public function update(Request $request, $id)
    {
        // Validasi data yang dikirimkan
        $request->validate([
           
            'name' => 'required|string|max:255',
            'nisn' => 'required|string',
            'jeniskelamin' => 'required|string',
            'tanggallahir' => 'required|date',
            'alamat' => 'required|string',
            'email' => 'required|email',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi gambar
        ]);
    
        // Ambil data siswa berdasarkan ID
        $siswa = Siswa::findOrFail($id);
    
        // Update data siswa
        $data = $request->all();
    
        // Jika ada gambar baru, upload dan simpan nama file
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($siswa->image) {
                $oldImagePath = public_path('images/' . $siswa->image);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath); // Hapus file gambar lama
                }
            }
    
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $data['image'] = $imageName; // Simpan nama gambar baru
        }
    
        // Update data siswa
        $siswa->update($data);
    
        // Redirect atau beri feedback setelah sukses
        return redirect()->route('siswas.index')->with('success', 'Siswa berhasil diupdate.');
    }
    public function destroy($id)
    {
        $siswa = Siswa::findOrFail($id);

        // Hapus gambar jika ada
        if ($siswa->image) {
            $oldImagePath = public_path('images/' . $siswa->image);
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath); // Hapus file gambar
            }
        }

        // Hapus siswa dari database
        $siswa->delete();

        // Redirect atau beri feedback setelah sukses
        return redirect()->route('siswas.index')->with('success', 'Siswa berhasil dihapus.');
    }
    public function updatePhoto(Request $request, $siswaID)
    {
        // Validasi file gambar
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        // Cari data siswa berdasarkan ID
        $siswa = Siswa::findOrFail($siswaID);
    
        // Hapus foto lama jika ada
        if ($siswa->image) {
            $oldImagePath = public_path('images/' . $siswa->image);
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath); // Hapus file gambar lama
            }
        }
    
        // Upload foto baru
        $imageName = time() . '_' . $request->file('image')->getClientOriginalName();
        $request->file('image')->move(public_path('images'), $imageName);
    
        // Update nama file di database
        $siswa->image = $imageName;
        $siswa->save();
    
        // Redirect kembali ke halaman detail siswa
        return redirect()->route('siswas.show', $siswaID)->with('success', 'Foto siswa berhasil diperbarui!');
    }
    
}