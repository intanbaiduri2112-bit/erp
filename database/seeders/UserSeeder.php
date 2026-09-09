<?php

namespace Database\Seeders;

use App\models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name'                  => 'Administator',
            'email'                 =>'admin@example.com',
            'password'              => bcrypt('password'),
            'email_verified_at'     => now(),
        ]);
    }
}