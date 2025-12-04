@extends('master')

@section('title', 'Daftar Jabatan')

@section('content')
    {{-- Header Halaman --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Daftar Jabatan</h2>
        <a href="{{ route('positions.create') }}" class="btn btn-primary shadow-sm">
            + Tambah Jabatan
        </a>
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
                    <th>Nama Jabatan</th>
                    <th>Gaji Pokok</th>
                    <th width="15%" class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($positions as $key => $position)
                <tr>
                    <td class="text-center">{{ $key + 1 }}</td>
                    <td>{{ $position->nama_jabatan }}</td>
                    <td>Rp {{ number_format($position->gaji_pokok, 0, ',', '.') }}</td>
                    <td class="text-center">
                        <div class="btn-group" role="group">
                            {{-- Tombol Edit (Opsional, aktifkan jika method edit sudah ada) --}}
                            {{-- <a href="{{ route('positions.edit', $position->id) }}" class="btn btn-sm btn-warning text-white">Edit</a> --}}
                            
                            {{-- Form Delete --}}
                            <form action="{{ route('positions.destroy', $position->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus jabatan ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center py-4 text-muted">
                        <em>Data jabatan belum tersedia.</em>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection