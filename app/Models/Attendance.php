<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    // Pastikan nama tabel didefinisikan jika tidak jamak standar (opsional jika nama tabel 'attendances')
    protected $table = 'attendance'; 
    protected $fillable = ['karyawan_id', 'tanggal', 'waktu_masuk', 'waktu_keluar', 'status_absensi'];

    // Relasi: Absensi milik 1 Karyawan
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'karyawan_id');
    }
}