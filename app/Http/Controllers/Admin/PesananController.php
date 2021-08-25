<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pesanan;
use Illuminate\Http\Request;

class PesananController extends Controller
{
    //
    public function index(){
        $status = \request('status');
        $codeStatus = null;
        $pesanan = Pesanan::with('getPelanggan');

        if ($status){
            if ($status == 'Menunggu Pembayaran'){
                $codeStatus = 0;
            }elseif ($status == 'Menunggu Konfirmasi'){
                $codeStatus = 1;
            }elseif ($status == 'Diproses'){
                $codeStatus = 2;
            }elseif ($status == 'Dikirim'){
                $codeStatus = 3;
            }elseif ($status == 'Selesai'){
                $codeStatus = 4;
            }elseif ($status == 'Dikembalikan'){
                $codeStatus = 5;
            }
            $pesanan->where('status_pesanan','=',$codeStatus);
        }
        $pesanan = $pesanan->paginate(10);

        return view('admin.pesanan.pesanan')->with(['data' => $pesanan]);
    }

    public function getDetailPesanan($id){
        if (\request()->isMethod('POST')){
            $pesanan = Pesanan::find($id);
            $pesanan->update(['status_pesanan' => \request('status')]);
            return response()->json('berhasil');
        }
        $pesanan = Pesanan::with('getPelanggan')->find($id);
        return $pesanan;
    }

    public function konfirmasiRetur($id){
        $pesanan = Pesanan::find($id);
        if (\request('status') == 1){
            $pesanan->update(['status_pesanan' => 5]);
        }
        $pesanan->getRetur()->update(['status' => \request('status')]);
        return response()->json('berhasil');
    }


}
