<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    use HasFactory;

    protected $fillable = [
        'holder_bank',
        'norek',
        'url_gambar',
        'nama_bank',
    ];
}
