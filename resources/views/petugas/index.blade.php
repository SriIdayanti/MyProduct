<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Petugas</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        /* Memberi jarak antara navbar dan konten */
        .container {
            margin-top: 80px; /* Sesuaikan tinggi navbar */
        }
    </style>
</head>
<body class="bg-gray-100 min-h-screen">
@extends('layouts.app')

@section('content')

<div class="container mx-auto my-10 p-6 bg-white shadow-lg rounded-lg mt-20">
    <h1 class="text-3xl font-bold mb-6 text-center">Daftar Petugas</h1>
    
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4" role="alert">
            {{ session('success') }}
        </div>
    @endif
    
    <div class="flex justify-between items-center mb-4">
        <a href="{{ route('petugas.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Tambah Petugas</a>
        
        <form action="{{ route('petugas.index') }}" method="GET" class="flex">
            <input type="text" name="search" class="border border-gray-300 p-2 rounded-l-md" placeholder="Cari nama petugas" value="{{ request('search') }}">
            <button type="submit" class="bg-gray-600 text-white px-4 rounded-r-md hover:bg-gray-700">Cari</button>
        </form>
    </div>
    
    <div class="overflow-x-auto">
        <table class="w-full border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border border-gray-300 px-4 py-2">Nama</th>
                    <th class="border border-gray-300 px-4 py-2">Email</th>
                    <th class="border border-gray-300 px-4 py-2">No. Telepon</th>
                    <th class="border border-gray-300 px-4 py-2">Jenis Kelamin</th>
                    <th class="border border-gray-300 px-4 py-2">Alamat</th>
                    <th class="border border-gray-300 px-4 py-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($petugas as $petugas)
                    <tr class="bg-white hover:bg-gray-100">
                        <td class="border border-gray-300 px-4 py-2">{{ $petugas->name }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $petugas->email }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $petugas->phone }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $petugas->jenis_kelamin }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $petugas->alamat }}</td>
                        <td class="border border-gray-300 px-4 py-2 flex space-x-2">
                            <a href="{{ route('petugas.edit', $petugas->id) }}" class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600">Edit</a>
                            <form action="{{ route('petugas.destroy', $petugas->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?');">
                                {{ csrf_field() }}
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        setTimeout(() => {
            const alertElement = document.querySelector('.bg-green-100');
            if (alertElement) alertElement.style.display = 'none';
        }, 3000);
    });
</script>

@endsection
</body>
</html>
