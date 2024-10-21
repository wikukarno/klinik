<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RumahSakit extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $table = 'rumah_sakit';

    protected $primaryKey = 'id_rumah_sakit';

    protected $fillable = [
        'nama_rumah_sakit',
        'no_hp_rumah_sakit',
        'alamat_rumah_sakit',
    ];
}
