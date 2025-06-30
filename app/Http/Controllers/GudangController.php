<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;

class GudangController extends Controller
{
    public function index(Request $request)
    {
        $query = Barang::query();

        if ($request->filled('cari')) {
            $query->where('nama_barang', 'like', $request->cari . '%');
        }

        $barangs = $query->orderBy('id_barang', 'asc')->get();

        return view('gudang_barang', compact('barangs'));
    }

    public function simpan(Request $request)
    {
        $request->validate([
            'kode_barang' => 'required',
            'nama_barang' => 'required',
            'jumlah_barang' => 'required|integer|min:1',
            'satuan' => 'required',
            'expired_date' => 'required|date',
            'harga_satuan' => 'required|integer|min:1',
        ]);

        Barang::create($request->all());

        return redirect()->route('gudang.barang')->with('success', 'Barang berhasil ditambahkan.');
    }

    public function update(Request $request)
    {
        $request->validate([
            'id_barang' => 'required|exists:tbl_barang,id_barang',
            'kode_barang' => 'required',
            'nama_barang' => 'required',
            'jumlah_barang' => 'required|integer|min:1',
            'satuan' => 'required',
            'expired_date' => 'required|date',
            'harga_satuan' => 'required|integer|min:1',
        ]);

        $barang = Barang::findOrFail($request->id_barang);
        $barang->update($request->all());

        return redirect()->route('gudang.barang')->with('success', 'Barang berhasil diupdate.');
    }

    public function hapus($id)
    {
        $barang = Barang::findOrFail($id);
        $barang->delete();

        return redirect()->route('gudang.barang')->with('success', 'Barang berhasil dihapus.');
    }
}