<?php

namespace App\Http\Controllers;

use App\Helper\CustomController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends CustomController
{
    //
    //
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function registerMember()
    {
        $fieldUser = $this->request->validate(
            [
                'username' => 'required|string|unique:users,username',
                'password' => 'required|string|confirmed',
            ]
        );

        $fieldMember = $this->request->validate(
            [
                'nama'   => 'required|string',
                'alamat' => 'required',
                'no_hp'  => 'required',
            ]
        );
        $number = strpos($fieldMember['no_hp'],"0") == 0 ? preg_replace('/0/','62',$fieldMember['no_hp'],1) : $fieldMember['no_hp'];


        $user = User::create(
            [
                'username' => $fieldUser['username'],
                'roles'    => 'user',
                'password' => Hash::make($fieldUser['password']),
                'nama'     => $fieldMember['nama'],
                'alamat'   => $fieldMember['alamat'],
                'no_hp'    => $number,
            ]
        );

        Auth::loginUsingId($user->id);

        return $this->jsonResponse(['msg' => 'berhasil mendaftar'], 200);

    }

    /**
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function login()
    {
        $credentials = [
            'username' => $this->request->get('username'),
            'password' => $this->request->get('password'),
        ];
        if ($this->isAuth($credentials)) {
            $redirect = '/';
            if (Auth::user()->roles === 'admin') {
                return redirect('/admin');
            }

            return redirect()->back();
        }

        return response()->json(['msg' => 'Login gagal'],201);
    }

    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function logout()
    {
        Auth::logout();

        return redirect('/');
    }
}
