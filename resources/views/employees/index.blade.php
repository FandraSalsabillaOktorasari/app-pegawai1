@extends('master')
@section('title', 'Daftar Pegawai')

@section('content')
    {{-- Header Halaman: Judul di kiri, Tombol di kanan --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Daftar Pegawai</h2>
        <a href="{{ route('employees.create') }}" class="btn btn-primary">
            + Tambah Pegawai
        </a>
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
@endsection