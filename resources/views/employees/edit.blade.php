@extends('master')
@section('title', 'Edit Pegawai')

@section('content')
    <h2 class="mb-4">Edit Data Pegawai</h2>
    
    <form action="{{ route('employees.update', $employee->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <table>
            <tr>
                <td><label for="nama_lengkap">Nama Lengkap</label></td>
                <td><input type="text" id="nama_lengkap" name="nama_lengkap" value="{{ old('nama_lengkap', $employee->nama_lengkap) }}" required></td>
            </tr>
            <tr>
                <td><label for="email">Email</label></td>
                <td><input type="email" id="email" name="email" value="{{ old('email', $employee->email) }}" required></td>
            </tr>
            <tr>
                <td><label for="nomor_telepon">Nomor Telepon</label></td>
                <td><input type="text" id="nomor_telepon" name="nomor_telepon" value="{{ old('nomor_telepon', $employee->nomor_telepon) }}" required></td>
            </tr>
            <tr>
                <td><label for="tanggal_lahir">Tanggal Lahir</label></td>
                <td><input type="date" id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir', $employee->tanggal_lahir) }}" required></td>
            </tr>
            <tr>
                <td><label for="alamat">Alamat</label></td>
                <td><textarea id="alamat" name="alamat" required>{{ old('alamat', $employee->alamat) }}</textarea></td>
            </tr>

            {{-- UPDATE DEPARTEMEN --}}
            <tr>
                <td><label for="departemen_id">Departemen</label></td>
                <td>
                    <select name="departemen_id" id="departemen_id" required>
                        <option value="">-- Pilih Departemen --</option>
                        @foreach($departments as $dept)
                            <option value="{{ $dept->id }}" 
                                {{ old('departemen_id', $employee->departemen_id) == $dept->id ? 'selected' : '' }}>
                                {{ $dept->nama_departemen }}
                            </option>
                        @endforeach
                    </select>
                </td>
            </tr>

            {{-- UPDATE JABATAN --}}
            <tr>
                <td><label for="jabatan_id">Jabatan</label></td>
                <td>
                    <select name="jabatan_id" id="jabatan_id" required>
                        <option value="">-- Pilih Jabatan --</option>
                        @foreach($positions as $pos)
                            <option value="{{ $pos->id }}" 
                                {{ old('jabatan_id', $employee->jabatan_id) == $pos->id ? 'selected' : '' }}>
                                {{ $pos->nama_jabatan }}
                            </option>
                        @endforeach
                    </select>
                </td>
            </tr>

            <tr>
                <td><label for="tanggal_masuk">Tanggal Masuk</label></td>
                <td><input type="date" id="tanggal_masuk" name="tanggal_masuk" value="{{ old('tanggal_masuk', $employee->tanggal_masuk) }}" required></td>
            </tr>
            <tr>
                <td><label for="status">Status</label></td>
                <td>
                    <select name="status" id="status">
                        <option value="aktif" {{ old('status', $employee->status) == 'aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="nonaktif" {{ old('status', $employee->status) == 'nonaktif' ? 'selected' : '' }}>Tidak Aktif</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <button type="submit">Update</button>
                    <a href="{{ route('employees.index') }}" style="margin-left: 10px;">Batal</a>
                </td>
            </tr>
        </table>
    </form>
@endsection