<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PrincipalController extends Controller
{
    public function index(){
        $user = auth() -> user();

        return view('principal', compact('user'));
    }

    public function tambahData(Request $request)
    {
        $jenis = $request->get('jenis');
        $nama = $request->get('nama');
        $alamat = $request->get('alamat');
        $tglLahir = $request->get('tglLahir');
        $sex = $request->get('sex');
        $noTelp = $request->get('noTelp');
        $kelas = $request->get('kelas');
        $username = $request->get('username');
        $password = $request->get('password');

                

        return response()->json(array(
            'message' => "success",        
        ), 200);
    }
}