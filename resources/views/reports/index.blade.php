@extends('master')

@section('title', 'Laporan')

@section('content')
    <h2 class="mb-4">Pusat Laporan</h2>

    <div class="row">
        {{-- Card Laporan Pegawai --}}
        <div class="col-md-6">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <h5 class="card-title"><i class="bi bi-people-fill text-primary"></i> Laporan Pegawai</h5>
                    <p class="card-text text-muted">Cetak daftar lengkap seluruh pegawai beserta departemen dan jabatannya dalam format PDF.</p>
                    <a href="{{ route('reports.employees.pdf') }}" target="_blank" class="btn btn-primary w-100">
                        Cetak PDF
                    </a>
                </div>
            </div>
        </div>

        {{-- Card Placeholder (Untuk Laporan Lain Nanti) --}}
        <div class="col-md-6">
            <div class="card shadow-sm h-100 bg-light border-0">
                <div class="card-body text-center d-flex flex-column justify-content-center">
                    <h5 class="text-muted">Laporan Gaji & Absensi</h5>
                    <p class="small text-muted">Fitur akan datang...</p>
                </div>
            </div>
        </div>
    </div>
@endsection