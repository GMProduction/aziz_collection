<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expedisi extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_pesanan',
        'nama',
        'service',
        'estimasi',
        'id_kota',
        'nama_kota',
        'id_propinsi',
        'nama_propinsi',
        'biaya'
    ];
}
