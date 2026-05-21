@extends('master')
@section('title', 'Manajemen Proyek')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Daftar Proyek</h2>
        <a href="{{ route('projects.create') }}" class="btn btn-primary shadow-sm">+ Buat Proyek</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-hover table-bordered align-middle">
            <thead class="table-light">
                <tr>
                    <th>Nama Proyek</th>
                    <th>Klien</th>
                    <th>Deadline</th>
                    <th>Status</th>
                    <th width="25%">Tim (Pegawai)</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($projects as $project)
                <tr>
                    <td class="fw-bold">{{ $project->name }}</td>
                    <td>{{ $project->client_name ?? '-' }}</td>
                    <td>{{ \Carbon\Carbon::parse($project->end_date)->format('d M Y') }}</td>
                    <td>
                        @php
                            $badge = match($project->status) {
                                'pending' => 'bg-secondary',
                                'progress' => 'bg-primary',
                                'completed' => 'bg-success',
                                'maintenance' => 'bg-warning text-dark',
                                default => 'bg-light text-dark'
                            };
                        @endphp
                        <span class="badge {{ $badge }}">{{ ucfirst($project->status) }}</span>
                    </td>
                    <td>
                        {{-- Loop untuk menampilkan avatar/nama pegawai --}}
                        @foreach($project->employees as $emp)
                            <span class="badge bg-info text-dark mb-1">{{ $emp->nama_lengkap }}</span>
                        @endforeach
                        @if($project->employees->isEmpty())
                            <small class="text-muted">Belum ada tim</small>
                        @endif
                    </td>
                    <td>
                        <div class="btn-group">
                            <a href="{{ route('projects.edit', $project->id) }}" class="btn btn-sm btn-warning text-white">Edit</a>
                            <form action="{{ route('projects.destroy', $project->id) }}" method="POST" onsubmit="return confirm('Hapus proyek ini?');">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="text-center py-4">Belum ada data proyek.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="d-flex justify-content-end mt-3">{{ $projects->links('pagination::bootstrap-5') }}</div>
@endsection