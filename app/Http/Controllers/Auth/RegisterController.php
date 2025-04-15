<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    use RegistersUsers;

    /**
     * Redirect setelah registrasi.
     *
     * @var string
     */
    protected function redirectTo()
    {
        if (auth()->user()->role == 'admin') {
            return '/admin';
        } elseif (auth()->user()->role == 'petugas') {
            return '/petugas';
        }
        return '/welcome';
    }

    /**
     * Hanya tamu yang bisa mengakses halaman ini.
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Tampilkan form registrasi.
     */
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    /**
     * Validasi data registrasi.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'nik' => 'required|string|max:16|unique:users',
            'phone' => 'required|string|max:15',
            'jabatan' => 'nullable|string|max:255',
            'jenis_kelamin' => 'nullable|string|max:10',
            'alamat' => 'nullable|string|max:255',
            'nama_lengkap' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    }

    /**
     * Buat user baru setelah registrasi.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        // Simpan gambar jika ada
        $imageName = null;
        if (isset($data['image']) && $data['image']->isValid()) {
            $imageName = time() . '.' . $data['image']->getClientOriginalExtension();
            $data['image']->move(public_path('images'), $imageName);
        }

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'nik' => $data['nik'],
            'phone' => $data['phone'],
            'jabatan' => $data['jabatan'] ?? null,
            'jenis_kelamin' => $data['jenis_kelamin'] ?? null,
            'alamat' => $data['alamat'] ?? null,
            'nama_lengkap' => $data['nama_lengkap'] ?? null,
            'image' => $imageName,
        ]);
    }

    /**
     * Tangani request registrasi manual.
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        $user = $this->create($request->all());

        Auth::login($user);

        return redirect($this->redirectTo());
    }
}
