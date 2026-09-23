<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Department;
use App\Models\Position;
use App\Models\Employee;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class EmployeeSeeder extends Seeder
{
    public function run(): void
    {
        $department = Department::where('name', 'Human Resources')->first();

        if (!$department) {
            $this->command->error(
                'Department Human Resources belum tersedia.'
            );

            return;
        }

        $positions = Position::whereIn('name', [
            'Manager',
            'Supervisor',
            'Staff',
            'Human Resources',
            'Finance',
        ])->get()->keyBy('name');

        $employees = [
            [
                'name' => 'Muhammad khairul fikri',
                'username' => 'Fikri',
                'email' => 'Fikri@example.com',
                'position' => 'Manager',
                'address' => 'Jl. pinang No. 10',
                'pob' => 'Pekanbaru',
                'dob' => '2004-12-2',
                'gender' => 'male',
                'religion' => 'islam',
                'phone_number' => '081234567801',
                'salary' => 5000000,
                'start_date' => '2024-01-10',
                'status' => 'active', // <-- KOMA DITAMBAHKAN
                // Link diganti dengan link gambar langsung (contoh)
                'image' => 'https://i.pravatar.cc/150?img=11', 
            ],

            [
                'name' => 'Siti Aisyah',
                'username' => 'siti',
                'email' => 'siti@example.com',
                'position' => 'Supervisor',
                'address' => 'Jl. Melati No. 15',
                'pob' => 'Pelalawan',
                'dob' => '1998-08-20',
                'gender' => 'female',
                'religion' => 'islam',
                'phone_number' => '081234567802',
                'salary' => 4500000,
                'start_date' => '2024-02-15',
                'status' => 'active',
                'image' => 'https://i.pravatar.cc/150?img=5', // <-- Tambahkan link
            ],

            [
                'name' => 'Budi Santoso',
                'username' => 'budi',
                'email' => 'budi@example.com',
                'position' => 'Staff',
                'address' => 'Jl. Ahmad Yani No. 20',
                'pob' => 'Dumai',
                'dob' => '1997-03-15',
                'gender' => 'male',
                'religion' => 'protestan',
                'phone_number' => '081234567803',
                'salary' => 3500000,
                'start_date' => '2024-03-01',
                'status' => 'active',
                'image' => 'https://i.pravatar.cc/150?img=12', // <-- Tambahkan link
            ],

            [
                'name' => 'Rina Amelia',
                'username' => 'rina',
                'email' => 'rina@example.com',
                'position' => 'Human Resources',
                'address' => 'Jl. Kenanga No. 25',
                'pob' => 'Siak',
                'dob' => '1999-11-25',
                'gender' => 'female',
                'religion' => 'katolik',
                'phone_number' => '081234567804',
                'salary' => 3000000,
                'start_date' => '2025-01-05',
                'status' => 'trainee',
                'image' => 'https://i.pravatar.cc/150?img=9', // <-- Tambahkan link
            ],

            [
                'name' => 'Dedi Kurniawan',
                'username' => 'dedi',
                'email' => 'dedi@example.com',
                'position' => 'Finance',
                'address' => 'Jl. Lintas Timur No. 30',
                'pob' => 'Kerinci',
                'dob' => '2000-06-18',
                'gender' => 'male',
                'religion' => 'hindu',
                'phone_number' => '081234567805',
                'salary' => 2500000,
                'start_date' => '2025-06-01',
                'status' => 'applicant',
                'image' => 'https://i.pravatar.cc/150?img=3', // <-- Tambahkan link
            ],
        ];

        foreach ($employees as $data) {

            // Cari position
            $position = $positions->get($data['position']);

            if (!$position) {
                $this->command->warn(
                    "Position {$data['position']} tidak ditemukan."
                );

                continue;
            }

            // Buat atau update user
            $user = User::updateOrCreate(
                [
                    'email' => $data['email'],
                ],
                [
                    'name' => $data['name'],
                    'username' => $data['username'],
                    'password' => Hash::make('password123'),
                ]
            );

            // Buat atau update employee
            Employee::updateOrCreate(
                [
                    'user_id' => $user->id,
                ],
                [
                    'department_id' => $department->id,
                    'position_id' => $position->id,
                    'address' => $data['address'],
                    'pob' => $data['pob'],
                    'dob' => $data['dob'],
                    'gender' => $data['gender'],
                    'religion' => $data['religion'],
                    'phone_number' => $data['phone_number'],
                    'salary' => $data['salary'],
                    'start_date' => $data['start_date'],
                    'status' => $data['status'],
                    'image' => $data['image'], // <-- UBAH DARI null MENJADI $data['image']
                ]
            );
        }

        $this->command->info(
            '5 data employee berhasil dibuat atau diperbarui.'
        );
    }
}