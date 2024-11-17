<?php

namespace Database\Seeders;

use App\Models\RumahSakit;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RumahSakitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rumah_sakit = [
            [
                'id_rumah_sakit' => 1,
                'nama_rumah_sakit' => 'RS Awal Bros Pekanbaru',
                'no_hp_rumah_sakit' => '076147333',
                'alamat_rumah_sakit' => 'Jl. Jendral Sudirman No.117, Pekanbaru',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_rumah_sakit' => 2,
                'nama_rumah_sakit' => 'RSUD Arifin Achmad',
                'no_hp_rumah_sakit' => '076121618',
                'alamat_rumah_sakit' => 'Jl. Diponegoro No.2, Pekanbaru',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_rumah_sakit' => 3,
                'nama_rumah_sakit' => 'RS Santa Maria Pekanbaru',
                'no_hp_rumah_sakit' => '076123050',
                'alamat_rumah_sakit' => 'Jl. Jendral Sudirman No.105, Pekanbaru',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_rumah_sakit' => 4,
                'nama_rumah_sakit' => 'RS Ibnu Sina',
                'no_hp_rumah_sakit' => '076146333',
                'alamat_rumah_sakit' => 'Jl. Melur No.31, Pekanbaru',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_rumah_sakit' => 5,
                'nama_rumah_sakit' => 'RS Eka Hospital Pekanbaru',
                'no_hp_rumah_sakit' => '0761698999',
                'alamat_rumah_sakit' => 'Jl. Soekarno-Hatta, Pekanbaru',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        RumahSakit::insert($rumah_sakit);
    }
}
