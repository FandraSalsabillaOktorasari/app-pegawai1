<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Salary;
use App\Models\Employee;

class SalaryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $salaries = Salary::with('employee')->latest()->get();
        return view('salaries.index', compact('salaries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $employees = Employee::all();
        return view('salaries.create', compact('employees'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'karyawan_id' => 'required|exists:employees,id',
            'bulan' => 'required|string', // Contoh: "September 2025"
            'gaji_pokok' => 'required|numeric|min:0',
            'tunjangan' => 'required|numeric|min:0',
            'potongan' => 'required|numeric|min:0',
        ]);

        // Hitung Total Gaji Otomatis
        $total_gaji = $request->gaji_pokok + $request->tunjangan - $request->potongan;

        // Merge total_gaji ke dalam request data
        $data = $request->all();
        $data['total_gaji'] = $total_gaji;

        Salary::create($data);

        return redirect()->route('salaries.index')->with('success', 'Data gaji berhasil disimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $salary = Salary::findOrFail($id);
        $employees = Employee::all();
        return view('salaries.edit', compact('salary', 'employees'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'karyawan_id' => 'required|exists:employees,id',
            'bulan' => 'required|string',
            'gaji_pokok' => 'required|numeric|min:0',
            'tunjangan' => 'required|numeric|min:0',
            'potongan' => 'required|numeric|min:0',
        ]);

        // Hitung ulang Total Gaji
        $total_gaji = $request->gaji_pokok + $request->tunjangan - $request->potongan;
        
        $data = $request->all();
        $data['total_gaji'] = $total_gaji;

        $salary = Salary::findOrFail($id);
        $salary->update($data);

        return redirect()->route('salaries.index')->with('success', 'Data gaji berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $salary = Salary::findOrFail($id);
        $salary->delete();
        return redirect()->route('salaries.index')->with('success', 'Data gaji berhasil dihapus');
    }
}
