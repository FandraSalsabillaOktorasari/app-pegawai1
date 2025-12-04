@extends('master')

@section('title', 'Tambah Jabatan')

@section('content')
<div class="container mt-5">
    <h2>Tambah Jabatan Baru</h2>
    <br>
    
    <form action="{{ route('positions.store') }}" method="POST">
        @csrf
        
        <div style="margin-bottom: 15px;">
            <label for="nama_jabatan"><strong>Nama Jabatan:</strong></label><br>
            <input type="text" id="nama_jabatan" name="nama_jabatan" required style="padding: 5px; width: 300px;">
        </div>

        <div style="margin-bottom: 15px;">
            <label for="gaji_pokok"><strong>Gaji Pokok:</strong></label><br>
            <input type="number" id="gaji_pokok" name="gaji_pokok" required style="padding: 5px; width: 300px;">
        </div>

        <button type="submit" style="padding: 5px 15px; cursor: pointer;">Simpan</button>
        <a href="{{ route('positions.index') }}" style="margin-left: 10px;">Batal</a>
    </form>
</div>
@endsection