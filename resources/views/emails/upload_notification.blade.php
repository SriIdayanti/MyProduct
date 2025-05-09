<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk Terbaru</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 100%;
            padding: 20px;
            background-color: #ffffff;
        }
        h1 {
            color: #007bff;
            text-align: center;
            font-size: 24px;
        }
        .card {
            border-radius: 15px;
            overflow: hidden;
            border: 1px solid #ddd;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .card-header {
            background: linear-gradient(to right, #007bff, #00c6ff);
            border-radius: 15px 15px 0 0;
            color: white;
            padding: 15px;
            text-align: center;
        }
        .card-body {
            padding: 15px;
        }
        .badge {
            font-size: 1rem;
            padding: 8px 12px;
        }
        .badge.bg-success {
            background-color: #28a745;
            color: white;
        }
        .badge.bg-danger {
            background-color: #dc3545;
            color: white;
        }
        .badge.bg-warning {
            background-color: #ffc107;
            color: black;
        }
        a {
            color: #007bff;
            text-decoration: none;
        }
        .img-container {
            text-align: center;
            margin-top: 20px;
        }
        .img-fluid {
            max-width: 300px;
            border: 2px solid #ccc;
            border-radius: 8px;
        }
        .text-muted {
            color: #6c757d;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Detail Upload Produk</h1>

        <div class="card">
            <div class="card-header">
                <h4>{{ $upload->namaproduk }}</h4>
            </div>
            <div class="card-body">
                <p><strong>Nama:</strong> {{ $upload->name }}</p>
                <p><strong>Kategori:</strong> {{ $upload->kategoriproduk }}</p>
                <p><strong>Status:</strong>
                    <span class="badge {{ $upload->status == 'Diterima' ? 'bg-success' : ($upload->status == 'Ditolak' ? 'bg-danger' : 'bg-warning') }}">
                        {{ $upload->status }}
                    </span>
                </p>
                <p><strong>Deskripsi:</strong> {{ $upload->descriptionproduct }}</p>
                <p><strong>Tanggal Dibuat:</strong> {{ \Carbon\Carbon::parse($upload->tanggaldibuat)->format('d-m-Y') }}</p>
                <p><strong>Link Produk:</strong> <a href="{{ $upload->link }}" target="_blank">{{ $upload->link }}</a></p>
                
                @if($upload->image)
                    <div class="img-container">
                        <img src="{{ asset('images/' . $upload->image) }}" alt="Gambar Produk" class="img-fluid">
                    </div>
                @else
                    <p class="text-muted">Tidak ada gambar untuk produk ini.</p>
                @endif
            </div>
        </div>
    </div>
</body>
</html>
