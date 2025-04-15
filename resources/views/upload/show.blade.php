<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Produk</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
        }
        .card {
            border-radius: 15px;
            overflow: hidden;
        }
        .card-header {
            background: linear-gradient(to right, #007bff, #00c6ff);
            border-radius: 15px 15px 0 0;
            color: white;
        }
        .badge {
            font-size: 1rem;
            padding: 8px 12px;
        }
        img {
            transition: transform 0.3s ease-in-out;
        }
        img:hover {
            transform: scale(1.1);
        }
        .btn {
            transition: all 0.3s ease;
        }
        .btn:hover {
            transform: scale(1.05);
        }
    </style>
</head>
<body>
    <div class="container my-5" data-aos="fade-up">
        <h1 class="my-4 text-center text-primary">Detail Upload Produk</h1>

        <div class="card shadow-lg">
            <div class="card-header text-center py-3">
                <h4 class="mb-0">{{ $upload->namaproduk }}</h4>
            </div>
            <div class="card-body">
                <p><strong>Nama:</strong> {{ $upload->name }}</p>
                <p><strong>Kategori:</strong> {{ $upload->kategoriproduk }}</p>
                <p><strong>Status:</strong>
                    <span class="badge {{ $upload->status == 'Diterima' ? 'bg-success' : ($upload->status == 'Ditolak' ? 'bg-danger' : 'bg-warning text-dark') }}">
                        {{ $upload->status }}
                    </span>
                </p>
                <p><strong>Deskripsi:</strong> {{ $upload->descriptionproduct }}</p>
                <p><strong>Tanggal Dibuat:</strong> {{ \Carbon\Carbon::parse($upload->tanggaldibuat)->format('d-m-Y') }}</p>
                <p><strong>Link Produk:</strong> <a href="{{ $upload->link }}" target="_blank" class="text-primary">{{ $upload->link }}</a></p>
                
                @if($upload->image)
                    <div class="text-center mt-3">
                        <img src="{{ asset('images/' . $upload->image) }}" alt="Gambar Produk" class="img-fluid rounded shadow" style="max-width: 300px; border: 2px solid #ccc;">
                    </div>
                @else
                    <p class="text-muted">Tidak ada gambar untuk produk ini.</p>
                @endif
            </div>
        </div>

        
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script>
        AOS.init({
            duration: 1000,
            easing: 'ease-in-out',
        });
    </script>
</body>
</html>