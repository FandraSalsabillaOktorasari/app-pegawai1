<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'App Pegawai')</title>
    
    {{-- 1. Load Bootstrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    {{-- 2. Load Google Font: Poppins --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    {{-- 3. Custom CSS --}}
    <style>
        /* Global Styles */
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f0f2f5;
            padding-top: 80px;
            color: #333;
        }

        /* Navbar Styling */
        .navbar {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            padding: 15px 0;
        }
        
        .navbar-brand {
            font-weight: 600;
            font-size: 1.5rem;
            letter-spacing: 0.5px;
        }

        .nav-link {
            font-weight: 400;
            transition: 0.3s;
            color: rgba(255, 255, 255, 0.75) !important; /* Warna agak pudar jika tidak aktif */
        }

        /* Efek Hover */
        .nav-link:hover {
            color: #fff !important;
            transform: translateY(-2px);
            text-shadow: 0 0 5px rgba(255,255,255,0.5);
        }

        /* --- PERBAIKAN: Efek Menu Aktif --- */
        .nav-link.active {
            color: #fff !important; /* Putih Terang */
            font-weight: 600; /* Lebih Tebal */
            border-bottom: 2px solid rgba(255,255,255,0.5); /* Garis bawah tipis */
        }

        /* Card Styling */
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            background-color: #ffffff;
            transition: 0.3s;
        }

        .card:hover {
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.12);
        }

        .card-body {
            padding: 2rem;
        }

        /* Table Styling */
        .table {
            border-collapse: separate;
            border-spacing: 0;
        }
        
        .table thead th {
            background-color: #667eea;
            color: white;
            border: none;
            padding: 15px;
            font-weight: 500;
        }

        .table thead tr th:first-child { border-top-left-radius: 10px; }
        .table thead tr th:last-child { border-top-right-radius: 10px; }

        .table tbody tr td {
            padding: 15px;
            border-bottom: 1px solid #f0f0f0;
            vertical-align: middle;
        }

        /* Button Styling */
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 8px;
            padding: 8px 20px;
            transition: 0.3s;
        }

        .btn-primary:hover {
            opacity: 0.9;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(118, 75, 162, 0.4);
        }

        /* --- TAMBAHAN CSS UNTUK TOMBOL CANTIK --- */

        /* Gaya Dasar Tombol Gradient */
        .btn-gradient {
            border: none;
            color: white;
            padding: 12px 25px; /* Lebih besar sedikit */
            font-weight: 500;
            letter-spacing: 0.5px;
            border-radius: 10px;
            transition: all 0.4s ease;
            position: relative;
            overflow: hidden;
        }
        
        /* Efek Hover Umum */
        .btn-gradient:hover {
            color: white;
            transform: translateY(-3px); /* Tombol naik sedikit saat di-hover */
            box-shadow: 0 10px 20px rgba(0,0,0,0.15); /* Bayangan makin jelas */
        }

        /* 1. Tombol Biru/Ungu (Untuk Laporan Pegawai) - Menggantikan btn-primary biasa */
        .btn-gradient-primary {
            background-image: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }

        /* 2. Tombol Hijau Segar (Untuk Absensi) */
        .btn-gradient-success {
            background-image: linear-gradient(135deg, #42e695 0%, #3bb2b8 100%);
            box-shadow: 0 5px 15px rgba(66, 230, 149, 0.4);
        }

        /* 3. Tombol Merah Menyala (Untuk Gaji) */
        .btn-gradient-danger {
            background-image: linear-gradient(135deg, #ff416c 0%, #ff4b2b 100%);
            box-shadow: 0 5px 15px rgba(255, 65, 108, 0.4);
        }
        
        /* Footer */
        footer {
            margin-top: 60px;
            padding: 30px 0;
            background-color: white;
            box-shadow: 0 -5px 20px rgba(0,0,0,0.02);
            font-size: 0.9rem;
        }
    </style>
</head>
<body>

    {{-- Navbar --}}
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('dashboard') }}">
                App Pegawai
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    {{-- 
                        LOGIKA: request()->is('employees*') 
                        Artinya: Jika URL diawali dengan 'employees' (misal: /employees, /employees/create), 
                        maka tambahkan class 'active'.
                    --}}
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('employees*') ? 'active' : '' }}" href="{{ url('/employees') }}">Pegawai</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('departments*') ? 'active' : '' }}" href="{{ url('/departments') }}">Departemen</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('positions*') ? 'active' : '' }}" href="{{ url('/positions') }}">Jabatan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('attendance*') ? 'active' : '' }}" href="{{ url('/attendance') }}">Absensi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('salaries*') ? 'active' : '' }}" href="{{ url('/salaries') }}">Gaji</a>
                    </li>
                    <li class="nav-item">
                         <a class="nav-link {{ request()->is('report*') ? 'active' : '' }}" href="{{ route('reports.index') }}">Laporan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('projects*') ? 'active' : '' }}" href="{{ route('projects.index') }}">Project</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    {{-- Main Content --}}
    <main class="container">
        <div class="card fade-in-up">
            <div class="card-body">
                @yield('content')
            </div>
        </div>
    </main>

    {{-- Footer --}}
    <footer class="text-center text-muted">
        <p>&copy; {{ date('Y') }} Aplikasi Kepegawaian - Dibuat dengan Laravel 11</p>
    </footer>

    {{-- Script Bootstrap --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>