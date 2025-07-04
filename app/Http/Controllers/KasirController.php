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
        $keranjang = session('keranjang', []);
        $total_harga = array_sum(array_column($keranjang, 'subtotal'));
        return view('kasir_transaksi', compact('barangs', 'no_transaksi', 'keranjang', 'total_harga'));
    }

    public function tambahKeranjang(Request $request)
    {
        $request->validate([
            'id_barang' => 'required|exists:tbl_barang,id_barang',
            'qty' => 'required|integer|min:1',
        ]);

        $barang = Barang::findOrFail($request->id_barang);
        $keranjang = session('keranjang', []);

        $found = false;
        foreach ($keranjang as &$item) {
            if ($item['id_barang'] == $barang->id_barang) {
                $item['qty'] += $request->qty;
                $item['subtotal'] = $item['qty'] * $barang->harga_satuan;
                $found = true;
                break;
            }
        }
        unset($item);

        if (!$found) {
            $keranjang[] = [
                'id_barang' => $barang->id_barang,
                'kode_barang' => $barang->kode_barang,
                'nama_barang' => $barang->nama_barang,
                'harga_satuan' => $barang->harga_satuan,
                'qty' => $request->qty,
                'subtotal' => $barang->harga_satuan * $request->qty,
            ];
        }

        session(['keranjang' => $keranjang]);
        return redirect()->back()->with('success', 'Barang ditambahkan ke keranjang!');
    }

    public function resetKeranjang()
    {
        session()->forget('keranjang');
        return redirect()->back()->with('success', 'Keranjang dikosongkan!');
    }

    public function simpan(Request $request)
    {
        $request->validate([
            'no_transaksi' => 'required',
            'tgl_transaksi' => 'required|date',
            'bayar' => 'required|integer|min:1',
        ]);

        $keranjang = session('keranjang', []);
        if (empty($keranjang)) {
            return redirect()->back()->with('error', 'Keranjang masih kosong!');
        }

        $total_harga = array_sum(array_column($keranjang, 'subtotal'));
        if ($request->bayar < $total_harga) {
            return redirect()->back()->with('error', 'Jumlah bayar kurang dari total!');
        }

        foreach ($keranjang as $item) {
            Transaksi::create([
                'no_transaksi'   => $request->no_transaksi,
                'tgl_transaksi'  => $request->tgl_transaksi,
                'total_bayar'    => $item['subtotal'],
                'id_user'        => Auth::user()->id_user,
                'id_barang'      => $item['id_barang'],
                'qty'            => $item['qty'],
            ]);
        }

        session()->forget('keranjang');
        return redirect()->route('kasir.transaksi')->with('success', 'Transaksi berhasil disimpan!');
    }
}