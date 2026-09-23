<?php

namespace Database\Seeders;

use App\Models\Position;
use Illuminate\Database\Seeder;

class PositionSeeder extends Seeder
{
    public function run(): void
    {
        $positions = [
            [
                'name' => 'Manager',
                'description' => 'Bertanggung jawab mengelola dan mengawasi kegiatan perusahaan.',
                'allowance' => 5000000,
            ],
            [
                'name' => 'Supervisor',
                'description' => 'Bertanggung jawab mengawasi pekerjaan dan kinerja staff.',
                'allowance' => 3500000,
            ],
            [
                'name' => 'Staff',
                'description' => 'Melaksanakan tugas operasional sesuai dengan tanggung jawabnya.',
                'allowance' => 2500000,
            ],
            [
                'name' => 'Human Resources',
                'description' => 'Mengelola sumber daya manusia dan administrasi karyawan.',
                'allowance' => 3000000,
            ],
            [
                'name' => 'Finance',
                'description' => 'Mengelola administrasi dan keuangan perusahaan.',
                'allowance' => 3000000,
            ],
        ];

        foreach ($positions as $position) {
            Position::updateOrCreate(
                [
                    'name' => $position['name'],
                ],
                [
                    'description' => $position['description'],
                    'allowance' => $position['allowance'],
                ]
            );
        }
    }
}