@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h1 class="text-center mb-4">Biodata Siswa</h1>

    @if(session('success'))
        <div class="alert alert-success text-center">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('siswas.create') }}" class="btn btn-success mb-3">
        <i class="bi bi-person-plus-fill"></i> Tambah Siswa
    </a>

    <div class="row">
        @foreach($siswas as $siswa)
            <div class="col-md-4">
                <div class="card mb-4 shadow-sm h-100">
                    <!-- Gambar Siswa -->
                    @if($siswa->image) 
                        <img src="{{ asset('images/' . $siswa->image) }}" 
                             alt="Gambar Siswa" 
                             class="card-img-top img-fluid" 
                             style="height: 200px; object-fit: cover;">
                    @else
                        <img src="https://via.placeholder.com/300x200" 
                             alt="Placeholder" 
                             class="card-img-top img-fluid" 
                             style="height: 200px; object-fit: cover;">
                    @endif

                    <div class="card-body">
                        <h5 class="card-title">{{ $siswa->name }}</h5>
                        <p class="card-text">
                            <strong>ID:</strong> {{ $siswa->siswaID }}<br>
                            <strong>Jenis Kelamin:</strong> {{ $siswa->jeniskelamin }}<br>
                            <strong>Tanggal Lahir:</strong> {{ $siswa->tanggallahir->format('d-m-Y') }}<br>
                            <strong>Alamat:</strong> {{ $siswa->alamat }}<br>
                            <strong>Email:</strong> {{ $siswa->email }}
                        </p>

                        <!-- Tombol Aksi -->
                        <div class="btn-group w-100" role="group">
                            <a href="{{ route('siswas.show', $siswa->siswaID) }}" 
                               class="btn btn-info btn-sm" 
                               title="Lihat Detail">
                                <i class="bi bi-eye-fill"></i>
                            </a>
                            <a href="{{ route('siswas.edit', $siswa->siswaID) }}" 
                               class="btn btn-warning btn-sm" 
                               title="Edit Data">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            <form action="{{ route('siswas.destroy', $siswa->siswaID) }}" 
                                  method="POST" 
                                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')"
                                  style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="btn btn-danger btn-sm" 
                                        title="Hapus Data">
                                    <i class="bi bi-trash-fill"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<!-- Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
@endsection
