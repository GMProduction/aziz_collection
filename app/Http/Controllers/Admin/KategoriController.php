<?php

namespace App\Http\Controllers\Admin;

use App\Helper\CustomController;
use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class KategoriController extends CustomController
{
    //
    public function index(){
        $kategori = Kategori::paginate(10);
        return view('admin.kategori.kategori')->with(['data' => $kategori]);
    }

    public function dataKategori()
    {
        $kategori = Kategori::all();

        return $kategori;
    }

    public function addKategori()
    {
        $field = \request()->validate(
            [
                'nama_kategori' => 'required',
            ]
        );

        $img = $this->request->files->get('url_foto');
        if ($img || $img != '') {
            $image     = $this->generateImageName('url_foto');
            $stringImg = '/images/kategori/'.$image;
            $this->uploadImage('url_foto', $image, 'imageKategori');
            $field = Arr::add($field, 'url_foto', $stringImg);
        }
        if ($this->request->get('id')) {
            $kategori = Kategori::find($this->request->get('id'));
            if ($img && $kategori->url_foto){
                if (file_exists('../public'.$kategori->url_foto)) {
                    unlink('../public'.$kategori->url_foto);
                }
            }
            $kategori->update($field);
        } else {
            Kategori::create($field);

        }
        return response()->json([
            'msg' => 'berhasil'
        ],200);
    }
}
