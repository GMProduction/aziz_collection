<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DikemasController extends Controller
{
    //
    public function index()
    {
        $pesanan = Pesanan::where([['id_user', '=', Auth::id()], ['status_pesanan', '=', 2]])->get();

        return view('user.dikemas')->with(['data' => $pesanan]);
    }
}
