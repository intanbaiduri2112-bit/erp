<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
     Company::create([
         'name' => 'PT INTAN SEJATI',
         'address' => 'Jl. Raya No. 123',
         'email' => 'info@example.com',
         'phone' => '123-456-7890',
     ]);
    }
}
