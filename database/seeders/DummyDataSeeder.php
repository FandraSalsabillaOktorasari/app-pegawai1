<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Employee;
use App\Models\Department;
use App\Models\Position;
use App\Models\Attendance;
use App\Models\Salary;
use App\Models\Project;
use App\Models\Skill; // Pastikan Model Skill sudah dibuat
use Carbon\Carbon;

class DummyDataSeeder extends Seeder
{
    public function run(): void
    {
        // ---------------------------------------------------------
        // 0. BERSIHKAN DATABASE (TRUNCATE)
        // ---------------------------------------------------------
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        
        // Hapus tabel pivot dulu
        DB::table('employee_skill')->truncate();
        DB::table('project_employee')->truncate();
        
        // Hapus tabel utama
        Skill::truncate();
        Project::truncate();
        Salary::truncate();
        Attendance::truncate();
        Employee::truncate();
        Position::truncate();
        Department::truncate();
        
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');


        // ---------------------------------------------------------
        // 1. BUAT MASTER SKILL (TECH STACK)
        // ---------------------------------------------------------
        $skillsData = [
            ['name' => 'Laravel', 'category' => 'framework'],
            ['name' => 'React JS', 'category' => 'framework'],
            ['name' => 'Vue JS', 'category' => 'framework'],
            ['name' => 'Flutter', 'category' => 'framework'],
            ['name' => 'Node JS', 'category' => 'framework'],
            ['name' => 'PHP', 'category' => 'language'],
            ['name' => 'Python', 'category' => 'language'],
            ['name' => 'Go Lang', 'category' => 'language'],
            ['name' => 'MySQL', 'category' => 'database'],
            ['name' => 'PostgreSQL', 'category' => 'database'],
            ['name' => 'Docker', 'category' => 'tool'],
            ['name' => 'AWS', 'category' => 'tool'],
            ['name' => 'Figma', 'category' => 'tool'],
            ['name' => 'Git', 'category' => 'tool'],
            ['name' => 'JIRA', 'category' => 'tool'],
        ];

        foreach ($skillsData as $skill) {
            Skill::create($skill);
        }
        $allSkills = Skill::all();
        $this->command->info('✅ Master Skills berhasil dibuat.');


        // ---------------------------------------------------------
        // 2. BUAT 10 DEPARTEMEN
        // ---------------------------------------------------------
        $deptNames = [
            'Teknologi Informasi (IT)', 'Human Resources (HRD)', 'Finance & Accounting', 
            'Marketing & Sales', 'Operasional', 'Legal & Compliance', 
            'Research & Development', 'Customer Support', 'Procurement', 'Creative Design'
        ];

        foreach ($deptNames as $name) {
            Department::create(['nama_departemen' => $name]);
        }
        $departments = Department::all();
        $this->command->info('✅ 10 Departemen berhasil dibuat.');


        // ---------------------------------------------------------
        // 3. BUAT 10 JABATAN (POSITIONS)
        // ---------------------------------------------------------
        $posData = [
            ['name' => 'General Manager', 'gaji' => 25000000],
            ['name' => 'Engineering Manager', 'gaji' => 20000000],
            ['name' => 'Senior Backend Dev', 'gaji' => 15000000],
            ['name' => 'Senior Frontend Dev', 'gaji' => 14000000],
            ['name' => 'UI/UX Designer', 'gaji' => 12000000],
            ['name' => 'DevOps Engineer', 'gaji' => 16000000],
            ['name' => 'QA Engineer', 'gaji' => 10000000],
            ['name' => 'Mobile Developer', 'gaji' => 13000000],
            ['name' => 'System Analyst', 'gaji' => 11000000],
            ['name' => 'Internship', 'gaji' => 3000000],
        ];

        foreach ($posData as $pos) {
            Position::create([
                'nama_jabatan' => $pos['name'],
                'gaji_pokok' => $pos['gaji']
            ]);
        }
        $positions = Position::all();
        $this->command->info('✅ 10 Jabatan berhasil dibuat.');


        // ---------------------------------------------------------
        // 4. BUAT 15 PEGAWAI (LENGKAP DENGAN RELASI)
        // ---------------------------------------------------------
        $names = [
            'Andi Pratama', 'Siti Aminah', 'Budi Santoso', 'Dewi Lestari', 'Eko Kurniawan',
            'Fajar Nugraha', 'Gita Gutawa', 'Hendra Setiawan', 'Indah Permata', 'Joko Anwar',
            'Kartika Sari', 'Lukman Hakim', 'Maya Septha', 'Nanda Putra', 'Olivia Zalianty'
        ];

        foreach ($names as $index => $name) {
            // Random Jabatan & Dept
            $position = $positions->random();
            $department = $departments->random();

            // A. Create Employee
            $employee = Employee::create([
                'nama_lengkap' => $name,
                'email' => strtolower(str_replace(' ', '.', $name)) . '@softwarehouse.com',
                'nomor_telepon' => '0812345678' . str_pad($index, 2, '0', STR_PAD_LEFT),
                'tanggal_lahir' => '199' . ($index % 9) . '-05-15',
                'alamat' => 'Jl. Digital No. ' . ($index + 1) . ', Surabaya',
                'tanggal_masuk' => '2023-01-' . ($index + 1),
                'status' => 'aktif',
                'departemen_id' => $department->id,
                'jabatan_id' => $position->id,
            ]);

            // B. Create Absensi (10 Hari Terakhir)
            for ($i = 0; $i < 10; $i++) {
                Attendance::create([
                    'karyawan_id' => $employee->id,
                    'tanggal' => Carbon::now()->subDays($i)->format('Y-m-d'),
                    'waktu_masuk' => '08:00:00',
                    'waktu_keluar' => '17:00:00',
                    'status_absensi' => 'hadir',
                ]);
            }

            // C. Create Gaji (Bulan Ini) - FIX FORMAT TANGGAL
            $gajiPokok = $position->gaji_pokok;
            $tunjangan = rand(500000, 2000000);
            $potongan = rand(50000, 200000);
            $total = $gajiPokok + $tunjangan - $potongan;

            Salary::create([
                'karyawan_id' => $employee->id,
                'bulan' => Carbon::now()->format('M Y'), // Format "Dec 2025" (Aman untuk varchar(10))
                'gaji_pokok' => $gajiPokok,
                'tunjangan' => $tunjangan,
                'potongan' => $potongan,
                'total_gaji' => $total,
            ]);

            // D. Assign Random Skills (3-6 Skill per orang)
            $randomSkills = $allSkills->random(rand(3, 6));
            foreach($randomSkills as $skill) {
                $employee->skills()->attach($skill->id, [
                    'level' => collect(['beginner', 'intermediate', 'expert'])->random()
                ]);
            }
        }
        $employees = Employee::all();
        $this->command->info('✅ 15 Pegawai (+ Absensi, Gaji, Skill) berhasil dibuat.');


        // ---------------------------------------------------------
        // 5. BUAT 10 PROYEK & TIM
        // ---------------------------------------------------------
        $projectNames = [
            'Sistem Informasi Akademik Kampus',
            'Aplikasi E-Commerce Fashion',
            'Website Company Profile BUMN',
            'Sistem ERP Manufaktur',
            'Aplikasi Mobile Absensi Face ID',
            'Dashboard Monitoring IoT',
            'Marketplace Jual Beli Mobil',
            'Sistem Antrian Rumah Sakit',
            'Aplikasi Kasir (POS) Cloud',
            'Learning Management System (LMS)'
        ];

        foreach ($projectNames as $pName) {
            // A. Buat Proyek
            $project = Project::create([
                'name' => $pName,
                'client_name' => 'PT. Client ' . rand(100, 999),
                'start_date' => Carbon::now()->subMonths(rand(1, 5)),
                'end_date' => Carbon::now()->addMonths(rand(2, 6)),
                'status' => collect(['pending', 'progress', 'completed', 'maintenance'])->random(),
            ]);

            // B. Assign Tim (3-5 Orang per proyek)
            $team = $employees->random(rand(3, 5)); 
            foreach($team as $member) {
                $role = collect(['Project Manager', 'Backend Dev', 'Frontend Dev', 'UI/UX Designer', 'QA Tester'])->random();
                $project->employees()->attach($member->id, ['role' => $role]);
            }
        }
        $this->command->info('✅ 10 Proyek (+ Tim Assignment) berhasil dibuat.');
    }
}