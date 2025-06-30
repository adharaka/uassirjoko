<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $table = 'tbl_barang';
    protected $primaryKey = 'id_barang';
    public $timestamps = false;

    protected $fillable = [
        'kode_barang',
        'nama_barang',
        'expired_date',
        'jumlah_barang',
        'satuan',
        'harga_satuan',
    ];
}