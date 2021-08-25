<?php

namespace App\Http\Controllers\Admin;

use App\Helper\CustomController;
use App\Http\Controllers\Controller;
use App\Models\Bank;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class BankController extends CustomController
{
    //

    public function index()
    {
        if ($this->request->isMethod('POST')){
            $field = \request()->validate(
                [
                    'holder_bank' => 'required',
                    'nama_bank' => 'required',
                    'norek' => 'required',
                ]
            );

            $img = $this->request->files->get('url_gambar');
            if ($img || $img != '') {
                $image     = $this->generateImageName('url_gambar');
                $stringImg = '/images/bank/'.$image;
                $this->uploadImage('url_gambar', $image, 'imageBank');
                $field = Arr::add($field, 'url_gambar', $stringImg);
            }
            if ($this->request->get('id')) {
                $bank = Bank::find($this->request->get('id'));
                if ($img && $bank->url_gambar){
                    if (file_exists('../public'.$bank->url_gambar)) {
                        unlink('../public'.$bank->url_gambar);
                    }
                }
                $bank->update($field);
            } else {
                Bank::create($field);

            }
            return response()->json([
                'msg' => 'berhasil'
            ],200);
        }
        $bank = Bank::paginate(10);
        return view('admin.bank.bank')->with(['data' => $bank]);
    }

    public function getBank(){
        $bank = Bank::all();
        return $bank;
    }
}
