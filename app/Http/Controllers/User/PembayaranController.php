<?php

namespace App\Http\Controllers\User;

use App\Helper\CustomController;
use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\Kategori;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class PembayaranController extends CustomController
{
    //
    public function index()
    {
        if (\request()->isMethod('POST')) {
            $id    = $this->request->get('id');
            $field = [
                'id_bank'            => \request('bank'),
                'tanggal_pembayaran' => $this->now->format('Y-m-d H-i-s'),
                'status_pesanan'     => 1,
            ];
            $img   = $this->request->files->get('image');

            if ($img || $img != '') {
                $image     = $this->generateImageName('image');
                $stringImg = '/images/bukti/'.$image;
                $this->uploadImage('image', $image, 'imageBukti');
                $field = Arr::add($field, 'url_pembayaran', $stringImg);
            }
            $pesanan = Pesanan::find($id);
            if ($pesanan->url_pembayaran) {
                if (file_exists('../public'.$pesanan->url_pembayaran)) {
                    unlink('../public'.$pesanan->url_pembayaran);
                }
            }

            $pesanan->update($field);

            return response()->json('Berhasil');

        }
        $pesanan = Pesanan::where([['id_user', '=', Auth::id()],['status_pesanan','=',0]])->get();
        $bank = Bank::all();
        $data = [
            'data' => $pesanan,
            'bank' => $bank
        ];
        return view('user.pembayaran')->with($data);
    }
}
