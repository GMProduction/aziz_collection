<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SelesaiController extends Controller
{
    //

    public function index(){
        $pesanan = Pesanan::where([['id_user', '=', Auth::id()],['status_pesanan','=',4]])->get();

        return view('user.selesai')->with(['data' => $pesanan]);
    }
}
