<?php

namespace Database\Seeders;

use App\Models\Layanan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LayananSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $layanan = [
            [
                'id_layanan' => 1,
                'nama_layanan' => 'Pemeriksaan Umum',
                'harga_layanan' => 50000.00,
                'deskripsi_layanan' => 'Pemeriksaan kesehatan umum untuk pasien.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_layanan' => 2,
                'nama_layanan' => 'Pemeriksaan Kehamilan',
                'harga_layanan' => 75000.00,
                'deskripsi_layanan' => 'Pemeriksaan rutin untuk ibu hamil.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_layanan' => 3,
                'nama_layanan' => 'USG',
                'harga_layanan' => 100000.00,
                'deskripsi_layanan' => 'Pemeriksaan ultrasonografi untuk melihat kondisi janin.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_layanan' => 4,
                'nama_layanan' => 'Imunisasi',
                'harga_layanan' => 20000.00,
                'deskripsi_layanan' => 'Pemberian imunisasi untuk anak.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        Layanan::insert($layanan);
    }
}
