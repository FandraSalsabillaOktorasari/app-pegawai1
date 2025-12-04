@extends('master')
@section('title', 'Edit Absensi')

@section('content')
    <h2>Edit Data Absensi</h2>
    <form action="{{ route('attendance.update', $attendance->id) }}" method="POST">
        @csrf
        @method('PUT')
        <table>
            <tr>
                <td>Karyawan</td>
                <td>
                    <select name="karyawan_id" required>
                        @foreach($employees as $emp)
                            <option value="{{ $emp->id }}" {{ $attendance->karyawan_id == $emp->id ? 'selected' : '' }}>
                                {{ $emp->nama_lengkap }}
                            </option>
                        @endforeach
                    </select>
                </td>
            </tr>
            <tr>
                <td>Tanggal</td>
                <td><input type="date" name="tanggal" value="{{ $attendance->tanggal }}" required></td>
            </tr>
            <tr>
                <td>Waktu Masuk</td>
                <td><input type="time" name="waktu_masuk" value="{{ $attendance->waktu_masuk }}" required></td>
            </tr>
            <tr>
                <td>Waktu Keluar</td>
                <td><input type="time" name="waktu_keluar" value="{{ $attendance->waktu_keluar }}"></td>
            </tr>
            <tr>
                <td>Status</td>
                <td>
                    <select name="status_absensi" required>
                        <option value="hadir" {{ $attendance->status_absensi == 'hadir' ? 'selected' : '' }}>Hadir</option>
                        <option value="izin" {{ $attendance->status_absensi == 'izin' ? 'selected' : '' }}>Izin</option>
                        <option value="sakit" {{ $attendance->status_absensi == 'sakit' ? 'selected' : '' }}>Sakit</option>
                        <option value="alpha" {{ $attendance->status_absensi == 'alpha' ? 'selected' : '' }}>Alpha</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td colspan="2"><button type="submit">Update</button></td>
            </tr>
        </table>
    </form>
@endsection