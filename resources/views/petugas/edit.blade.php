@extends('layouts.template')

@section('content')

<div class="container mx-auto my-5 p-5 bg-white shadow rounded">
    <h1 class="text-4xl font-semibold mb-5 text-center">Edit Petugas</h1>

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
            <form id="updatePetugasForm" action="{{ route('petugas.update', $petugas->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="name">Nama:</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $petugas->name }}" required>
                </div>

                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ $petugas->email }}" required>
                </div>

                <!-- Password lama dihilangkan dari form untuk keamanan -->
                <input type="hidden" name="password_lama" value="{{ $petugas->password }}">

                <div class="form-group">
                    <label for="password">Password Baru:</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>

                <div class="form-group">
                    <label for="phone">Phone:</label>
                    <input type="number" class="form-control" id="phone" name="phone" value="{{ $petugas->phone }}">
                </div>

                <!-- Role hanya bisa sebagai petugas -->
                <input type="hidden" name="role" value="petugas">

                <!-- Jabatan hanya bisa sebagai petugas -->
                <div class="form-group">
                    <label for="jabatan">Jabatan:</label>
                    <select class="form-control" id="jabatan" name="jabatan" required disabled>
                        <option value="petugas" selected>Petugas</option>
                    </select>
                    <input type="hidden" name="jabatan" value="petugas">
                </div>

                <div class="form-group">
                    <label for="jenis_kelamin">Jenis Kelamin:</label>
                    <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                        <option value="laki-laki" {{ $petugas->jenis_kelamin == 'laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="perempuan" {{ $petugas->jenis_kelamin == 'perempuan' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="alamat">Alamat:</label>
                    <input type="text" class="form-control" id="alamat" name="alamat" value="{{ $petugas->alamat }}">
                </div>

                <button type="submit" class="btn btn-primary" id="submitBtn">
                    <i class="fas fa-save"></i> Update
                </button>
                <a href="{{ route('petugas.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Back
                </a>
            </form>
        </div>
    </div>
</div>

@section('scripts')
<!-- Include SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // SweetAlert confirmation for form submission
    document.getElementById('updatePetugasForm').addEventListener('submit', function (e) {
        e.preventDefault(); // Prevent the form from submitting immediately

        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to save the changes?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, update it!',
            cancelButtonText: 'Cancel',
        }).then((result) => {
            if (result.isConfirmed) {
                this.submit(); // Submit the form if confirmed
            }
        });
    });
</script>
@endsection

@endsection
