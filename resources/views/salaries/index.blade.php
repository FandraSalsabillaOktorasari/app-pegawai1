@extends('master')

@section('title', 'Daftar Gaji')

@section('content')
    <div class="row mb-4 align-items-center">
        <div class="col-md-6">
            <h2 class="mb-0">Daftar Gaji</h2>
        </div>
        <div class="col-md-6">
            <div class="d-flex justify-content-md-end gap-2">
                <form action="{{ route('salaries.index') }}" method="GET" class="d-flex">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Cari nama/bulan..." value="{{ request('search') }}">
                        <button class="btn btn-outline-secondary" type="submit">Cari</button>
                    </div>
                </form>
                <a href="{{ route('salaries.create') }}" class="btn btn-primary text-nowrap">
                    + Input Gaji Baru
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
                    <th>Karyawan</th>
                    <th>Bulan</th>
                    <th>Gaji Pokok</th>
                    <th>Tunjangan</th>
                    <th>Potongan</th>
                    <th>Total Gaji</th>
                    <th width="15%" class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($salaries as $key => $row)
                <tr>
                    <td class="text-center">{{ $key + 1 }}</td>
                    <td>
                        <span class="fw-bold">{{ $row->employee->nama_lengkap ?? '-' }}</span>
                        <br>
                        <small class="text-muted">{{ $row->employee->department->nama_departemen ?? '' }}</small>
                    </td>
                    <td>{{ $row->bulan }}</td>
                    <td>Rp {{ number_format($row->gaji_pokok, 0, ',', '.') }}</td>
                    <td class="text-success">+ Rp {{ number_format($row->tunjangan, 0, ',', '.') }}</td>
                    <td class="text-danger">- Rp {{ number_format($row->potongan, 0, ',', '.') }}</td>
                    <td>
                        <strong class="text-primary">Rp {{ number_format($row->total_gaji, 0, ',', '.') }}</strong>
                    </td>
                    <td class="text-center">
                        <div class="btn-group" role="group">
                            {{-- Edit Button --}}
                            <a href="{{ route('salaries.edit', $row->id) }}" class="btn btn-sm btn-warning text-white">Edit</a>
                            
                            {{-- Delete Form --}}
                            <form action="{{ route('salaries.destroy', $row->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data gaji ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center py-4 text-muted">
                        <em>Belum ada data gaji.</em>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    {{-- Tambahkan Pagination --}}
    <div class="d-flex justify-content-end mt-3">
        {{ $salaries->links('pagination::bootstrap-5') }}
    </div>
@endsection