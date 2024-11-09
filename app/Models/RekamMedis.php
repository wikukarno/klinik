<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RekamMedis extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'rekam_medis';

    protected $primaryKey = 'id_rekam_medis';

    protected $fillable = [
        'id_pasien',
        'anamnesa',
        'diagnosa',
        'theraphy',
        'resep_obat',
    ];

    public function pasien()
    {
        return $this->belongsTo(Pasien::class, 'id_pasien', 'id_pasien');
    }
}
