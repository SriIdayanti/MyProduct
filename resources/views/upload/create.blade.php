<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Upload Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .card {
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .form-label {
            font-weight: bold;
            color: #495057;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="card p-4">
            <h3 class="text-center mb-4 text-primary">Tambah Upload Produk</h3>
            <form id="uploadForm" action="{{ route('upload.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ auth()->user()->name }}" readonly>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label for="namaproduk" class="form-label">Nama Produk</label>
                        <input type="text" class="form-control" id="namaproduk" name="namaproduk" required>
                    </div>
                    <div class="col-md-6">
                        <label for="link" class="form-label">Link</label>
                        <input type="text" class="form-control" id="link" name="link" required>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-6">
                        <label for="tanggaldibuat" class="form-label">Tanggal Dibuat</label>
                        <input type="date" class="form-control" id="tanggaldibuat" name="tanggaldibuat" required>
                    </div>
                    <div class="col-md-6">
                        <label for="kategoriproduk" class="form-label">Kategori Produk</label>
                        <select class="form-select" id="kategoriproduk" name="kategoriproduk" required>
                            <option value="" disabled selected>Pilih Kategori</option>
                            <option value="Alat">Alat</option>
                            <option value="Software">Software</option>
                            <option value="Website">Website</option>
                            <option value="lainnya">Lainnya...</option>
                        </select>
                        <input type="text" class="form-control mt-2 d-none" id="customKategori" name="customKategori" placeholder="Masukkan kategori lainnya">
                    </div>
                </div>
                <div class="mb-3 mt-3">
                    <label for="descriptionproduct" class="form-label">Deskripsi Produk</label>
                    <textarea class="form-control" id="descriptionproduct" name="descriptionproduct" rows="4" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Gambar Produk</label>
                    <div class="input-group">
                        <input type="file" class="form-control d-none" id="image" name="image" accept="image/*">
                        <button type="button" class="btn btn-primary" id="openCamera"><i class="bi bi-camera-fill"></i> Ambil Foto</button>
                        <button type="button" class="btn btn-secondary" id="chooseFile"><i class="bi bi-folder-fill"></i> Pilih Foto</button>
                    </div>
                </div>
                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('upload.index') }}" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Kembali</a>
                    <button type="submit" class="btn btn-primary"><i class="bi bi-check-circle"></i> Simpan</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        document.getElementById('openCamera').addEventListener('click', function () {
            document.getElementById('image').click();
        });
        document.getElementById('chooseFile').addEventListener('click', function () {
            document.getElementById('image').click();
        });
        document.getElementById('kategoriproduk').addEventListener('change', function () {
            let customInput = document.getElementById('customKategori');
            if (this.value === 'lainnya') {
                customInput.classList.remove('d-none');
                customInput.setAttribute('name', 'kategoriproduk');
                customInput.setAttribute('required', 'required');
                this.removeAttribute('name');
            } else {
                customInput.classList.add('d-none');
                customInput.removeAttribute('required');
                customInput.removeAttribute('name');
                this.setAttribute('name', 'kategoriproduk');
            }
        });
        document.getElementById('uploadForm').addEventListener('submit', function (event) {
            event.preventDefault();
            Swal.fire({
                title: 'Konfirmasi',
                text: 'Apakah Anda yakin ingin mengunggah produk ini?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Simpan!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Berhasil!',
                        text: 'Produk telah berhasil diunggah.',
                        icon: 'success',
                        timer: 2000,
                        showConfirmButton: false
                    });
                    setTimeout(() => {
                        event.target.submit();
                    }, 2000);
                }
            });
        });
    </script>
</body>
</html>
