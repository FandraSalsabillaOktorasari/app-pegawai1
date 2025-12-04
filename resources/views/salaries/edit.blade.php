@extends('master')
@section('title', 'Edit Gaji')

@section('content')
    <h2>Edit Data Gaji</h2>
    <form action="{{ route('salaries.update', $salary->id) }}" method="POST">
        @csrf
        @method('PUT')
        <table>
            <tr>
                <td>Karyawan</td>
                <td>
                    <select name="karyawan_id" required>
                        @foreach($employees as $emp)
                            <option value="{{ $emp->id }}" {{ $salary->karyawan_id == $emp->id ? 'selected' : '' }}>
                                {{ $emp->nama_lengkap }}
                            </option>
                        @endforeach
                    </select>
                </td>
            </tr>
            <tr>
                <td>Bulan</td>
                <td><input type="text" name="bulan" value="{{ $salary->bulan }}" required></td>
            </tr>
            <tr>
                <td>Gaji Pokok</td>
                <td><input type="number" name="gaji_pokok" value="{{ $salary->gaji_pokok }}" required></td>
            </tr>
            <tr>
                <td>Tunjangan</td>
                <td><input type="number" name="tunjangan" value="{{ $salary->tunjangan }}" required></td>
            </tr>
            <tr>
                <td>Potongan</td>
                <td><input type="number" name="potongan" value="{{ $salary->potongan }}" required></td>
            </tr>
            <tr>
                <td colspan="2"><button type="submit">Update & Hitung Ulang</button></td>
            </tr>
        </table>
    </form>
@endsection