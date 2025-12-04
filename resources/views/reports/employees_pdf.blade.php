<!DOCTYPE html>
<html>
<head>
    <title>Laporan Data Pegawai</title>
    <style>
        body { font-family: sans-serif; }
        h2 { text-align: center; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #333; padding: 8px; font-size: 12px; }
        th { background-color: #f2f2f2; }
        .tgl { font-size: 10px; float: right; }
    </style>
</head>
<body>
    <span class="tgl">Dicetak pada: {{ date('d-m-Y H:i') }}</span>
    <h2>Laporan Data Pegawai</h2>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Lengkap</th>
                <th>Email</th>
                <th>Departemen</th>
                <th>Jabatan</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($employees as $index => $emp)
            <tr>
                <td align="center">{{ $index + 1 }}</td>
                <td>{{ $emp->nama_lengkap }}</td>
                <td>{{ $emp->email }}</td>
                <td>{{ $emp->department->nama_departemen ?? '-' }}</td>
                <td>{{ $emp->position->nama_jabatan ?? '-' }}</td>
                <td align="center">{{ ucfirst($emp->status) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
