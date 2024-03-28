<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Siswa extends Authenticatable
{


    
        use HasFactory;
        use SoftDeletes;
        protected $table = 'tb_siswa';

        protected $guarded ='tb_siswa';


        protected $primaryKey = 'id_siswa';
    

    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nisn',
        'nama',
        'kelas',
        'email',
        'password',
        
        

        // 'api_token',

        'api_token',

    ];
   
    protected $hidden = [
        // 'password',
        // 'remember_token',
       
    ];
}
