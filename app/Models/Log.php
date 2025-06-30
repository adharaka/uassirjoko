<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $table = 'tbl_log';
    protected $primaryKey = 'id_log';
    public $timestamps = false;

    protected $fillable = [
        'waktu',
        'aktivitas',
        'id_user'
    ];
}