<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Employee;
use App\Models\Department;
use App\Models\Position;
use App\Models\Attendance;
use App\Models\Salary;
use Carbon\Carbon;

class DummyDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Ambil Data Master (Pastikan Seeder DataMasterSeeder sudah dijalankan sebelumnya)
        $departments = Department::all();
        $positions = Position::all();

        // Cek jika master data kosong, hentikan proses agar tidak error
        if ($departments->count() == 0 || $positions->count() == 0) {
            $this->command->info('Harap jalankan DataMasterSeeder terlebih dahulu!');
            return;
        }

        // 2. Daftar Nama Dummy
        $names = ['Andi Pratama', 'Siti Aminah', 'Budi Santoso', 'Dewi Lestari', 'Eko Kurniawan'];
        
        foreach ($names as $index => $name) {
            // Ambil jabatan dan departemen secara acak
            $position = $positions->random();
            $department = $departments->random();
            
            // --- CREATE PEGAWAI ---
            $employee = Employee::create([
                'nama_lengkap' => $name,
                // Membuat email dummy dari nama: andi.pratama@company.com
                'email' => strtolower(str_replace(' ', '.', $name)) . '@company.com',
                'nomor_telepon' => '0812345678' . $index,
                'tanggal_lahir' => '199' . $index . '-05-15',
                'alamat' => 'Jl. Merpati No. ' . ($index + 1) . ', Surabaya',
                'tanggal_masuk' => '2023-01-10',
                'status' => 'aktif',
                'departemen_id' => $department->id,
                'jabatan_id' => $position->id,
            ]);

            // --- CREATE ABSENSI (3 Hari Terakhir) ---
            for ($i = 0; $i < 3; $i++) {
                Attendance::create([
                    'karyawan_id' => $employee->id,
                    'tanggal' => Carbon::now()->subDays($i)->format('Y-m-d'),
                    'waktu_masuk' => '08:00:00',
                    'waktu_keluar' => '17:00:00',
                    'status_absensi' => 'hadir',
                ]);
            }

            // --- CREATE GAJI (Bulan Ini) ---
            $gajiPokok = $position->gaji_pokok;
            $tunjangan = 500000;
            $potongan = 100000;
            $total = $gajiPokok + $tunjangan - $potongan;

            Salary::create([
                'karyawan_id' => $employee->id,
                // PERBAIKAN: Format 'M Y' (Dec 2025) agar muat di varchar(10)
                'bulan' => Carbon::now()->format('M Y'), 
                'gaji_pokok' => $gajiPokok,
                'tunjangan' => $tunjangan,
                'potongan' => $potongan,
                'total_gaji' => $total,
            ]);
        }
    }
}