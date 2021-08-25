<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_kategori',
        'nama_produk',
        'deskripsi',
        'harga',
        'stok'
    ];

    protected $with = ['getKategori','getImage'];

    public function getKategori(){
        return $this->belongsTo(Kategori::class,'id_kategori');
    }

    public function getImage(){
        return $this->hasMany(FotoProduk::class,'id_produk');
    }

    public function scopeFilter($query, $filter = []){
        $query->when($filter['kategori'] ?? false, function ($query, $kategori) {
            return $query->whereHas('getKategori', function ($query) use ($kategori){
                $query->where('nama_kategori','=',$kategori);
            });
        });

        $query->when($filter['produk'] ?? false, function ($query, $produk) {
            return $query->where('nama_produk','like','%'.$produk.'%');
        });
    }
}
