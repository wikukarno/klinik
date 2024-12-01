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
    ];

    protected $with = ['layanan'];

    public function layanan()
    {
        return $this->belongsTo(Layanan::class, 'id_layanan', 'id_layanan');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'nik_pasien', 'nik_pasien');
    }

    // Relasi ke antrean (hasOne karena satu pasien hanya memiliki satu antrean)
    public function antrian()
    {
        return $this->hasOne(Antrian::class, 'pasien_id', 'id_pasien');
    }
}
