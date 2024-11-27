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
                'nik_pasien' => '3456789012345678',
                'no_bpjs' => '7654321098',
                'no_hp_pasien' => '081456789012',
                'jenis_kelamin' => 'P',
                'tanggal_lahir' => '1985-03-10',
                'alamat_pasien' => 'Jalan Bidan, Kota C',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            
            [
                'name' => 'Petugas',
                'email' => 'petugas@gmail.com',
                'password' => Hash::make('petugas'),
                'peran' => 'petugas',
                'nik_pasien' => '2345678901234567',
                'no_bpjs' => '8765432109',
                'no_hp_pasien' => '081345678901',
                'jenis_kelamin' => 'P',
                'tanggal_lahir' => '1990-01-20',
                'alamat_pasien' => 'Jalan Petugas, Kota B',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'User',
                'email' => 'user@gmail.com',
                'password' => Hash::make('user'),
                'peran' => 'user',
                'nik_pasien' => '1234567890123456',
                'no_bpjs' => '9876543210',
                'no_hp_pasien' => '081234567890',
                'jenis_kelamin' => 'L',
                'tanggal_lahir' => '1995-06-15',
                'alamat_pasien' => 'Jalan User, Kota A',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        User::insert($user);
    }
}
