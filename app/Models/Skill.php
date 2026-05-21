<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    protected $fillable = ['name', 'category'];

    // Relasi ke Pegawai
    public function employees()
    {
        return $this->belongsToMany(Employee::class, 'employee_skill')
                    ->withPivot('level')
                    ->withTimestamps();
    }
}
