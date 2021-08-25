<?php

namespace App\Http\Controllers\User;

use App\Helper\CustomController;
use App\Http\Controllers\Controller;
use App\Models\Keranjang;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KeranjangController extends CustomController
{
    //

    public function index()
    {

        $keranjang = Keranjang::where([['id_user', '=', Auth::id()],['id_pesanan','=',null]])->get();
        if (\request()->isMethod('POST')) {
            $dataPesanan = [
                'tanggal_pesanan' => $this->now->format('Y-m-d H-i-s'),
                'alamat_pengiriman' => $this->request->get('alamat'),
                'biaya_pengiriman' => $this->request->get('ongkir'),
                'id_user' => Auth::id(),
                'total_harga' => $this->request->get('totalHarga'),
            ];

            $dataExpedisi = [
                'nama'          => $this->request->get('kurir'),
                'service'       => $this->request->get('service'),
                'estimasi'      => $this->request->get('estimasi'),
                'id_kota'       => $this->request->get('kota'),
                'nama_kota'     => $this->request->get('nama_kota'),
                'id_propinsi'   => $this->request->get('propinsiid'),
                'nama_propinsi' => $this->request->get('propinsi'),
                'biaya'         => $this->request->get('ongkir'),
            ];
            $pesanan = Pesanan::create($dataPesanan);
            $pesanan->getExpedisi()->create($dataExpedisi);
            foreach ($keranjang as $k){
                $k->update(['id_pesanan' => $pesanan->id]);
            }
            response()->json('berhasil');
        }

        $jum       = $keranjang->sum('total_harga');
        $data      = [
            'data'   => $keranjang,
            'jumlah' => $jum,
        ];

        return view('user.keranjang')->with($data);
    }

    public function delete($id){
        Keranjang::destroy($id);
        return response()->json('berhasil');
    }
}
