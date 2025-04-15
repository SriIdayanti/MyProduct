<h2>Cetak Penilaian Berdasarkan Tanggal</h2>
<form action="{{ route('cetakpenilaianPertanggal') }}" method="GET">
    <label for="tglawal">Tanggal Awal:</label>
    <input type="date" name="tglawal" required>

    <label for="tglakhir">Tanggal Akhir:</label>
    <input type="date" name="tglakhir" required>

    <button type="submit">Cetak</button>
</form>
