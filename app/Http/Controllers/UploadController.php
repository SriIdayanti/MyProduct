<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Mail;
use App\Mail\UploadNotification;
use App\Models\Upload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        // Menampilkan data upload dengan pencarian berdasarkan nama produk
        $uploads = Upload::when($search, function ($query) use ($search) {
            return $query->where('nama', 'like', '%' . $search . '%');
        })->paginate(10);

        return view('user', compact('uploads', 'search'));
    }

    public function create()
    {
        return view('upload.create');
    }
    public function store(Request $request)
    {
        $rules = [
            'descriptionproduct' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'tanggaldibuat' => 'required|date',
            'namaproduk' => 'required|string',
            'link' => 'required|string',
            'kategoriproduk' => 'required|string',
        ];
    
        $this->validate($request, $rules);
    
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
        } else {
            $imageName = null;
        }
    
        $upload = new Upload;
        $upload->user_id = auth()->id(); // Tambahkan user_id
        $upload->name = $request->name;
        $upload->descriptionproduct = $request->descriptionproduct;
        $upload->image = $imageName;
        $upload->tanggaldibuat = $request->tanggaldibuat;
        $upload->namaproduk = $request->namaproduk;
        $upload->link = $request->link;
        $upload->kategoriproduk = $request->kategoriproduk;
        $upload->save();

        // Mengirim email notifikasi ke pengguna
        Mail::to(auth()->user()->email)->send(new UploadNotification($upload));
    
        return redirect()->route('upload.index')->with('success', 'Upload created successfully.');
    }
    

    public function edit($id)
    {
        $upload = Upload::findOrFail($id);

        return view('upload.edit', compact('upload'));
    }
    
   

    public function update(Request $request, $id)
    {
        $rules = [
            'name'              => 'required|string|max:255',
            'namaproduk'        => 'required|string|max:255',
            'kategoriproduk'    => 'required|string|max:255',
            'descriptionproduct'=> 'required|string',
            'link'              => 'required|url',
            'image'             => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    
        $this->validate($request, $rules);
    
        try {
            $upload = Upload::findOrFail($id);
    
            $upload->name = $request->name;
            $upload->namaproduk = $request->namaproduk;
            $upload->link = $request->link;
            $upload->kategoriproduk = $request->kategoriproduk;
            $upload->descriptionproduct = $request->descriptionproduct;
    
            // Jika ada gambar baru
            if ($request->hasFile('image')) {
                // Hapus gambar lama
                if ($upload->image) {
                    $oldImagePath = public_path('images/' . $upload->image);
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath);
                    }
                }
    
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images'), $imageName);
                $upload->image = $imageName;
            }
    
            $upload->save();
    
            return redirect()->route('upload.index')->with('success', 'Produk berhasil diperbarui.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }
    
    public function destroy($id)
    {
        $upload = Upload::findOrFail($id);

        // Delete the image from storage if it exists
        if ($upload->image && Storage::exists('public/images/' . $upload->image)) {
            Storage::delete('public/images/' . $upload->image);
        }

        $upload->delete();

        return redirect()->route('upload.index')->with('success', 'Upload deleted successfully.');
    }

   // app/Http/Controllers/UploadController.php
public function show($id)
{
    // Ambil data upload beserta penilaians terkait
    $upload = Upload::with('penilaians')->findOrFail($id);

    return view('upload.show', compact('upload'));
}

public function kirimLaporan()
    {
        // Ambil semua data produk yang diunggah
        $uploads = Upload::all();

        // Kirim email ke Mailtrap
        Mail::to('admin@example.com')->send(new UploadProdukMail($uploads));

        return redirect()->route('upload.index')->with('success', 'Laporan berhasil dikirim ke email!');
    }


   
}
