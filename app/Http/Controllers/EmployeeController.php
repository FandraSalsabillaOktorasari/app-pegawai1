<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\Position;
use App\Models\Skill;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        $query = Employee::with(['department', 'position', 'skills']);

        // Filter Pencarian Nama/Email
        if ($request->has('search') && $request->search != '') {
            $keyword = $request->search;
            $query->where(function($q) use ($keyword) {
                $q->where('nama_lengkap', 'like', '%' . $keyword . '%')
                  ->orWhere('email', 'like', '%' . $keyword . '%');
            });
        }

        // Filter Pencarian Skill
        if ($request->has('skill_id') && $request->skill_id != '') {
            $query->whereHas('skills', function($q) use ($request) {
                $q->where('skills.id', $request->skill_id);
            });
        }

        $employees = $query->latest()->paginate(5)->withQueryString();
        
        // Ambil semua skill untuk dropdown filter
        $skills = \App\Models\Skill::orderBy('name')->get();

        return view('employees.index', compact('employees', 'skills'));
    }

    public function create()
    {
        $departments = Department::all();
        $positions = Position::all();
        $skills = Skill::all(); // Ambil semua data skill untuk pilihan
        
        return view('employees.create', compact('departments', 'positions', 'skills'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:employees,email',
            'nomor_telepon' => 'required|string|max:20',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string',
            'tanggal_masuk' => 'required|date',
            'status' => 'required',
            'departemen_id' => 'required|exists:departments,id',
            'jabatan_id' => 'required|exists:positions,id',
            // Validasi array skill (opsional, boleh kosong)
            'skill_ids' => 'array',
            'skill_levels' => 'array',
        ]);

        // 1. Simpan Data Pegawai
        $employee = Employee::create($request->except(['skill_ids', 'skill_levels']));

        // 2. Simpan Relasi Skill (Jika ada yang dipilih)
        if ($request->has('skill_ids')) {
            foreach ($request->skill_ids as $skillId) {
                // Ambil level dari input array skill_levels berdasarkan ID skill
                $level = $request->skill_levels[$skillId] ?? 'beginner';
                
                // Attach ke pivot table dengan data extra (level)
                $employee->skills()->attach($skillId, ['level' => $level]);
            }
        }

        return redirect()->route('employees.index')->with('success', 'Pegawai berhasil ditambahkan');
    }

    public function edit(string $id)
    {
        $employee = Employee::findOrFail($id);
        $departments = Department::all();
        $positions = Position::all();
        $skills = Skill::all();

        return view('employees.edit', compact('employee', 'departments', 'positions', 'skills'));
    }

    public function update(Request $request, string $id)
    {
        // Validasi input
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:employees,email,'.$id,
            'nomor_telepon' => 'required|string|max:20',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string',
            'tanggal_masuk' => 'required|date',
            'status' => 'required',
            'departemen_id' => 'required|exists:departments,id',
            'jabatan_id' => 'required|exists:positions,id',
            'skill_ids' => 'array', // Validasi array ID skill
        ]);

        // Cari data pegawai
        $employee = Employee::findOrFail($id);
        
        // 1. Update Data Utama Pegawai
        $employee->update($request->except(['skill_ids', 'skill_levels']));

        // 2. Update Relasi Skill (Sync)
        $syncData = [];
        if ($request->has('skill_ids')) {
            foreach ($request->skill_ids as $skillId) {
                // Ambil level dari input array skill_levels berdasarkan ID skill
                // Jika tidak ada level yang dipilih, default ke 'beginner'
                $level = $request->skill_levels[$skillId] ?? 'beginner';
                
                // Masukkan ke array penampung dengan format yang benar untuk sync
                // Format: [ skill_id => ['column_pivot' => 'value'], ... ]
                $syncData[$skillId] = ['level' => $level];
            }
        }
        
        // Eksekusi sinkronisasi data skill
        // Hapus skill lama yang tidak dipilih, tambah skill baru, update level skill yang ada
        $employee->skills()->sync($syncData);

        return redirect()->route('employees.index')->with('success', 'Data pegawai diperbarui');
    }

    public function destroy(string $id)
    {
        Employee::findOrFail($id)->delete();
        return redirect()->route('employees.index')->with('success', 'Pegawai dihapus');
    }
}
