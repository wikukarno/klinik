<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pasien extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'pasien';

    protected $primaryKey = 'id_pasien';

    protected $fillable = [
        'id_layanan',
        'nik_pasien',
        'no_bpjs',
        'nama_pasien',
        'no_hp_pasien',
        'jenis_kelamin',
        'tanggal_lahir',
        'tanggal_checkup',
        'alamat_pasien',
    ];
}
