<?php

namespace App\Http\Controllers\Admin;

use App\Helper\CustomController;
use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\FotoProduk;
use App\Models\Keranjang;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class ProdukController extends CustomController
{
    //
    public function index(){

        $produk = Produk::paginate(10);
        $data = [];
        foreach ($produk as $key => $d){
            $data[$key] = $d;
            $laku = Keranjang::with('getPesanan')->where('id_produk', '=', $d->id)->whereHas(
                'getPesanan',
                function ($q) {
                    return $q->where('status_pesanan', '>=', 2);
                }
            )->sum('qty');
            $sisa = (int) $d->stok - (int) $laku;
            Arr::add($data[$key],'sisa', $sisa);
        }
        return view('admin.produk.produk')->with(['data' => $data]);
    }

    public function data(){
        if ($this->request->isMethod('POST')){
            $field = \request()->validate(
                [
                    'nama_produk' => 'required',
                    'deskripsi' => 'required',
                    'harga' => 'required',
                    'id_kategori' => 'required',
                    'stok' => 'required'
                ]
            );

            if ($this->request->get('id')) {
                $produk = Produk::find($this->request->get('id'));
                $produk->update($field);
            } else {
                $produk= Produk::create($field);

            }
            return response()->json([
                'data' => $produk
            ],200);
        }
        $produk = Produk::find($this->request->get('id'));

        return view('admin.produk.addData')->with(['data' => $produk]);
    }

    public function addImage(){
        if ($this->request->isMethod('POST')){
            if ($this->request->get('action') == 2) {
                $this->deleteImg('FotoProduk', $this->request->get('id'), $this->request->get('name'));
                $data = 'Berhasil hapus';
            } else {
                $data = [
                    'id_produk' => $this->request->get('id'),
                    'url_foto'        => $this->saveImg('file'),
                ];
                $res  = FotoProduk::create($data);
                $data = [
                    'id'    => $res['id'],
                    'image' => $res['url_foto'],
                    'size'  => number_format(floor(filesize(public_path($res['url_foto']))) / 1025, 1, '.', '').' KB',
                ];
            }
            return response()->json($data);
        }

        $image = FotoProduk::where('id_produk','=',$this->request->get('id'))->get();
        $data = [];
        foreach ($image as $key => $im) {
            $data[$key] = [
                'id'    => $im['id'],
                'image' => $im['url_foto'],
                'size'  => filesize(public_path($im['url_foto'])),
            ];
        }
        return $data;
    }

    public function saveImg($file)
    {
        $image  = $this->generateImageName($file);
        $string = '/images/produk/'.$image;
        $this->uploadImage($file, $image, 'imageProduk');

        return $string;
    }

    public function deleteImg($model, $id, $name)
    {
        $class = '\\App\\Models\\'.$model;
        $class::destroy($id);
        if (file_exists('../public'.$name)) {
            unlink('../public'.$name);
        }
    }
}
