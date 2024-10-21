<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = [
            [
                'name' => 'Bidan',
                'email' => 'bidan@gmail.com',
                'password' => Hash::make('bidan'),
                'peran' => 'bidan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Petugas',
                'email' => 'petugas@gmail.com',
                'password' => Hash::make('petugas'),
                'peran' => 'petugas',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        User::insert($user);
    }
}
