<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'name', 
        'client_name', 
        'start_date', 
        'end_date', 
        'status'
    ];

    // Relasi Many-to-Many ke Pegawai
    public function employees()
    {
        // Parameter: Model Tujuan, Nama Tabel Pivot
        return $this->belongsToMany(Employee::class, 'project_employee')
                    ->withPivot('role') // Agar kita bisa akses kolom 'role' di tabel pivot
                    ->withTimestamps();
    }
}
