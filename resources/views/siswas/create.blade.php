@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <!-- Card untuk Form -->
            <div class="card shadow-lg border-0">
                <div class="card-header bg-primary text-white text-center">
                    <h3>Tambah Siswa Baru</h3>
                </div>
                <div class="card-body p-4">
                    <!-- Form -->
                    <form action="{{ route('siswas.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Nama -->
                        <div class="mb-3">
                            <label for="name" class="form-label fw-bold">Nama</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Jenis Kelamin & Tanggal Lahir -->
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="jeniskelamin" class="form-label fw-bold">Jenis Kelamin</label>
                                <select name="jeniskelamin" class="form-select" required>
                                    <option value="Laki-laki" {{ old('jeniskelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="Perempuan" {{ old('jeniskelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                                @error('jeniskelamin')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="tanggallahir" class="form-label fw-bold">Tanggal Lahir</label>
                                <input type="date" name="tanggallahir" class="form-control" value="{{ old('tanggallahir') }}" required>
                                @error('tanggallahir')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Alamat -->
                        <div class="mb-3">
                            <label for="alamat" class="form-label fw-bold">Alamat</label>
                            <textarea name="alamat" class="form-control" rows="3" required>{{ old('alamat') }}</textarea>
                            @error('alamat')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label fw-bold">Email</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                            @error('email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Upload Foto -->
                        <div class="mb-3">
                            <label class="form-label fw-bold">Foto Siswa</label>
                            <div class="d-flex gap-2">
                                <input type="file" class="form-control d-none" id="image" name="image" accept="image/*">
                                <button type="button" class="btn btn-primary" id="openCamera">
                                    <i class="bi bi-camera"></i> Ambil Foto
                                </button>
                                <button type="button" class="btn btn-secondary" id="chooseFile">
                                    <i class="bi bi-image"></i> Pilih Foto
                                </button>
                            </div>
                        </div>

                        <!-- Preview Foto -->
                        <div class="text-center mb-3">
                            <img id="previewImage" src="#" class="img-fluid rounded shadow d-none" style="max-width: 200px;">
                        </div>

                        <!-- Tombol Simpan dan Kembali -->
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('siswas.index') }}" class="btn btn-outline-secondary">Kembali</a>
                            <button type="submit" class="btn btn-success">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Script untuk Foto -->
<script>
    document.getElementById('openCamera').addEventListener('click', function () {
        document.getElementById('image').click();
    });

    document.getElementById('chooseFile').addEventListener('click', function () {
        document.getElementById('image').click();
    });

    document.getElementById('image').addEventListener('change', function (event) {
        let reader = new FileReader();
        reader.onload = function () {
            let preview = document.getElementById('previewImage');
            preview.src = reader.result;
            preview.classList.remove('d-none');
        };
        reader.readAsDataURL(event.target.files[0]);
    });
</script>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection
