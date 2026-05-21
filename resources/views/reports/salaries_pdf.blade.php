<!DOCTYPE html>
<html>
<head>
    <title>Laporan Gaji</title>
    <style>
        body { font-family: sans-serif; font-size: 11px; } /* Font agak kecil biar muat */
        h2 { text-align: center; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #333; padding: 5px; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <div style="text-align: right; font-size: 10px;">Dicetak: {{ date('d-m-Y H:i') }}</div>
    <h2>Laporan Data Gaji Karyawan</h2>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Karyawan</th>
                <th>Bulan</th>
                <th>Gaji Pokok</th>
                <th>Tunjangan</th>
                <th>Potongan</th>
                <th>Total Gaji</th>
            </tr>
        </thead>
        <tbody>
            @foreach($salaries as $key => $row)
            <tr>
                <td align="center">{{ $key + 1 }}</td>
                <td>{{ $row->employee->nama_lengkap ?? '-' }}</td>
                <td align="center">{{ $row->bulan }}</td>
                <td align="right">Rp {{ number_format($row->gaji_pokok, 0, ',', '.') }}</td>
                <td align="right">Rp {{ number_format($row->tunjangan, 0, ',', '.') }}</td>
                <td align="right">Rp {{ number_format($row->potongan, 0, ',', '.') }}</td>
                <td align="right"><strong>Rp {{ number_format($row->total_gaji, 0, ',', '.') }}</strong></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>