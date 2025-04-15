@extends('layouts.app')

@section('content')
<div class="container mx-auto my-5 p-5 bg-white shadow rounded">

    <h1 class="text-4xl font-semibold mb-5 text-center">Tambah Petugas Baru</h1>

    @if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="row">
        <div class="col-md-8 offset-md-2">
            <form id="petugasForm" action="{{ route('petugas.store') }}" method="POST">
                {{ csrf_field() }}

                <div class="form-group">
                    <label for="name">Nama:</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>

                <div class="form-group" style="display: none;">
                    <label for="role">Role:</label>
                    <select class="form-control" id="role" name="role" required>
                        <option value="petugas"{{ old('role') == 'petugas' ? ' selected' : '' }}>Petugas</option>
                        <option value="admin"{{ old('role') == 'admin' ? ' selected' : '' }}{{ old('role') == 'admin' ? ' disabled' : '' }}>Admin</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>

                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>

                <div class="form-group">
                    <label for="phone">Telepon:</label>
                    <input type="number" class="form-control" id="phone" name="phone" value="{{ old('phone') }}">
                </div>

                <div class="form-group">
                    <label for="jabatan">Jabatan:</label>
                    <select class="form-control" id="jabatan" name="jabatan" disabled>
                        <option value="petugas" selected>Petugas</option>
                    </select>
                </div>
                <input type="hidden" name="jabatan" value="petugas">

                <div class="form-group">
                    <label for="jenis_kelamin" class="form-label">Jenis Kelamin:</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="jenis_kelamin" id="laki-laki" value="laki-laki" {{ old('jenis_kelamin') == 'laki-laki' ? 'checked' : '' }}>
                        <label class="form-check-label" for="laki-laki">
                            Laki-laki
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="jenis_kelamin" id="perempuan" value="perempuan" {{ old('jenis_kelamin') == 'perempuan' ? 'checked' : '' }}>
                        <label class="form-check-label" for="perempuan">
                            Perempuan
                        </label>
                    </div>
                </div>

                <div class="form-group">
                    <label for="alamat">Alamat:</label>
                    <input type="text" class="form-control" id="alamat" name="alamat">
                </div>

                <!-- Tombol dengan ikon -->
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i>Tambah
                </button>

                <a href="{{ route('petugas.index') }}" class="btn btn-secondary">
                    <i class="fas fa-times me-2"></i>Batal
                </a>
            </form>
        </div>
    </div>
</div>

<!-- Script untuk SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        let form = document.getElementById("petugasForm");

        form.addEventListener("submit", function (event) {
            event.preventDefault();

            let formData = new FormData(form);
            
            fetch(form.action, {
                method: "POST",
                body: formData,
                headers: { "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value }
            })
            .then(response => {
                if (!response.ok) throw new Error("Gagal menambah petugas.");
                return response.text();
            })
            .then(() => {
                Swal.fire({
                    icon: 'success',
                    title: 'Petugas Berhasil Ditambah!',
                    text: 'Data petugas baru telah ditambahkan.',
                    showConfirmButton: false,  // Menyembunyikan tombol OK
                    timer: 2000 // Menunggu 2 detik sebelum redirect
                }).then(() => {
                    window.location.href = "{{ route('petugas.index') }}";
                });
            })
            .catch(error => {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: 'Terjadi kesalahan saat menambah petugas.',
                    showConfirmButton: false,
                    timer: 2000 // Menunggu 2 detik sebelum menunjukkan pesan
                });
                console.error("Error:", error);
            });
        });
    });
</script>
@endsection
