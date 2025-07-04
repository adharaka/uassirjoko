<?php

// routes/web.php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\GudangController;
use App\Http\Controllers\KasirController;
use App\Http\Middleware\MyCustomMiddleware;


Route::get('/', function () {
    return view('login');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->middleware('guest')->name('login');
Route::post('/login', [AuthController::class, 'login'])->middleware('guest');


Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(MyCustomMiddleware::class)->group(function () {

    // Rute Admin
    Route::get('/admin/log', [AdminController::class, 'logActivity'])->name('admin.log');
    Route::get('/admin/user', [AdminController::class, 'kelolaUser'])->name('kelola.user');
    Route::post('/admin/user', [AdminController::class, 'simpanUser'])->name('kelola.user.simpan');
    Route::delete('/admin/user/{id}', [AdminController::class, 'hapusUser'])->name('kelola.user.hapus');
    Route::post('/admin/user/update', [AdminController::class, 'updateUser'])->name('kelola.user.update');
    Route::get('/admin/laporan', [AdminController::class, 'kelolaLaporan'])->name('kelola.laporan');

    // ROUTE KELENGKAPAN GUDANG
    Route::get('/gudang/barang', [GudangController::class, 'index'])->name('gudang.barang');
    Route::post('/gudang/barang', [GudangController::class, 'simpan'])->name('gudang.barang.simpan');
    Route::post('/gudang/barang/update', [GudangController::class, 'update'])->name('gudang.barang.update');
    Route::delete('/gudang/barang/{id}', [GudangController::class, 'hapus'])->name('gudang.barang.hapus');

    // KASIR
    Route::get('/kasir/transaksi', [KasirController::class, 'index'])->name('kasir.transaksi');
    Route::post('/kasir/keranjang/tambah', [KasirController::class, 'tambahKeranjang'])->name('kasir.keranjang.tambah');
    Route::get('/kasir/keranjang/reset', [KasirController::class, 'resetKeranjang'])->name('kasir.keranjang.reset');
    Route::post('/kasir/transaksi/simpan', [KasirController::class, 'simpan'])->name('kasir.transaksi.simpan');

    Route::get('/kasir/form', fn() => 'Kelola Form Kasir')->name('kasir.form');

});