<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\SalaryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ProjectController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::resource('employees',EmployeeController::class);

Route::resource('departments', DepartmentController::class);

Route::resource('positions', PositionController::class);

Route::resource('attendance', AttendanceController::class);

Route::resource('salaries', SalaryController::class);

// Route Halaman Menu Laporan
Route::get('/report', [ReportController::class, 'index'])->name('reports.index');

// Route Action Cetak PDF
Route::get('/report/employees/pdf', [ReportController::class, 'printEmployees'])->name('reports.employees.pdf');

Route::get('/report', [ReportController::class, 'index'])->name('reports.index');
Route::get('/report/employees/pdf', [ReportController::class, 'printEmployees'])->name('reports.employees.pdf');

Route::get('/report/attendance/pdf', [ReportController::class, 'printAttendance'])->name('reports.attendance.pdf');
Route::get('/report/salaries/pdf', [ReportController::class, 'printSalaries'])->name('reports.salaries.pdf');

Route::resource('projects', ProjectController::class);