<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            $user = Auth::user();

            // Tambahkan log aktivitas login
            \DB::table('tbl_log')->insert([
                'waktu' => now(),
                'aktivitas' => 'Login',
                'id_user' => $user->id_user
            ]);

            if ($user->tipe_user == 'Admin') {
                return redirect()->route('admin.log');
            } elseif ($user->tipe_user == 'Gudang') {
                return redirect()->route('gudang.barang');
            } elseif ($user->tipe_user == 'Kasir') {
                return redirect()->route('kasir.transaksi');
            }
        }

        return back()->withErrors(['login' => 'Username atau password yang anda masukkan tidak sesuai!'])->withInput();
    }
}
