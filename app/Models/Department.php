<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable = ['nama_departemen'];

    // Relasi: Departemen punya banyak Karyawan
    public function employees()
    {
        return $this->hasMany(Employee::class, 'departemen_id');
    }
}
