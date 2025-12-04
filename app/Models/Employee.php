<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'nama_lengkap',
        'email',
        'nomor_telepon',
        'tanggal_lahir',
        'alamat',
        'tanggal_masuk',
        'status',
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
}
