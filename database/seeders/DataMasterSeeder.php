<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Department;
use App\Models\Position;

class DataMasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Buat Data Departemen
        $departments = [
            ['nama_departemen' => 'Teknologi Informasi (IT)'],
            ['nama_departemen' => 'Human Resources (HRD)'],
            ['nama_departemen' => 'Finance & Accounting'],
            ['nama_departemen' => 'Marketing'],
            ['nama_departemen' => 'Operasional'],
        ];

        foreach ($departments as $dept) {
            Department::create($dept);
        }

        // 2. Buat Data Jabatan
        $positions = [
            [
                'nama_jabatan' => 'Manager',
                'gaji_pokok' => 12000000
            ],
            [
                'nama_jabatan' => 'Supervisor',
                'gaji_pokok' => 8000000
            ],
            [
                'nama_jabatan' => 'Senior Staff',
                'gaji_pokok' => 6000000
            ],
            [
                'nama_jabatan' => 'Staff',
                'gaji_pokok' => 4500000
            ],
            [
                'nama_jabatan' => 'Internship',
                'gaji_pokok' => 2500000
            ],
        ];

        foreach ($positions as $pos) {
            Position::create($pos);
        }
    }
}
