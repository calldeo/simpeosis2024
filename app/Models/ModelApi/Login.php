<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;

class Login extends Authenticatable
{
    use HasApiTokens,HasFactory, Notifiable;
    protected $primaryKey = 'id_siswa';
    protected $table = 'tb_siswa';
    protected $guard = [];
    protected $fillable = [
        'nisn', 'nama','kelas','email', 'password', 
    ];

    protected $hidden = [
        'password',
    ];

    protected $username = 'email';
    public $timestamps = true;
}
?>


?>