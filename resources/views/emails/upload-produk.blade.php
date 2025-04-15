<!DOCTYPE html>
<html>
<head>
    <title>Daftar Upload Produk Siswa</title>
</head>
<body>
    <h2>Daftar Upload Produk Siswa</h2>
    <table border="1" cellpadding="10" cellspacing="0">
        <thead>
            <tr>
                <th>Nama Produk</th>
                <th>Kategori</th>
                <th>Tanggal Dibuat</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($uploads as $upload)
            <tr>
                <td>{{ $upload->namaproduk }}</td>
                <td>{{ $upload->kategoriproduk }}</td>
                <td>{{ \Carbon\Carbon::parse($upload->tanggaldibuat)->format('d-m-Y') }}</td>
                <td>{{ $upload->status }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
