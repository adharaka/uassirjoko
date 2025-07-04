<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
            $user = Auth::user(); // Ini akan mengembalikan instance model tbl_user

            session(['tiket' => true]);
            $request->session()->regenerate();

            DB::table('tbl_log')->insert([
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

    public function logout(Request $request)
    {
        $userId = Auth::id();

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        session()->forget('tiket');

        if ($userId) { 
            DB::table('tbl_log')->insert([
                'waktu' => now(),
                'aktivitas' => 'Logout',
                'id_user' => $userId,
            ]);
        } else {

            DB::table('tbl_log')->insert([
                'waktu' => now(),
                'aktivitas' => 'Logout (ID tidak tersedia)',
                'id_user' => null,
            ]);
        }

        return redirect('/login');
    }
}