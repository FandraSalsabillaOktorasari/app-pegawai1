<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\SalaryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReportController;

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