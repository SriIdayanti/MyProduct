@extends('layouts.template')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h3 class="text-center mb-0">Edit Penilaian</h3>
                </div>
                <div class="card-body">
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('penilaian.update', ['penilaian' => $penilaian->penilaianID]) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Read-only product display -->
                        <div class="form-group mb-4">
                            <label class="form-label">Produk:</label>
                            <div class="product-display p-3">
                                @foreach ($upload as $item)
                                    @if($penilaian->uploadID == $item->uploadID)
                                        <div class="d-flex align-items-center">
                                            <div class="product-icon me-3">
                                                <i class="fas fa-box-open text-primary"></i>
                                            </div>
                                            <div>
                                                <h5 class="mb-1">{{ $item->namaproduk }}</h5>
                                                <small class="text-muted">ID Produk: {{ $item->uploadID }}</small>
                                            </div>
                                        </div>
                                        <!-- Hidden input to keep the uploadID value -->
                                        <input type="hidden" name="uploadID" value="{{ $item->uploadID }}">
                                    @endif
                                @endforeach
                            </div>
                        </div>

                        <!-- Rating System (Fixed and Styled) -->
                      <!-- Rating section -->
                      <div class="col-12 mt-4">
    <div class="text-center">
        <label class="form-label fs-5 mb-3">
            <i class="fas fa-star me-2 text-primary"></i>Penilaian Produk
        </label>

        <div class="d-flex justify-content-center">
            @for($i = 1; $i <= 5; $i++)
                <div class="form-check form-check-inline mx-1">
                    <input type="radio" class="btn-check" name="rating" id="rating-{{ $i }}" value="{{ $i }}"
                           {{ old('rating', $penilaian->rating) == $i ? 'checked' : '' }} required>
                    <label for="rating-{{ $i }}" 
                           class="btn btn-outline-primary rounded-circle d-inline-flex align-items-center justify-content-center"
                           style="width: 40px; height: 40px;">
                        {{ $i }}
                    </label>
                </div>
            @endfor
        </div>

        <div class="mt-2 text-muted small">Pilih angka untuk memberikan nilai</div>
    </div>
