@extends('layouts.app')

@section('content')
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <!-- Meta Tags -->
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        
        <title>Detail Siswa</title>
        <style>
            body {
                background-color: #f8f9fa; /* Warna latar belakang yang lebih terang */
            }
            h1 {
                color: #9B1B30; /* Warna red wine untuk judul */
                margin-bottom: 20px;
            }
            .card {
                border: none; /* Menghilangkan border default */
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Menambahkan bayangan pada kartu */
            }
            .btn {
                margin-right: 10px; /* Jarak antar tombol */
            }
        </style>
    </head>
    <body>
        <div class="container mt-5">
            <h1>Detail Siswa</h1>

            <!-- Tampilkan pesan sukses jika ada -->
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="card mt-3">
                <div class="card-body">
                    <h5 class="card-title">Informasi Siswa</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>ID:</strong> {{ $siswa->siswaID }}</p>
                            <p><strong>Nama:</strong> {{ $siswa->name }}</p>
                            <p><strong>Jenis Kelamin:</strong> {{ $siswa->jeniskelamin }}</p>
                            <p><strong>Tanggal Lahir:</strong> {{ $siswa->tanggallahir->format('d-m-Y') }}</p>
                            <p><strong>Alamat:</strong> {{ $siswa->alamat }}</p>
                            <p><strong>Email:</strong> {{ $siswa->email }}</p>
                        </div>
                        <div class="col-md-6 text-center">
                            @if($siswa && $siswa->image)
                                <img src="{{ asset('images/' . $siswa->image) }}" alt="Gambar Siswa" class="img-fluid rounded-circle" style="max-width: 200px;">
                            @else
                                <p class="mt-3 text-muted">Tidak ada gambar untuk siswa ini.</p>
                            @endif

                            <!-- Tombol untuk mengganti foto -->
                            <form action="{{ route('siswas.updatePhoto', $siswa->siswaID) }}" method="POST" enctype="multipart/form-data" class="mt-3">
                                @csrf
                                @method('PATCH')
                                <div class="mb-2">
                                    <input type="file" name="image" class="form-control" accept="image/*" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Ganti Foto</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-3">
                <a href="{{ route('siswas.index') }}" class="btn btn-secondary">Kembali ke Daftar Siswa</a>
                <a href="{{ route('siswas.edit', $siswa->siswaID) }}" class="btn btn-warning">Edit Siswa</a>
                
                <form action="{{ route('siswas.destroy', $siswa->siswaID) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Hapus Siswa</button>
                </form>
            </div>
        </div>

        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pzjw8f+ua7Kw1TIq0lzKp63Q6J" crossorigin="anonymous"></script>
    </body>
    </html>
@endsection
