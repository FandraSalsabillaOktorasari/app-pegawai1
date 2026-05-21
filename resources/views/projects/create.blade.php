@extends('master')
@section('title', 'Buat Proyek')

@section('content')
    <h2 class="mb-4">Buat Proyek Baru</h2>
    <form action="{{ route('projects.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Nama Proyek</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Nama Klien</label>
                <input type="text" name="client_name" class="form-control">
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Tanggal Mulai</label>
                <input type="date" name="start_date" class="form-control" required>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Deadline (Selesai)</label>
                <input type="date" name="end_date" class="form-control" required>
            </div>
            <div class="col-md-12 mb-3">
                <label class="form-label">Status Proyek</label>
                <select name="status" class="form-select">
                    <option value="pending">Pending</option>
                    <option value="progress">On Progress</option>
                    <option value="completed">Completed</option>
                    <option value="maintenance">Maintenance</option>
                </select>
            </div>
            
            <div class="col-md-12 mb-4">
                <label class="form-label fw-bold">Pilih Tim (Pegawai)</label>
                <div class="card p-3" style="max-height: 200px; overflow-y: auto;">
                    @foreach($employees as $emp)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="employee_ids[]" value="{{ $emp->id }}" id="emp{{ $emp->id }}">
                            <label class="form-check-label" for="emp{{ $emp->id }}">
                                {{ $emp->nama_lengkap }} <small class="text-muted">({{ $emp->position->nama_jabatan ?? '-' }})</small>
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Simpan Proyek</button>
    </form>
@endsection