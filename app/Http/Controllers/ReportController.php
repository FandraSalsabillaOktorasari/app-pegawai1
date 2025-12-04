<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    // 1. Halaman Menu Laporan
    public function index()
    {
        return view('reports.index');
    }

    // 2. Logika Cetak PDF Data Pegawai
    public function printEmployees()
    {
        // Ambil semua data pegawai
        $employees = Employee::with(['department', 'position'])->get();

        // Load view khusus PDF dan kirim datanya
        $pdf = Pdf::loadView('reports.employees_pdf', compact('employees'));

        // Download file PDF dengan nama 'laporan-pegawai.pdf'
        return $pdf->stream('laporan-pegawai.pdf');
    }
}
