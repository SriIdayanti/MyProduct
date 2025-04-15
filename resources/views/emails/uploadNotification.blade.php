<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifikasi Upload Berhasil</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background-color: #f5f7fa;
            color: #333;
            line-height: 1.6;
        }
        
        .container {
            max-width: 800px;
            margin: 40px auto;
            padding: 30px;
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }
        
        .header {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 2px solid #f0f0f0;
        }
        
        .header h1 {
            color: #4CAF50;
            font-size: 32px;
            margin-bottom: 10px;
            display: inline-block;
            position: relative;
        }
        
        .header h1:after {
            content: "✓";
            display: inline-block;
            background: #4CAF50;
            color: white;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            font-size: 18px;
            line-height: 30px;
            margin-left: 10px;
            text-align: center;
        }
        
        .product-info {
            background: #f9f9f9;
            padding: 25px;
            border-radius: 10px;
            margin-bottom: 30px;
        }
        
        .info-item {
            display: flex;
            margin-bottom: 15px;
            border-bottom: 1px dashed #e0e0e0;
            padding-bottom: 15px;
        }
        
        .info-item:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }
        
        .info-label {
            font-weight: bold;
            width: 150px;
            color: #555;
        }
        
        .info-value {
            flex: 1;
        }
        
        .category-tag {
            display: inline-block;
            padding: 5px 10px;
            background: #2196F3;
            color: white;
            border-radius: 20px;
            font-size: 14px;
        }
        
        .link-value {
            color: #2196F3;
            text-decoration: underline;
            word-break: break-all;
        }
        
        .image-container {
            text-align: center;
            margin-top: 20px;
            padding: 15px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
        }
        
        .product-image {
            max-width: 200px;
            height: auto;
            border-radius: 8px;
            box-shadow: 0 3px 15px rgba(0, 0, 0, 0.1);
        }
        
        .no-image {
            padding: 30px;
            background: #f5f5f5;
            color: #888;
            border-radius: 8px;
            font-style: italic;
        }
        
        .footer {
            margin-top: 30px;
            text-align: center;
            color: #777;
            font-size: 14px;
        }

        /* Tambahan CSS untuk tombol */
        .btn-penilaian {
            display: inline-block;
            margin-top: 15px;
            padding: 12px 20px;
            background: #4CAF50;
            color: white;
            font-size: 16px;
            text-decoration: none;
            border-radius: 5px;
            transition: 0.3s;
        }

        .btn-penilaian:hover {
            background: #45a049;
        }
        
        @media (max-width: 600px) {
            .container {
                padding: 20px;
                margin: 20px;
            }
            
            .info-item {
                flex-direction: column;
            }
            
            .info-label {
                width: 100%;
                margin-bottom: 5px;
            }
            
            .product-image {
                max-width: 150px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Upload Berhasil</h1>
            <p>Produk Anda telah berhasil diunggah ke sistem!</p>
        </div>
        
        <div class="product-info">
            <div class="info-item">
                <div class="info-label">Nama Produk:</div>
                <div class="info-value">{{ $upload->namaproduk }}</div>
            </div>
            
            <div class="info-item">
                <div class="info-label">Nama Siswa:</div>
                <div class="info-value">{{ $upload->name }}</div>
            </div>
            
            <div class="info-item">
                <div class="info-label">Kategori:</div>
                <div class="info-value">
                    <span class="category-tag">{{ $upload->kategoriproduk }}</span>
                </div>
            </div>
            
            <div class="info-item">
                <div class="info-label">Tanggal Upload:</div>
                <div class="info-value">{{ \Carbon\Carbon::parse($upload->tanggaldibuat)->format('d-m-Y') }}</div>
            </div>
            
            <div class="info-item">
                <div class="info-label">Link:</div>
                <div class="info-value">
                    <a href="{{ $upload->link }}" class="link-value" target="_blank">{{ $upload->link }}</a>
                </div>
            </div>
        </div>
        
        <div class="image-container">
            @if($upload->image)
                <img src="{{ asset('images/' . $upload->image) }}" alt="Gambar Produk" class="product-image">
            @else
                <div class="no-image">Tidak ada gambar untuk produk ini.</div>
            @endif
        </div>
        
        <div class="footer">
            <p>Terima kasih telah menggunakan layanan kami!</p>
           
        </div>
    </div>
</body>
</html>
