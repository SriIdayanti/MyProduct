<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Upload Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
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
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }
        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="card shadow-lg p-4 border-0 rounded-3 bg-light">
            <h2 class="text-center text-white bg-primary p-3 rounded">Edit Upload Produk</h2>
            <form action="{{ route('upload.update', $upload->uploadID) }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate id="uploadForm">
                @csrf
                @method('PUT')
                
                <div class="mb-3">
                    <label for="name" class="form-label">Nama</label>
                    <input type="text" class="form-control border-primary shadow-sm" id="name" name="name" value="{{ old('name', $upload->name) }}" required>
                </div>
                
                <div class="mb-3">
                    <label for="namaproduk" class="form-label">Nama Produk</label>
                    <input type="text" class="form-control border-primary shadow-sm" id="namaproduk" name="namaproduk" value="{{ old('namaproduk', $upload->namaproduk) }}" required>
                </div>
                
                <div class="mb-3">
                    <label for="descriptionproduct" class="form-label">Deskripsi Produk</label>
                    <textarea class="form-control border-primary shadow-sm" id="descriptionproduct" name="descriptionproduct" rows="4" required>{{ old('descriptionproduct', $upload->descriptionproduct) }}</textarea>
                </div>
                
                <div class="mb-3">
    <label for="image" class="form-label">Gambar Produk</label>
    <input type="file" class="form-control border-primary shadow-sm" id="image" name="image" accept="image/*">

    <!-- Menampilkan gambar sebelumnya jika ada -->
    @if($upload->image)
        <div class="mt-2">
            <img src="{{ asset('storage/' . $upload->image) }}" alt="Gambar Produk" class="img-thumbnail" width="150">
        </div>
    @endif
</div>

                
                <div class="mb-3">
                    <label for="link" class="form-label">Link</label>
                    <input type="text" class="form-control border-primary shadow-sm" id="link" name="link" value="{{ old('link', $upload->link) }}" required>
                </div>
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="tanggaldibuat" class="form-label">Tanggal Dibuat</label>
                        <input type="date" class="form-control border-primary shadow-sm" id="tanggaldibuat" name="tanggaldibuat" value="{{ old('tanggaldibuat', $upload->tanggaldibuat) }}" required>
                    </div>
                    <div class="col-md-6">
    <label for="kategoriproduk" class="form-label">Kategori Produk</label>
    <select class="form-select" id="kategoriproduk" name="kategoriproduk" required onchange="toggleCustomKategori(this)">
        <option value="" disabled>Pilih Kategori</option>
        <option value="Alat" {{ old('kategoriproduk', $upload->kategoriproduk) == 'Alat' ? 'selected' : '' }}>Alat</option>
        <option value="Software" {{ old('kategoriproduk', $upload->kategoriproduk) == 'Software' ? 'selected' : '' }}>Software</option>
        <option value="Website" {{ old('kategoriproduk', $upload->kategoriproduk) == 'Website' ? 'selected' : '' }}>Website</option>
        <option value="lainnya" {{ !in_array(old('kategoriproduk', $upload->kategoriproduk), ['Alat', 'Software', 'Website']) ? 'selected' : '' }}>Lainnya...</option>
    </select>
    
    <!-- Input teks untuk kategori lainnya -->
    <input type="text" class="form-control mt-2 {{ !in_array(old('kategoriproduk', $upload->kategoriproduk), ['Alat', 'Software', 'Website']) ? '' : 'd-none' }}" 
        id="customKategori" 
        name="customKategori" 
        placeholder="Masukkan kategori lainnya" 
        value="{{ !in_array(old('kategoriproduk', $upload->kategoriproduk), ['Alat', 'Software', 'Website']) ? old('kategoriproduk', $upload->kategoriproduk) : '' }}">
</div>

<script>
    function toggleCustomKategori(selectElement) {
        var customKategoriInput = document.getElementById('customKategori');

        if (selectElement.value === 'lainnya') {
            customKategoriInput.classList.remove('d-none');
            customKategoriInput.required = true;
            customKategoriInput.focus();
        } else {
            customKategoriInput.classList.add('d-none');
            customKategoriInput.required = false;
            customKategoriInput.value = '';
        }
    }
</script>

                </div>
                
                <div class="d-flex gap-3 mt-4 justify-content-center">
                    <button type="submit" class="btn btn-success px-4 shadow-sm" id="updateButton">
                        <i class="bi bi-save"></i> Update
                    </button>
                    <a href="{{ route('upload.index') }}" class="btn btn-secondary px-4 shadow-sm">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
    
    <script>
    document.getElementById("uploadForm").addEventListener("submit", function (event) {
        event.preventDefault();
        
        let form = this;
        let button = document.getElementById("updateButton");
        let name = document.getElementById("name").value.trim();
        let namaproduk = document.getElementById("namaproduk").value.trim();
        let descriptionproduct = document.getElementById("descriptionproduct").value.trim();
        let link = document.getElementById("link").value.trim();
        let tanggaldibuat = document.getElementById("tanggaldibuat").value;
        let kategoriproduk = document.getElementById("kategoriproduk").value;
        let image = document.getElementById("image").files[0];

        // Validasi form sebelum submit
        if (!name || !namaproduk || !descriptionproduct || !link || !tanggaldibuat || !kategoriproduk) {
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: 'Harap isi semua bidang yang wajib!',
            });
            return;
        }

        // Validasi URL
        let urlPattern = /^(https?:\/\/)?([\w\d-]+\.)+[\w\d]{2,}(\/.*)?$/;
        if (!urlPattern.test(link)) {
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: 'Harap masukkan link yang valid!',
            });
            return;
        }

        // Validasi format gambar
        if (image) {
            let allowedExtensions = ['image/jpeg', 'image/png', 'image/jpg'];
            if (!allowedExtensions.includes(image.type)) {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: 'Format gambar harus JPG atau PNG!',
                });
                return;
            }
        }

        // Validasi tanggal tidak melebihi hari ini
        let today = new Date().toISOString().split("T")[0];
        if (tanggaldibuat > today) {
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: 'Tanggal tidak boleh melebihi hari ini!',
            });
            return;
        }

        // Tombol submit loading
        button.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Updating...';
        button.disabled = true;

        // Tampilkan SweetAlert konfirmasi
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Data akan diperbarui!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, update!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            } else {
                // Kembalikan tombol submit jika dibatalkan
                button.innerHTML = '<i class="bi bi-save"></i> Update';
                button.disabled = false;
            }
        });
    });
</script>

</body>
</html>
