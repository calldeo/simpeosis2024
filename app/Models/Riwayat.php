<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Riwayat extends Authenticatable
{


    
        use HasFactory;
        protected $table = 'tb_riwayat';
        protected $guarded = [];
        protected $primaryKey = 'id_riwayat';
    

    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_riwayat',
        
        'id_siswa',
        'id_kategori_riwayat',
        'id',
        'judul_riwayat',
        'catatan_riwayat',
        
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    // protected $hidden = [
    //     'password',
    //     'remember_token',
    // ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    // protected $casts = [
    //     'email_verified_at' => 'datetime',
    // ];
   
    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }
     public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'id_siswa');
    }
    public function ketpelanggaran()
    {
        return $this->belongsTo(KetPelanggaran::class, 'id_kategori_pelanggaran');
    }
    
}
