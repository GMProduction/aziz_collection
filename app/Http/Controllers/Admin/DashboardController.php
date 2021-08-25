<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pesanan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //

    public function index(){
        $baru = Pesanan::where('status_pesanan','=',1)->latest()->get();
        $kirim = Pesanan::where('status_pesanan','=',2)->latest()->get();

        $data  = [
            'data' => $baru,
            'proses' => $kirim
        ];

        return view('admin.dashboard')->with($data);
    }
}
