<?php

namespace App\Http\Controllers;

use App\Helper\CustomController;
use App\Models\FotoProduk;
use App\Models\Kategori;
use App\Models\Keranjang;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class ProdukController extends CustomController
{
    //
    public function index()
    {
        $produk   = Produk::orderBy('created_at', 'DESC')->filter(\request(['produk','kategori']))->paginate(8)->withQueryString();
        $kategori = Kategori::where('nama_kategori', '=', \request('kategori'))->first();
        $data     = [
            'data'     => $produk,
            'kategori' => $kategori,
        ];
        return view('produk')->with($data);
    }

    public function detail($id)
    {
        $produk = Produk::find($id);
        $laku = Keranjang::with('getPesanan')->where('id_produk', '=', $produk->id)->whereHas(
            'getPesanan',
            function ($q) {
                return $q->where('status_pesanan', '>=', 2);
            }
        )->sum('qty');
        $sisa = (int) $produk->stok - (int) $laku;
        Arr::add($produk,'sisa', $sisa);
        return view('detail')->with(['data' => $produk]);
    }

    public function simpanPesanan($id)
    {
        $field = [
            'id_produk'   => $id,
            'qty'         => $this->request->get('qty'),
            'total_harga' => $this->request->get('totalHarga'),
            'keterangan'  => $this->request->get('keterangan'),
            'id_user'     => Auth::id(),
        ];
        Keranjang::create($field);

        return response()->json('berhasil', 200);
    }

    public function getImageProduk($id)
    {
        $image = FotoProduk::where('id_produk', '=', $id)->get();

        return $image;
    }

    public function dataProduk(){
        $produk = Produk::filter(\request(['produk','kategori']))->orderBy('created_at','DESC')->limit(4)->get();
        return $produk;
    }
}
