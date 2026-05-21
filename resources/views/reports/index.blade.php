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

        {{-- Card Laporan Absensi & Gaji --}}
        <div class="col-md-6">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <h5 class="card-title"><i class="bi bi-file-earmark-text-fill text-success"></i> Laporan Lainnya</h5>
                    <p class="card-text text-muted">Cetak laporan riwayat kehadiran dan rekapitulasi gaji karyawan.</p>
                    
                    <div class="d-grid gap-2">
                        <a href="{{ route('reports.attendance.pdf') }}" target="_blank" class="btn btn-outline-success">
                            <i class="bi bi-printer"></i> Cetak Laporan Absensi
                        </a>
                        <a href="{{ route('reports.salaries.pdf') }}" target="_blank" class="btn btn-outline-danger">
                            <i class="bi bi-printer"></i> Cetak Laporan Gaji
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection