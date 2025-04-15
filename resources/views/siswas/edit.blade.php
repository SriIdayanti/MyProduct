@extends('layouts.template')
@section('content')
    <div class="container mt-5">
        <div class="card shadow-lg p-4 rounded">
            <h2 class="text-center mb-4 text-primary fw-bold">Edit Siswa</h2>

            <!-- Form untuk mengedit siswa -->
            <form action="{{ route('siswas.update', $siswa->siswaID) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Input Nama -->
                <div class="mb-3">
                    <label for="name" class="form-label fw-bold">Nama</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $siswa->name) }}" required>
                    @error('name') <div class="text-danger small">{{ $message }}</div> @enderror
                </div>

                <!-- Input Jenis Kelamin -->
                <div class="mb-3">
                    <label for="jeniskelamin" class="form-label fw-bold">Jenis Kelamin</label>
                    <select name="jeniskelamin" id="jeniskelamin" class="form-select" required>
                        <option value="L" {{ old('jeniskelamin', $siswa->jeniskelamin) == 'L' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="P" {{ old('jeniskelamin', $siswa->jeniskelamin) == 'P' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                    @error('jeniskelamin') <div class="text-danger small">{{ $message }}</div> @enderror
                </div>

                <!-- Input Tanggal Lahir -->
                <div class="mb-3">
                    <label for="tanggallahir" class="form-label fw-bold">Tanggal Lahir</label>
                    <input type="date" name="tanggallahir" id="tanggallahir" class="form-control" 
                           value="{{ old('tanggallahir', $siswa->tanggallahir ? $siswa->tanggallahir->format('Y-m-d') : '') }}" required>
                    @error('tanggallahir') <div class="text-danger small">{{ $message }}</div> @enderror
                </div>

                <!-- Input Alamat -->
                <div class="mb-3">
                    <label for="alamat" class="form-label fw-bold">Alamat</label>
                    <textarea name="alamat" id="alamat" class="form-control" rows="3" required>{{ old('alamat', $siswa->alamat) }}</textarea>
                    @error('alamat') <div class="text-danger small">{{ $message }}</div> @enderror
                </div>

                <!-- Input Email -->
                <div class="mb-3">
                    <label for="email" class="form-label fw-bold">Email</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $siswa->email) }}" required>
                    @error('email') <div class="text-danger small">{{ $message }}</div> @enderror
                </div>

                <!-- Gambar Produk -->
                <div class="mb-3">
                    <label for="image" class="form-label fw-bold">Gambar Produk</label>
                    <div class="d-flex gap-2">
                        <button type="button" class="btn btn-outline-primary" id="openCamera">
                            <i class="bi bi-camera"></i> Ambil Foto
                        </button>
                        <button type="button" class="btn btn-outline-secondary" id="chooseFile">
                            <i class="bi bi-image"></i> Pilih Foto
                        </button>
                    </div>
                    <input type="file" class="form-control d-none" id="image" name="image" accept="image/*" capture="environment">
                    
                    <!-- Preview Gambar -->
                    <div class="mt-3 text-center">
                        <img id="previewImage" src="#" class="img-thumbnail d-none" width="200px">
                    </div>
                </div>

                <!-- Tombol Update dan Kembali -->
                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('siswas.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-circle"></i> Update
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- CSS Styling -->
    <style>
        .card {
            max-width: 700px;
            margin: auto;
            border-radius: 10px;
        }

        .form-control, .form-select {
            border-radius: 8px;
            border: 1px solid #ddd;
            padding: 10px;
            font-size: 16px;
        }

        .btn {
            border-radius: 8px;
            font-size: 16px;
            transition: all 0.3s;
        }

        .btn-primary {
            background-color: rgb(17, 87, 218);
            border: none;
        }

        .btn-primary:hover {
            background-color: rgb(6, 27, 216);
        }

        .btn-outline-primary:hover, .btn-outline-secondary:hover {
            transform: scale(1.05);
        }

        .img-thumbnail {
            border-radius: 10px;
            border: 2px solid #ddd;
        }
    </style>

    <!-- JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Event untuk tombol kamera & galeri
            document.getElementById('openCamera').addEventListener('click', function () {
                document.getElementById('image').click();
            });

            document.getElementById('chooseFile').addEventListener('click', function () {
                document.getElementById('image').click();
            });

            // Preview Gambar
            document.getElementById('image').addEventListener('change', function(event) {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const preview = document.getElementById('previewImage');
                        preview.src = e.target.result;
                        preview.classList.remove('d-none');
                    };
                    reader.readAsDataURL(file);
                }
            });
        });
    </script>
@endsection
