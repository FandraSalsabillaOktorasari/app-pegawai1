@extends('master')

@section('title', 'Daftar Absensi')

@section('content')
    {{-- Header Halaman --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Daftar Absensi Karyawan</h2>
        <a href="{{ route('attendance.create') }}" class="btn btn-primary shadow-sm">
            + Tambah Absensi
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
@endsection