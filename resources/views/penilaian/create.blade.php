@extends('layouts.template')
<!-- FontAwesome CDN -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<!-- Custom CSS -->
<style>
    :root {
        --primary-color: #4361ee;
        --primary-light: #4895ef;
        --primary-dark: #3f37c9;
        --gray-light: #f8f9fa;
        --gray-medium: #e9ecef;
        --text-dark: #212529;
        --text-muted: #6c757d;
        --shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        --transition: all 0.3s ease;
    }

    /* Card styling */
    .card {
        border-radius: 12px;
        overflow: hidden;
        box-shadow: var(--shadow);
        transition: var(--transition);
    }
    
    .card:hover {
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12);
    }
    
    .card-header {
        background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
        color: white;
        padding: 1.5rem;
        border-bottom: none;
    }
    
    /* Rating system */
    .rating-container {
        display: flex;
        justify-content: center;
        gap: 0.5rem;
        margin: 1rem 0;
    }
    
    .rating-button {
        cursor: pointer;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: white;
        border: 2px solid var(--gray-medium);
        color: var(--text-muted);
        font-weight: 600;
        font-size: 1.2rem;
        transition: var(--transition);
    }
    
    .rating-input {
        display: none;
    }
    
    .rating-button:hover {
        background-color: var(--gray-light);
        transform: translateY(-5px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    
    .rating-input:checked + .rating-button {
        background-color: var(--primary-color);
        border-color: var(--primary-dark);
        color: white;
        transform: translateY(-5px);
        box-shadow: 0 4px 12px rgba(67, 97, 238, 0.3);
    }
    
    /* Form elements */
    .form-control, .form-select {
        border-radius: 8px;
        border: 1px solid var(--gray-medium);
        padding: 0.8rem 1rem;
        transition: var(--transition);
    }
    
    .form-control:focus, .form-select:focus {
        border-color: var(--primary-light);
        box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.2);
    }
    
    textarea.form-control {
        min-height: 140px;
        resize: vertical;
    }
    
    .form-label {
        font-weight: 500;
        color: var(--text-dark);
        margin-bottom: 0.5rem;
    }
    
    /* Buttons */
    .btn {
        border-radius: 8px;
        padding: 0.6rem 1.5rem;
        font-weight: 500;
        transition: var(--transition);
    }
    
    .btn-primary {
        background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
        border: none;
        color: white;
    }
    
    .btn-primary:hover {
        background: linear-gradient(135deg, var(--primary-dark), var(--primary-dark));
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(67, 97, 238, 0.3);
    }
    
    .btn-outline-secondary {
        border: 1px solid var(--gray-medium);
        color: var(--text-muted);
    }
    
    .btn-outline-secondary:hover {
        background-color: var(--gray-light);
        color: var(--text-dark);
    }
    
    /* Product card */
    .product-card {
        border-radius: 12px;
        overflow: hidden;
        box-shadow: var(--shadow);
        margin-top: 1rem;
    }
    
    .product-card img {
        width: 100%;
        height: 200px;
        object-fit: cover;
        border-radius: 8px;
    }
    
    .product-info {
        padding: 1.2rem;
    }
    
    .product-info p {
        margin-bottom: 0.7rem;
    }
    
    .badge {
        padding: 0.5rem 0.8rem;
        font-weight: 500;
        border-radius: 6px;
    }
    
    /* Animation */
    .animated-icon {
        transition: transform 0.3s ease;
    }
    
    .btn:hover .animated-icon {
        transform: translateX(4px);
    }
    
    .btn:hover .animated-icon-back {
        transform: translateX(-4px);
    }
    
    /* Rating text */
    .rating-text {
        font-weight: 500;
        margin-top: 0.5rem;
        color: var(--primary-color);
        height: 1.5rem;
    }
</style>

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header text-center">
                    <h3 class="mb-2"><i class="fas fa-star me-2"></i>Tambah Penilaian</h3>
                    <p class="mb-0 opacity-75">Bagikan pengalaman Anda menggunakan produk ini</p>
                </div>

                <div class="card-body p-4">
                    @if(session('success'))
                    <script>
                        document.addEventListener("DOMContentLoaded", function() {
                            Swal.fire({
                                icon: 'success',
                                title: 'Penilaian Tersimpan!',
                                text: 'Terima kasih telah memberikan penilaian.',
                                confirmButtonText: 'OK',
                                confirmButtonColor: '#4361ee'
                            });
                        });
                    </script>
                    @endif

                    <form id="penilaianForm" action="{{ route('penilaian.store') }}" method="POST">
                        @csrf
                        <div class="row g-4">
                            <div class="col-md-6">
                                <label for="tanggal" class="form-label">
                                    <i class="far fa-calendar-alt me-2"></i>Tanggal Penilaian
                                </label>
                                <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                            </div>
                            
                            <div class="col-md-6">
                                <label for="uploadID" class="form-label">
                                    <i class="fas fa-box-open me-2"></i>Pilih Produk
                                </label>
                                <select name="uploadID" id="uploadID" class="form-select" required>
                                    <option value="" disabled selected>Pilih produk untuk dinilai</option>
                                    @foreach($uploads as $upload)
                                        <option value="{{ $upload->uploadID }}">{{ $upload->namaproduk }}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <!-- Product detail section -->
                            <div class="col-12 mt-3" id="produk-detail" style="display: none;">
                                <div class="product-card">
                                    <div class="row g-0">
                                        <div class="col-md-4">
                                            <img id="detail-gambar" src="{{ asset('img/no-image.png') }}" alt="Gambar Produk" class="img-fluid">
                                        </div>
                                        <div class="col-md-8">
                                            <div class="product-info">
                                                <h4 id="detail-namaproduk" class="mb-2"></h4>
                                                <p><span class="fw-medium">Nama:</span> <span id="detail-nama"></span></p>
                                                <p><span class="fw-medium">Kategori:</span> <span id="detail-kategori"></span></p>
                                                <p>
                                                    <span class="fw-medium">Status:</span> 
                                                    <span id="detail-status" class="badge bg-secondary"></span>
                                                </p>
                                                <p><span class="fw-medium">Deskripsi:</span> <span id="detail-deskripsi"></span></p>
                                                <p>
                                                    <a id="detail-link" href="#" target="_blank" class="btn btn-sm btn-outline-primary">
                                                        <i class="fas fa-external-link-alt me-1"></i> Kunjungi Produk
                                                    </a>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Rating section -->
                            <div class="col-12 mt-4">
                                <div class="text-center">
                                    <label class="form-label fs-5 mb-2">
                                        <i class="fas fa-star me-2"></i>Penilaian Produk
                                    </label>
                                    
                                    <div class="rating-container">
                                        @for($i = 1; $i <= 5; $i++)
                                            <div class="rating-wrapper">
                                                <input type="radio" name="rating" value="{{ $i }}" id="rating-{{ $i }}" class="rating-input" required>
                                                <label for="rating-{{ $i }}" class="rating-button" title="Nilai {{ $i }}">{{ $i }}</label>
                                            </div>
                                        @endfor
                                    </div>
                                    <div class="rating-text">Pilih angka untuk memberikan nilai</div>
                                </div>
                            </div>

                            <!-- Comment section -->
                            <div class="col-12 mt-3">
                                <label for="komentar" class="form-label">
                                    <i class="far fa-comment me-2"></i>Komentar dan Ulasan
                                </label>
                                <textarea name="komentar" id="komentar" class="form-control" placeholder="Tulis komentar Anda tentang produk ini..." required></textarea>
                                <div class="form-text mt-2">
                                    <i class="fas fa-info-circle me-1"></i> Bagikan pengalaman Anda untuk membantu pengguna lain.
                                </div>
                            </div>

                            <!-- Buttons -->
                            <div class="col-12 mt-4">
                                <div class="d-flex gap-3 justify-content-between">
                                    <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary">
                                        <i class="fas fa-arrow-left me-2 animated-icon-back"></i> Kembali
                                    </a>
                                    
                                    <button type="submit" class="btn btn-primary">
                                        Simpan Penilaian <i class="fas fa-paper-plane ms-2 animated-icon"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Set default date to today
        document.getElementById('tanggal').valueAsDate = new Date();
        
        // Rating visual feedback
        const ratingText = document.querySelector('.rating-text');
        const ratingButtons = document.querySelectorAll('.rating-button');
        const ratingMessages = [
            "", // Not used (0 index)
            "Sangat Buruk", 
            "Buruk", 
            "Cukup", 
            "Baik", 
            "Sangat Baik"
        ];
        
        document.querySelectorAll('.rating-input').forEach(input => {
            input.addEventListener('change', function() {
                const value = this.value;
                ratingText.textContent = ratingMessages[value];
                ratingText.style.opacity = "1";
                
                // Add animation classes
                ratingText.classList.add('animate__animated', 'animate__fadeIn');
                setTimeout(() => {
                    ratingText.classList.remove('animate__animated', 'animate__fadeIn');
                }, 1000);
            });
        });
        
        // Handle products that have already been rated
        const penilaianUploadIDs = @json($penilaianUploadIDs); // Get data from controller
        const selectElement = document.getElementById("uploadID");
        const options = selectElement.querySelectorAll("option");
        
        options.forEach(option => {
            const value = option.value;
            if (penilaianUploadIDs.includes(parseInt(value))) {
                option.style.display = "none"; // Hide already rated products
            }
        });
        
        // Product details display
        const produkData = @json($uploads); // All product data from controller
        
        document.getElementById("uploadID").addEventListener("change", function () {
            const selectedID = parseInt(this.value);
            const detailSection = document.getElementById("produk-detail");
            
            const selectedProduk = produkData.find(p => p.uploadID === selectedID);
            
            if (selectedProduk) {
                document.getElementById("detail-namaproduk").textContent = selectedProduk.namaproduk;
                document.getElementById("detail-nama").textContent = selectedProduk.name || "-";
                document.getElementById("detail-kategori").textContent = selectedProduk.kategoriproduk || "-";
                document.getElementById("detail-status").textContent = selectedProduk.status;
                
                // Set badge color based on status
                const statusBadge = document.getElementById("detail-status");
                statusBadge.className = "badge"; // reset
                switch (selectedProduk.status.toLowerCase()) {
                    case "diterima":
                        statusBadge.classList.add("bg-success");
                        break;
                    case "ditolak":
                        statusBadge.classList.add("bg-danger");
                        break;
                    default:
                        statusBadge.classList.add("bg-warning", "text-dark");
                }
                
                document.getElementById("detail-deskripsi").textContent = selectedProduk.descriptionproduct || "-";
                
                const linkProduk = selectedProduk.link || "#";
                document.getElementById("detail-link").href = linkProduk;
                document.getElementById("detail-link").textContent = linkProduk ? "Kunjungi Produk" : "Tidak tersedia";
                
                const gambarElement = document.getElementById("detail-gambar");
                if (selectedProduk.image) {
                    gambarElement.src = "{{ asset('images/') }}/" + selectedProduk.image;
                    gambarElement.alt = "Gambar " + selectedProduk.namaproduk;
                } else {
                    gambarElement.src = "{{ asset('img/no-image.png') }}";
                    gambarElement.alt = "Gambar tidak tersedia";
                }
                
                detailSection.style.display = "block";
            } else {
                detailSection.style.display = "none";
            }
        });
        
        // Form submission with validation
        let form = document.getElementById("penilaianForm");
        form.addEventListener("submit", function (event) {
            event.preventDefault();
            
            // Validate rating selection
            const ratingSelected = document.querySelector('input[name="rating"]:checked');
            if (!ratingSelected) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Belum Lengkap',
                    text: 'Silakan berikan nilai untuk produk ini',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#4361ee'
                });
                return;
            }
            
            let formData = new FormData(form);
            
            // Show loading state
            const submitBtn = form.querySelector('button[type="submit"]');
            const originalBtnHtml = submitBtn.innerHTML;
            submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span> Menyimpan...';
            submitBtn.disabled = true;
            
            fetch(form.action, {
                method: "POST",
                body: formData,
                headers: { "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value }
            })
            .then(response => {
                if (!response.ok) throw new Error("Gagal menyimpan penilaian.");
                return response.text();
            })
            .then(() => {
                Swal.fire({
                    icon: 'success',
                    title: 'Penilaian Tersimpan!',
                    text: 'Terima kasih telah memberikan penilaian untuk produk ini.',
                    confirmButtonText: 'Lihat Semua Penilaian',
                    confirmButtonColor: '#4361ee',
                    timer: 3000,
                    timerProgressBar: true
                }).then(() => {
                    window.location.href = "{{ route('penilaian.index') }}";
                });
            })
            .catch(error => {
                submitBtn.innerHTML = originalBtnHtml;
                submitBtn.disabled = false;
                
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: 'Terjadi kesalahan saat menyimpan penilaian.',
                    confirmButtonText: 'Coba Lagi',
                    confirmButtonColor: '#4361ee'
                });
                console.error("Error:", error);
            });
        });
    });
</script>
@endsection