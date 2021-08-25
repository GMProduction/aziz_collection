<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;

    protected $fillable = [
        'tanggal_pesanan',
        'alamat_pengiriman',
        'biaya_pengiriman',
        'id_user',
        'total_harga',
        'id_bank',
        'tanggal_pembayaran',
        'url_pembayaran',
        'status_pesanan'
    ];

    protected $with = ['getExpedisi','getKeranjang'];


    public function getExpedisi(){
        return $this->hasOne(Expedisi::class,'id_pesanan');
    }

    public function getPelanggan(){
        return $this->belongsTo(User::class, 'id_user');
    }

    public function getKeranjang(){
        return $this->hasMany(Keranjang::class, 'id_pesanan');
    }

    public function getBank(){
        return $this->belongsTo(Bank::class, 'id_bank');
    }
}
