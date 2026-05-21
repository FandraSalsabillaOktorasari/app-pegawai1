@extends('master')

@section('title', 'Daftar Absensi')

@section('content')
    <div class="row mb-4 align-items-center">
        <div class="col-md-6">
            <h2 class="mb-0">Daftar Absensi</h2>
        </div>
        <div class="col-md-6">
            <div class="d-flex justify-content-md-end gap-2">
                <form action="{{ route('attendance.index') }}" method="GET" class="d-flex">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Cari nama karyawan..." value="{{ request('search') }}">
                        <button class="btn btn-outline-secondary" type="submit">Cari</button>
                    </div>
                </form>
                <a href="{{ route('attendance.create') }}" class="btn btn-primary text-nowrap">
                    + Tambah Absensi
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
                    <th>Nama Karyawan</th>
                    <th>Tanggal</th>
                    <th>Masuk</th>
                    <th>Keluar</th>
                    <th class="text-center">Status</th>
                    <th width="15%" class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($attendances as $key => $row)
                <tr>
                    <td class="text-center">{{ $key + 1 }}</td>
                    <td>{{ $row->employee->nama_lengkap ?? '-' }}</td>
                    <td>{{ $row->tanggal }}</td>
                    <td>{{ $row->waktu_masuk }}</td>
                    <td>{{ $row->waktu_keluar ?? '-' }}</td>
                    <td class="text-center">
                        {{-- Badge Warna-warni sesuai Status --}}
                        @php
                            $badgeClass = match($row->status_absensi) {
                                'hadir' => 'bg-success',
                                'izin' => 'bg-warning text-dark',
                                'sakit' => 'bg-info text-dark',
                                'alpha' => 'bg-danger',
                                default => 'bg-secondary'
                            };
                        @endphp
                        <span class="badge {{ $badgeClass }}">
                            {{ ucfirst($row->status_absensi) }}
                        </span>
                    </td>
                    <td class="text-center">
                        <div class="btn-group" role="group">
                            {{-- Edit Button (Opsional) --}}
                            {{-- <a href="{{ route('attendance.edit', $row->id) }}" class="btn btn-sm btn-warning text-white">Edit</a> --}}
                            
                            {{-- Delete Form --}}
                            <form action="{{ route('attendance.destroy', $row->id) }}" method="POST" onsubmit="return confirm('Hapus data absensi ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center py-4 text-muted">
                        <em>Belum ada data absensi.</em>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="d-flex justify-content-end mt-3">
        {{ $attendances->links('pagination::bootstrap-5') }}
    </div>
@endsection