<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $table = 'tbl_user';
    protected $primaryKey = 'id_user';
    public $timestamps = false;

    protected $fillable = [
        'tipe_user',
        'nama',
        'alamat',
        'telpon',
        'username',
        'password'
    ];

    protected $hidden = [
        'password',
    ];

    public function getAuthIdentifierName()
    {
        return 'username';
    }
}