<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\LeaveRequest;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class LeaveRequestSeeder extends Seeder
{
    public function run(): void
    {
        $employees = Employee::all();

        if ($employees->isEmpty()) {
            $this->command->error('Employee kosong. Jalankan EmployeeSeeder dulu.');
            return;
        }

        // Helper cari employee by nama
        $findEmp = function (string $name) use ($employees) {
            return $employees->first(fn ($e) => str_contains($e->user->name, $name));
        };

        // Data contoh persis seperti tabel Anda
        $data = [
            [
                'employee'   => $findEmp('Siti Aisyah'),
                'leave_type' => 'annual',
                'start_date' => '2026-09-25',
                'end_date'   => '2026-09-27',
                'reason'     => 'Liburan keluarga ke Bali',
                'status'     => 'approved',
                'notes'      => 'Disetujui oleh Manager HRD',
            ],
            [
                'employee'   => $findEmp('Budi Santoso'),
                'leave_type' => 'sick',
                'start_date' => '2026-10-01',
                'end_date'   => '2026-10-02',
                'reason'     => 'Demam dan sakit kepala',
                'status'     => 'pending',
                'notes'      => null,
            ],
            // Beberapa data tambahan
            [
                'employee'   => $findEmp('Muhammad khairul fikri') ?? $employees->first(),
                'leave_type' => 'annual',
                'start_date' => '2026-10-10',
                'end_date'   => '2026-10-12',
                'reason'     => 'Acara keluarga',
                'status'     => 'pending',
                'notes'      => null,
            ],
            [
                'employee'   => $findEmp('Rina Amelia') ?? $employees->last(),
                'leave_type' => 'maternity',
                'start_date' => '2026-11-01',
                'end_date'   => '2027-02-01',
                'reason'     => 'Cuti melahirkan',
                'status'     => 'approved',
                'notes'      => 'Sesuai kebijakan HR',
            ],
            [
                'employee'   => $findEmp('Dedi Kurniawan') ?? $employees->last(),
                'leave_type' => 'unpaid',
                'start_date' => '2026-12-20',
                'end_date'   => '2026-12-25',
                'reason'     => 'Urusan pribadi',
                'status'     => 'rejected',
                'notes'      => 'Tidak disetujui karena peak season',
            ],
        ];

        foreach ($data as $row) {
            if (!$row['employee']) continue;

            $start = Carbon::parse($row['start_date']);
            $end   = Carbon::parse($row['end_date']);
            $days  = $start->diffInDays($end) + 1;

            LeaveRequest::create([
                'employee_id' => $row['employee']->id,
                'leave_type'  => $row['leave_type'],
                'start_date'  => $row['start_date'],
                'end_date'    => $row['end_date'],
                'days'        => $days,
                'reason'      => $row['reason'],
                'status'      => $row['status'],
                'approved_by' => $row['status'] === 'approved' ? 1 : null,
                'approved_at' => $row['status'] === 'approved' ? now() : null,
                'notes'       => $row['notes'],
            ]);
        }

        $this->command->info('Leave request seeder selesai.');
    }
}