<?php

namespace Database\Seeders;

use App\Models\Pasien;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PasienSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pasien = [
            [
                'id_pasien' => 1,
                'id_layanan' => 1, // Pemeriksaan Umum
                'nik_pasien' => '3201234567891234',
                'no_bpjs' => '1234567890123',
                'nama_pasien' => 'Ahmad Fauzi',
                'no_hp_pasien' => '081234567890',
                'jenis_kelamin' => 'L',
                'tanggal_lahir' => '1990-05-15',
                'tanggal_checkup' => null,
                'status' => 'menunggu',
                'alamat_pasien' => 'Jl. Merdeka No.12, Pekanbaru',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_pasien' => 2,
                'id_layanan' => 2, // Pemeriksaan Kehamilan
                'nik_pasien' => '3209876543210987',
                'no_bpjs' => '9876543210123',
                'nama_pasien' => 'Siti Aminah',
                'no_hp_pasien' => '081298765432',
                'jenis_kelamin' => 'P',
                'tanggal_lahir' => '1992-08-20',
                'tanggal_checkup' => '2024-10-25',
                'status' => 'berlangsung',
                'alamat_pasien' => 'Jl. Melur No.21, Pekanbaru',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_pasien' => 3,
                'id_layanan' => 3, // USG
                'nik_pasien' => '3201122334455667',
                'no_bpjs' => '1122334455667',
                'nama_pasien' => 'Rina Handayani',
                'no_hp_pasien' => '081345678901',
                'jenis_kelamin' => 'P',
                'tanggal_lahir' => '1995-03-10',
                'tanggal_checkup' => '2024-10-20',
                'status' => 'selesai',
                'alamat_pasien' => 'Jl. Sudirman No.45, Pekanbaru',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_pasien' => 4,
                'id_layanan' => 4, // Imunisasi
                'nik_pasien' => '3209988776655443',
                'no_bpjs' => '9988776655443',
                'nama_pasien' => 'Bagus Saputra',
                'no_hp_pasien' => '081367890123',
                'jenis_kelamin' => 'L',
                'tanggal_lahir' => '2018-07-15',
                'tanggal_checkup' => null,
                'status' => 'menunggu',
                'alamat_pasien' => 'Jl. Harapan No.88, Pekanbaru',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_pasien' => 5,
                'id_layanan' => 1, // Pemeriksaan Umum
                'nik_pasien' => '3205566778899001',
                'no_bpjs' => '5566778899001',
                'nama_pasien' => 'Dewi Lestari',
                'no_hp_pasien' => '081376549021',
                'jenis_kelamin' => 'P',
                'tanggal_lahir' => '1988-12-11',
                'tanggal_checkup' => null,
                'status' => 'berlangsung',
                'alamat_pasien' => 'Jl. Pahlawan No.14, Pekanbaru',
                'created_at' => now(),
                'updated_at' => now(),
           
            ],
        ];

        Pasien::insert($pasien);

    }
}
