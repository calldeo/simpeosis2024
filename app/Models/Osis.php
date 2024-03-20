<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Osis extends Model
{
   
        use HasFactory;
        protected $table = 'calon_osis';
        protected $guarded = [];
        protected $primaryKey = 'id_calon';
    

    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_riwayat',
        
        'nama_calon',
        'visimisi',
        'gambar',
        'jumlah_vote',
        
        
    ];
}
