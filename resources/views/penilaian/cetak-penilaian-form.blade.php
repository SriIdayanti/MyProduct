<h2>Data Penilaian</h2>
    <table border="1">
        <tr>
            <th>No</th>
            <th>Nama User</th>
            <th>Nama File</th>
            <th>Nilai</th>
            <th>Tanggal</th>
        </tr>
        @foreach($penilaiancetak as $key => $data)
        <tr>
            <td>{{ $key+1 }}</td>
            <td>{{ $data->user->name }}</td>
            <td>{{ $data->upload->file_name }}</td>
            <td>{{ $data->nilai }}</td>
            <td>{{ $data->created_at }}</td>
        </tr>
        @endforeach
    </table>
    <a href="{{ route('cetakForm') }}">Cetak Berdasarkan Tanggal</a>