</div>



                        <div class="form-group mb-4">
                            <label for="komentar" class="form-label">Komentar:</label>
                            <textarea name="komentar" id="komentar" class="form-control" rows="4" placeholder="Tulis komentar anda tentang produk ini...">{{ $penilaian->komentar }}</textarea>
                        </div>

                        <div class="form-group mb-4">
                            <label for="tanggal" class="form-label">Tanggal Penilaian:</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                <input type="date" name="tanggal" id="tanggal" value="{{ old('tanggal', $penilaian->tanggal) }}" required class="form-control">
                            </div>
                        </div>

                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('penilaian.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left me-1"></i> Kembali
                            </a>
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-save me-1"></i> Update Penilaian
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    /* Card styling */
    .card {
        border: none;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 0.5rem 1.5rem rgba(0, 0, 0, 0.15);
        transition: all 0.3s ease;
    }
    
    .card:hover {
        box-shadow: 0 0.7rem 2rem rgba(0, 0, 0, 0.18);
    }
    
    .card-header {
        background-color: #4e73df;
        padding: 1.2rem;
        border-bottom: none;
    }
    
    .card-body {
        padding: 2.5rem;
        background-color: #fff;
    }
    
    /* Form elements styling */
    .form-label {
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 0.6rem;
        font-size: 0.95rem;
        letter-spacing: 0.02rem;
    }
    
    .form-control, .form-select {
        padding: 0.75rem 1rem;
        border-radius: 8px;
        border: 1px solid #e2e8f0;
        background-color: #f8fafc;
        transition: all 0.3s;
        font-size: 0.95rem;
    }
    
    .form-control:focus, .form-select:focus {
        border-color: #4e73df;
        box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.25);
        background-color: #fff;
    }
    
    .form-group {
        margin-bottom: 1.8rem;
    }
    
    /* Button styling */
    .btn {
        padding: 0.65rem 1.6rem;
        border-radius: 8px;
        font-weight: 500;
        transition: all 0.3s;
        letter-spacing: 0.03rem;
    }
    
    .btn-success {
        background-color: #1cc88a;
        border-color: #1cc88a;
    }
    
    .btn-success:hover {
        background-color: #18a878;
        border-color: #18a878;
        transform: translateY(-2px);
    }
    
    .btn-outline-secondary {
        color: #6c757d;
        border-color: #6c757d;
    }
    
    .btn-outline-secondary:hover {
        background-color: #6c757d;
        color: #fff;
        transform: translateY(-2px);
    }
    
    /* Product Display */
    .product-display {
        background-color: #f8f9fc;
        border-radius: 10px;
        border: 1px solid #e2e8f0;
        padding: 1.2rem !important;
        transition: all 0.3s;
    }
    
    .product-display:hover {
        background-color: #f0f3fa;
    }
    
    .product-icon {
        font-size: 1.6rem;
        color: #4e73df;
        margin-right: 1rem;
    }
    
    /* Rating System Styling - Clean and Modern */
    .rating-wrapper {
        background-color: #f8f9fc;
        border-radius: 10px;
        padding: 1.5rem;
        border: 1px solid #e2e8f0;
        transition: all 0.3s;
    }
    
    .rating-wrapper:hover {
        background-color: #f0f3fa;
    }
    
    .rating-title {
        margin-bottom: 1.2rem;
        text-align: center;
    }
    
    .rating-title-text {
        font-size: 1.1rem;
        color: #333;
        font-weight: 600;
    }
    
    .rating-title-text i {
        color: #ffc107;
    }
    
    .rating-circles-container {
        display: flex;
        justify-content: center;
        gap: 15px;
        margin: 1.2rem 0;
    }
    
    .rating-circle-item {
        position: relative;
    }
    
    .rating-circle-item input {
        position: absolute;
        opacity: 0;
        width: 0;
        height: 0;
    }
    
    .rating-circle {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 58px;
        height: 58px;
        border-radius: 50%;
        background-color: white;
        border: 2px solid #e5e5e5;
        color: #555;
        cursor: pointer;
        font-weight: 600;
        font-size: 18px;
        transition: all 0.2s ease;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
    }
    
    .rating-circle:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
        border-color: #c0c0c0;
    }
    
    input:checked + .rating-circle {
        background-color: #4e73df;
        border-color: #4e73df;
        color: white;
        transform: scale(1.05);
    }
    
    .rating-instruction {
        text-align: center;
        color: #4169e1;
        font-size: 14px;
        margin-top: 12px;
        font-weight: 500;
    }
    
    /* Input group styling */
    .input-group-text {
        background-color: #f8f9fc;
        border-color: #e2e8f0;
        border-radius: 8px 0 0 8px;
    }
    
    /* Responsive adjustments */
    @media (max-width: 768px) {
        .card-body {
            padding: 1.5rem;
        }
        
        .d-flex {
            flex-direction: column;
            gap: 1rem;
        }
        
        .btn {
            width: 100%;
        }
        
        .rating-circles-container {
            gap: 10px;
        }
        
        .rating-circle {
            width: 48px;
            height: 48px;
            font-size: 16px;
        }
    }
</style>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Confirmation before leaving page with unsaved changes
        const form = document.querySelector('form');
        let formChanged = false;
        
        // Track form changes
        form.addEventListener('input', function() {
            formChanged = true;
        });
        
        // Confirmation when clicking back button
        const backButton = document.querySelector('.btn-outline-secondary');
        backButton.addEventListener('click', function (e) {
            if (formChanged && !confirm('Perubahan yang Anda buat belum disimpan. Yakin ingin meninggalkan halaman ini?')) {
                e.preventDefault();
            }
        });
    });
</script>
@endsection