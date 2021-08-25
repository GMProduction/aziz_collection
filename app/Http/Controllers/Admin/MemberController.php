<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    //
    public function index(){
        $user = User::where('roles','=','user')->get();
        return view('admin.pelanggan.pelanggan')->with(['data' => $user]);
    }
}
