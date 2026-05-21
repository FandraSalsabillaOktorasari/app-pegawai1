@extends('master')
@section('title', 'Edit Proyek')

@section('content')
    <h2 class="mb-4">Edit Proyek</h2>
    <form action="{{ route('projects.update', $project->id) }}" method="POST">
        @csrf @method('PUT')
        
        {{-- Input text & date sama seperti create, tambahkan value="{{ $project->name }}" dst. --}}
        {{-- Agar singkat, saya fokus ke bagian Checkbox yang tricky --}}
        
        <div class="mb-3">
            <label>Nama Proyek</label>
            <input type="text" name="name" class="form-control" value="{{ $project->name }}" required>
        </div>
        
        {{-- ... (Silakan lengkapi input tanggal & klien seperti file create, pakai value=$project->...) ... --}}
        
        <div class="mb-3">
            <label>Status</label>
            <select name="status" class="form-select">
                <option value="pending" {{ $project->status == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="progress" {{ $project->status == 'progress' ? 'selected' : '' }}>On Progress</option>
                <option value="completed" {{ $project->status == 'completed' ? 'selected' : '' }}>Completed</option>
                <option value="maintenance" {{ $project->status == 'maintenance' ? 'selected' : '' }}>Maintenance</option>
            </select>
        </div>

        <div class="mb-4">
            <label class="form-label fw-bold">Update Tim</label>
            <div class="card p-3" style="max-height: 200px; overflow-y: auto;">
                @foreach($employees as $emp)
                    <div class="form-check">
                        {{-- Logika Check: Cek apakah ID pegawai ada di koleksi $project->employees --}}
                        <input class="form-check-input" type="checkbox" name="employee_ids[]" value="{{ $emp->id }}" 
                            id="emp{{ $emp->id }}"
                            {{ $project->employees->contains($emp->id) ? 'checked' : '' }}>
                        <label class="form-check-label" for="emp{{ $emp->id }}">
                            {{ $emp->nama_lengkap }}
                        </label>
                    </div>
                @endforeach
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Update Proyek</button>
    </form>
@endsection