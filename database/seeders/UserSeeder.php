<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'SigCenJsr',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin.123'),
            'role' => 'staticUser',
        ]);
    }
}
