<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    public function run(): void
    {
        Department::updateOrCreate(
            [
                'email' => 'hr@example.com',
            ],
            [
                'name' => 'Human Resources',
                'description' => 'Department yang mengelola sumber daya manusia.',
                'address' => 'Jl. Raya No. 123',
                'phone_number' => '123-456-7890',
            ]
        );
    }
}