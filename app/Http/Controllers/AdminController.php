<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function logActivity(Request $request)
    {
        $query = \DB::table('tbl_log');
        if ($request->filled('tanggal')) {
            $query->whereDate('waktu', $request->tanggal);
        }
        $logs = $query->orderBy('waktu', 'desc')->get();
        return view('admin_log', compact('logs'));
    }
    public function kelolaUser(Request $request)
    {
        $query = \App\Models\User::query()->whereIn('tipe_user', ['Gudang', 'Kasir']);

        if ($request->filled('cari')) {
            $query->where('nama', 'like', '%' . $request->cari . '%');
        }

        $users = $query->orderBy('id_user', 'asc')->get();

        return view('kelola_user', compact('users'));
    }
    public function hapusUser($id)
    {
        $user = \App\Models\User::findOrFail($id);
        $user->delete();

        return redirect()->route('kelola.user')->with('success', 'User berhasil dihapus.');
    }
    public function updateUser(Request $request)
    {
        $request->validate([
            'id_user' => 'required|exists:tbl_user,id_user',
            'tipe_user' => 'required',
            'nama' => 'required',
            'alamat' => 'required',
            'telpon' => 'required',
            'username' => 'required',
        ]);

        $user = \App\Models\User::findOrFail($request->id_user);
        $user->tipe_user = $request->tipe_user;
        $user->nama = $request->nama;
        $user->alamat = $request->alamat;
        $user->telpon = $request->telpon;
        $user->username = $request->username;
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }
        $user->save();

        return redirect()->route('kelola.user')->with('success', 'User berhasil diupdate.');
    }
    public function simpanUser(Request $request)
    {
        $request->validate([
            'tipe_user' => 'required',
            'nama' => 'required',
            'alamat' => 'required',
            'telpon' => 'required',
            'username' => 'required|unique:tbl_user,username',
            'password' => 'required|min:4',
        ]);

        \App\Models\User::create([
            'tipe_user' => $request->tipe_user,
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'telpon' => $request->telpon,
            'username' => $request->username,
            'password' => bcrypt($request->password),
        ]);

        return redirect()->route('kelola.user')->with('success', 'User berhasil ditambahkan.');
    }
    public function kelolaLaporan(Request $request) {
        $query = \DB::table('tbl_transaksi')
            ->join('tbl_user', 'tbl_transaksi.id_user', '=', 'tbl_user.id_user')
            ->select('tbl_transaksi.*', 'tbl_user.nama as nama_kasir');

        if ($request->filled('tanggal_awal')) {
            $query->whereDate('tgl_transaksi', '>=', $request->tanggal_awal);
        }
        if ($request->filled('tanggal_akhir')) {
            $query->whereDate('tgl_transaksi', '<=', $request->tanggal_akhir);
        }

        $laporan = $query->orderBy('tgl_transaksi')->get();

        // Data chart: omzet per tanggal
        $chartData = $laporan->groupBy('tgl_transaksi')->map(function($rows, $tgl) {
            return [
                'label' => \Carbon\Carbon::parse($tgl)->format('d/m/Y'),
                'value' => $rows->sum('total_bayar')
            ];
        })->values();

        return view('kelola_laporan', compact('laporan', 'chartData'));
    }
}