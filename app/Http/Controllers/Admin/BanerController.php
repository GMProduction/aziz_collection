<?php

namespace App\Http\Controllers\Admin;

use App\Helper\CustomController;
use App\Http\Controllers\Controller;
use App\Models\Baner;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class BanerController extends CustomController
{
    //
    public function index(){
        if ($this->request->isMethod('POST')){
            $img = $this->request->files->get('url_gambar');
            $field = [
              'url_web' => $this->request->get('url_web')
            ];
            if ($img || $img != '') {
                $image     = $this->generateImageName('url_gambar');
                $stringImg = '/images/baner/'.$image;
                $this->uploadImage('url_gambar', $image, 'imageBaner');
                $field = Arr::add($field, 'url_gambar', $stringImg);
            }
            if ($this->request->get('id')){
                $baner = Baner::find($this->request->get('id'));
                if ($img && $baner->url_gambar){
                    if (file_exists('../public'.$baner->url_gambar)) {
                        unlink('../public'.$baner->url_gambar);
                    }
                }
                $baner->update($field);
            }else{
                Baner::create($field);
            }
            return response()->json([
                'msg' => 'berhasil'
            ],200);
        }
        $baner = Baner::paginate(10);
        return view('admin.baner.baner')->with(['data' => $baner]);
    }

    function delete($id){
        Baner::destroy($id);
        return response()->json('berhasil');
    }
}
