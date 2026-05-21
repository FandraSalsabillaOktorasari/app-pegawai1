@extends('master')

@section('title', 'Daftar Departemen')

@section('content')
    <div class="row mb-4 align-items-center">
        <div class="col-md-6">
            <h2 class="mb-0">Daftar Departemen</h2>
        </div>
        <div class="col-md-6">
            <div class="d-flex justify-content-md-end gap-2">
                <form action="{{ route('departments.index') }}" method="GET" class="d-flex">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Cari departemen..." value="{{ request('search') }}">
                        <button class="btn btn-outline-secondary" type="submit">Cari</button>
                    </div>
                </form>
                <a href="{{ route('departments.create') }}" class="btn btn-primary text-nowrap">
                    + Tambah Departemen
                </a>
            </div>
        </div>
    </div>

    {{-- Alert Pesan Sukses --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Tabel Data --}}
    <div class="table-responsive">
        <table class="table table-hover table-bordered align-middle">
            <thead class="table-light">
                <tr>
                    <th width="5%" class="text-center">No</th>
                    <th>Nama Departemen</th>
                    <th width="15%" class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($departments as $key => $department)
                <tr>
                    <td class="text-center">{{ $key + 1 }}</td>
                    <td>{{ $department->nama_departemen }}</td>
                    <td class="text-center">
                        {{-- Group Tombol Aksi --}}
                        <div class="btn-group" role="group">
                            {{-- Tombol Edit (Siapkan kodenya tapi di-komen dulu jika belum ada method edit) --}}
                            {{-- <a href="{{ route('departments.edit', $department->id) }}" class="btn btn-sm btn-warning text-white">Edit</a> --}}
                            
                            {{-- Form Delete --}}
                            <form action="{{ route('departments.destroy', $department->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus departemen ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="text-center py-4 text-muted">
                        <em>Data departemen belum tersedia.</em>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="d-flex justify-content-end mt-3">
        {{ $departments->links('pagination::bootstrap-5') }}
    </div>
@endsection