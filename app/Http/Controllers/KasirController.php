<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\Barang;
use Illuminate\Support\Facades\Auth;

class KasirController extends Controller
{
    public function index()
    {
        $barangs = Barang::orderBy('nama_barang')->get();
        $no_transaksi = 'TRX' . date('YmdHis');
        return view('kasir_transaksi', compact('barangs', 'no_transaksi'));
    }

    public function simpan(Request $request)
    {
        $request->validate([
            'no_transaksi' => 'required',
            'tgl_transaksi' => 'required|date',
            'total_bayar' => 'required|integer|min:1',
            'id_barang' => 'required|exists:tbl_barang,id_barang',
        ]);

        Transaksi::create([
            'no_transaksi'   => $request->no_transaksi,
            'tgl_transaksi'  => $request->tgl_transaksi,
            'total_bayar'    => $request->total_bayar,
            'id_user'        => Auth::user()->id_user,
            'id_barang'      => $request->id_barang,
        ]);

        return redirect()->route('kasir.transaksi')->with('success', 'Transaksi berhasil disimpan!');
    }
}