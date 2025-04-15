<!-- Tambahkan Bootstrap Icons di bagian <head> layout utama -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="header text-center my-4">
        <h1 class="fw-bold">Daftar Upload Produk Siswa</h1>
        <p class="text-muted">Tempat bagi siswa untuk meng-upload dan mengelola produk yang mereka buat.</p>
    </div>

    <!-- Search Form and Upload Button -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <form class="d-flex" action="{{ route('upload.index') }}" method="GET">
            <input type="text" class="form-control me-2" name="search" placeholder="Cari Nama Produk" value="{{ request('search') }}">
            <button class="btn btn-primary" type="submit"><i class="bi bi-search"></i> Cari</button>
        </form>
        <a href="{{ route('upload.create') }}" class="btn btn-success"><i class="bi bi-cloud-upload"></i> Upload Produk</a>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif
    @if(!isset($uploads))
        <p class="text-red-500">Variabel $uploads tidak tersedia!</p>
    @endif

    <!-- Produk Cards -->
    <div class="row">
        @forelse($uploads as $upload)
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <!-- Gambar Produk -->
                    @if($upload->image)
                        <img src="{{ asset('images/' . $upload->image) }}" alt="Gambar Produk" 
                             class="card-img-top img-fluid" 
                             style="height: 200px; object-fit: cover;">
                    @else
                        <img src="https://via.placeholder.com/300x200" alt="Placeholder" 
                             class="card-img-top img-fluid" 
                             style="height: 200px; object-fit: cover;">
                    @endif

                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $upload->namaproduk }}</h5>
                        <p class="card-text text-muted"><strong>Kategori:</strong> {{ $upload->kategoriproduk }}</p>
                        <p class="card-text text-muted"><strong>Tanggal Dibuat:</strong> {{ \Carbon\Carbon::parse($upload->tanggaldibuat)->format('d-m-Y') }}</p>
                        <p class="card-text"><strong>Status:</strong> 
                            <span class="badge bg-{{ $upload->status == 'Aktif' ? 'success' : 'secondary' }}">
                                {{ $upload->status }}
                            </span>
                        </p>

                        <!-- Tombol Aksi -->
                        <div class="mt-auto">
    <div class="btn-group w-100" role="group" aria-label="Aksi Produk">
        <a href="{{ route('upload.show', $upload->uploadID) }}" class="btn btn-info btn-sm" title="Lihat">
            <i class="bi bi-eye"></i>
        </a>
        <a href="{{ route('upload.edit', $upload->uploadID) }}" class="btn btn-warning btn-sm" title="Edit">
            <i class="bi bi-pencil-square"></i>
        </a>
        <form action="{{ route('upload.destroy', $upload->uploadID) }}" method="POST" 
              onsubmit="return confirmDelete(event, this);" class="d-inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger btn-sm" title="Hapus">
                <i class="bi bi-trash"></i>
            </button>
        </form>
    </div>
</div>

                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center">
                <p class="text-muted">Belum ada produk yang diunggah.</p>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center">
        {{ $uploads->links() }}
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<!-- SweetAlert2 JS untuk konfirmasi penghapusan -->
<script>
    function confirmDelete(event, form) {
        event.preventDefault();
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Data ini akan dihapus!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal',
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    }

    // SweetAlert2 untuk menampilkan notifikasi sukses
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '{{ session('success') }}',
        });
    @endif
</script>

@endsection
