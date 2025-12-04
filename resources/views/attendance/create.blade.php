@extends('master')
@section('title', 'Input Absensi')

@section('content')
    <h2>Input Absensi Baru</h2>
    <form action="{{ route('attendance.store') }}" method="POST">
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
                <td>Tanggal</td>
                <td><input type="date" name="tanggal" required></td>
            </tr>
            <tr>
                <td>Waktu Masuk</td>
                <td><input type="time" name="waktu_masuk" required></td>
            </tr>
            <tr>
                <td>Waktu Keluar</td>
                <td><input type="time" name="waktu_keluar"></td>
            </tr>
            <tr>
                <td>Status</td>
                <td>
                    <select name="status_absensi" required>
                        <option value="hadir">Hadir</option>
                        <option value="izin">Izin</option>
                        <option value="sakit">Sakit</option>
                        <option value="alpha">Alpha</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td colspan="2"><button type="submit">Simpan</button></td>
            </tr>
        </table>
    </form>
@endsection