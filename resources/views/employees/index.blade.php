@extends('master')
@section('title', 'Daftar Pegawai')

@section('content')
    {{-- Header Halaman: Judul di kiri, Tombol di kanan --}}
{{-- Header Halaman: Judul, Search Bar, dan Tombol Tambah --}}
    {{-- Header Halaman: Judul, Filter, dan Tombol Tambah --}}
    <div class="row mb-4 align-items-center">
        <div class="col-md-4">
            <h2 class="mb-0">Daftar Pegawai</h2>
        </div>
        <div class="col-md-8">
            <div class="d-flex justify-content-md-end gap-2">
                {{-- Form Pencarian & Filter --}}
                <form action="{{ route('employees.index') }}" method="GET" class="d-flex gap-2">
                    
                    {{-- Dropdown Filter Skill --}}
                    <select name="skill_id" class="form-select" style="max-width: 180px;" onchange="this.form.submit()">
                        <option value="">-- Filter Skill --</option>
                        @foreach($skills as $skill)
                            <option value="{{ $skill->id }}" {{ request('skill_id') == $skill->id ? 'selected' : '' }}>
                                {{ $skill->name }}
                            </option>
                        @endforeach
                    </select>

                    {{-- Input Search Nama --}}
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Cari nama..." value="{{ request('search') }}">
                        <button class="btn btn-outline-secondary" type="submit">Cari</button>
                    </div>
                </form>
                
                {{-- Tombol Tambah --}}
                <a href="{{ route('employees.create') }}" class="btn btn-primary text-nowrap">
                    + Tambah
                </a>
            </div>
        </div>
    </div>

    {{-- Pesan Sukses (Muncul setelah simpan/update/hapus) --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Tabel Data --}}
    <div class="table-responsive">
        <table class="table table-hover table-bordered">
            <thead class="table-light">
                <tr>
                    <th>Nama Lengkap</th>
                    <th>Email</th>
                    <th>Skills (Stack)</th>
                    <th>Departemen</th>
                    <th>Jabatan</th>
                    <th>Telepon</th>
                    <th>Status</th>
                    <th width="150px">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($employees as $employee)
                <tr>
                    <td>{{ $employee->nama_lengkap }}</td>
                    <td>{{ $employee->email }}</td>
                    <td>
                        @foreach($employee->skills as $skill)
                            @php
                                 $color = match($skill->pivot->level) {
                                    'beginner' => 'bg-secondary',
                                    'intermediate' => 'bg-primary',
                                    'expert' => 'bg-success',
                                    default => 'bg-light'
                                };
                            @endphp
                            <span class="badge {{ $color }} mb-1">
                                {{ $skill->name }} <small>({{ substr($skill->pivot->level, 0, 1) }})</small>
                            </span>
                        @endforeach
                    </td>
                    <td>{{ $employee->department->nama_departemen ?? '-' }}</td>
                    <td>{{ $employee->position->nama_jabatan ?? '-' }}</td>
                    <td>{{ $employee->nomor_telepon }}</td>
                    <td>
                        <span class="badge {{ $employee->status == 'aktif' ? 'bg-success' : 'bg-danger' }}">
                            {{ ucfirst($employee->status) }}
                        </span>
                    </td>
                    <td>
                        <div class="btn-group" role="group">
                            <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-sm btn-warning text-white">Edit</a>
                            
                            <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus pegawai ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center py-4">
                        <div class="text-muted">Belum ada data pegawai.</div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination (Jika ada) --}}
    <div class="d-flex justify-content-end">
        {{-- {{ $employees->links() }} --}} 
        {{-- Uncomment baris di atas jika Anda menggunakan paginate() di controller --}}
    </div>
    {{-- Pagination dengan Style Bootstrap --}}
    <div class="d-flex justify-content-end mt-3">
        {{ $employees->links('pagination::bootstrap-5') }}
    </div>
@endsection