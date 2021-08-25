<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MenungguController extends Controller
{
    //

    public function index(){
        $pesanan = Pesanan::with('getBank')->where([['id_user', '=', Auth::id()],['status_pesanan','=',1]])->get();

        return view('user.menunggu')->with(['data' => $pesanan]);
    }
}
