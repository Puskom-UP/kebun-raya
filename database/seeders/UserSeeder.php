<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Administrator Kebun Raya',
            'username' => 'admin',
            'email' => 'admin@up.ac.id',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
        ]);


        User::create([
            'name' => 'Petugas Konservasi',
            'username' => 'petugas',
            'email' => 'petugas@up.ac.id',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
        ]);
    }
}
