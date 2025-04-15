<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use App\Models\Siswa;

class ProfilController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        $siswa = Siswa::where('user_id', $user->id)->first(); // Ambil data siswa berdasarkan user yang login
        return view('profil.edit', compact('user', 'siswa'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $siswa = Siswa::where('user_id', $user->id)->first(); // Ambil data siswa

        $request->validate([
            'name' => 'required|string|max:255',
            'kelas' => 'required|string|max:255',
            'sekolah' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $user->name = $request->name;
        if ($siswa) {
            $siswa->kelas = $request->kelas;
            $siswa->sekolah = $request->sekolah;
            $siswa->save();
        }

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();

            // Resize gambar
            $image = Image::make($file);
            $image->resize(150, 150, function ($constraint) {
                $constraint->aspectRatio();
            });

            // Simpan ke storage
            $path = 'public/images/' . $filename;
            Storage::put($path, (string) $image->encode());

            // Simpan ke database
            $user->image = 'storage/images/' . $filename;
        }

        $user->save();

        return redirect()->route('user.profile')->with('success', 'Profil berhasil diperbarui');
    }
}
