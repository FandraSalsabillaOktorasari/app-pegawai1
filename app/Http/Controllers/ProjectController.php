<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Employee;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil proyek beserta data pegawai yang mengerjakan (tim)
        $projects = Project::with('employees')->latest()->paginate(5);
        return view('projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //daftar semua pegawai untuk dipilih sebagai tim
        $employees = Employee::all(); 
        return view('projects.create', compact('employees'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'client_name' => 'nullable|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'status' => 'required',
            'employee_ids' => 'array' // Validasi input array checkbox
        ]);

        // 1. Simpan Data Proyek
        $project = Project::create($request->except('employee_ids'));

        // 2. Hubungkan Pegawai ke Proyek (Masuk ke tabel pivot)
        if ($request->has('employee_ids')) {
            $project->employees()->attach($request->employee_ids);
        }

        return redirect()->route('projects.index')->with('success', 'Proyek berhasil dibuat');
    
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
        $project = Project::findOrFail($id);
        $employees = Employee::all();
        return view('projects.edit', compact('project', 'employees'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'client_name' => 'nullable|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'status' => 'required',
            'employee_ids' => 'array'
        ]);

        $project = Project::findOrFail($id);
        
        // 1. Update Data Proyek
        $project->update($request->except('employee_ids'));

        // 2. Update Tim (Sync otomatis menghapus yang tidak dicentang & menambah yang baru)
        $project->employees()->sync($request->employee_ids ?? []);

        return redirect()->route('projects.index')->with('success', 'Data proyek diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $project = Project::findOrFail($id);
        $project->delete(); // Data di pivot table otomatis terhapus (Cascade)
        return redirect()->route('projects.index')->with('success', 'Proyek dihapus');
    }
}
