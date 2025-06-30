<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'tbl_transaksi';
    protected $primaryKey = 'id_transaksi';
    public $timestamps = false;

    protected $fillable = [
        'no_transaksi',
        'tgl_transaksi',
        'total_bayar',
        'id_user',
        'id_barang',
    ];

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang', 'id_barang');
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'id_user', 'id_user');
    }
}