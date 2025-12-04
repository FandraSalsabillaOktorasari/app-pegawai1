@extends('master')

@section('title', 'Dashboard')

@section('page-title', 'Dashboard Ringkasan')

@section('content')
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="mb-4">Selamat Datang di App Pegawai 👋</h2>
        </div>
    </div>

    <div class="row">
        {{-- Widget 1: Total Pegawai --}}
        <div class="col-md-3">
            <div class="card text-white bg-primary mb-3 shadow">
                <div class="card-body">
                    <h5 class="card-title">Total Pegawai</h5>
                    <p class="card-text display-4 fw-bold">{{ $totalPegawai }}</p>
                    <small>Orang</small>
                </div>
            </div>
        </div>

        {{-- Widget 2: Total Departemen --}}
        <div class="col-md-3">
            <div class="card text-white bg-success mb-3 shadow">
                <div class="card-body">
                    <h5 class="card-title">Departemen</h5>
                    <p class="card-text display-4 fw-bold">{{ $totalDepartemen }}</p>
                    <small>Divisi Aktif</small>
                </div>
            </div>
        </div>

        {{-- Widget 3: Absensi Hari Ini --}}
        <div class="col-md-3">
            <div class="card text-white bg-warning mb-3 shadow">
                <div class="card-body">
                    <h5 class="card-title">Absensi Hari Ini</h5>
                    <p class="card-text display-4 fw-bold text-dark">{{ $hadirHariIni }}</p>
                    <small class="text-dark">{{ date('d M Y') }}</small>
                </div>
            </div>
        </div>

        {{-- Widget 4: Pengeluaran Gaji --}}
        <div class="col-md-3">
            <div class="card text-white bg-danger mb-3 shadow">
                <div class="card-body">
                    <h5 class="card-title">Gaji ({{ $bulanIni }})</h5>
                    {{-- Menggunakan logic font size dinamis biar angka panjang muat --}}
                    <p class="card-text fw-bold" style="font-size: 1.5rem; margin-top: 15px;">
                        Rp {{ number_format($totalGaji, 0, ',', '.') }}
                    </p>
                    <small>Total Pengeluaran</small>
                </div>
            </div>
        </div>
    </div>

    {{-- Section Pintasan Cepat --}}
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-white fw-bold">
                    Aksi Cepat
                </div>
                <div class="card-body">
                    <a href="{{ route('employees.create') }}" class="btn btn-outline-primary me-2">+ Tambah Pegawai</a>
                    <a href="{{ route('attendance.create') }}" class="btn btn-outline-warning me-2">+ Input Absensi</a>
                    <a href="{{ route('salaries.create') }}" class="btn btn-outline-danger">+ Input Gaji</a>
                </div>
            </div>
        </div>
    </div>
@endsection