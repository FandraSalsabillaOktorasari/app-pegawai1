@extends('master')
@section('title', 'Input Gaji')

@section('content')
    <h2>Input Gaji Pegawai</h2>
    <form action="{{ route('salaries.store') }}" method="POST">
        @csrf
        <table>
            <tr>
                <td>Karyawan</td>
                <td>
                    <select name="karyawan_id" required>
                        <option value="">-- Pilih Karyawan --</option>
                        @foreach($employees as $emp)
                            <option value="{{ $emp->id }}">{{ $emp->nama_lengkap }}</option>
                        @endforeach
                    </select>
                </td>
            </tr>
            <tr>
                <td>Bulan (Cth: September 2025)</td>
                <td><input type="text" name="bulan" required></td>
            </tr>
            <tr>
                <td>Gaji Pokok</td>
                <td><input type="number" name="gaji_pokok" required></td>
            </tr>
            <tr>
                <td>Tunjangan</td>
                <td><input type="number" name="tunjangan" value="0" required></td>
            </tr>
            <tr>
                <td>Potongan</td>
                <td><input type="number" name="potongan" value="0" required></td>
            </tr>
            <tr>
                <td colspan="2">
                    <button type="submit">Simpan & Hitung Total</button>
                </td>
            </tr>
        </table>
    </form>
@endsection