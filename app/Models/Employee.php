<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employee extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama_lengkap',
        'email',
        'nomor_telepon',
        'tanggal_lahir',
        'alamat',
        'tanggal_masuk',
        'status',
        'departemen_id', // Wajib dimasukkan karena kita sudah membuat relasi
        'jabatan_id',    // Wajib dimasukkan karena kita sudah membuat relasi
    ];

    // Relasi: Karyawan milik 1 Departemen
    public function department()
    {
        return $this->belongsTo(Department::class, 'departemen_id');
    }

    // Relasi: Karyawan punya 1 Jabatan
    public function position()
    {
        return $this->belongsTo(Position::class, 'jabatan_id');
    }

    // Relasi: Karyawan punya banyak Absensi
    public function attendances()
    {
        return $this->hasMany(Attendance::class, 'karyawan_id');
    }

    // Relasi: Karyawan punya banyak Riwayat Gaji
    public function salaries()
    {
        return $this->hasMany(Salary::class, 'karyawan_id');
    }

    // Relasi Many-to-Many: Pegawai mengerjakan banyak Proyek
    public function projects()
    {
        return $this->belongsToMany(Project::class, 'project_employee')
                    ->withPivot('role')
                    ->withTimestamps();
    }

    // Relasi Skill: Pegawai punya banyak Skill dengan Level tertentu
    public function skills()
    {
        return $this->belongsToMany(Skill::class, 'employee_skill')
                    ->withPivot('level')
                    ->withTimestamps();
    }


}
