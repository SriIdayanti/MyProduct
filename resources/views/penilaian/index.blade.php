@extends('layouts.app')

@section('content')

<div class="container mt-5">
    <div class="card shadow">
        <div class="card-body">
            <h2 class="text-center mb-4">Daftar Penilaian</h2>

            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-3 gap-2">
                <a href="{{ route('penilaian.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle"></i> Buat Penilaian Baru
                </a>

                <div class="d-flex gap-2 flex-grow-1 justify-content-end">
                    <input 
                        type="text" 
                        id="searchInput" 
                        class="form-control w-auto" 
                        placeholder="Cari Nama Siswa..." 
                        onkeyup="searchNamaSiswa()"
                    >
                    <button class="btn btn-outline-secondary" onclick="showPrintOptions()">
                        <i class="bi bi-printer"></i> Cetak PDF
                    </button>
                </div>
            </div>

            <div class="table-responsive" id="print-area">
                <table class="table table-bordered table-hover text-center align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Nama Siswa</th>
                            <th>Nama Produk</th>
                            <th>Rating</th>
                            <th>Komentar</th>
                            <th>Tanggal Penilaian</th>
                            <th>Tanggal Pengajuan</th>
                            <th class="no-export">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody">
                        @foreach($penilaians as $penilaian)
                            <tr data-penilaian="{{ $penilaian->tanggal }}" data-pengajuan="{{ $penilaian->upload->tanggaldibuat ?? '-' }}">
                                <td>{{ $penilaian->penilaianID }}</td>
                                <td>{{ $penilaian->upload->name ?? '-' }}</td>
                                <td>{{ $penilaian->upload->namaproduk ?? '-' }}</td>
                                <td>{{ $penilaian->rating }}</td>
                                <td>{{ $penilaian->komentar }}</td>
                                <td>{{ $penilaian->tanggal }}</td>
                                <td>{{ $penilaian->upload->tanggaldibuat ?? '-' }}</td>
                                <td class="no-export">
                                    <a href="{{ route('penilaian.edit', $penilaian->penilaianID) }}" class="btn btn-sm btn-warning me-1">Edit</a>
                                    <form action="{{ route('penilaian.destroy', $penilaian->penilaianID) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>

<!-- Modal Cetak -->
<div class="modal fade" id="printModal" tabindex="-1" aria-labelledby="printModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content shadow">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="printModalLabel">Pilih Rentang Tanggal</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <label for="filterType">Filter Berdasarkan:</label>
                <select id="filterType" class="form-control">
                    <option value="penilaian">Tanggal Penilaian</option>
                    <option value="pengajuan">Tanggal Pengajuan</option>
                </select>
                <label for="startDate" class="mt-2">Tanggal Awal:</label>
                <input type="date" id="startDate" class="form-control">
                <label for="endDate" class="mt-2">Tanggal Akhir:</label>
                <input type="date" id="endDate" class="form-control">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" onclick="printFiltered()">Cetak PDF</button>
            </div>
        </div>
    </div>
</div>

<!-- Gaya CSS -->
<style>
    @media print {
        .no-export {
            display: none !important;
        }
    }

    .table td, .table th {
        vertical-align: middle !important;
    }
</style>

<!-- Script JavaScript TIDAK DIUBAH -->
<script>
    function showPrintOptions() {
        let printModal = new bootstrap.Modal(document.getElementById('printModal'));
        printModal.show();
    }

    function searchNamaSiswa() {
        const input = document.getElementById("searchInput").value.toLowerCase().trim();
        const rows = document.querySelectorAll("#tableBody tr");

        rows.forEach(row => {
            const namaCell = row.cells[1];
            const nama = namaCell ? namaCell.textContent.toLowerCase() : '';
            row.style.display = nama.includes(input) ? '' : 'none';
        });
    }

    function printFiltered() {
        const startDate = document.getElementById('startDate').value;
        const endDate = document.getElementById('endDate').value;
        const filterType = document.getElementById('filterType').value;
        const today = new Date().toISOString().split('T')[0];

        if (!startDate || !endDate) {
            alert("Silakan pilih rentang tanggal terlebih dahulu!");
            return;
        }

        const rows = document.querySelectorAll('#tableBody tr');
        let validRows = [];

        rows.forEach(row => {
            let rowDate = row.getAttribute(`data-${filterType}`);
            if (rowDate && rowDate >= startDate && rowDate <= endDate) {
                validRows.push(row.outerHTML);
            }
        });

        if (validRows.length === 0) {
            alert("Tidak ada data dalam rentang tanggal yang dipilih.");
            return;
        }

        let printContent = `
            <html>
            <head>
                <title>Cetak Laporan</title>
                <style>
                    body { font-family: Arial, sans-serif; padding: 20px; color: #333; }
                    h2 { text-align: center; }
                    table { width: 100%; border-collapse: collapse; margin-top: 20px; }
                    th, td { border: 1px solid black; padding: 8px; text-align: center; }
                    th { background-color: #007bff; color: white; }
                    .no-export { display: none; }
                </style>
            </head>
            <body>
                <h2>Laporan Penilaian</h2>
                <p><strong>Periode:</strong> ${startDate} - ${endDate}</p>
                <p><strong>Tanggal Cetak:</strong> ${today}</p>
                <table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Siswa</th>
                            <th>Nama Produk</th>
                            <th>Rating</th>
                            <th>Komentar</th>
                            <th>Tanggal Penilaian</th>
                            <th>Tanggal Pengajuan</th>
                        </tr>
                    </thead>
                    <tbody>
                        ${validRows.join('')}
                    </tbody>
                </table>
            </body>
            </html>
        `;

        let newWin = window.open("", "_blank");
        newWin.document.write(printContent);
        newWin.document.close();
        newWin.print();
    }
</script>

@endsection
