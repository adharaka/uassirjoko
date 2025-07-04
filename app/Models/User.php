<?php



namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'tbl_user'; 
    protected $primaryKey = 'id_user'; 
    public $incrementing = true; 
    protected $keyType = 'int'; 
    protected $fillable = [
        'tipe_user', 'nama', 'alamat', 'telpon', 'username', 'password',
    ];
    protected $hidden = [
        'password',
    ];
    public $timestamps = false;
}