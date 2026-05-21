<!DOCTYPE html>
<html>
<head>
    <title>Laporan Absensi</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        h2 { text-align: center; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #333; padding: 6px; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <div style="text-align: right; font-size: 10px;">Dicetak: {{ date('d-m-Y H:i') }}</div>
    <h2>Laporan Data Absensi</h2>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Karyawan</th>
                <th>Tanggal</th>
                <th>Masuk</th>
                <th>Keluar</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($attendances as $key => $row)
            <tr>
                <td align="center">{{ $key + 1 }}</td>
                <td>{{ $row->employee->nama_lengkap ?? '-' }}</td>
                <td align="center">{{ $row->tanggal }}</td>
                <td align="center">{{ $row->waktu_masuk }}</td>
                <td align="center">{{ $row->waktu_keluar ?? '-' }}</td>
                <td align="center">{{ ucfirst($row->status_absensi) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>