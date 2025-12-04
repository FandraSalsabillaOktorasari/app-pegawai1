<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Department;
use App\Models\Attendance;
use App\Models\Salary;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Hitung Total Pegawai
        $totalPegawai = Employee::count();

        // 2. Hitung Total Departemen
        $totalDepartemen = Department::count();

        // 3. Hitung Absensi Hari Ini
        $hadirHariIni = Attendance::whereDate('tanggal', Carbon::today())->count();

        // 4. Hitung Total Gaji (Bulan Ini)
        // Format bulan di database kita "December 2025" (M Y)
        $bulanIni = Carbon::now()->format('M Y'); 
        $totalGaji = Salary::where('bulan', $bulanIni)->sum('total_gaji');

        return view('dashboard', compact('totalPegawai', 'totalDepartemen', 'hadirHariIni', 'totalGaji', 'bulanIni'));
    }
}
