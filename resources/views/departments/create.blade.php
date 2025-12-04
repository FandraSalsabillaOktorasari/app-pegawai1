@extends('master')

@section('title', 'Tambah Departemen')

@section('content')
<div class="container mt-5">
    <h2>Tambah Departemen Baru</h2>
    <br>
    
    <form action="{{ route('departments.store') }}" method="POST">
        @csrf
        
        <div style="margin-bottom: 15px;">
            <label for="nama_departemen"><strong>Nama Departemen:</strong></label><br>
            <input type="text" id="nama_departemen" name="nama_departemen" 
                   value="{{ old('nama_departemen') }}" 
                   placeholder="Masukkan nama departemen" required style="padding: 5px; width: 300px;">
            
            @error('nama_departemen')
                <div style="color: red; margin-top: 5px;">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" style="padding: 5px 15px; cursor: pointer;">Simpan</button>
        <a href="{{ route('departments.index') }}" style="margin-left: 10px;">Batal</a>
    </form>
</div>
@endsection