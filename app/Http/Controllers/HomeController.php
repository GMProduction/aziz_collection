<?php

namespace App\Http\Controllers;

use App\Models\Baner;
use App\Models\Kategori;
use App\Models\Keranjang;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    //
    public function index(){
        $kategori = Kategori::all();
        $produk = Produk::orderBy('created_at','DESC')->limit(4)->get();
        $data = [
            'kategori' => $kategori,
            'produk' => $produk
        ];
        return view('home')->with($data);
    }

    public function baner(){
        $baner = Baner::all();
        return $baner;
    }

    public function getKeranjang(){
        $keranjang = Keranjang::where([['id_user','=', Auth::id()],['id_pesanan','=', null]])->count('*');
        return $keranjang;
    }
}
