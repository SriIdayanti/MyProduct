<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class PetugasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        $this->middleware(function ($request, $next) {
            if (auth()->user()->role !== 'admin') {
                return redirect()->route('home')->with('error', 'Anda tidak memiliki akses.');
            }
            return $next($request);
        });
    }

    public function index(Request $request)
    {
        $search = $request->input('search');

        $petugas = User::where('role', 'petugas')
                        ->when($search, function ($query, $search) {
                            return $query->where('name', 'like', "%{$search}%");
                        })
                        ->orderBy('name', 'asc')
                        ->paginate(10);

        return view('petugas.index', compact('petugas'));
    }

    public function create()
    {
        return view('petugas.create');
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'phone' => 'required|string',
            'role' => 'required|string|in:admin,petugas',
            'jenis_kelamin' => 'required|in:laki-laki,perempuan',
            'alamat' => 'nullable|string|max:255',
        ];

        if ($request->role === 'petugas') {
            $rules['jabatan'] = 'required|string|max:255';
        } else {
            $rules['jabatan'] = 'nullable|string|max:255';
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'role' => $request->role,
            'jabatan' => $request->jabatan,
            'jenis_kelamin' => $request->jenis_kelamin,
            'alamat' => $request->alamat,
        ]);

        return redirect()->route('petugas.index')->with('success', 'Petugas berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $petugas = User::findOrFail($id);
        return view('petugas.edit', compact('petugas'));
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'role' => 'required|string|in:admin,petugas',
            'jenis_kelamin' => 'required|in:laki-laki,perempuan',
            'alamat' => 'nullable|string|max:255',
            'password' => 'nullable|string|min:8',
        ];

        if ($request->role === 'petugas') {
            $rules['jabatan'] = 'required|string|max:255';
        } else {
            $rules['jabatan'] = 'nullable|string|max:255';
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $petugas = User::findOrFail($id);

        $data = $request->except(['password']);
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $petugas->update($data);

        return redirect()->route('petugas.index')->with('success', 'Petugas berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $petugas = User::findOrFail($id);

        if ($petugas->role === 'admin') {
            return redirect()->route('petugas.index')->with('error', 'Admin tidak bisa dihapus.');
        }

        $petugas->delete();

        return redirect()->route('petugas.index')->with('success', 'Petugas berhasil dihapus.');
    }
}
