<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keranjang extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_produk',
        'qty',
        'total_harga',
        'id_pesanan',
        'keterangan',
        'id_user'
    ];

    protected $with = 'getProduk';

    public function getProduk(){
        return $this->belongsTo(Produk::class,'id_produk');
    }

    public function getUser(){
        return $this->belongsTo(User::class,'id_user');
    }

    public function getPesanan(){
        return $this->belongsTo(Pesanan::class, 'id_pesanan');
    }
}
